<?php
session_start();
include '../db/db.php';

if (!isset($_SESSION['buyer_id'])) {
    header("Location: ../view/login.php");
    exit();
}

$buyer_id = $_SESSION['buyer_id'];

if (isset($_GET['id'])) {
    $order_id = intval($_GET['id']);

   
    $stmt = $conn->prepare("DELETE FROM orders WHERE id = ? AND buyer_id = ?");
    $stmt->bind_param("ii", $order_id, $buyer_id);
    $stmt->execute();
    $stmt->close();
}

header("Location: ../view/profile.php");
exit();
?>
