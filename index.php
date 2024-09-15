<?php
session_start(); // Memulai sesi

// Mengecek jika pengguna sudah terautentikasi
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: dashboard/view.php"); // Arahkan ke view.php di folder dashboard
    exit;
} else {
    header("Location: login/view.php"); // Arahkan ke view.php di folder login
    exit;
}
?>