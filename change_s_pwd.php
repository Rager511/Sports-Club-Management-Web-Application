<?php
session_start();
include './include/db_conn.php';

// Get POST data
$user_id_auth = trim($_POST['login_id'] ?? '');
$secure_key   = trim($_POST['login_key'] ?? '');
$new_pass     = trim($_POST['pwfield'] ?? '');
$confirm_pass = trim($_POST['confirmfield'] ?? '');

// Basic validation
if (empty($user_id_auth) || empty($secure_key) || empty($new_pass) || empty($confirm_pass)) {
    $status = 'error';
    $message = 'All fields are required';
} elseif ($new_pass !== $confirm_pass) {
    $status = 'error';
    $message = 'Confirm Password Mismatch';
} else {
    // Check if user exists with secure key
    $stmt = $con->prepare("SELECT username FROM admin WHERE username=? AND securekey=?");
    $stmt->bind_param("ss", $user_id_auth, $secure_key);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Update password
        $update_stmt = $con->prepare("UPDATE admin SET pass_key=? WHERE username=?");
        $update_stmt->bind_param("ss", $new_pass, $user_id_auth);
        if ($update_stmt->execute()) {
            $status = 'success';
            $message = 'Password updated successfully. Redirecting to login...';
            $redirect = 'http://localhost/sportsclub/index.php';
        } else {
            $status = 'error';
            $message = 'Failed to update password.';
        }
        $update_stmt->close();
    } else {
        $status = 'error';
        $message = 'Invalid username or secure key.';
    }
    $stmt->close();
}
$con->close();
?>