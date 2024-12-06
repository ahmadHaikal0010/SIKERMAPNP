<?php
include_once "database/koneksi.php";
global $pdo;
?>

<h2>Tambah Data MOU / MOA</h2>
<form action="" method="post" enctype="multipart/form-data">
    <!-- nomor mou moa -->
    <label for="nomorMou">Nomor MOU / MOA : </label>
    <input type="text" name="nomorMou" id="nomorMou">
    <!-- jenis kerjasama -->
    <label for="jenisKerjasama">Jenis Kerjasama : </label>
    <select name="jenisKerjasama" id="jenisKerjasama">
        <option value="mou">MOU</option>
        <option value="moa">MOA</option>
    </select>
    <!-- jangka waktu -->
    <input type="text" name="jangkaWaktu" id="jangkaWaktu" hidden>
    <!-- awal kerjasama -->
    <label for="awalKerjasama">Awal Kerjasama : </label>
    <input type="date" name="awalKerjasama" id="awalKerjasama">
    <!-- akhir kerjasama -->
    <label for="akhirKerjasama">Akhir Kerjasama : </label>
    <input type="date" name="akhirKerjasama" id="akhirKerjasama">
    <!-- keterangan -->
    <label for="keterangan">Keterangan : </label>
    <select name="keterangan" id="keterangan">
        <option value="aktif">Aktif</option>
        <option value="tidakAktif">Tidak Aktif</option>
    </select>
    <!-- tindakan -->
    <label for="tindakan">Tindakan : </label>
    <input type="text" name="tindakan" id="tindakan">
    <!-- jurusan -->
    <label for="">Jurusan Yang Melakukan PKS :</label>
    <input type="checkbox" name="jurusan" id="jurusan">
    <label for="jurusan">Teknologi Informasi</label>
    <!-- topik kerjasama -->
    <label for="topikKerjasama">Topik Kerjasama : </label>
    <input type="text" name="topikKerjasama" id="topikKerjasama">
    <!-- file dokumen -->
    <label for="fileDokumen">File Dokumen : </label>
    <input type="file" name="fileDokumen" id="fileDokumen">
    <!-- id mitra -->
    <label for="mitra_idMitra">Mitra :</label>
    <select name="mitra_idMitra" id="mitra_idMitra">
        <option value="" selected disabled>--mitra--</option>
        <?php
        $stmt = $pdo->prepare("SELECT namaInstansi FROM tb_mitra");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row):
        ?>
            <option value="<?= $row["namaInstansi"] ?>"><?= $row["namaInstansi"] ?></option>
        <?php
        endforeach;
        ?>
    </select>
    <!-- id user -->
    <input type="number" name="user_idAkun" id="user_idAkun" hidden>
    <button type="submit" name="submit">Submit</button>
</form>