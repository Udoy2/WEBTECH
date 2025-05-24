<?php
session_start();
include '../db/db.php';

if (!isset($_SESSION['buyer_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    $buyer_id = $_SESSION['buyer_id'];

    $stmt = $conn->prepare("DELETE FROM buyers WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $buyer_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $stmt->close();
            $conn->close();

            session_destroy();
            header("Location: register.php");
            exit();
        } else {
            echo "No account found with this ID.";
        }
    } else {
        echo "Error deleting account: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect back if accessed directly or wrong request method
    header("Location: profile.php?action=delete");
    exit();
}
?>
