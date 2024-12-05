<?php
include_once "Database/koneksi.php";

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
                echo "<script>
                        alert('Login Berhasil');
                        document.location.href = 'index.php';
                    </script>";
                exit;
            }
        }
        echo "<script>
                alert('Username atau Password salah');
            </script>";
    }
}
?>

<body>
    <h1>Login</h1>
    <form action="" method="post">
        <label for="username">Username : </label>
        <input type="text" name="username" id="username">
        <label for="password">Password : </label>
        <input type="password" name="password" id="password">
        <button type="submit" name="submit">Login</button>
    </form>
</body>