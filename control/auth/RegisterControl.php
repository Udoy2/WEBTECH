<?php 
session_start();
include_once '../../db/database.php';
include_once '../../model/UserModel.php';

function registerUser($name, $email, $username, $phone, $userType, $password) {
    // Check if email or username already exists
    if (getUserByEmail($email) || getUserByUsername($username)) {
        return false;
    }
    
    // Create new user
    return createUser($name, $email, $username, $phone, $userType, $password);
}

if (registerUser($_POST['name'], $_POST['email'], $_POST['username'], $_POST['phone'], $_POST['userType'], $_POST['password'])) {
    // Registration successful
    header("Location: ../../view/auth/login.php");
} else {
    // Registration failed
    echo "<script>alert('Registration failed. Email or username already exists.'); window.location.href='../../view/auth/register.php';</script>";
}

?>