<?php
session_start();
require_once '../../model/PostModel.php';

// Check if user is logged in and is a seller
if (!isset($_SESSION['user_id']) || $_SESSION['userType'] !== 'seller') {
    header("Location: ../../view/auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'delete':
                if (isset($_POST['post_id'])) {
                    $success = deleteSellerPost($_POST['post_id'], $_SESSION['user_id']);
                    if ($success) {
                        $_SESSION['dashboard_message'] = "Post deleted successfully";
                    } else {
                        $_SESSION['dashboard_error'] = "Failed to delete post";
                    }
                }
                break;
                
            case 'update':
                if (isset($_POST['post_id'])) {
                    $imagePath = null;
                    if (isset($_FILES['pet_image']) && $_FILES['pet_image']['error'] === 0) {
                        $uploadDir = '../../public/uploads/';
                        $fileExtension = pathinfo($_FILES['pet_image']['name'], PATHINFO_EXTENSION);
                        $fileName = uniqid() . '.' . $fileExtension;
                        $targetPath = $uploadDir . $fileName;
                        
                        if (move_uploaded_file($_FILES['pet_image']['tmp_name'], $targetPath)) {
                            $imagePath = 'public/uploads/' . $fileName;
                        }
                    }
                    
                    $sellerData = [
                        'seller_name' => $_POST['seller_name'],
                        'business_name' => $_POST['business_name'],
                        'contact_number' => $_POST['contact_number'],
                        'pet_category' => $_POST['pet_category'],
                        'price_range' => $_POST['price_range'],
                        'description' => $_POST['description'],
                        'availability' => $_POST['availability']
                    ];
                    
                    $success = updateSellerPost($_POST['post_id'], $_SESSION['user_id'], $sellerData, $imagePath);
                    if ($success) {
                        $_SESSION['dashboard_message'] = "Post updated successfully";
                    } else {
                        $_SESSION['dashboard_error'] = "Failed to update post";
                    }
                }
                break;
        }
    }
    header("Location: ../../view/dashboard/seller_dashboard.php");
    exit();
}
?>