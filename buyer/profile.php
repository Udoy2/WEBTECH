<?php
session_start();
include '../db/db.php';

if (!isset($_SESSION['buyer_id'])) {
    header("Location: login.php");
    exit();
}

$buyer_id = $_SESSION['buyer_id'];

$action = $_GET['action'] ?? 'list';  // Default view: show order list

// Fetch buyer info for update form or profile display
$stmt2 = $conn->prepare("SELECT name, email, pet, gender, address FROM buyers WHERE id = ?");
$stmt2->bind_param("i", $buyer_id);
$stmt2->execute();
$buyer = $stmt2->get_result()->fetch_assoc();
$stmt2->close();

$update_msg = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_info'])) {
    // Process update form submission
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pet = $_POST['pet'];
    $gender = $_POST['gender'] ?? '';
    $address = trim($_POST['address']);

    if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt_update = $conn->prepare("UPDATE buyers SET name=?, email=?, pet=?, gender=?, address=? WHERE id=?");
        $stmt_update->bind_param("sssssi", $name, $email, $pet, $gender, $address, $buyer_id);
        if ($stmt_update->execute()) {
            $update_msg = "Information updated successfully!";
            $action = 'list';  // After update, go back to list view
        } else {
            $update_msg = "Update failed!";
            $action = 'update';
        }
        $stmt_update->close();
    } else {
        $update_msg = "Please enter a valid name and email.";
        $action = 'update';
    }
}

// If action is 'list', fetch all orders (since no buyer_id column)
if ($action === 'list') {
    $stmt = $conn->prepare("SELECT id, product_name, quantity, price FROM orders ORDER BY id DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>My Profile - Pet Valley</title>
    <link rel="stylesheet" href="../assets/profile.css" />
</head>
<body>
    <div class="container">
        <h2>My Profile</h2>

        <div class="btn-group">
            <a href="profile.php?action=list" class="btn">Order History</a>
            <a href="profile.php?action=update" class="btn">Update Info</a>
            <a href="profile.php?action=delete" class="btn btn-danger">Delete Account</a>
            <a href="logout.php" class="btn btn-logout">Logout</a>
        </div>

        <?php if ($action === 'list'): ?>
            <h3>Order History</h3>
            <?php if ($result && $result->num_rows > 0): ?>
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
                        <?php while ($order = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['id']) ?></td>
                            <td><?= htmlspecialchars($order['product_name']) ?></td>
                            <td><?= htmlspecialchars($order['quantity']) ?></td>
                            <td>$<?= htmlspecialchars($order['price']) ?></td>
                        </tr>
                        <?php endwhile; ?>
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

            <form method="POST" class="update-form">
                <label>Name:</label>
                <input type="text" name="name" value="<?= htmlspecialchars($buyer['name']) ?>" required>

                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($buyer['email']) ?>" required>

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
                <textarea name="address" rows="3"><?= htmlspecialchars($buyer['address']) ?></textarea>

                <button type="submit" name="update_info">Update Info</button>
            </form>

        <?php elseif ($action === 'delete'): ?>
            <h3>Delete Account</h3>
            <p>Are you sure you want to delete your account? This action cannot be undone.</p>
            <form method="POST" action="delete.php">
                <button type="submit" name="confirm_delete" class="btn btn-danger">Yes, Delete My Account</button>
                <a href="profile.php?action=list" class="btn">Cancel</a>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
