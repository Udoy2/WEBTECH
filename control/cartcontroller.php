<?php
session_start();

include '../db/db.php'; 
include '../model/cartmodel.php';

if (!isset($_SESSION['buyer_id'])) {
    header("Location: ../view/login.php");
    exit();
}

$model = new CartModel($conn);

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$order_confirmed = false;
$cart_cleared = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['confirm_order']) && !empty($_SESSION['cart'])) {
            $model->saveOrders($_SESSION['cart'], $_SESSION['buyer_id']);
            $_SESSION['cart'] = [];
            $order_confirmed = true;
        } elseif (isset($_POST['delete_cart'])) {
            $_SESSION['cart'] = [];
            $cart_cleared = true;
        }
    } catch (Exception $e) {
        die("Error processing order: " . $e->getMessage());
    }
}


$cart = $_SESSION['cart'];
include '../view/cart.php';
