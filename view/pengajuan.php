<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/image/logo.png" type="image/x-icon">
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- CSS External -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Pengusulan Kerjasama</title>
</head>

<body>
    <div class="form-container">
        <h2 class="text-center mb-4">Form Mengusulkan Kerjasama</h2>
        <div class="form-card mx-auto col-md-8">
            <form action="sendMail.php" method="POST" enctype="multipart/form-data">
                <!-- nama instansi -->
                <div class="mb-4">
                    <label for="nama_instansi" class="form-label">Nama Instansi</label>
                    <input type="text" id="nama_instansi" name="nama_instansi" class="form-control" required>
                </div>
                <!-- alamat instansi -->
                <div class="mb-4">
                    <label for="alamat_instansi" class="form-label">Alamat</label>
                    <div class="form-floating">
                        <textarea class="form-control" name="alamat_instansi" placeholder="alamat" id="alamat_instansi" style="height: 100px" required></textarea>
                    </div>
                </div>
                <!-- no kontak -->
                <div class="mb-4">
                    <label for="kontak" class="form-label">Kontak</label>
                    <input type="text" id="kontak" name="kontak" class="form-control" required>
                </div>
                <!-- nama penanda tangan -->
                <div class="mb-4">
                    <label for="nama_penandatangan" class="form-label">Nama Penanda Tangan</label>
                    <input type="text" id="nama_penandatangan" name="nama_penandatangan" class="form-control" required>
                </div>
                <!-- jabatan -->
                <div class="mb-4">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan" class="form-control" required>
                </div>
                <!-- kontak person -->
                <div class="mb-4">
                    <label for="kontak_person" class="form-label">Kontak Person</label>
                    <input type="text" id="kontak_person" name="kontak_person" class="form-control" required>
                </div>
                <!-- email -->
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <!-- dokumen -->
                <div class="mb-4">
                    <label for="dokumen" class="form-label">Dokumen Usulan</label>
                    <input type="file" name="dokumen" id="dokumen" class="form-control" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary w-30">Submit</button>
            </form>
        </div>
    </div>
</body>