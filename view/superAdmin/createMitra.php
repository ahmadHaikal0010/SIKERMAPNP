<?php
include_once "Library/functions.php";

global $pdo;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        if(createMitra($_POST)) {
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
?>

<h2>Tambah Data Mitra</h2>
<form action="" method="post" enctype="multipart/form-data">
    <!-- Nama Mitra -->
    <label for="namaInstansi">Nama Mitra : </label>
    <input type="text" name="namaInstansi" id="namaInstansi">
    <!-- Nama Pimpinan -->
    <label for="namaPimpinan">Nama Pimpinan : </label>
    <input type="text" name="namaPimpinan" id="namaPimpinan">
    <!-- Alamat Mitra -->
    <label for="alamatMitra">Alamat Mitra : </label>
    <input type="text" name="alamatMitra" id="alamatMitra">
    <!-- Email Mitra -->
    <label for="emailMitra">Email Mitra : </label>
    <input type="email" name="emailMitra" id="emailMitra">
    <!-- Nomor Telepon Mitra -->
    <label for="teleponMitra">Nomor Telepon Mitra : </label>
    <input type="text" name="teleponMitra" id="teleponMitra">
    <!-- Bidang Usaha -->
    <label for="bidangUsaha">Bidang Usaha : </label>
    <input type="text" name="bidangUsaha" id="bidangUsaha">
    <!-- Website Mitra -->
    <label for="websiteMitra">Website Mitra : </label>
    <input type="text" name="websiteMitra" id="websiteMitra">
    <!-- Provinsi -->
    <label for="provinsi">Provinsi : </label>
    <input type="text" name="provinsi" id="provinsi">
    <!-- Kota -->
    <label for="kota">Kota : </label>
    <input type="text" name="kota" id="kota">
    <button type="submit" name="submit">Submit</button>
</form>