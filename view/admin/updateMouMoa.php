<?php

include_once "Library/functions.php";

global $pdo;

// Cek apakah yang menambah data adalah Admin atau Super Admin
if ($_SESSION["role"] === "super admin" || $_SESSION["role"] === "admin") {
    if (isset($_POST["submit"])) {
        if (updateMouMoa($_GET["idMouMoa"], $_POST)) {
            echo "<script>
                alert('Data berhasil dirubah');
                document.location.href = 'index.php?action=list_mou_moa';
                </script>";
        } else {
            echo "<script>
                alert('Data gagal dirubah');
                document.location.href = 'index.php?action=list_mou_moa';
                </script>";
        }
    }
}

try {
    $stmt = $pdo->prepare("SELECT nomorMouMoa, jenisKerjasama, judul_kerjasama, awalKerjasama, akhirKerjasama, tindakan, jurusan, topik_kerjasama, fileDokumen, mitra_idMitra FROM tb_mou_moa WHERE idMouMoa = :idMouMoa");
    $stmt->execute([":idMouMoa" => $_GET["idMouMoa"]]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Gagal mengambil data: " . $e->getMessage();
}

foreach ($result as $row);
if ($row["jurusan"] !== "General") {
    $jurusan = explode(",", $row["jurusan"]);
} else {
    $jurusan = [];
}
?>

<div class="form-container">
    <h2 class="text-center mb-4">Ubah Data MoU & MoA</h2>
    <div class="form-card mx-auto col-md-8 shadow">
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- nomor mou moa -->
            <div class="mb-4">
                <label for="nomorMou" class="form-label">Nomor MoU & MoA</label>
                <input type="text" id="nomorMou" name="nomorMou" class="form-control" value="<?= $row["nomorMouMoa"] ?>" required>
            </div>
            <!-- jenis kerjasama -->
            <div class="mb-4">
                <label for="jenisKerjasama" class="form-label">Jenis Kerjasama</label>
                <div class="form-check">
                    <input class="form-check-input" value="mou" type="radio" name="jenisKerjasama" id="flexRadioDefault1" <?= ($row["jenisKerjasama"] == "mou") ? "checked" : "" ?>>
                    <label class="form-check-label" for="flexRadioDefault1">
                        MOU
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="moa" type="radio" name="jenisKerjasama" id="flexRadioDefault2" <?= ($row["jenisKerjasama"] == "moa") ? "checked" : "" ?>>
                    <label class="form-check-label" for="flexRadioDefault2">
                        MOA
                    </label>
                </div>
            </div>
            <!-- mitra -->
            <div class="mb-5">
                <label for="mitra" class="form-label">Mitra</label>
                <select name="mitra_idMitra" id="mitra_idMitra" class="form-select">
                    <option value="" selected disabled>Mitra</option>
                    <?php
                    $stmt = $pdo->prepare("SELECT idMitra, namaInstansi FROM tb_mitra");
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $rows):
                        $selected = ($rows["idMitra"] == $row["mitra_idMitra"]) ? "selected" : "";
                    ?>
                        <option value="<?= $rows["idMitra"] ?>" <?= $selected ?>><?= $rows["namaInstansi"] ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>
            <!-- judul kerjasama -->
            <div class="mb-4">
                <label for="judulKerjasama" class="form-label">Judul Kerjasama</label>
                <input type="text" id="judulKerjasama" name="judulKerjasama" class="form-control" value="<?= $row["judul_kerjasama"] ?>" required>
            </div>
            <!-- awal kerjasama -->
            <div class="mb-4">
                <label for="awalKerjasama" class="form-label">Awal Kerjasama</label>
                <input type="date" id="awalKerjasama" name="awalKerjasama" class="form-control" value="<?= $row["awalKerjasama"] ?>" required>
            </div>
            <!-- akhir kerjasama -->
            <div class="mb-4">
                <label for="akhirKerjasama" class="form-label">Akhir Kerjasama</label>
                <input type="date" id="akhirKerjasama" name="akhirKerjasama" class="form-control" value="<?= $row["akhirKerjasama"] ?>" required>
            </div>
            <!-- tindakan -->
            <div class="mb-4">
                <label for="tindakan" class="form-label">Tindakan</label>
                <input type="text" id="tindakan" name="tindakan" class="form-control" value="<?= $row["tindakan"] ?>">
            </div>
            <!-- jurusan -->
            <div class="mb-4">
                <label for="" class="form-label">Jurusan yang melakukan PKS</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jurusan[]" value="General" id="flexCheckDefault" <?= ($row["jurusan"] == "General") ? "checked" : "" ?>>
                    <label class="form-check-label" for="flexCheckDefault">
                        General
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jurusan[]" value="Teknologi Informasi" id="flexCheckDefault" <?= (in_array("Teknologi Informasi", $jurusan)) ? "checked" : "" ?>>
                    <label class="form-check-label" for="flexCheckDefault">
                        Teknologi Informasi
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jurusan[]" value="Teknik Mesin" id="flexCheckDefault" <?= (in_array("Teknik Mesin", $jurusan)) ? "checked" : "" ?>>
                    <label class="form-check-label" for="flexCheckDefault">
                        Teknik Mesin
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jurusan[]" value="Teknik Sipil" id="flexCheckDefault" <?= (in_array("Teknik Sipil", $jurusan)) ? "checked" : "" ?>>
                    <label class="form-check-label" for="flexCheckDefault">
                        Teknik Sipil
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jurusan[]" value="Teknik Elektro" id="flexCheckDefault" <?= (in_array("Teknik Elektro", $jurusan)) ? "checked" : "" ?>>
                    <label class="form-check-label" for="flexCheckDefault">
                        Teknik Elektro
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jurusan[]" value="Administrasi Niaga" id="flexCheckDefault" <?= (in_array("Administrasi Niaga", $jurusan)) ? "checked" : "" ?>>
                    <label class="form-check-label" for="flexCheckDefault">
                        Teknik Administrasi Niaga
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jurusan[]" value="Bahasa Inggris" id="flexCheckDefault" <?= (in_array("Bahasa Inggris", $jurusan)) ? "checked" : "" ?>>
                    <label class="form-check-label" for="flexCheckDefault">
                        Teknik Bahasa Inggris
                    </label>
                </div>
            </div>
            <!-- topik kerjasama -->
            <div class="mb-4">
                <label for="topik_kerjasama" class="form-label">Topik Kerjasama</label>
                <input type="text" id="topik_kerjasama" name="topik_kerjasama" class="form-control" value="<?= $row["topik_kerjasama"] ?>">
            </div>
            <!-- file dokumen kerjasama -->
            <div class="mb-4">
                <label for="fileDokumen" class="form-label">File Dokumen Kerjasama</label>
                <input type="file" name="fileDokumen" id="fileDokumen" class="form-control">
            </div>
            <input type="number" name="user_idAkun" value="<?= $_SESSION["id"] ?>" hidden>
            <input type="text" name="fileLama" value="<?= $row["fileDokumen"] ?>" hidden>
            <button type="submit" name="submit" class="btn btn-primary w-30">Update</button>
        </form>
    </div>
</div>