<?php
session_start();
include '../db/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email.";
    } else {
        $stmt = $conn->prepare("SELECT id, name, password FROM buyers WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $name, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['buyer_id'] = $id;
                $_SESSION['buyer_name'] = $name;
                header("Location: ../view/dashboard.php");
                exit();
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "No user found with this email.";
        }
        $stmt->close();
    }
    
    $_SESSION['error'] = $error;
    $_SESSION['old_email'] = $email;
    header("Location: ../view/login.php");
    exit();
}
