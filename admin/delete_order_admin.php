<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "pemesanan_makanan");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Jika ID pesanan tidak diberikan, redirect ke halaman admin
if (!isset($_GET['id'])) {
    header('Location: admin.php');
    exit();
}

$id = $_GET['id'];

// Hapus pesanan dengan ID yang sesuai
$sql = "DELETE FROM pesanan WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    header('Location: admin.php');
    exit();
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>
