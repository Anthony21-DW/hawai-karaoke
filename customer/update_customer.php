<?php
include_once '../config/dadatabase.php';

// Check the request method
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get the ID from GET request
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    
    if ($id > 0) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $db_connection->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $user = $result->fetch_assoc();
        echo json_encode($user);

        $stmt->close();
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid user ID'
        ]);
    }

    $db_connection->close();
    
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $name = $_POST['name'] ?? '';
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role_id = isset($_POST['role_id']) ? (int)$_POST['role_id'] : 3;

    if ($id > 0) {
        if ($password != '') {
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "UPDATE users SET name = ?, username = ?, email = ?, role_id = ?, password = ? WHERE id = ?";
            $stmt = $db_connection->prepare($sql);
            $stmt->bind_param('sssssi', $name, $username, $email, $role_id, $hashed_password, $id);
        } else {
            $sql = "UPDATE users SET name = ?, username = ?, email = ?, role_id = ? WHERE id = ?";
            $stmt = $db_connection->prepare($sql);
            $stmt->bind_param('ssssi', $name, $username, $email, $role_id, $id);
        }

        if ($stmt->execute()) {
            echo json_encode([
                'status' => 'success',
                'message' => 'User updated successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to update user: ' . $stmt->error
            ]);
        }

        $stmt->close();
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid user ID'
        ]);
    }

    $db_connection->close();
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}
?>
