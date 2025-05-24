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


function getSellerPostsByUserId($userId) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM sellers WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $posts = [];
    
    while($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
    
    $stmt->close();
    return $posts;
}

function getSellerPostById($postId, $userId) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM sellers WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $postId, $userId);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();
    
    $stmt->close();
    return $post;
}

function updateSellerPost($postId, $userId, $sellerData, $imagePath = null) {
    global $conn;
    
    $sql = "UPDATE sellers SET seller_name = ?, business_name = ?, contact_number = ?, 
            pet_category = ?, price_range = ?, description = ?, availability = ?";
    
    if ($imagePath) {
        $sql .= ", image_path = ?";
    }
    
    $sql .= " WHERE id = ? AND user_id = ?";
    
    $stmt = $conn->prepare($sql);
    
    if ($imagePath) {
        $stmt->bind_param("ssssssssii", 
            $sellerData['seller_name'],
            $sellerData['business_name'],
            $sellerData['contact_number'],
            $sellerData['pet_category'],
            $sellerData['price_range'],
            $sellerData['description'],
            $sellerData['availability'],
            $imagePath,
            $postId,
            $userId
        );
    } else {
        $stmt->bind_param("sssssssii", 
            $sellerData['seller_name'],
            $sellerData['business_name'],
            $sellerData['contact_number'],
            $sellerData['pet_category'],
            $sellerData['price_range'],
            $sellerData['description'],
            $sellerData['availability'],
            $postId,
            $userId
        );
    }
    
    $success = $stmt->execute();
    $stmt->close();
    
    return $success;
}

function deleteSellerPost($postId, $userId) {
    global $conn;
    
    $stmt = $conn->prepare("DELETE FROM sellers WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $postId, $userId);
    
    $success = $stmt->execute();
    $stmt->close();
    
    return $success;
}