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

<?php if ($_SESSION["role"] !== "jurusan"): ?>
    <a href="?action=tambah_mou_moa" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i> Tambah</a>
<?php endif; ?>
<div class="table-responsive">
    <table id="tabel-mou-moa" class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Jenis Kerjasama</th>
                <th>Judul Kerjasama</th>
                <th>Mitra</th>
                <th>Jangka Waktu</th>
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
                $stmt = $pdo->prepare("SELECT *, DATE_FORMAT(awalKerjasama, '%d %M %Y') AS awalKerjasama, DATE_FORMAT(akhirKerjasama, '%d %M %Y') AS akhirKerjasama, akhirKerjasama AS akhir FROM tb_mou_moa JOIN tb_mitra ON tb_mou_moa.mitra_idMitra = tb_mitra.idMitra ORDER BY awalKerjasama DESC");
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Gagal mengambil data: " . $e->getMessage();
            }

            foreach ($result as $row):
                if (date("Y-m-d") <= $row["akhir"]) {
                    $ket = "Aktif";
                } else {
                    $ket = "Tidak Aktif";
                }
            ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= strtoupper($row["jenisKerjasama"]) ?></td>
                    <td><?= $row["judul_kerjasama"] ?></td>
                    <td><?= $row["namaInstansi"] ?></td>
                    <td><?= $row["jangkaWaktu"] . " Tahun" ?></td>
                    <td>
                        <?= htmlspecialchars($ket, ENT_QUOTES, 'UTF-8') ?>
                    </td>
                    <td><?= $row["jurusan"]; ?></td>
                    <td>
                        <div class="action-buttons-vertical">
                            <a href="uploads/documents/<?= $row["fileDokumen"] ?>" download=""><i class="btn btn-success bi bi-cloud-download"></i></a>
                        </div>
                    </td>
                    <td>
                        <form action="" method="post" class="action-buttons-vertical">
                            <button type="button" name="detail" class="button-no-border tombol-aksi" data-bs-toggle="modal" data-bs-target="#<?= $row["idMouMoa"] ?>">
                                <i class="btn btn-primary bi bi-list-ul"></i>
                            </button>
                            <?php if ($_SESSION["role"] !== "jurusan"): ?>
                                <a href="index.php?action=update_mou_moa&idMouMoa=<?= $row["idMouMoa"] ?>" class="btn btn-warning bi bi-pencil-square"></a>
                                <button name="delete" class="button-no-border tombol-aksi" value="<?= $row["idMouMoa"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus?')">
                                    <i class="btn btn-danger bi bi-trash"></i>
                                </button>
                            <?php endif; ?>
                        </form>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal modal-lg fade" id="<?= $row["idMouMoa"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel"><?= $row["judul_kerjasama"] ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h6>Nomor MOU/MOA: <?= $row["nomorMouMoa"] ?></h6>
                                <h6>Jenis Kerjasama: <?= strtoupper($row["jenisKerjasama"]) ?></h6>
                                <h6>Jangka Waktu: <?= $row["jangkaWaktu"] ?> Tahun</h6>
                                <h6>Awal Kerjasama: <?= $row["awalKerjasama"] ?></h6>
                                <h6>Akhir Kerjasama: <?= $row["akhirKerjasama"] ?></h6>
                                <h6>Keterangan: <?= $ket ?></h6>
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