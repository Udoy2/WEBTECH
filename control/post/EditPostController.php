<?php
session_start();
require_once '../../model/PostModel.php';

// Check if user is logged in and is a seller
if (!isset($_SESSION['user_id']) || $_SESSION['userType'] !== 'seller') {
    header("Location: ../../view/auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $postId = $_POST['post_id'];
    $userId = $_SESSION['user_id'];
    
    // Verify post belongs to user
    $existingPost = getSellerPostById($postId, $userId);
    if (!$existingPost) {
        $_SESSION['dashboard_error'] = "Invalid post";
        header("Location: ../../view/dashboard/seller_dashboard.php");
        exit();
    }
    
    // Handle image upload if new image is provided
    $imagePath = null;
    if (isset($_FILES['pet_image']) && $_FILES['pet_image']['error'] === 0) {
        $uploadDir = '../../public/uploads/';
        $fileExtension = pathinfo($_FILES['pet_image']['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $fileExtension;
        $targetPath = $uploadDir . $fileName;
        
        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($_FILES['pet_image']['type'], $allowedTypes)) {
            $_SESSION['dashboard_error'] = "Invalid file type. Only JPG, JPEG & PNG files are allowed.";
            header("Location: ../../view/dashboard/edit_post.php?id=" . $postId);
            exit();
        }
        
        // Upload new image
        if (move_uploaded_file($_FILES['pet_image']['tmp_name'], $targetPath)) {
            $imagePath = 'public/uploads/' . $fileName;
            
            // Delete old image if exists
            if ($existingPost['image_path'] && file_exists('../../' . $existingPost['image_path'])) {
                unlink('../../' . $existingPost['image_path']);
            }
        }
    }
    
    // Prepare post data
    $postData = [
        'seller_name' => $_POST['seller_name'],
        'business_name' => $_POST['business_name'],
        'contact_number' => $_POST['contact_number'],
        'pet_category' => $_POST['pet_category'],
        'price_range' => $_POST['price_range'],
        'description' => $_POST['description'],
        'availability' => $_POST['availability']
    ];
    
    // Update post
    if (updateSellerPost($postId, $userId, $postData, $imagePath)) {
        $_SESSION['dashboard_message'] = "Post updated successfully";
    } else {
        $_SESSION['dashboard_error'] = "Failed to update post";
    }
    
    header("Location: ../../view/dashboard/seller_dashboard.php");
    exit();
}
?>