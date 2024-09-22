<?php
include_once '../config/dadatabase.php';

// Check if form data is sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = $_POST["name"] ?? '';
    $phone = $_POST["phone"] ?? '';
    $gender = $_POST["gender"] ?? '';
    $birthyear = (int)$_POST["birthyear"] ?? 0;
    $username = $_POST["username"] ?? '';
    $email = $_POST["email"] ?? '';
    $address = $_POST["address"] ?? '';
    $password = $_POST["password"] ?? '';
    $role_id = 3;
    
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL statement to prevent SQL injection
    $stmt = $db_connection->prepare("INSERT INTO users (name, phone, gender, birthyear, username, email, address, password, role_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param('sssssssss', $name, $phone, $gender, $birthyear, $username, $email, $address, $hashed_password, $role_id);

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Registrasi Berhasil'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to insert user: ' . $stmt->error
        ]);
    }

    // Close the statement
    $stmt->close();
    
    $db_connection->close();
} 

