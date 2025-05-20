<?php
$name ="";
$email ="";
$address =""; 
$gender = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";

    if (empty($name) || strlen($name) < 3) {
        $errors[] = "Name must be at least 3 characters long.";
    }

    if (empty($email) || strpos($email, "gmail") === false) {
        $errors[] = "Please provide a valid Gmail address.";
    }

    if (empty($address)) {
        $errors[] = "Address is required.";
    }

    if (empty($gender)) {
        $errors[] = "Please select a gender.";
    }

    if (empty($_POST['desired_items'])) {
        $errors[] = "Please select at least one desired item.";
    }

    if (empty($errors)) {
        $successMessage = "Registration successful! Thank you";
    }
}
?>