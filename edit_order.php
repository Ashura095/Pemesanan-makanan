<?php
// Koneksi ke database
include 'koneksi.php';

// Mendapatkan ID pesanan yang akan diedit
$id = $_GET['id'];

// Mengambil data pesanan berdasarkan ID
$sql = "SELECT * FROM pesanan WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "Pesanan tidak ditemukan.";
    exit();
}

$row = mysqli_fetch_assoc($result);

// Proses pengeditan pesanan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $menu_makanan = $_POST['menu_makanan'];
    $menu_minuman = $_POST['menu_minuman'];
    $jumlah_makanan = $_POST['jumlah_makanan'];
    $jumlah_minuman = $_POST['jumlah_minuman'];

    // Query untuk mengupdate pesanan
    $sql = "UPDATE pesanan SET menu_makanan='$menu_makanan', menu_minuman='$menu_minuman', 
            jumlah_makanan=$jumlah_makanan, jumlah_minuman=$jumlah_minuman WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Pesanan berhasil diperbarui."); window.location.href = "menu.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Menutup koneksi database
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan</title>
    <link rel="stylesheet" href="style_edit.css">
</head>
<body>
    <div class="container">
        <h2>Edit Pesanan</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="menu_makanan">Menu Makanan:</label>
            <select name="menu_makanan" id="menu_makanan">
                <option value="Nasi Goreng" <?php if ($row['menu_makanan'] == 'Nasi Goreng') echo 'selected'; ?>>Nasi Goreng - Rp. 15000</option>
                <option value="Mie Goreng" <?php if ($row['menu_makanan'] == 'Mie Goreng') echo 'selected'; ?>>Mie Goreng - Rp. 12000</option>
                <option value="Ayam Goreng" <?php if ($row['menu_makanan'] == 'Ayam Goreng') echo 'selected'; ?>>Ayam Goreng - Rp. 20000</option>
            </select><br>
            <label for="menu_minuman">Menu Minuman:</label>
            <select name="menu_minuman" id="menu_minuman">
                <option value="Es Teh" <?php if ($row['menu_minuman'] == 'Es Teh') echo 'selected'; ?>>Es Teh - Rp. 5000</option>
                <option value="Es Jeruk" <?php if ($row['menu_minuman'] == 'Es Jeruk') echo 'selected'; ?>>Es Jeruk - Rp. 6000</option>
                <option value="Jus Alpukat" <?php if ($row['menu_minuman'] == 'Jus Alpukat') echo 'selected'; ?>>Jus Alpukat - Rp. 10000</option>
            </select><br>
            <label for="jumlah_makanan">Jumlah Makanan:</label>
            <input type="number" name="jumlah_makanan" id="jumlah_makanan" value="<?php echo $row['jumlah_makanan']; ?>"><br>
            <label for="jumlah_minuman">Jumlah Minuman:</label>
            <input type="number" name="jumlah_minuman" id="jumlah_minuman" value="<?php echo $row['jumlah_minuman']; ?>"><br>
            <input type="submit" name="edit" value="Edit">
        </form>
        <br>
        <a href="menu.php">Kembali ke Menu</a>
    </div>
</body>
</html>
