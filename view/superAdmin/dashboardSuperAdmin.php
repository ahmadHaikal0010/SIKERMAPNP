<?php
include_once "database/koneksi.php";
global $pdo;
?>

<h2>List Data MOU dan MOA</h2>
<table id="tabel-mou-moa" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Jenis Kerjasama</th>
            <th>Mitra</th>
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
                <td><?= $row["keterangan"] ?></td>
                <td><?= $row["jurusan"] ?></td>
                <td>
                    <a href=""><i class="btn btn-primary bi bi-eye"></i></a>
                    <a href=""><i class="btn btn-success bi bi-cloud-download"></i></a>
                </td>
                <td>
                    <a href=""><i class="btn btn-primary bi bi-list-ul"></i></a>
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