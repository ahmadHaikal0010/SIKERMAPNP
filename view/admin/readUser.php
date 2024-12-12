<?php

include_once "Library/functions.php";

global $pdo;

if ($_SESSION["role"] === "super admin" || $_SESSION["role"] === "admin") {
    if (isset($_POST["delete"])) {
        if (deleteUser($_POST["delete"])) {
            echo "<script>
                alert('Data berhasil dihapus');
                document.location.href = 'index.php?action=list_user';
                </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus');
                document.location.href = 'index.php?action=list_user';
                </script>";
        }
    }
}

?>

<a href="?action=tambah_user" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i> Tambah</a>
<div class="table-responsive">
    <table id="tabel-user" class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Akun</th>
                <th>Email User</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            try {
                $stmt = $pdo->prepare("SELECT * FROM tb_user");
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Gagal mengambil data: " . $e->getMessage();
            }

            foreach ($result as $row):
            ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $row["namaUser"] ?></td>
                    <td><?= $row["emailUser"] ?></td>
                    <td><?= $row["username"] ?></td>
                    <td><?= $row["role"] ?></td>
                    <td>
                        <form action="" method="post" class="action-buttons-vertical">
                            <a href="index.php?action=update_user&idAkun=<?= $row["idAkun"] ?>"><i class="btn btn-warning bi bi-pencil-square"></i></a>
                            <button name="delete" class="button-no-border tombol-aksi" value="<?= $row["idAkun"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus?')"><i class="btn btn-danger bi bi-trash"></i></button>
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