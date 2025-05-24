<nav class="navbar">
    <div class="nav-brand">
        <a href="/WEBTECH/index.php">Pet Valley</a>
    </div>
    <div class="nav-links">
        <a href="/WEBTECH/view/post/buyer.php">Buy Pets</a>
        <a href="/WEBTECH/view/post/seller.php">Sell Pets</a>
        <?php if (isset($_SESSION['username'])): ?>
            <a href="#"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
            <a href="/WEBTECH/control/auth/LogoutController.php">Logout</a>
        <?php else: ?>
            <a href="/WEBTECH/view/auth/login.php">Login</a>
            <a href="/WEBTECH/view/auth/register.php">Register</a>
        <?php endif; ?>
    </div>
</nav>