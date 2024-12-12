<?php
include_once "Library/functions.php";

?>

<!-- Main Content -->
<div class="row g-4">
    <div class="row g-4">
        <!-- Statistik Ringkasan -->
        <?php
        try {
            $stmt = $pdo->prepare("SELECT 
                                                YEAR(awalKerjasama) AS tahun, 
                                                jenisKerjasama,
                                                COUNT(*) AS jumlahKerjasama
                                            FROM 
                                                tb_mou_moa
                                            WHERE 
                                                YEAR(awalKerjasama) BETWEEN YEAR(CURDATE()) - 5 AND YEAR(CURDATE())
                                            GROUP BY 
                                                YEAR(awalKerjasama), jenisKerjasama
                                            ORDER BY 
                                                tahun DESC, jenisKerjasama;
                                            ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Gagal mengambil data: " . $e->getMessage();
        }

        $tahun  = [];
        $label = [];
        $jumlah = [];
        foreach ($result as $data) {
            $tahun[] = $data["tahun"];
            $label[] = $data["jenisKerjasama"];
            $jumlah[] = $data["jumlahKerjasama"];
        }

        // Mengurutkan data berdasarkan tahun secara ascending
        array_multisort($tahun, SORT_ASC, $label, $jumlah);

        $tahun_json = json_encode($tahun);
        $label_json = json_encode($label);
        $jumlah_json = json_encode($jumlah);;
        ?>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title home-judul">Statistik Ringkasan</h5>
                    <canvas id="myChart1"></canvas>
                </div>
            </div>
        </div>

        <!-- Daftar Pengajuan Baru -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title home-judul">Daftar Pengajuan Baru</h5>
                    <ul class="list-group">
                        <?php
                        try {
                            $stmt = $pdo->prepare("SELECT 
                                                                idUsulan, 
                                                                namaInstansi, 
                                                                DATE_FORMAT(waktu, '%d %M %Y') AS waktu
                                                            FROM 
                                                                tb_usulan_kerjasama 
                                                            ORDER BY 
                                                                idUsulan DESC 
                                                            LIMIT 5;
                                                            ");
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        } catch (PDOException $e) {
                            echo "Gagal mengambil data: " . $e->getMessage();
                        }

                        foreach ($result as $usulan):
                        ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">

                                <span><?= $usulan["namaInstansi"] ?></span>
                                <span class="text-muted home-isi"><?= $usulan["waktu"] ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-4">
        <!-- Daftar Kerjasama Terbaru -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title home-judul">Daftar Kerjasama Terbaru</h5>
                    <div class="d-flex kontainer-column">
                        <!-- <div class="me-3" style="background-color: #FF9A3F; width: 50px; height: 50px;"></div> -->
                        <?php
                        try {
                            $stmt = $pdo->prepare("SELECT 
                                                                idMouMoa, 
                                                                judul_kerjasama, 
                                                                DATE_FORMAT(awalKerjasama, '%d %M %Y') AS awalKerjasama, 
                                                                DATE_FORMAT(akhirKerjasama, '%d %M %Y') AS akhirKerjasama
                                                            FROM 
                                                                tb_mou_moa 
                                                            ORDER BY 
                                                                idMouMoa DESC 
                                                            LIMIT 5;
                                                            ");
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        } catch (PDOException $e) {
                            echo "Gagal mengambil data: " . $e->getMessage();
                        }

                        foreach ($result as $terbaru):
                        ?>
                            <div class="terbaru">
                                <p class="mb-1 ms-3"><strong><?= $terbaru["judul_kerjasama"] ?></strong></p>
                                <ul>
                                    <li>
                                        <p class="text-muted mb-0 home-isi"><?= $terbaru["awalKerjasama"] ?> - <?= $terbaru["akhirKerjasama"] ?></p>
                                    </li>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Kerjasama Yang Akan Berakhir -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title home-judul">Kerjasama Yang Akan Berakhir</h5>
                    <div class="d-flex kontainer-column">
                        <!-- <div class="me-3" style="background-color: #FF9A3F; width: 50px; height: 50px;"></div> -->
                        <?php
                        try {
                            $stmt = $pdo->prepare("SELECT idMouMoa, 
                                                                 judul_kerjasama, 
                                                                 DATE_FORMAT(awalKerjasama, '%d %M %Y') AS awalKerjasama, 
                                                                 DATE_FORMAT(akhirKerjasama, '%d %M %Y') AS akhirKerjasama
                                                          FROM tb_mou_moa 
                                                          WHERE akhirKerjasama BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
                                                          ORDER BY akhirKerjasama DESC LIMIT 5");
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        } catch (PDOException $e) {
                            echo "Gagal mengambil data: " . $e->getMessage();
                        }

                        foreach ($result as $berakhir):
                        ?>
                            <div class="terbaru">
                                <p class="mb-1 ms-3"><strong><?= $berakhir["judul_kerjasama"] ?></strong></p>
                                <ul>
                                    <li>
                                        <p class="text-muted mb-0 home-isi"><?= $berakhir["awalKerjasama"] ?> - <?= $berakhir["akhirKerjasama"] ?></p>
                                    </li>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('myChart1').getContext('2d');

    // Menyiapkan data untuk Chart.js
    const tahun = <?= $tahun_json ?>;
    const label = <?= $label_json ?>;
    const jumlah = <?= $jumlah_json ?>;

    // Mengelompokkan data berdasarkan jenisKerjasama
    const dataMOU = [];
    const dataMOA = [];

    tahun.forEach((year, index) => {
        if (label[index] === "mou") {
            dataMOU.push(jumlah[index]);
        } else if (label[index] === "moa") {
            dataMOA.push(jumlah[index]);
        }
    });

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: [...new Set(tahun)], // Set untuk tahun yang unik
            datasets: [{
                    label: 'MOU',
                    data: dataMOU,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2
                },
                {
                    label: 'MOA',
                    data: dataMOA,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah'
                    },
                    ticks: {
                        stepSize: 1, // Menetapkan langkah setiap label untuk angka bulat
                        callback: function(value) {
                            // Menghilangkan label desimal (menampilkan hanya angka bulat)
                            if (value % 1 === 0) {
                                return value;
                            }
                        }
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tahun'
                    }
                }
            }
        }
    });
</script>