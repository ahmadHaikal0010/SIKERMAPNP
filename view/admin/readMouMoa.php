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
                $stmt = $pdo->prepare("SELECT *, DATE_FORMAT(awalKerjasama, '%d %M %Y') AS awalKerjasama, DATE_FORMAT(akhirKerjasama, '%d %M %Y') AS akhirKerjasama FROM tb_mou_moa JOIN tb_mitra ON tb_mou_moa.mitra_idMitra = tb_mitra.idMitra ORDER BY awalKerjasama DESC");
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
                    <td><?= $row["jangkaWaktu"] . " Tahun"; ?></td>
                    <td><?= $row["topik_kerjasama"] ?></td>
                    <td><?= $row["keterangan"] ?></td>
                    <td><?= $row["jurusan"] ?></td>
                    <td>
                        <a href="uploads/documents/<?= $row["fileDokumen"] ?>"><i class="btn btn-success bi bi-cloud-download"></i></a>
                    </td>
                    <td>
                        <form action="" method="post">
                            <button type="button" name="detail" class="button-no-border tombol-aksi" data-bs-toggle="modal" data-bs-target="#<?= $row["idMouMoa"] ?>"><i class="btn btn-primary bi bi-list-ul"></i></button>
                            <a href="index.php?action=update_mou_moa&idMouMoa=<?= $row["idMouMoa"] ?>"><i class="btn btn-warning bi bi-pencil-square ms-1"></i></a>
                            <button name="delete" class="button-no-border tombol-aksi" value="<?= $row["idMouMoa"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus?')"><i class="btn btn-danger bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="<?= $row["idMouMoa"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h6>Nomor MOU/MOA: <?= $row["nomorMouMoa"] ?></h6>
                                <h6>Jenis Kerjasama: <?= $row["jenisKerjasama"] ?></h6>
                                <h6>Jangka Waktu: <?= $row["jangkaWaktu"] ?> Tahun</h6>
                                <h6>Awal Kerjasama: <?= $row["awalKerjasama"] ?></h6>
                                <h6>Akhir Kerjasama: <?= $row["akhirKerjasama"] ?></h6>
                                <h6>Keterangan: <?= $row["keterangan"] ?></h6>
                                <h6>Tindakan: <?= $row["tindakan"] ?></h6>
                                <h6>Jurusan: <?= $row["jurusan"] ?></h6>
                                <h6>Topik Kerjasama: <?= $row["topik_kerjasama"] ?></h6>
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Understood</button> -->
                            </div>
                        </div>
                    </div>
                </div>

            <?php
                $i++;
            endforeach;
            ?>
        </tbody>
    </table>
</div>