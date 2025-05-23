<?php
require_once __DIR__ . '/../db/database.php';

function createUser($name, $email, $username, $phone, $userType, $password) {
    global $conn;
    
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (name, email, username, phone, userType, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $username, $phone, $userType, $hashedPassword);
    
    // Execute and get result
    $success = $stmt->execute();
    
    // Close the statement
    $stmt->close();
    
    return $success;
}

function getUserByEmail($email) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    $stmt->close();
    
    return $user;
}

function getUserByUsername($username) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    $stmt->close();
    
    return $user;
}
?>