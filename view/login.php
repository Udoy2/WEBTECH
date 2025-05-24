<?php
session_start();
$error = $_SESSION['error'] ?? '';
$email = $_SESSION['old_email'] ?? '';
unset($_SESSION['error'], $_SESSION['old_email']);
?>

<!DOCTYPE html>
<head>
    <title>Login - Pet Valley</title>
    <link rel="stylesheet" href="./loginstyle.css" />
</head>
<body>
    <form method="POST" action="../control/logincontroller.php">
        <h2>Login to Pet Valley</h2>
        <input type="text" name="email" placeholder="Email" required value="<?php echo htmlspecialchars($email); ?>">
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <?php if ($error): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
</body>
</html>
