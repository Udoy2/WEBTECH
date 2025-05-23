<?php
session_start();
require_once '../../model/PostModel.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../view/auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    
    // Validate inputs
    if (empty($_POST['seller_name'])) $errors[] = "Seller name is required";
    if (empty($_POST['business_name'])) $errors[] = "Business name is required";
    if (empty($_POST['contact_number'])) $errors[] = "Contact number is required";
    if (empty($_POST['pet_category'])) $errors[] = "Pet category is required";
    if (empty($_POST['price_range'])) $errors[] = "Price range is required";
    
    // Handle image upload
    $imagePath = null;
    if (isset($_FILES['pet_image']) && $_FILES['pet_image']['error'] === 0) {
        $uploadDir = '../../public/uploads/';
        
        // Create directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        // Generate unique filename
        $fileExtension = pathinfo($_FILES['pet_image']['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $fileExtension;
        $targetPath = $uploadDir . $fileName;
        
        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($_FILES['pet_image']['type'], $allowedTypes)) {
            $errors[] = "Invalid file type. Only JPG, JPEG & PNG files are allowed.";
        }
        
        // Move uploaded file
        if (empty($errors) && move_uploaded_file($_FILES['pet_image']['tmp_name'], $targetPath)) {
            $imagePath = 'public/uploads/' . $fileName;
        } else {
            $errors[] = "Failed to upload image";
        }
    }
    
    if (empty($errors)) {
        $sellerData = [
            'seller_name' => $_POST['seller_name'],
            'business_name' => $_POST['business_name'],
            'contact_number' => $_POST['contact_number'],
            'pet_category' => $_POST['pet_category'],
            'price_range' => $_POST['price_range'],
            'description' => $_POST['description'],
            'availability' => $_POST['availability']
        ];
        
        if (createSellerPost($_SESSION['user_id'], $sellerData, $imagePath)) {
            header("Location: ../../view/dashboard/seller_dashboard.php");
            exit();
        } else {
            $errors[] = "Failed to create post";
        }
    }
    
    // If there are errors, redirect back with error messages
    if (!empty($errors)) {
        $_SESSION['seller_errors'] = $errors;
        header("Location: ../../view/post/seller.php");
        exit();
    }
}
?>