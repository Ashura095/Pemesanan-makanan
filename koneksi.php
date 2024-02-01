<?php
// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$database = "pemesanan_makanan";

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $database);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
