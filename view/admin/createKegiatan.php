<?php

include_once "Library/functions.php";

global $pdo;

// Cek apakah yang menambah data adalah Admin atau Super Admin
if ($_SESSION["role"] === "super admin" || $_SESSION["role"] === "admin") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["submit"])) {
            if (createKegiatan($_POST)) {
                echo "<script>
                alert('Data berhasil ditambahkan');
                document.location.href = 'index.php?action=list_kegiatan';
                </script>";
            } else {
                echo "<script>
                alert('Data gagal ditambahkan');
                document.location.href = 'index.php?action=tambah_kegiatan';
                </script>";
            }
        }
    }
}
?>

<div class="form-container">
    <h2 class="text-center mb-4">Tambah Data Kegiatan Yang Telah Dilaksanakan</h2>
    <div class="form-card mx-auto col-md-8 shadow">
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- mou / moa -->
            <div class="mb-5">
                <label for="idMouMoa" class="form-label">Judul Kerjasama</label>
                <select name="idMouMoa" id="idMouMoa" class="form-select">
                    <option value="" selected disabled>MOU/MOA</option>
                    <?php
                    $stmt = $pdo->prepare("SELECT idMouMoa, judul_kerjasama FROM tb_mou_moa");
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $rows):
                    ?>
                        <option value="<?= $rows["idMouMoa"] ?>"><?= $rows["judul_kerjasama"] ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>
            <!-- kegiatan -->
            <div class="mb-4">
                <label for="kegiatan" class="form-label">Kegiatan</label>
                <input type="text" id="kegiatan" name="kegiatan" class="form-control">
            </div>
            <!-- deskripsi -->
            <div class="mb-4">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <div class="form-floating">
                    <textarea class="form-control" name="deskripsi" placeholder="alamat" id="deskripsi" style="height: 100px"></textarea>
                </div>
            </div>
            <!-- dokumentasi -->
            <div class="mb-4">
                <label for="dokumentasi" class="form-label">Dokumentasi</label>
                <input type="file" name="dokumentasi[]" id="dokumentasi" class="form-control" accept="image/*" multiple>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-30">Submit</button>
        </form>
    </div>
</div>