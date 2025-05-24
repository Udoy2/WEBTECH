<?php
session_start();

$buyer = $_SESSION['buyer'] ?? [];
$orders = $_SESSION['orders'] ?? [];
$update_msg = $_SESSION['update_msg'] ?? '';
unset($_SESSION['buyer'], $_SESSION['orders'], $_SESSION['update_msg']);

$action = $_GET['action'] ?? 'list';
?>

<!DOCTYPE html>
<head>
    <title>My Profile - Pet Valley</title>
    <link rel="stylesheet" href="./profile.css" />
</head>
<body>
    <div class="container">
        <h2>My Profile</h2>

        <div class="btn-group">
            <a href="../control/profilecontroller.php?action=list" class="btn">Order History</a>
            <a href="../control/profilecontroller.php?action=update" class="btn">Update Info</a>
            <a href="./profile.php?action=delete" class="btn btn-danger">Delete Account</a>
            <a href="../control/logoutcontrol.php" class="btn btn-logout">Logout</a>
        </div>

        <?php if ($action === 'list'): ?>
            <h3>Order History</h3>
            <?php if (!empty($orders)): ?>
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['id']) ?></td>
                            <td><?= htmlspecialchars($order['product_name']) ?></td>
                            <td><?= htmlspecialchars($order['quantity']) ?></td>
                            <td>$<?= htmlspecialchars($order['price']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="no-orders">No orders found.</p>
            <?php endif; ?>

        <?php elseif ($action === 'update'): ?>
            <h3>Update Information</h3>
            <?php if ($update_msg): ?>
                <p class="update-msg"><?= htmlspecialchars($update_msg) ?></p>
            <?php endif; ?>

            <form method="POST" action="../control/profilecontroller.php?action=update" class="update-form">
                <label>Name:</label>
                <input type="text" name="name" value="<?= htmlspecialchars($buyer['name'] ?? '') ?>" required>

                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($buyer['email'] ?? '') ?>" required>

                <label>Pet Interested:</label>
                <select name="pet">
                    <option value="dog" <?= $buyer['pet'] == 'dog' ? 'selected' : '' ?>>Dog</option>
                    <option value="cat" <?= $buyer['pet'] == 'cat' ? 'selected' : '' ?>>Cat</option>
                    <option value="parrot" <?= $buyer['pet'] == 'parrot' ? 'selected' : '' ?>>Parrot</option>
                    <option value="pigeon" <?= $buyer['pet'] == 'pigeon' ? 'selected' : '' ?>>Pigeon</option>
                </select>

                <label>Gender:</label>
                <div class="gender-group">
                    <label><input type="radio" name="gender" value="male" <?= $buyer['gender'] == 'male' ? 'checked' : '' ?>> Male</label>
                    <label><input type="radio" name="gender" value="female" <?= $buyer['gender'] == 'female' ? 'checked' : '' ?>> Female</label>
                </div>

                <label>Address:</label>
                <textarea name="address" rows="3"><?= htmlspecialchars($buyer['address'] ?? '') ?></textarea>

                <button type="submit" name="update_info">Update Info</button>
            </form>

        <?php elseif ($action === 'delete'): ?>
            <h3>Delete Account</h3>
            <p>Are you sure you want to delete your account? This action cannot be undone.</p>
            <form method="POST" action="../control/deletecontroller.php">
                <button type="submit" name="confirm_delete" class="btn btn-danger">Yes, Delete My Account</button>
                <a href="../control/profilecontroller.php?action=list" class="btn">Cancel</a>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
