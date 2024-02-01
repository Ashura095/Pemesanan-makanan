<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "pemesanan_makanan");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $status_pengiriman = $_POST['status_pengiriman'];
    $sql = "UPDATE pesanan SET status_pengiriman='$status_pengiriman' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header('Location: admin.php');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM pesanan";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style_admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&family=Poor+Story&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>🍴~ Admin Panel ~🍜</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Makanan</th>
                    <th>Jumlah Makanan</th>
                    <th>Minuman</th>
                    <th>Jumlah Minuman</th>
                    <th>Nama</th>
                    <th>No Telp</th>
                    <th>Alamat</th>
                    <th>Waktu Pesan</th>
                    <th>Status Pengiriman</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['menu_makanan'] . "</td>";
                        echo "<td>" . $row['jumlah_makanan'] . "</td>";
                        echo "<td>" . $row['menu_minuman'] . "</td>";
                        echo "<td>" . $row['jumlah_minuman'] . "</td>";
                        echo "<td>" . $row['nama_pengguna'] . "</td>";
                        echo "<td>" . $row['nomor_telepon'] . "</td>";
                        echo "<td>" . $row['alamat'] . "</td>";
                        echo "<td>" . $row['waktu_pesan'] . "</td>";
                        echo "<td>" . ($row['status_pengiriman'] ? $row['status_pengiriman'] : 'Belum Terkirim') . "</td>"; // Status pengiriman default "Belum Terkirim"
                        echo "<td><a href='edit_order_admin.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete_order_admin.php?id=" . $row['id'] . "'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>Belum ada pesanan.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <a href="admin_logout.php">Logout</a>
    </div>
</body>
</html>
