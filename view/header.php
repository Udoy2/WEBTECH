
<?php
session_start();
if (!isset($_SESSION['buyer_id'])) {
    header("Location: ./login.php");
    exit();
}
?>

<!DOCTYPE html>
<head>
    <title>Pet Valley Dashboard</title>
    <link rel="stylesheet" href="./dashboardstyle.css" />
</head>
<body>
<header>
    <div class="header-container">
        <h1>Pet Valley Dashboard</h1>
        <nav class="nav-buttons">
            <a href="./profile.php" class="btn">My Profile</a>
            <a href="../control/cartcontroller.php" class="btn">Go to Cart</a>
            <a href="../control/logoutcontrol.php" class="btn btn-logout">Logout</a>
        </nav>
    </div>
</header>
<main>
