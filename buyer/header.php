
<?php
session_start();
if (!isset($_SESSION['buyer_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Pet Valley Dashboard</title>
    <link rel="stylesheet" href="../assets/dashboardstyle.css" />
</head>
<body>
<header>
    <div class="header-container">
        <h1>Pet Valley Dashboard</h1>
        <nav class="nav-buttons">
            <a href="profile.php" class="btn">My Profile</a>
            <a href="../cart/cart.php" class="btn">Go to Cart</a>
            <a href="logout.php" class="btn btn-logout">Logout</a>
        </nav>
    </div>
</header>
<main>
