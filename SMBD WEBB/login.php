<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
/* Style for the body */
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

/* Style for the container */
.container {
    max-width: 400px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    margin-top: 50px;
}

/* Style for headings */
h1, h2 {
    text-align: center;
    color: #333;
}

/* Style for labels */
label {
    display: block;
    margin-bottom: 5px;
    color: #555;
}

/* Style for form inputs */
input[type="text"], input[type="password"], input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* Style for form buttons */
button[type="submit"] {
    background-color: #333;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
}

button[type="submit"]:hover {
    background-color: #555;
}

/* Style for links */
a {
    text-decoration: none;
    color: #007bff;
}

a:hover {
    text-decoration: underline;
}

/* Style for error messages */
.error-message {
    color: #f00;
    margin-top: 10px;
}

/* Style for success messages */
.success-message {
    color: #008000;
    margin-top: 10px;
}

/* Style for the registration form */
#register-form {
    display: none; /* Hide registration form by default */
}

/* Style for the "Switch to Register" link */
#switch-to-register {
    text-align: center;
    margin-top: 10px;
}

/* Style for the "Switch to Login" link */
#switch-to-login {
    text-align: center;
    margin-top: 10px;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php
        session_start();
        if (isset($_SESSION['username'])) {
            header('Location: index.php');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "web_novi";

            $koneksi = mysqli_connect($host, $user, $pass, $db);
            if (!$koneksi) {
                die("Tidak bisa terkoneksi ke database");
            }

            $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($koneksi, $sql);

            if ($result && mysqli_num_rows($result) == 1) {
                $_SESSION['username'] = $username;
                header('Location: index.php');
                exit();
            } else {
                $error = "Username atau password salah.";
            }
        }
        ?>

        <?php if (isset($error)) : ?>
            <div class="alert" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <!-- Formulir login -->
            <div class="mb-3">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>

        <!-- Tombol untuk mengarahkan ke halaman registrasi -->
        <p class="mt-3 text-center">Belum punya akun? <a href="register.php">Registrasi</a></p>
    </div>
</body>
</html>