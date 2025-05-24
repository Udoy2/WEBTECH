<?php
session_start();

if (!isset($_SESSION['buyer_id'])) {
    header("Location: ./view/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'] ?? '';
    $price = floatval($_POST['price'] ?? 0);

    if ($product_name && $price > 0) {
        
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $found = false;

        
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_name'] === $product_name) {
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
           
            $_SESSION['cart'][] = [
                'product_name' => $product_name,
                'price' => $price,
                'quantity' => 1
            ];
        }
    }
}


header("Location: ../view/dashboard.php");
exit();
?>
