<?php
session_start();

include_once "../../Database/koneksi.php";

global $pdo;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM tb_user WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["username" => $username]);

        // cek username
        if ($stmt->rowCount()) {
            // cek password
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (password_verify($password, $result[0]["password"])) {
                $_SESSION["username"] = $result[0]["namaUser"];
                $_SESSION["role"] = $result[0]["role"];
                $_SESSION["id"] = $result[0]["idAkun"];
                $_SESSION["login"] = true;
                header("Location: ../../index.php?action=home");
                exit;
            } else {
                echo "<script>
                alert('Password salah!');
            </script>";
            }
        } else {
            echo "<script>
                alert('Username tidak ditemukan');
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../assets/image/logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body class="login">
    <div class="login-container shadow">
        <h1 class="text-center mb-4">WELCOME!</h1>
        <p class="text-center mb-4">Sign in to continue</p>
        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <!-- <a href="#" class="text-decoration-none">Forget password?</a> -->
                <!-- <a href="../landingPage.php" class="text-decoration-none"><i class="bi bi-arrow-left-circle me-2"></i> Back</a> -->
                <!-- <a href=""><i class="bi bi-arrow-left-circle me-2"></i> Back</a> -->
            </div>
            <button type="submit" class="btn btn-primary w-100" name="submit">Login</button>
        </form>
        <div class="text-center mt-3">
            <a href="../landingPage.php" style="color: #ff914d;" class="text-decoration-none"><i class="bi bi-arrow-left-circle"></i> Back</a>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>