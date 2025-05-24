<?php
session_start();
require_once '../db/db.php';

if (!isset($_SESSION['buyer_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['buyer_id'];
$result = $conn->query("SELECT * FROM buyers WHERE id = $id");
$buyer = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];

    $conn->query("UPDATE buyers SET name = '$name', address = '$address' WHERE id = $id");
    header("Location: dashboard.php");
    exit();
}
?>

<form method="POST">
    Name: <input type="text" name="name" value="<?php echo $buyer['name']; ?>"><br>
    Address: <textarea name="address"><?php echo $buyer['address']; ?></textarea><br>
    <button type="submit">Update</button>
</form>
