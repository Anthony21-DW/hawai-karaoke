<?php
session_start(); // Start session if not already started
include_once '../config/dadatabase.php';

$response = []; // Array to store response for AJAX

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if POST data is not empty
    if (!empty($_POST)) {
        $email    = mysqli_real_escape_string($db_connection, $_POST['email']);
        $password = mysqli_real_escape_string($db_connection, $_POST['password']);
    }

    // Query to find user by email
    $query  = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($db_connection, $query) or die(mysqli_error($db_connection));

    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['role_id'] = $row['role_id'];
            $_SESSION['role_code'] = $row['role_id'] == 1 ? "Administrator" : ($row['role_id'] == 2 ? 'User' : 'Customer');
            $_SESSION['name']  = $row['name'];
            $_SESSION['email']  = $row['email'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];

            // Success response
            $response['status'] = 'success';
            $response['message'] = 'Login successful';
        } else {
            // Incorrect password
            $response['status'] = 'error';
            $response['message'] = 'Password salah!';
        }
    } else {
        // No user found with that email
        $response['status'] = 'error';
        $response['message'] = 'Username atau password salah!';
    }
    
    // Return JSON response
    echo json_encode($response);
}
?>
