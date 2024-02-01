<?php
session_start();

// Jika admin sudah login, redirect ke halaman admin
if (isset($_SESSION['admin'])) {
    header('Location: admin.php');
    exit();
}

// Jika ada data yang dikirimkan dari form login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cek username dan password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Anda dapat mengganti username dan password sesuai dengan yang Anda inginkan
    if ($username === 'admin' && $password === 'admin123') {
        // Jika login berhasil, set session admin
        $_SESSION['admin'] = true;
        header('Location: admin.php');
        exit();
    } else {
        // Jika login gagal, tampilkan pesan error
        $error = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
