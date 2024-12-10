<?php

include_once "Library/functions.php";

global $pdo;

// Cek apakah yang menambah data adalah Super Admin
if ($_SESSION["role"] === "super admin") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["submit"])) {
            if (createUser($_POST)) {
                echo "<script>
                alert('Data berhasil ditambahkan');
                document.location.href = 'index.php';
                </script>";
            } else {
                echo "<script>
                alert('Data gagal ditambahkan');
                document.location.href = 'index.php?action=tambah_user';
                </script>";
            }
        }
    }
}

?>

<div class="form-container">
    <h2 class="text-center mb-4">Tambah Data User</h2>
    <div class="form-card mx-auto col-md-8">
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- nama user -->
            <div class="mb-4">
                <label for="namaUser" class="form-label">Nama User</label>
                <input type="text" id="namaUser" name="namaUser" class="form-control" required>
            </div>
            <!-- email user -->
            <div class="mb-4">
                <label for="emailUser" class="form-label">Email User</label>
                <input type="email" id="emailUser" name="emailUser" class="form-control" required>
            </div>
            <!-- username -->
            <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <!-- password -->
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <!-- confirm password -->
            <div class="mb-4">
                <label for="password2" class="form-label">Confirm Password</label>
                <input type="password" id="password2" name="password2" class="form-control" required>
            </div>
            <!-- role -->
            <div class="mb-5">
                <label for="mitra" class="form-label">Role</label>
                <select name="role" id="role" class="form-select">
                    <option value="" selected disabled>role</option>
                    <option value="super admin">Super Admin</option>
                    <option value="admin">Admin</option>
                    <option value="jurusan">Jurusan</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-30">Submit</button>
        </form>
    </div>
</div>