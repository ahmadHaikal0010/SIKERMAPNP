<?php
include_once "Library/functions.php";

global $pdo;

// Cek apakah yang menambah data adalah Super Admin
if ($_SESSION["role"] === "super admin") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["submit"])) {
            if (register($_POST)) {
                echo "<script>
                alert('Data berhasil ditambahkan');
                document.location.href = 'index.php';
                </script>";
            } else {
                echo "<script>
                alert('Data gagal ditambahkan');
                document.location.href = 'index.php';
                </script>";
            }
        }
    }
}

?>

<h1>Tambah Akun</h1>
<form action="" method="post">
    <label for="nama">Nama : </label>
    <input type="text" name="namaUser" id="nama">
    <label for="email">Email : </label>
    <input type="email" name="emailUser" id="email">
    <label for="username">Username : </label>
    <input type="text" name="username" id="username">
    <label for="password">Password : </label>
    <input type="password" name="password" id="password">
    <label for="role">Role :</label>
    <select name="role" id="role">
        <option value="admin">Admin</option>
        <option value="jurusan">Jurusan</option>
        <option value="mitra">Mitra</option>
    </select>
    <button type="submit" name="submit">Register</button>
</form>