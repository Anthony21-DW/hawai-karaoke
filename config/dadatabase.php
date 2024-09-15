<?php
// config/database.php

$server = "localhost";
$username = "root";
$password = "";
$database = "hawai_karaoke";

// Membuat koneksi menggunakan mysqli
$db_connection = mysqli_connect($server, $username, $password, $database) or die("Koneksi gagal - " . mysqli_connect_error());

?>