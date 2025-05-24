<?php
session_start();
include '../db/db.php'; // Your database connection file

if (!isset($_SESSION['buyer_id'])) {
    header("Location: login.php");
    exit();
}

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$order_confirmed = false;
$cart_cleared = false;

// Handle order confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm_order'])) {
        if (!empty($_SESSION['cart'])) {
            // Prepare insert without buyer_id because your table doesn't have it
            $stmt = $conn->prepare("INSERT INTO orders (product_name, quantity, price) VALUES (?, ?, ?)");
            if (!$stmt) {
                die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
            }

            foreach ($_SESSION['cart'] as $item) {
                $product_name = $item['product_name'];
                $quantity = $item['quantity'];
                $price = $item['price'];

                $stmt->bind_param("sid", $product_name, $quantity, $price);

                if (!$stmt->execute()) {
                    die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
                }
            }
            $stmt->close();
            $_SESSION['cart'] = []; // Clear cart after order confirmation
            $order_confirmed = true;
        }
    } elseif (isset($_POST['delete_cart'])) {
        // Clear cart on delete button click
        $_SESSION['cart'] = [];
        $cart_cleared = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pet Valley - Cart</title>
    <link rel="stylesheet" href="../assets/dashboardstyle.css">
    <style>
        .cart-table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        .cart-table th, .cart-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .cart-table th {
            background-color: #f4f4f4;
        }
        .confirm-btn, .delete-btn {
            margin-top: 20px;
            display: inline-block;
            width: 150px;
            padding: 10px;
            color: white;
            text-align: center;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-right: 15px;
        }
        .confirm-btn {
            background-color: #4caf50;
        }
        .confirm-btn:hover {
            background-color: #45a049;
        }
        .delete-btn {
            background-color: #f44336;
        }
        .delete-btn:hover {
            background-color: #d32f2f;
        }
        .message {
            text-align: center;
            font-weight: bold;
            margin: 20px;
            font-size: 18px;
        }
    </style>
</head>
<body>
<header>
    <div class="header-container">
        <h1>Pet Valley</h1>
        <nav class="nav-buttons">
            <a href="../buyer/profile.php" class="btn">My Profile</a>
            <a href="../buyer/logout.php" class="btn btn-logout">Logout</a>
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

        <?php if (!empty($_SESSION['cart'])): ?>
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
                    foreach ($_SESSION['cart'] as $item):
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
            <form method="post" style="text-align:center; margin-top: 20px;">
                <button type="submit" name="confirm_order" class="confirm-btn">Confirm Order</button>
                <button type="submit" name="delete_cart" class="delete-btn">Delete Cart</button>
            </form>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>

    </section>
</main>
</body>
</html>
