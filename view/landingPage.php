<?php
include_once "../database/koneksi.php";

global $pdo;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sikerma PNP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.bootstrap5.min.css">
    <style>
        /* General Styling */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Navigation Bar */
        .navbar {
            background-color: #1D2951;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            z-index: 1000;
        }

        .navbar .logo {
            font-size: 18px;
            margin-left: 100px;
            font-weight: bold;
        }

        .navbar .menu {
            display: flex;
            gap: 20px;
            margin-right: 100px;
        }

        .navbar .menu a {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .navbar .menu a:hover {
            text-decoration: underline;
        }

        /* Hero Section */
        .hero {
            background: url('../assets/image/heroo.jpg') no-repeat center center/cover;
            height: 100vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: 0px;
            /* Adjust for navbar height */
        }

        .hero h1 {
            font-size: 45px;
            font-weight: bold;
        }

        /* Statistik Section */
        .stats {
            background-color: #f57c00;
            color: white;
            padding: 2rem 0;
        }

        .stats h3 {
            font-size: 1.5rem;
            font-weight: bold;
        }

        /* Tabel Section */
        .table-section {
            padding: 2rem 0;
        }

        /* Footer */
        footer {
            background-color: #1D2951;
            color: white;
            text-align: left;
            justify-content: center;
            font-size: 15px;
            padding: 4px;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <div class="navbar">
        <div class="logo">SIKERMA - PNP</div>
        <div class="menu">
            <a href="">Ajukan Kerjasama</a>
            <a href="#stats">Statistik</a>
            <a href="#kerjasama">Kerjasama</a>
            <a href="auth/login.php">Login</a>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero">
        <div>
            <img src="../assets/image/logo.png" alt="Logo UNJ" class="mb-4" style="max-width: 180px;">
            <h1>Sistem Informasi Kerjasama</h1>
            <h1>Politeknik Negeri Padang</h1>
        </div>
    </div>

    <?php
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) as jumlah, jenisKerjasama FROM tb_mou_moa GROUP BY jenisKerjasama");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Gagal mengambil data: " . $e->getMessage();
    }

    $agree = [];
    foreach ($result as $row) {
        $agree[] = $row["jumlah"];
    }
    ?>

    <!-- Statistik Section -->
    <div id="stats" class="stats text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Memorandum of Understanding</h3>
                    <p class="fs-4"><?= $agree[1] ?></p>
                </div>
                <div class="col-md-6">
                    <h3>Memorandum of Agreement</h3>
                    <p class="fs-4"><?= $agree[0] ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Statistik Dokumen Kerjasama</h2>
        <div class="row">
            <div class="col-md-6">
                <div id="chart-dokument-per-tahun"></div>
            </div>
            <div class="col-md-6">
                <div id="chart-per-fakultas"></div>
            </div>
        </div>
    </div>

    <!-- Tabel Section -->
    <div id="kerjasama" class="table-section">
        <div class="container">
            <h2 class="text-center mb-4">Daftar Dokumen Kerjasama</h2>
            <table id="table-awal" class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama Mitra</th>
                        <th>Jenis</th>
                        <!-- <th>Judul Kerjasama</th> -->
                        <th>Tanggal Awal</th>
                        <th>Tanggal Akhir</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    try {
                        $stmt = $pdo->prepare("SELECT namaInstansi, jenisKerjasama, awalKerjasama, akhirKerjasama, keterangan FROM tb_mou_moa JOIN tb_mitra ON tb_mou_moa.idMouMoa = tb_mitra.idMitra ORDER BY awalKerjasama DESC");
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
                        <td><?= strtoupper($row["jenisKerjasama"]) ?></td>
                        <td><?= $row["awalKerjasama"] ?></td>
                        <td><?= $row["akhirKerjasama"] ?></td>
                        <td><?= $row["keterangan"] ?></td>
                        <td><button class="btn btn-primary btn-sm">Detail</button></td>
                    </tr>
                    <?php
                    $i++;
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-green-unj bt-gold py-3">
        <div class="container d-flex align-items-center justify-content-between px-4 px-lg-5">
            <div class="small text-white">
                <span>Copyright &copy; 2024</span>
                <span style="white-space: nowrap">Politeknik Negeri Padang</span>
            </div>
            <div class="small text-white">
                <b>Version : </b>1.0
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- JS DataTables -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.12/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.12/vfs_fonts.min.js"></script>

    <script>
        new DataTable("#table-awal");
    </script>

    <script>
        // Grafik Statistik Dokumen Kerjasama Berdasarkan Tahun
        var tahunOptions = {
            series: [{
                name: 'Dokumen Kerjasama',
                data: [30, 40, 35, 50, 60, 70, 80, 90, 100, 110, 120, 130, 140]
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            xaxis: {
                categories: ['2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024']
            },
            title: {
                text: 'Grafik Distribusi Dokumen Kerjasama Per Tahun'
            }
        };

        var chartDokumenTahun = new ApexCharts(document.querySelector("#chart-dokument-per-tahun"), tahunOptions);
        chartDokumenTahun.render();

        // Grafik Distribusi Dokumen Kerjasama Per Fakultas
        var fakultasOptions = {
            series: [{
                name: 'Fakultas A',
                data: [20, 30, 40, 50]
            }, {
                name: 'Fakultas B',
                data: [10, 20, 30, 40]
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            xaxis: {
                categories: ['2020', '2021', '2022', '2023']
            },
            title: {
                text: 'Grafik Distribusi Dokumen Kerjasama Per Fakultas'
            }
        };

        var chartFakultas = new ApexCharts(document.querySelector("#chart-per-fakultas"), fakultasOptions);
        chartFakultas.render();

        // Grafik Distribusi Klasifikasi Mitra Kerjasama
        var klasifikasiOptions = {
            series: [60, 40],
            chart: {
                type: 'pie',
                height: 350
            },
            labels: ['Internal', 'Eksternal'],
            title: {
                text: 'Grafik Distribusi Klasifikasi Mitra Kerjasama'
            }
        };

        var chartKlasifikasi = new ApexCharts(document.querySelector("#chart-klasifikasi-mitra"), klasifikasiOptions);
        chartKlasifikasi.render();

        // Grafik Distribusi Asal Negara Mitra Kerjasama
        var negaraOptions = {
            series: [70, 30],
            chart: {
                type: 'pie',
                height: 350
            },
            labels: ['Indonesia', 'Internasional'],
            title: {
                text: 'Grafik Distribusi Asal Negara Mitra Kerjasama'
            }
        };

        var chartNegara = new ApexCharts(document.querySelector("#chart-negara-mitra"), negaraOptions);
        chartNegara.render();
    </script>
</body>

</html>