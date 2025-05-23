<?php
require_once __DIR__ . '/../db/database.php';

function createSellerPost($userId, $sellerData, $imagePath) {
    global $conn;
    
    $stmt = $conn->prepare("INSERT INTO sellers (user_id, seller_name, business_name, contact_number, 
        pet_category, price_range, description, availability, image_path) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
    $stmt->bind_param("issssssss", 
        $userId,
        $sellerData['seller_name'],
        $sellerData['business_name'],
        $sellerData['contact_number'],
        $sellerData['pet_category'],
        $sellerData['price_range'],
        $sellerData['description'],
        $sellerData['availability'],
        $imagePath
    );
    
    $success = $stmt->execute();
    $stmt->close();
    
    return $success;
}

function getSellerPosts() {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM sellers ORDER BY created_at DESC");
    $stmt->execute();
    
    $result = $stmt->get_result();
    $posts = [];
    
    while($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
    
    $stmt->close();
    return $posts;
}