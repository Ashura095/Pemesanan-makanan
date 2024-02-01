<?php
// Koneksi ke database
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa apakah input ada sebelum mengakses nilainya
    if (isset($_POST['menu_makanan'], $_POST['menu_minuman'], $_POST['jumlah_makanan'], $_POST['jumlah_minuman'], $_POST['nama_pengguna'], $_POST['nomor_telepon'], $_POST['alamat'])) {
        // Validasi dan membersihkan input
          $menu_makanan = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['menu_makanan']));
        $menu_minuman = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['menu_minuman']));
        $jumlah_makanan = intval($_POST['jumlah_makanan']);
        $jumlah_minuman = intval($_POST['jumlah_minuman']);
        $nama_pengguna = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['nama_pengguna']));
        $nomor_telepon = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['nomor_telepon']));
        $alamat = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['alamat']));
        
        // Periksa nilai $_POST['nama_pengguna']
        echo "Nilai nama_pengguna: " . $nama_pengguna; // Tambahkan ini untuk memeriksa nilai

        // Prepared statement untuk menghindari SQL injection
        $stmt = mysqli_prepare($conn, "INSERT INTO pesanan (menu_makanan, menu_minuman, jumlah_makanan, jumlah_minuman, nama_pengguna, nomor_telepon, alamat) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'ssiiiss', $menu_makanan, $menu_minuman, $jumlah_makanan, $jumlah_minuman, $nama_pengguna, $nomor_telepon, $alamat);

        // Eksekusi prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Pesanan berhasil ditambahkan."); window.location.href = "menu.php";</script>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Tutup statement
        mysqli_stmt_close($stmt);
    } else {
        // Tampilkan pesan kesalahan jika input tidak lengkap
        echo '<script>alert("Formulir tidak lengkap.");</script>';
    }
}


// Tampilkan daftar pesanan
$sql = "SELECT * FROM pesanan";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan Makanan</title>
    <link rel="stylesheet" href="style_edit.css">
</head>
<body>
    <div class="container">
        <h2>Silakan pilih menu dan masukkan informasi Anda.</h2>
        <form method="post">
            <label for="menu_makanan">Menu Makanan:</label>
            <select name="menu_makanan" id="menu_makanan">
                <option value="Nasi Goreng">Nasi Goreng - Rp. 15000</option>
                <option value="Mie Goreng">Mie Goreng - Rp. 12000</option>
                <option value="Ayam Goreng">Ayam Goreng - Rp. 20000</option>
            </select><br>
            <label for="menu_minuman">Menu Minuman:</label>
            <select name="menu_minuman" id="menu_minuman">
                <option value="Es Teh">Es Teh - Rp. 5000</option>
                <option value="Es Jeruk">Es Jeruk - Rp. 6000</option>
                <option value="Jus Alpukat">Jus Alpukat - Rp. 10000</option>
            </select><br>
            <label for="jumlah_makanan">Jumlah Makanan:</label>
            <input type="number" name="jumlah_makanan" id="jumlah_makanan" value="1"><br>
            <label for="jumlah_minuman">Jumlah Minuman:</label>
            <input type="number" name="jumlah_minuman" id="jumlah_minuman" value="1"><br>
            <div id="pengguna">
            <h3>Informasi Pemesanan</h3>
            <label for="nama_pengguna">Nama:</label>
            <input type="text" name="nama_pengguna" id="nama_pengguna" required><br>
            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="text" name="nomor_telepon" id="nomor_telepon" required><br>
            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" id="alamat" required><br>
            <input type="submit" name="submit" value="Pesan">
            </div>
            </div>
        </form>
        <br>
        <div class="daftar">
        <h3>Daftar Pesanan:</h3>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "ID: " . $row['id'] . "<br>";
                echo "Makanan: " . $row['menu_makanan'] . " x " . $row['jumlah_makanan'] . "<br>";
                echo "Minuman: " . $row['menu_minuman'] . " x " . $row['jumlah_minuman'] . "<br>";
                echo "<button id='btnAction'><a href='edit_order.php?id=" . $row['id'] . "'>Edit</a></button> |";
                echo "<button id='btnAction'><a href='delete_order.php?id=" . $row['id'] . "'>Delete</a></button><br>";
            }
        } else {
            echo "Belum ada pesanan.";
        }
        ?>
        <br>
        </div>
    </div>
</body>
</html>
