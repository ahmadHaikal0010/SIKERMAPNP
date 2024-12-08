<?php

include_once "Library/functions.php";

global $pdo;

// Cek apakah yang menambah data adalah Admin atau Super Admin
if ($_SESSION["role"] === "super admin" || $_SESSION["role"] === "admin") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["submit"])) {
            if (createMouMoa($_POST)) {
                echo "<script>
                alert('Data berhasil ditambahkan');
                document.location.href = 'index.php?action=list_mou_moa';
                </script>";
            } else {
                echo "<script>
                alert('Data gagal ditambahkan');
                document.location.href = 'index.php?action=list_mou_moa';
                </script>";
            }
        }
    }
}
?>

<div class="form-container">
    <h2 class="text-center mb-4">Tambah Data MOU/MOA</h2>
    <div class="form-card mx-auto col-md-8">
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- nomor mou moa -->
            <div class="mb-4">
                <label for="nomorMou" class="form-label">Nomor MOU/MOA</label>
                <input type="text" id="nomorMou" name="nomorMou" class="form-control" required>
            </div>
            <!-- jenis kerjasama -->
            <div class="mb-4">
                <label for="jenisKerjasama" class="form-label">Jenis Kerjasama</label>
                <div class="form-check">
                    <input class="form-check-input" value="mou" type="radio" name="jenisKerjasama" id="flexRadioDefault1" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                        MOU
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="moa" type="radio" name="jenisKerjasama" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        MOA
                    </label>
                </div>
            </div>
            <!-- awal kerjasama -->
            <div class="mb-4">
                <label for="awalKerjasama" class="form-label">Awal Kerjasama</label>
                <input type="date" id="awalKerjasama" name="awalKerjasama" class="form-control" required>
            </div>
            <!-- akhir kerjasama -->
            <div class="mb-4">
                <label for="akhirKerjasama" class="form-label">Akhir Kerjasama</label>
                <input type="date" id="akhirKerjasama" name="akhirKerjasama" class="form-control" required>
            </div>
            <!-- keterangan -->
            <div class="mb-4">
                <label for="keterangan" class="form-label">Keterangan</label>
                <select id="keterangan" name="keterangan" class="form-select" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
            <!-- tindakan -->
            <div class="mb-4">
                <label for="tindakan" class="form-label">Tindakan</label>
                <input type="text" id="tindakan" name="tindakan" class="form-control">
            </div>
            <!-- jurusan -->
            <div class="mb-4">
                <label for="" class="form-label">Jurusan yang melakukan PKS</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jurusan[]" value="General" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        General
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jurusan[]" value="Teknologi Informasi" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Teknologi Informasi
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jurusan[]" value="Teknik Mesin" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Teknik Mesin
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jurusan[]" value="Teknik Sipil" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Teknik Sipil
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jurusan[]" value="Teknik Elektro" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Teknik Elektro
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jurusan[]" value="Teknik Administrasi Niaga" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Teknik Administrasi Niaga
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jurusan[]" value="Teknik Bahasa Inggris" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Teknik Bahasa Inggris
                    </label>
                </div>
            </div>
            <!-- topik kerjasama -->
            <div class="mb-4">
                <label for="topik_kerjasama" class="form-label">Topik Kerjasama</label>
                <input type="text" id="topik_kerjasama" name="topik_kerjasama" class="form-control">
            </div>
            <!-- file dokumen kerjasama -->
            <div class="mb-4">
                <label for="fileDokumen" class="form-label">File Dokumen Kerjasama</label>
                <input type="file" name="fileDokumen" id="fileDokumen" class="form-control">
            </div>
            <!-- mitra -->
            <div class="mb-5">
                <label for="mitra" class="form-label">Mitra</label>
                <select name="mitra_idMitra" id="mitra_idMitra" class="form-select">
                    <option value="" selected disabled>--mitra--</option>
                    <?php
                    $stmt = $pdo->prepare("SELECT idMitra, namaInstansi FROM tb_mitra");
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row):
                    ?>
                        <option value="<?= $row["idMitra"] ?>"><?= $row["namaInstansi"] ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>
            <input type="number" name="user_idAkun" value="<?= $_SESSION["id"] ?>" hidden>
            <button type="submit" name="submit" class="btn btn-primary w-30">Submit</button>
        </form>
    </div>
</div>