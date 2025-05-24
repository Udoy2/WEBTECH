<?php
session_start();
include '../db/db.php';

if (!isset($_SESSION['buyer_id'])) {
    header("Location: ../view/login.php");
    exit();
}

$buyer_id = $_SESSION['buyer_id'];
$action = $_GET['action'] ?? 'list';


$stmt2 = $conn->prepare("SELECT name, email, pet, gender, address FROM buyers WHERE id = ?");
$stmt2->bind_param("i", $buyer_id);
$stmt2->execute();
$buyer = $stmt2->get_result()->fetch_assoc();
$stmt2->close();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_info'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pet = $_POST['pet'];
    $gender = $_POST['gender'] ?? '';
    $address = trim($_POST['address']);

    if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt_update = $conn->prepare("UPDATE buyers SET name=?, email=?, pet=?, gender=?, address=? WHERE id=?");
        $stmt_update->bind_param("sssssi", $name, $email, $pet, $gender, $address, $buyer_id);
        if ($stmt_update->execute()) {
            $_SESSION['update_msg'] = "Information updated successfully!";
            header("Location: ../view/profile.php?action=list");
        } else {
            $_SESSION['update_msg'] = "Update failed!";
            header("Location: ../view/profile.php?action=update");
        }
        exit();
    } else {
        $_SESSION['update_msg'] = "Please enter a valid name and email.";
        header("Location: ../view/profile.php?action=update");
        exit();
    }
}


if ($action === 'list') {
    $stmt = $conn->prepare("SELECT id, product_name, quantity, price FROM orders ORDER BY id DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    $_SESSION['orders'] = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}


$_SESSION['buyer'] = $buyer;
header("Location: ../view/profile.php?action=" . $action);
exit();
