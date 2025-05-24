<?php
session_start();
include '../db/db.php';

$name = $email = $gender = $address = "";
$pet = "";
$desired_items = [];
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $pet = $_POST['pet'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $address = trim($_POST['address']);
    $desired_items = $_POST['desired_items'] ?? [];

    if (empty($name)) {
        $errors[] = "Name is required";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM buyers WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "Email is already registered";
            $stmt->close();
        } else {
            $stmt->close();
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $items = implode(',', $desired_items);
            $stmt = $conn->prepare("INSERT INTO buyers (name, email, password, pet, gender, address, desired_items) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $name, $email, $hashed_password, $pet, $gender, $address, $items);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Registered successfully! Please login.";
                header("Location: ../view/login.php");
                exit();
            } else {
                $errors[] = "Registration failed. Please try again.";
            }
            $stmt->close();
        }
    }

    
    $_SESSION['register_data'] = [
        'name' => $name,
        'email' => $email,
        'pet' => $pet,
        'gender' => $gender,
        'address' => $address,
        'desired_items' => $desired_items,
        'errors' => $errors
    ];

    header("Location: ../view/register.php");
    exit();
}
?>
