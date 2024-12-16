<?php

include_once "Library/functions.php";

global $pdo;

if ($_SESSION["role"] === "super admin" || $_SESSION["role"] === "admin") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["delete"])) {
            if (deleteKegiatan($_POST["delete"])) {
                echo "<script>
                alert('Data berhasil dihapus');
                document.location.href = 'index.php?action=list_kegiatan';
                </script>";
            } else {
                echo "<script>
                alert('Data gagal dihapus');
                document.location.href = 'index.php?action=list_kegiatan';
                </script>";
            }
        }
    }
}
?>

<a href="?action=tambah_kegiatan" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i> Tambah</a>
<div class="table-responsive">
    <table id="tabel-kegiatan" class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Kegiatan</th>
                <th>Deskripsi</th>
                <th>Dokumentasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            try {
                $stmt = $pdo->prepare("SELECT * FROM tb_kegiatan_kerjasama ORDER BY idKegiatan DESC");
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Gagal mengambil data: " . $e->getMessage();
            }

            foreach ($result as $row):
            ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $row["kegiatan"] ?></td>
                    <td><?= $row["deskripsi"] ?></td>
                    <td>
                        <?php
                        $files = explode(",", $row["dokumentasi"]);
                        foreach ($files as $file):
                        ?>
                            <img src="uploads/images/<?= $file ?>" alt="" width="300px" class="tombol-aksi">
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <form action="" method="post" class="action-buttons-vertical">
                            <button type="button" name="detail" class="button-no-border tombol-aksi" data-bs-toggle="modal" data-bs-target="#<?= $row["idKegiatan"] ?>">
                                <i class="btn btn-primary bi bi-list-ul"></i>
                            </button>
                            <a href="index.php?action=update_kegiatan&idKegiatan=<?= $row["idKegiatan"] ?>"><i class="btn btn-warning bi bi-pencil-square"></i></a>
                            <button name="delete" class="button-no-border tombol-aksi" value="<?= $row["idKegiatan"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus?')">
                                <i class="btn btn-danger bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="<?= $row["idKegiatan"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel"><?= $row["kegiatan"] ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h6>Kegiatan: <?= $row["kegiatan"] ?></h6>
                                <h6>Deskripsi: <?= $row["deskripsi"] ?></h6>
                                <h6>Dokumentasi:</h6>
                                <?php
                                $files = explode(",", $row["dokumentasi"]);
                                foreach ($files as $file):
                                ?>
                                    <img src="uploads/images/<?= $file ?>" alt="" width="300px" class="tombol-aksi">
                                <?php endforeach; ?>
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