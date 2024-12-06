<?php
include_once "database/koneksi.php";
global $pdo;
?>

<h2>List Data Mitra</h2>
<table id="tabel-mou-moa" class="table table-bordered table-striped">
    <thead>
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
            $stmt = $pdo->prepare("SELECT * FROM tb_mitra");
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
                    <a href="" data-id="<?= $row["idMitra"] ?>"><i class="btn btn-primary bi bi-list-ul"></i></a>
                    <a href=""><i class="btn btn-warning bi bi-pencil-square"></i></a>
                    <a href=""><i class="btn btn-danger bi bi-trash"></i></a>
                </td>
            </tr>

        <?php
            $i++;
        endforeach;
        ?>
    </tbody>
</table>