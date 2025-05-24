<?php
session_start();
include '../db/db.php';

if (!isset($_SESSION['buyer_id'])) {
    die("Not logged in.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    $buyer_id = $_SESSION['buyer_id'];
    echo "Attempting to delete buyer ID: $buyer_id<br>";

    $stmt = $conn->prepare("DELETE FROM buyers WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $buyer_id);
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Account deleted. Logging out...";
            $stmt->close();
            $conn->close();
            session_destroy();
            header("Location: ../view/register.php");
            exit();
        } else {
            echo "No account found with ID: $buyer_id";
        }
    } else {
        echo "Error executing delete: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
