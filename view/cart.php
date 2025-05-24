<?php
session_start();
if (!isset($_SESSION['buyer_id'])) {
    header("Location: ./login.php");
    exit();
}

include '../db/db.php'; // include DB connection
include '../model/cartmodel.php'; // include CartModel

$order_confirmed = false;
$cart_cleared = false;

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm_order']) && !empty($_SESSION['cart'])) {
        $cartItems = $_SESSION['cart'];
        $buyer_id = $_SESSION['buyer_id'];

        try {
            $cartModel = new CartModel($conn);  // use $conn from db.php
            $cartModel->saveOrders($cartItems, $buyer_id); // Save to DB
            $_SESSION['cart'] = []; // Clear cart after saving
            $order_confirmed = true;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } elseif (isset($_POST['delete_cart'])) {
        $_SESSION['cart'] = [];
        $cart_cleared = true;
    }
}


$cart = $_SESSION['cart'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pet Valley - Cart</title>
    <link rel="stylesheet" href="./dashboardstyle.css" />
    <style>
       
    </style>
</head>
<body>
<header>
    <div class="header-container">
        <h1>Pet Valley Dashboard</h1>
        <nav class="nav-buttons">
            <a href="./profile.php" class="btn">My Profile</a>
            <a href="../control/logoutcontrol.php" class="btn btn-logout">Logout</a>
        </nav>
    </div>
</header>

<main>
    <section class="dashboard-content">
        <h2>Your Cart</h2>

        <?php if ($order_confirmed): ?>
            <p class="message">Your order has been confirmed! Thank you for shopping with us.</p>
        <?php elseif ($cart_cleared): ?>
            <p class="message">Your cart has been cleared.</p>
        <?php endif; ?>

        <?php if (!empty($cart)): ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price (Each)</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($cart as $item):
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                        <td><?= htmlspecialchars($item['quantity']) ?></td>
                        <td>$<?= number_format($item['price'], 2) ?></td>
                        <td>$<?= number_format($subtotal, 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3"><strong>Total</strong></td>
                        <td><strong>$<?= number_format($total, 2) ?></strong></td>
                    </tr>
                </tbody>
            </table>
            <form method="post" style="text-align:center;">
                <button type="submit" name="confirm_order" class="confirm-btn">Confirm Order</button>
                <button type="submit" name="delete_cart" class="delete-btn">Delete Cart</button>
            </form>
        <?php else: ?>
            <p class="message">Your cart is empty.</p>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
