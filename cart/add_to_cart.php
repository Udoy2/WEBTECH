<?php
session_start();

if (!isset($_SESSION['buyer_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'] ?? '';
    $price = floatval($_POST['price'] ?? 0);

    if ($product_name && $price > 0) {
        // Initialize cart if not set
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $found = false;

        // Check if product already in cart; if yes, increase quantity
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_name'] === $product_name) {
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            // Add new item with quantity 1
            $_SESSION['cart'][] = [
                'product_name' => $product_name,
                'price' => $price,
                'quantity' => 1
            ];
        }
    }
}

// Redirect back to seller page or dashboard
header("Location: ../buyer/dashboard.php");
exit();
?>
