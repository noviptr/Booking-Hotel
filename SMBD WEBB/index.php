<?php
// Koneksi ke database
$servername = "localhost"; // Ganti sesuai dengan server Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Kosongkan password
$database = "web_novi"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi untuk menambah data buah
function tambahBuah($nama_buah, $waktu_pengujian, $tanggal_pengujian) {
    global $conn;
    $sql = "INSERT INTO jenis_buah (nama_buah, waktu_pengujian, tanggal_pengujian) VALUES ('$nama_buah', '$waktu_pengujian', '$tanggal_pengujian')";
    $conn->query($sql);
}

// Fungsi untuk menambah data suhu
function tambahSuhu($nama_buah, $nilai_suhu, $tanggal_pengujian_suhu) {
    global $conn;
    $sql = "INSERT INTO temperature (nama_buah, nilai_suhu, tanggal_pengujian) VALUES ('$nama_buah', '$nilai_suhu', '$tanggal_pengujian_suhu')";
    $conn->query($sql);
}

// Fungsi untuk menambah data gas
function tambahGas($nama_buah, $nilai_gas, $tanggal_pengujian_gas) {
    global $conn;
    $sql = "INSERT INTO gas (nama_buah, nilai_gas, tanggal_pengujian) VALUES ('$nama_buah', '$nilai_gas', '$tanggal_pengujian_gas')";
    $conn->query($sql);
}

// Fungsi untuk menampilkan data buah
function tampilkanBuah() {
    global $conn;
    $sql = "SELECT * FROM jenis_buah";
    $result = $conn->query($sql);
    return $result;
}

// Fungsi untuk menampilkan data suhu
function tampilkanSuhu() {
    global $conn;
    $sql = "SELECT * FROM temperature";
    $result = $conn->query($sql);
    return $result;
}

// Fungsi untuk menampilkan data gas
function tampilkanGas() {
    global $conn;
    $sql = "SELECT * FROM gas";
    $result = $conn->query($sql);
    return $result;
}

// Fungsi untuk menghapus data buah
function hapusBuah($id) {
    global $conn;
    $sql = "DELETE FROM jenis_buah WHERE id = $id";
    $conn->query($sql);
}

// Fungsi untuk menghapus data suhu
function hapusSuhu($id) {
    global $conn;
    $sql = "DELETE FROM temperature WHERE id = $id";
    $conn->query($sql);
}

// Fungsi untuk menghapus data gas
function hapusGas($id) {
    global $conn;
    $sql = "DELETE FROM gas WHERE id = $id";
    $conn->query($sql);
}

// Handle aksi tambah data
if (isset($_POST['tambah_buah'])) {
    tambahBuah($_POST['nama_buah'], $_POST['waktu_pengujian'], $_POST['tanggal_pengujian']);
}

if (isset($_POST['tambah_suhu'])) {
    tambahSuhu($_POST['nama_buah_suhu'], $_POST['nilai_suhu'], $_POST['tanggal_pengujian_suhu']);
}

if (isset($_POST['tambah_gas'])) {
    tambahGas($_POST['nama_buah_gas'], $_POST['nilai_gas'], $_POST['tanggal_pengujian_gas']);
}

// Handle aksi hapus data
if (isset($_GET['hapus_buah'])) {
    hapusBuah($_GET['hapus_buah']);
}

if (isset($_GET['hapus_suhu'])) {
    hapusSuhu($_GET['hapus_suhu']);
}

if (isset($_GET['hapus_gas'])) {
    hapusGas($_GET['hapus_gas']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Website CRUD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h1 {
            color: #333;
        }

        h2 {
            color: #555;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        form {
            margin: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="time"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #555;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Data Buah</h1>
    <form method="post">
        <label>Nama Buah:</label>
        <input type="text" name="nama_buah" required><br>
        <label>Waktu Pengujian:</label>
        <input type="time" name="waktu_pengujian" required><br>
        <label>Tanggal Pengujian:</label>
        <input type="date" name="tanggal_pengujian" required><br>
        <button type="submit" name="tambah_buah">Tambah Data</button>
    </form>

    <h2>Daftar Buah</h2>
    <table border="1">
        <tr>
            <th>Nama Buah</th>
            <th>Waktu Pengujian</th>
            <th>Tanggal Pengujian</th>
            <th>Aksi</th>
        </tr>
        <?php
        $buah_result = tampilkanBuah();
        while ($row = $buah_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['nama_buah'] . "</td>";
            echo "<td>" . $row['waktu_pengujian'] . "</td>";
            echo "<td>" . $row['tanggal_pengujian'] . "</td>";
            echo "<td><a href='index.php?hapus_buah=" . $row['id'] . "'>Hapus</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h1>Data Suhu (Temperature)</h1>
    <form method="post">
        <label>Nama Buah:</label>
        <input type="text" name="nama_buah_suhu" required><br>
        <label>Nilai Suhu:</label>
        <input type="text" name="nilai_suhu" required><br>
        <label>Tanggal Pengujian:</label>
        <input type="date" name="tanggal_pengujian_suhu" required><br>
        <button type="submit" name="tambah_suhu">Tambah Data</button>
    </form>

    <h2>Daftar Suhu (Temperature)</h2>
    <table border="1">
        <tr>
            <th>Nama Buah</th>
            <th>Nilai Suhu</th>
            <th>Tanggal Pengujian</th>
            <th>Aksi</th>
        </tr>
        <?php
        $suhu_result = tampilkanSuhu();
        while ($row = $suhu_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['nama_buah'] . "</td>";
            echo "<td>" . $row['nilai_suhu'] . "</td>";
            echo "<td>" . $row['tanggal_pengujian'] . "</td>";
            echo "<td><a href='index.php?hapus_suhu=" . $row['id'] . "'>Hapus</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h1>Data Gas</h1>
    <form method="post">
        <label>Nama Buah:</label>
        <input type="text" name="nama_buah_gas" required><br>
        <label>Nilai Gas:</label>
        <input type="text" name="nilai_gas" required><br>
        <label>Tanggal Pengujian:</label>
        <input type="date" name="tanggal_pengujian_gas" required><br>
        <button type="submit" name="tambah_gas">Tambah Data</button>
    </form>

    <h2>Daftar Gas</h2>
    <table border="1">
        <tr>
            <th>Nama Buah</th>
            <th>Nilai Gas</th>
            <th>Tanggal Pengujian</th>
            <th>Aksi</th>
        </tr>
        <?php
        $gas_result = tampilkanGas();
        while ($row = $gas_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['nama_buah'] . "</td>";
            echo "<td>" . $row['nilai_gas'] . "</td>";
            echo "<td>" . $row['tanggal_pengujian'] . "</td>";
            echo "<td><a href='index.php?hapus_gas=" . $row['id'] . "'>Hapus</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
