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

// Proses form jika data dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jumlah_makanan = $_POST['jumlah_makanan'];
    $jumlah_minuman = $_POST['jumlah_minuman'];
    $status_pengiriman = $_POST['status_pengiriman']; // Tambahkan ini

    // Update pesanan dengan ID yang sesuai
    $sql = "UPDATE pesanan SET jumlah_makanan=$jumlah_makanan, jumlah_minuman=$jumlah_minuman, status_pengiriman='$status_pengiriman' WHERE id=$id"; // Tambahkan status_pengiriman

    if (mysqli_query($conn, $sql)) {
        header('Location: admin.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Ambil data pesanan berdasarkan ID
$sql = "SELECT * FROM pesanan WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan</title>
    <link rel="stylesheet" href="style_edit_order.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&family=Poor+Story&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>🍴~ Edit pesanan ~🍜</h2>
        <form method="post">
            <label for="jumlah_makanan">Jumlah Makanan:</label>
            <input type="number" name="jumlah_makanan" id="jumlah_makanan" value="<?php echo $row['jumlah_makanan']; ?>" required><br>
            <label for="jumlah_minuman">Jumlah Minuman:</label>
            <input type="number" name="jumlah_minuman" id="jumlah_minuman" value="<?php echo $row['jumlah_minuman']; ?>" required><br>

            <!-- Tambahkan bagian ini untuk edit status pengiriman -->
            <label for="status_pengiriman">Status Pengiriman:</label>
            <select name="status_pengiriman" id="status_pengiriman">
                <option value="Belum Dikirim" <?php if ($row['status_pengiriman'] == 'Belum Dikirim') echo 'selected'; ?>>Belum Dikirim</option>
                <option value="Sudah Dikirim" <?php if ($row['status_pengiriman'] == 'Sudah Dikirim') echo 'selected'; ?>>Sudah Dikirim</option>
            </select><br>
            <!-- Sampai sini -->

            <input type="submit" value="Simpan">
        </form>
        <br>
        <a href="admin.php">Kembali</a>
    </div>
</body>
</html>
