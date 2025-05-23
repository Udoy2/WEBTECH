<?php
session_start();
require_once '../../model/UserModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrEmail = $_POST['username'];
    $password = $_POST['password'];
    
    $user = loginUser($usernameOrEmail, $password);
    
    if ($user) {
        // Login successful
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['userType'] = $user['userType'];
        
        // Redirect based on user type
        if ($user['userType'] === 'buyer') {
            header("Location: ../../view/post/buyer.php");
        } else {
            header("Location: ../../view/post/seller.php");
        }
        exit();
    } else {
        // Login failed
        $_SESSION['login_error'] = "Invalid username/email or password";
        header("Location: ../../view/auth/login.php");
        exit();
    }
}
?>