<?php

include_once "Library/functions.php";

global $pdo;

if ($_SESSION["role"] === "super admin" || $_SESSION["role"] === "admin") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["delete"])) {
            if (deleteMouMoa($_POST["delete"])) {
                echo "<script>
                alert('Data berhasil dihapus');
                document.location.href = 'index.php?action=list_mou_moa';
                </script>";
            } else {
                echo "<script>
                alert('Data gagal dihapus');
                document.location.href = 'index.php?action=list_mou_moa';
                </script>";
            }
        }
    }
}
?>

<a href="?action=tambah_mou_moa" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i> Tambah</a>
<div class="table-responsive">
    <table id="tabel-mou-moa" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Kerjasama</th>
                <th>Mitra</th>
                <th>Jangka Waktu</th>
                <th>Topik Kerjasama</th>
                <th>Keterangan</th>
                <th>Jurusan</th>
                <th>Dokumen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            try {
                $stmt = $pdo->prepare("SELECT * FROM tb_mou_moa JOIN tb_mitra ON tb_mou_moa.mitra_idMitra = tb_mitra.idMitra");
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Gagal mengambil data: " . $e->getMessage();
            }

            foreach ($result as $row):
            ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $row["jenisKerjasama"] ?></td>
                    <td><?= $row["namaInstansi"] ?></td>
                    <td><?= $row["jangkaWaktu"] . " Tahun";?></td>
                    <td><?= $row["topik_kerjasama"] ?></td>
                    <td><?= $row["keterangan"] ?></td>
                    <td><?= $row["jurusan"] ?></td>
                    <td>
                        <a href="uploads/documents/<?= $row["fileDokumen"] ?>"><i class="btn btn-success bi bi-cloud-download"></i></a>
                        
                    </td>
                    <td>
                        <form action="" method="post">
                            <button name="detail" class="button-no-border tombol-aksi"><i class="btn btn-primary bi bi-list-ul"></i></button>
                            <button name="edit" class="button-no-border tombol-aksi"><i class="btn btn-warning bi bi-pencil-square"></i></button>
                            <button name="delete" class="button-no-border tombol-aksi" value="<?= $row["idMouMoa"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus?')"><i class="btn btn-danger bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>

            <?php
                $i++;
            endforeach;
            ?>
        </tbody>
    </table>
</div>