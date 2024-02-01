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

// Ambil data menu dari database
$sql = "SELECT * FROM menu";
$result = mysqli_query($conn, $sql);

// Jika ada form yang disubmit, proses pembaruan menu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menu_id = $_POST['menu_id'];
    $menu_name = $_POST['menu_name'];
    $menu_price = $_POST['menu_price'];

    // Update menu berdasarkan id menu
    $sql = "UPDATE menu SET menu_name='$menu_name', menu_price=$menu_price WHERE menu_id=$menu_id";

    if (mysqli_query($conn, $sql)) {
        header('Location: admin.php');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Ambil data menu yang akan diedit berdasarkan id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM menu WHERE menu_id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
} else {
    header('Location: admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu Makanan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>🍴~ Edit pesanan ~🍜</h2>
        <form method="post">
            <input type="hidden" name="menu_id" value="<?php echo $row['menu_id']; ?>">
            <label for="menu_name">Nama Menu:</label>
            <input type="text" name="menu_name" id="menu_name" value="<?php echo $row['menu_name']; ?>" required><br>
            <label for="menu_price">Harga:</label>
            <input type="number" name="menu_price" id="menu_price" value="<?php echo $row['menu_price']; ?>" required><br>
            <input type="submit" value="Simpan">
        </form>
        <br>
        <a href="admin.php">Kembali</a>
    </div>
</body>
</html>
