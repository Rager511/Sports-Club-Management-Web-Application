<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

$host     = "localhost"; 
$username = "root";      
$password = "";          
$db_name  = "sports_club"; 

$con = mysqli_connect($host, $username, $password, $db_name);

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

/**
 * Protect pages from unauthorized access
 */
function page_protect() {
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    // Check if user is logged in
    if(!isset($_SESSION['user_data']) || !isset($_SESSION['logged'])) {
        // Not logged in, redirect to login
        header('Location: ../../index.php');
        exit;
    }
}
?>
