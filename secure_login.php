<?php
if(session_status() == PHP_SESSION_NONE) session_start();
include './include/db_conn.php';

$user_id_auth = trim($_POST['user_id_auth'] ?? '');
$pass_key     = trim($_POST['pass_key'] ?? '');

// Empty check
if(empty($user_id_auth) || empty($pass_key)){
    header('Location: index.php?error=empty');
    exit;
}

// Use prepared statements
$stmt = $con->prepare("SELECT * FROM admin WHERE username=?");
$stmt->bind_param("s", $user_id_auth);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Check password (assuming plain text, if hashed use password_verify)
if($row && $pass_key === $row['pass_key']){
    $_SESSION['user_data'] = $user_id_auth;
    $_SESSION['logged']    = "start";
    $_SESSION['full_name'] = $row['Full_name'];
    $_SESSION['username']  = $row['Full_name'];

    header("Location: ./dashboard/admin/");
    exit;
} else {
    header('Location: index.php?error=invalid');
    exit;
}
?>
