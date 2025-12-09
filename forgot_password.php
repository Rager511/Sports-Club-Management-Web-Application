<?php
session_start();
include './include/db_conn.php';

$status = '';
$message = '';
$redirect = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id_auth = trim($_POST['login_id'] ?? '');
    $secure_key   = trim($_POST['login_key'] ?? '');
    $new_pass     = trim($_POST['pwfield'] ?? '');
    $confirm_pass = trim($_POST['confirmfield'] ?? '');

    if (empty($user_id_auth) || empty($secure_key) || empty($new_pass) || empty($confirm_pass)) {
        $status = 'error';
        $message = 'All fields are required';
    } elseif ($new_pass !== $confirm_pass) {
        $status = 'error';
        $message = 'Confirm Password Mismatch';
    } else {
        $stmt = $con->prepare("SELECT username FROM admin WHERE username=? AND securekey=?");
        $stmt->bind_param("ss", $user_id_auth, $secure_key);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
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
}
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sports Club | Change Password</title>
<link rel="stylesheet" href="./css/entypo.css">
<style>
* { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Roboto', sans-serif; }
body { height: 100vh; background-color: #d2d9e0; display: flex; justify-content: center; align-items: center; }
.login-wrapper { background: #6c8397; padding: 40px 30px; border-radius: 12px; box-shadow: 0 8px 25px rgba(0,0,0,0.7); width: 100%; max-width: 450px; color: #6c8397; text-align: center; }
.login-wrapper img.logo { width: 120px; margin-bottom: 20px; }
.login-wrapper h2 { margin-bottom: 20px; font-size: 24px; color: #f5f5f5; }
.form-group { margin-bottom: 20px; }
.input-group { display: flex; align-items: center; background: #3a3a3a; border-radius: 6px; overflow: hidden; }
.input-group-addon { padding: 10px 12px; background: #444; color: #4db6ac; display: flex; align-items: center; justify-content: center; }
.input-group input { flex: 1; padding: 10px; border: none; background: transparent; color: #fff; font-size: 16px; }
.input-group:focus-within { box-shadow: 0 0 8px 2px #4db6ac; border-radius: 6px; transition: box-shadow 0.3s ease; }
.input-group input::placeholder { color: #fff; }
.btn { width: 100%; padding: 12px; background-color: #a4b4c4; border: none; border-radius: 6px; color: #000; font-weight: bold; cursor: pointer; display: flex; align-items: center; justify-content: center; margin-bottom: 10px; }
.btn:hover {background-color: #4db6ac; color: #fff}
.btn i { margin-left: 8px; }
.cancel-btn { background-color: #d3d3d3; color: #000; }
.cancel-btn:hover { background-color: #c0c0c0; }
.toast-message { position: fixed; top: 20px; right: 20px; padding: 12px 20px; border-radius: 8px; font-weight: bold; z-index: 1000; opacity: 0; transform: translateY(-50px); animation: slideIn 0.5s forwards, fadeOut 0.5s 3s forwards; }
.toast-message.error { background-color: #ff4c4c; color: #fff; }
.toast-message.success { background-color: #32CD32; color: #fff; }
@keyframes slideIn { to { opacity: 1; transform: translateY(0); } }
@keyframes fadeOut { to { opacity: 0; transform: translateY(-50px); } }
</style>
</head>
<body>

<div class="login-wrapper">
    <img src="./images/msc_logo_Blanc-1.png" class="logo" alt="Sports Club Logo">
    <h2>Change Your Password</h2>

    <form method="POST">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="entypo-user"></i></div>
                <input type="text" name="login_id" placeholder="Your Login ID" required minlength="6"/>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="entypo-key"></i></div>
                <input type="text" name="login_key" placeholder="Your secret key" required minlength="6">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="entypo-key"></i></div>
                <input type="password" name="pwfield" id="pwfield" placeholder="Your new password" required minlength="6">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="entypo-key"></i></div>
                <input type="password" name="confirmfield" id="confirmfield" placeholder="Confirm your new password" required minlength="6">
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn">Submit <i class="entypo-login"></i></button>
            <a href="./index.php"><button type="button" class="btn cancel-btn">Cancel</button></a>
        </div>
    </form>
</div>

<?php if($status): ?>
<div class="toast-message <?= $status ?>">
    <?= $message ?>
</div>
<?php endif; ?>

<?php if(!empty($redirect)): ?>
<script>
setTimeout(() => { window.location.href = "<?= $redirect ?>"; }, 2000);
</script>
<?php endif; ?>

</body>
</html>
