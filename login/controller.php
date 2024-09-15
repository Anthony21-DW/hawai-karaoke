<?php
if (!isset($_SESSION)) {
    session_start();
}

// Mengecek jika pengguna sudah terautentikasi, arahkan ke index.php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: ../index.php"); // Arahkan ke index.php yang satu tingkat lebih tinggi
    exit;
}

include_once '../config/dadatabase.php';



// Proses login sederhana (misalnya menggunakan form POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST)) {
        $email    = mysqli_real_escape_string($db_connection, $_POST['email']);
        $password    = mysqli_real_escape_string($db_connection, $_POST['password']);
    }

    $login  = mysqli_query($db_connection, "SELECT * FROM users WHERE email='" . $email . "' AND password='" . $password . "'") or die(mysqli_errno($db_connection));
    
    $row    = mysqli_num_rows($login);

     if ($row > 0) {

        $row = mysqli_fetch_array($login);
        $_SESSION['loggedin'] = true;
        $_SESSION['role_id'] = $row['role_id'];
        $_SESSION['role_code'] = $row['role_id'] == 1 ? "Administrator" : "User";
        $_SESSION['name']  = $row['name'];
        $_SESSION['email']  = $row['email'];
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $row['id'];
        header("Location: ../index.php");
    } else {
         $error = "Username atau password salah!";
    }
}
?>
