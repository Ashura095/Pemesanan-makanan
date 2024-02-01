<?php
// Koneksi ke database
include 'koneksi.php';

// Mendapatkan ID pesanan yang akan dihapus
$id = $_GET['id'];

// Menghapus pesanan berdasarkan ID
$sql = "DELETE FROM pesanan WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    echo '<script>alert("Pesanan berhasil dihapus."); window.location.href = "menu.php";</script>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Menutup koneksi database
mysqli_close($conn);
?>
