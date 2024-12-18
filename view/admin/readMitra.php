<?php

include_once "Library/functions.php";

global $pdo;

if ($_SESSION["role"] === "super admin" || $_SESSION["role"] === "admin") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["delete"])) {
            if (deleteMitra($_POST["delete"])) {
                echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php?action=list_mitra';
                </script>";
            } else {
                echo "<script>
                alert('Hapus data MOU/MOA yang berkaitan terlebih dahulu!');
                document.location.href = 'index.php?action=list_mitra';
                </script>";
            }
        }
    }
}
?>

<a href="?action=tambah_mitra" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i> Tambah</a>
<div class="table-responsive">
    <table id="tabel-mitra" class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Mitra</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Bidang Usaha</th>
                <th>Provinsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            try {
                $stmt = $pdo->prepare("SELECT * FROM tb_mitra ORDER BY idMitra DESC");
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Gagal mengambil data: " . $e->getMessage();
            }

            foreach ($result as $row):
            ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $row["namaInstansi"] ?></td>
                    <td><?= $row["alamatMitra"] ?></td>
                    <td><?= $row["emailMitra"] ?></td>
                    <td><?= $row["teleponMitra"] ?></td>
                    <td><?= $row["bidangUsaha"] ?></td>
                    <td><?= $row["provinsi"] ?></td>
                    <td>
                        <form action="" method="post" class="action-buttons-vertical">
                            <button type="button" name="detail" class="button-no-border tombol-aksi" data-bs-toggle="modal" data-bs-target="#<?= $row["idMitra"] ?>">
                                <i class="btn btn-primary bi bi-list-ul"></i>
                            </button>
                            <a href="index.php?action=update_mitra&idMitra=<?= $row["idMitra"] ?>"><i class="btn btn-warning bi bi-pencil-square"></i></a>
                            <button name="delete" class="button-no-border tombol-aksi" value="<?= $row["idMitra"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus?')"><i class="btn btn-danger bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="<?= $row["idMitra"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel"><?= $row["namaInstansi"] ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h6>Nama Pimpinan: <?= $row["namaPimpinan"] ?></h6>
                                <h6>Alamat Mitra: <?= $row["alamatMitra"] ?></h6>
                                <h6>Email Mitra: <?= $row["emailMitra"] ?></h6>
                                <h6>Telepon Mitra: <?= $row["teleponMitra"] ?></h6>
                                <h6>Bidang Usaha: <?= $row["bidangUsaha"] ?></h6>
                                <h6>Website Mitra: <?= $row["websiteMitra"] ?></h6>
                                <h6>Provinsi: <?= $row["provinsi"] ?></h6>
                                <h6>Kota: <?= $row["kota"] ?></h6>
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