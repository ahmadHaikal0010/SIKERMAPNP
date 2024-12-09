<?php

include_once "Library/functions.php";

global $pdo;

// Cek apakah yang menambah data adalah Admin atau Super Admin
if ($_SESSION["role"] === "super admin" || $_SESSION["role"] === "admin") {
    if (isset($_POST["submit"])) {
        if (updateKegiatan($_GET["idKegiatan"], $_POST)) {
            echo "<script>
                alert('Data berhasil dirubah');
                document.location.href = 'index.php?action=list_kegiatan';
                </script>";
        } else {
            echo "<script>
                alert('Data gagal dirubah');
                document.location.href = 'index.php?action=tambah_kegiatan';
                </script>";
        }
    }
}

try {
    $stmt = $pdo->prepare("SELECT * FROM tb_kegiatan_kerjasama WHERE idKegiatan = :idKegiatan");
    $stmt->execute([":idKegiatan" => $_GET["idKegiatan"]]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Gagal mengambil data: " . $e->getMessage();
}

foreach ($result as $data);
?>

<div class="form-container">
    <h2 class="text-center mb-4">Ubah Data Kegiatan Yang Telah Dilaksanakan</h2>
    <div class="form-card mx-auto col-md-8">
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- mou / moa -->
            <div class="mb-5">
                <label for="idMouMoa" class="form-label">MOU/MOA</label>
                <select name="idMouMoa" id="idMouMoa" class="form-select">
                    <option value="" selected disabled>mou/moa</option>
                    <?php
                    $stmt = $pdo->prepare("SELECT idMouMoa, nomorMouMoa FROM tb_mou_moa");
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $rows):
                        $selected = ($rows["idMouMoa"] == $data["tb_mou_moa_idMouMoa"]) ? "selected" : "";
                    ?>
                        <option value="<?= $rows["idMouMoa"] ?>" <?= $selected ?>><?= $rows["nomorMouMoa"] ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>
            <!-- mitra -->
            <div class="mb-5">
                <label for="idMitra" class="form-label">Mitra</label>
                <select name="idMitra" id="idMitra" class="form-select">
                    <option value="" selected disabled>mitra</option>
                    <?php
                    $stmt = $pdo->prepare("SELECT idMitra, namaInstansi FROM tb_mitra");
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row):
                        $selected = ($row["idMitra"] == $data["tb_mou_moa_mitra_idMitra"]) ? "selected" : "";
                    ?>
                        <option value="<?= $row["idMitra"] ?>" <?= $selected ?>><?= $row["namaInstansi"] ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>
            <!-- kegiatan -->
            <div class="mb-4">
                <label for="kegiatan" class="form-label">Kegiatan</label>
                <input type="text" id="kegiatan" name="kegiatan" class="form-control" value="<?= $data["kegiatan"] ?>" required>
            </div>
            <!-- deskripsi -->
            <div class="mb-4">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <div class="form-floating">
                    <textarea class="form-control" name="deskripsi" placeholder="alamat" id="deskripsi" style="height: 100px">
                        <?= $data["deskripsi"] ?>
                    </textarea>
                </div>
            </div>
            <!-- dokumentasi -->
            <div class="mb-4">
                <label for="dokumentasi" class="form-label">Dokumentasi</label>
                <input type="file" name="dokumentasi[]" id="dokumentasi" class="form-control" multiple>
            </div>
            <input type="text" name="fileLama" value="<?= $data["dokumentasi"] ?>" hidden>
            <button type="submit" name="submit" class="btn btn-primary w-30">Update</button>
        </form>
    </div>
</div>