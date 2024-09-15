<?php
include_once '../config/dadatabase.php';

// Check if form data is sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = $_POST["name"] ?? '';
    $username = $_POST["username"] ?? '';
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';
    $role_id = (int)$_POST["role_id"] ?? 3;
    
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL statement to prevent SQL injection
    $stmt = $db_connection->prepare("INSERT INTO users (name, username, email, password, role_id) VALUES (?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param('sssss', $name, $username, $email, $hashed_password, $role_id);

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'User inserted successfully'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to insert user: ' . $stmt->error
        ]);
    }

    // Close the statement
    $stmt->close();
   
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}

$db_connection->close();
