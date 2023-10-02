<?php
session_start();
// Ganti dengan koneksi ke database Anda
$servername = "localhost";
$username = "root";
$password = "";
$database = "web_novi";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query SQL untuk menambahkan user baru ke database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['username'] = $username;
        header("Location: input.php");
        exit;
    } else {
        echo "Registrasi gagal. Silakan coba lagi.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form method="post" action="proses_register.php">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit" name="register">Register</button>
    </form>
    <p>Sudah punya akun? <a href="login.php">Login disini</a></p>
</body>
</html>
