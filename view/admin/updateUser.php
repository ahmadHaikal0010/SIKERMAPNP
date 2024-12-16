<?php

include_once "Library/functions.php";

global $pdo;

// Cek apakah yang menambah data adalah Super Admin
if ($_SESSION["role"] === "super admin") {
    if (isset($_POST["submit"])) {
        if (updateUser($_GET["idAkun"], $_POST)) {
            echo "<script>
                alert('Data berhasil dirubah');
                document.location.href = 'index.php';
                </script>";
        } else {
            echo "<script>
                alert('Data gagal dirubah');
                document.location.href = 'index.php?action=tambah_user';
                </script>";
        }
    }
}


try {
    $stmt = $pdo->prepare("SELECT * FROM tb_user WHERE idAkun = :idAkun");
    $stmt->execute([":idAkun" => $_GET["idAkun"]]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Gagal mengambil data: " . $e->getMessage();
}

foreach ($result as $row);
?>

<div class="form-container">
    <h2 class="text-center mb-4">Ubah Data User</h2>
    <div class="form-card mx-auto col-md-8 shadow">
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- nama user -->
            <div class="mb-4">
                <label for="namaUser" class="form-label">Nama User</label>
                <input type="text" id="namaUser" name="namaUser" class="form-control" value="<?= $row["namaUser"] ?>">
            </div>
            <!-- email user -->
            <div class="mb-4">
                <label for="emailUser" class="form-label">Email User</label>
                <input type="email" id="emailUser" name="emailUser" class="form-control" value="<?= $row["emailUser"] ?>">
            </div>
            <!-- username -->
            <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" value="<?= $row["username"] ?>">
            </div>
            <!-- password -->
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" value="<?= password_verify($row["password"], PASSWORD_DEFAULT) ?>">
            </div>
            <!-- confirm password -->
            <div class="mb-4">
                <label for="password2" class="form-label">Confirm Password</label>
                <input type="password" id="password2" name="password2" class="form-control" value="<?= password_verify($row["password"], PASSWORD_DEFAULT) ?>">
            </div>
            <!-- role -->
            <div class="mb-5">
                <label for="mitra" class="form-label">Role</label>
                <select name="role" id="role" class="form-select">
                    <option value="" disabled>role</option>
                    <option value="super admin" <?= ($row["role"] == "super admin") ? "selected" : "" ?>>Super Admin</option>
                    <option value="admin" <?= ($row["role"] == "admin") ? "selected" : "" ?>>Admin</option>
                    <option value="jurusan" <?= ($row["role"] == "jurusan") ? "selected" : "" ?>>Jurusan</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-30">Submit</button>
        </form>
    </div>
</div>