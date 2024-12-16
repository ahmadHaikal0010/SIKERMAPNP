<?php

include_once "Library/functions.php";

global $pdo;

// Cek apakah yang menambah data adalah Admin atau Super Admin
if ($_SESSION["role"] === "super admin" || $_SESSION["role"] === "admin") {
    if (isset($_POST["submit"])) {
        if (updateMitra($_GET["idMitra"], $_POST)) {
            echo "<script>
                alert('Data berhasil dirubah');
                document.location.href = 'index.php?action=list_mitra';
                </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambahkan');
                document.location.href = 'index.php?action=list_mitra';
                </script>";
        }
    }
}

try {
    $stmt = $pdo->prepare("SELECT * FROM tb_mitra WHERE idMitra = :idMitra");
    $stmt->execute([":idMitra" => $_GET["idMitra"]]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Gagal mengambil data: " . $e->getMessage();
}

foreach ($result as $row);
?>

<div class="form-container">
    <h2 class="text-center mb-4">Update Data Mitra</h2>
    <div class="form-card mx-auto col-md-8 shadow">
        <form action="" method="POST">
            <!-- nama instansi -->
            <div class="mb-4">
                <label for="namaInstansi" class="form-label">Nama Instansi</label>
                <input type="text" id="namaInstansi" name="namaInstansi" class="form-control" value="<?= $row["namaInstansi"] ?>">
            </div>
            <!-- nama pimpinan -->
            <div class="mb-4">
                <label for="namaPimpinan" class="form-label">Nama Pimpinan</label>
                <input type="text" id="namaPimpinan" name="namaPimpinan" class="form-control" value="<?= $row["namaPimpinan"] ?>">
            </div>
            <!-- alamat mitra -->
            <div class="mb-4">
                <label for="alamatMitra" class="form-label">Alamat Mitra</label>
                <div class="form-floating">
                    <textarea class="form-control" name="alamatMitra" placeholder="alamat" id="alamatMitra" style="height: 100px">
                    <?= $row["alamatMitra"] ?>
                    </textarea>
                </div>
            </div>
            <!-- email mitra -->
            <div class="mb-4">
                <label for="emailMitra" class="form-label">Email Mitra</label>
                <input type="email" id="emailMitra" name="emailMitra" class="form-control" value="<?= $row["emailMitra"] ?>">
            </div>
            <!-- nomor telepon mitra -->
            <div class="mb-4">
                <label for="teleponMitra" class="form-label">Nomor Telepon Mitra</label>
                <input type="text" id="teleponMitra" name="teleponMitra" class="form-control" value="<?= $row["teleponMitra"] ?>">
            </div>
            <!-- bidang usaha -->
            <div class="mb-4">
                <label for="bidangUsaha" class="form-label">Bidang Usaha</label>
                <input type="text" id="bidangUsaha" name="bidangUsaha" class="form-control" value="<?= $row["bidangUsaha"] ?>">
            </div>
            <!-- website mitra -->
            <div class="mb-4">
                <label for="websiteMitra" class="form-label">Website Mitra</label>
                <input type="text" id="websiteMitra" name="websiteMitra" class="form-control" value="<?= $row["websiteMitra"] ?>">
                <!-- provinsi -->
                <div class="mb-4">
                    <label for="provinsi" class="form-label">Provinsi</label>
                    <input type="text" id="provinsi" name="provinsi" class="form-control" value="<?= $row["provinsi"] ?>">
                </div>
                <!-- kota -->
                <div class="mb-4">
                    <label for="kota" class="form-label">Kota</label>
                    <input type="text" id="kota" name="kota" class="form-control" value="<?= $row["kota"] ?>">
                </div>
                <button type="submit" name="submit" class="btn btn-primary w-30">Update</button>
        </form>
    </div>
</div>