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
        <thead>
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
                $stmt = $pdo->prepare("SELECT * FROM tb_kegiatan_kerjasama");
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
                            <img src="uploads/images/<?= $file ?>" alt="" width="300px">
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <form action="" method="post">
                            <a href="" data-id="<?= $row["idKegiatan"] ?>"><i class="btn btn-primary bi bi-list-ul"></i></a>
                            <a href="index.php?action=update_kegiatan&idKegiatan=<?= $row["idKegiatan"] ?>"><i class="btn btn-warning bi bi-pencil-square"></i></a>
                            <button name="delete" class="button-no-border tombol-aksi" value="<?= $row["idKegiatan"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus?')"><i class="btn btn-danger bi bi-trash"></i></button>
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