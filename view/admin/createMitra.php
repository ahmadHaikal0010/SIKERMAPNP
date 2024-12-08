<?php

include_once "Library/functions.php";

global $pdo;

// Cek apakah yang menambah data adalah Admin atau Super Admin
if ($_SESSION["role"] === "super admin" || $_SESSION["role"] === "admin") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["submit"])) {
            if (createMitra($_POST)) {
                echo "<script>
                alert('Data berhasil ditambahkan');
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
}
?>

<div class="form-container">
    <h2 class="text-center mb-4">Tambah Data Mitra</h2>
    <div class="form-card mx-auto col-md-8">
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- nama instansi -->
            <div class="mb-4">
                <label for="namaInstansi" class="form-label">Nama Instansi</label>
                <input type="text" id="namaInstansi" name="namaInstansi" class="form-control" required>
            </div>
            <!-- nama pimpinan -->
            <div class="mb-4">
                <label for="namaPimpinan" class="form-label">Nama Pimpinan</label>
                <input type="text" id="namaPimpinan" name="namaPimpinan" class="form-control" required>
            </div>
            <!-- alamat mitra -->
            <div class="mb-4">
                <label for="alamatMitra" class="form-label">Alamat Mitra</label>
                <div class="form-floating">
                    <textarea class="form-control" name="alamatMitra" placeholder="alamat" id="alamatMitra" style="height: 100px"></textarea>
                </div>
            </div>
            <!-- email mitra -->
            <div class="mb-4">
                <label for="emailMitra" class="form-label">Email Mitra</label>
                <input type="email" id="emailMitra" name="emailMitra" class="form-control">
            </div>
            <!-- nomor telepon mitra -->
            <div class="mb-4">
                <label for="teleponMitra" class="form-label">Nomor Telepon Mitra</label>
                <input type="text" id="teleponMitra" name="teleponMitra" class="form-control" required>
            </div>
            <!-- bidang usaha -->
            <div class="mb-4">
                <label for="bidangUsaha" class="form-label">Bidang Usaha</label>
                <input type="text" id="bidangUsaha" name="bidangUsaha" class="form-control" required>
            </div>
            <!-- website mitra -->
            <div class="mb-4">
                <label for="websiteMitra" class="form-label">Website Mitra</label>
                <input type="text" id="websiteMitra" name="websiteMitra" class="form-control">
            <!-- provinsi -->
            <div class="mb-4">
                <label for="provinsi" class="form-label">Provinsi</label>
                <input type="text" id="provinsi" name="provinsi" class="form-control">
            </div>
            <!-- kota -->
            <div class="mb-4">
                <label for="kota" class="form-label">Kota</label>
                <input type="text" id="kota" name="kota" class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-30">Submit</button>
        </form>
    </div>
</div>