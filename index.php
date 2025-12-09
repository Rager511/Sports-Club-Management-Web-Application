<?php
if(session_status() == PHP_SESSION_NONE) session_start();

if(isset($_SESSION["user_data"])) {
    header("Location: ./dashboard/admin/");
    exit;
}

$errorMessage = '';
if(isset($_GET['error'])) {
    if($_GET['error'] === 'empty') $errorMessage = "Username and Password cannot be empty!";
    if($_GET['error'] === 'invalid') $errorMessage = "Username or Password is invalid!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sports Club | Login</title>
<link rel="stylesheet" href="./css/entypo.css">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Roboto', sans-serif;
}

body {
    height: 100vh;
    background-color: #d2d9e0; 
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-wrapper {
    background: #6c8397; /* bluish-gray card */
    padding: 40px 30px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.7);
    width: 100%;
    max-width: 400px;
    color: #f5f5f5; 
    text-align: center;
}

.login-wrapper h2 {
    margin-bottom: 20px;
    font-size: 28px;
    color: #f5f5f5;
}

.login-wrapper img.logo {
    width: 120px;
    margin-bottom: 20px;
}


.login-wrapper p.description {
    font-size: 14px;
    margin-bottom: 30px;
    color: #fff;
}

.form-group {
    margin-bottom: 20px;
}

.toast-message {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #ff4c4c; 
    color: #fff;
    padding: 12px 20px;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    font-weight: bold;
    z-index: 1000;
    opacity: 0;
    transform: translateY(-50px);
    animation: slideIn 0.5s forwards, fadeOut 0.5s 3s forwards;
}

@keyframes slideIn {
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeOut {
    to { opacity: 0; transform: translateY(-50px); }
}


.input-group {
    display: flex;
    align-items: center;
    background: #3a3a3a; 
    border-radius: 6px;
    overflow: hidden;
}

.input-group-addon {
    padding: 10px 12px;
    background: #444;
    color: #4db6ac;
    display: flex;
    align-items: center;
    justify-content: center;
}

.input-group input {
    flex: 1;
    padding: 10px;
    border: none;
    background: transparent;
    color: #fff;
    font-size: 16px;
}

.input-group:focus-within {
    box-shadow: 0 0 8px 2px #4db6ac; 
    border-radius: 6px; 
    transition: box-shadow 0.3s ease;
}


.input-group input::placeholder {
    color: #fff;
}

.btn {
    width: 100%;
    padding: 12px;
    background-color: #a4b4c4; 
    border: none;
    border-radius: 6px;
    color: #fff; 
    font-weight: bold;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn i {
    margin-left: 8px;
}

.btn:hover {
    background-color: #4db6ac;
}

.login-bottom-links {
    margin-top: 15px;
}

.login-bottom-links a {
    color: #fff;
    text-decoration: none;
    font-size: 13px;
}

.login-bottom-links a:hover {
    text-decoration: underline;
}
</style>
</head>
<body>
<div class="login-wrapper">
    <img src="./images/msc_logo_Blanc-1.png" class="logo" alt="Sports Club Logo">
    <h2>WELCOME TO SPORTS CLUB</h2>
    <p class="description">Dear user, log in to access the admin area!</p>

    <form action="secure_login.php" method="post" id="bb">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="entypo-user"></i></div>
                <input type="text" name="user_id_auth" placeholder="User ID" required minlength="6" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="entypo-key"></i></div>
                <input type="password" name="pass_key" placeholder="Password" required minlength="6" autocomplete="off">
            </div>
        </div>

        <?php if($errorMessage): ?>
        <div class="toast-message"><?= $errorMessage ?></div>
        <script>
            setTimeout(() => {
                document.querySelector('.toast-message').style.display = 'none';
                history.replaceState({}, document.title, window.location.pathname);
            }, 4000);
        </script>
        <?php endif; ?>

        <div class="form-group">
            <button type="submit" name="btnLogin" class="btn">Login <i class="entypo-login"></i></button>
        </div>
    </form>

    <div class="login-bottom-links">
        <a href="forgot_password.php">Forgot your password?</a>
    </div>
    <?php if($errorMessage): ?>
    <div class="toast-message" id="toast"><?= $errorMessage ?></div>
    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast');
            if(toast) toast.style.display = 'none';
        }, 4000); 
    </script>
    <?php endif; ?>
</div>
</body>
</html>
