<?php

require 'assets/PHPMailer/src/PHPMailer.php';
require 'assets/PHPMailer/src/Exception.php';
require 'assets/PHPMailer/src/SMTP.php';
include_once "Database/koneksi.php";

// Create User
function createUser($data)
{
    global $pdo;

    if ($data["password"] !== $data["password2"]) {
        echo "<script>alert('Password tidak sama');</script>";

        return false;
    }

    $stmt = $pdo->prepare("INSERT INTO tb_user (namaUser, emailUser, username, password, role) VALUES (:namaUser, :emailUser, :username, :password, :role)");
    return $stmt->execute([
        ":namaUser" => htmlspecialchars($data["namaUser"]),
        ":emailUser" => htmlspecialchars($data["emailUser"]),
        ":username" => htmlspecialchars($data["username"]),
        ":password" => password_hash($data["password"], PASSWORD_DEFAULT),
        ":role" => $data["role"]
    ]);
}

// Update User
function updateUser($id, $data)
{
    global $pdo;

    $stmt = $pdo->prepare("UPDATE tb_user SET namaUser = :namaUser, emailUser = :emailUser, username = :username, password = :password, role = :role WHERE idAkun = :id");
    return $stmt->execute([
        ":idAkun" => $id,
        ":namaUser" => htmlspecialchars($data["namaUser"]),
        ":emailUser" => htmlspecialchars($data["emailUser"]),
        ":username" => htmlspecialchars($data["username"]),
        ":password" => password_hash($data["password"], PASSWORD_DEFAULT),
        ":role" => $data["role"]
    ]);
}

// Delete User
function deleteUser($id)
{
    global $pdo;

    $stmt = $pdo->prepare("DELETE FROM tb_user WHERE idAkun = :id");
    return $stmt->execute([":id" => $id]);
}

// Create Mitra
function createMitra($data)
{
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO tb_mitra (namaInstansi, namaPimpinan, alamatMitra, emailMitra, teleponMitra, bidangUsaha, websiteMitra, provinsi, kota) VALUES (:namaInstansi, :namaPimpinan, :alamatMitra, :emailMitra, :teleponMitra, :bidangUsaha, :websiteMitra, :provinsi, :kota)");
    return $stmt->execute([
        ":namaInstansi" => htmlspecialchars($data["namaInstansi"]),
        ":namaPimpinan" => htmlspecialchars($data["namaPimpinan"]),
        ":alamatMitra" => htmlspecialchars($data["alamatMitra"]),
        ":emailMitra" => htmlspecialchars($data["emailMitra"]),
        ":teleponMitra" => htmlspecialchars($data["teleponMitra"]),
        ":bidangUsaha" => htmlspecialchars($data["bidangUsaha"]),
        ":websiteMitra" => htmlspecialchars($data["websiteMitra"]),
        ":provinsi" => htmlspecialchars($data["provinsi"]),
        ":kota" => htmlspecialchars($data["kota"])
    ]);
}

// Update Mitra
function updateMitra($id, $data)
{
    global $pdo;

    $stmt = $pdo->prepare("UPDATE tb_mitra SET 
    namaInstansi = :namaInstansi,
    namaPimpinan = :namaPimpinan,
    alamatMitra = :alamatMitra,
    emailMitra = :emailMitra,
    teleponMitra = :teleponMitra,
    bidangUsaha = :bidangUsaha,
    websiteMitra = :websiteMitra,
    provinsi = :provinsi,
    kota = :kota
    WHERE idMitra = :idMitra");
    return $stmt->execute([
        ":namaInstansi" => htmlspecialchars($data["namaInstansi"]),
        ":namaPimpinan" => htmlspecialchars($data["namaPimpinan"]),
        ":alamatMitra" => htmlspecialchars($data["alamatMitra"]),
        ":emailMitra" => htmlspecialchars($data["emailMitra"]),
        ":teleponMitra" => htmlspecialchars($data["teleponMitra"]),
        ":bidangUsaha" => htmlspecialchars($data["bidangUsaha"]),
        ":websiteMitra" => htmlspecialchars($data["websiteMitra"]),
        ":provinsi" => htmlspecialchars($data["provinsi"]),
        ":kota" => htmlspecialchars($data["kota"]),
        ":idMitra" => $id
    ]);
}

// Delete Mitra
function deleteMitra($id)
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("DELETE FROM tb_mitra WHERE idMitra = :id");
        return $stmt->execute([":id" => $id]);
    } catch (PDOException $message) {
        // echo "Gagal menghapus data: " . $message->getMessage();
    }
}

// Create MOU/MOA
function createMouMoa($data)
{
    global $pdo;

    $tanggal1 = new DateTime($data["awalKerjasama"]);
    $tanggla2 = new DateTime($data["akhirKerjasama"]);
    $jangkaWaktu = $tanggal1->diff($tanggla2);


    // upload file
    $fileName = $_FILES["fileDokumen"]["name"];
    $fileDirektori = "uploads/documents/";
    $fileTemporary = $_FILES["fileDokumen"]["tmp_name"];
    $file_size = $_FILES["fileDokumen"]["size"];

    // mengambil esktensi file
    $ekstensi = explode(".", $fileName);
    $ekstensi = strtolower(end($ekstensi));

    // cek ekstensi file
    $ekstensi_valid = ["pdf", "doc", "docx"];;
    if (!in_array($ekstensi, $ekstensi_valid)) {
        echo "<script>
            alert('File harus berformat pdf, doc, docx!');
            </script>";

        return false;
    }

    // cek ukuran file
    if ($file_size > 3000000) {
        echo "<script>
            alert('Ukuran file harus lebih kecil dari 3MB!');
            </script>";

        return false;
    }

    // generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensi;

    // memindahkan file dari temporary ke direktori penyimpanan
    move_uploaded_file($fileTemporary, $fileDirektori . $namaFileBaru);

    $jurusan = implode(",", $data["jurusan"]);

    $stmt = $pdo->prepare("INSERT INTO tb_mou_moa (nomorMouMoa, jenisKerjasama, judul_kerjasama, jangkaWaktu, awalKerjasama, akhirKerjasama, tindakan, jurusan, topik_kerjasama, fileDokumen,  mitra_idMitra, user_idAkun) VALUES (:nomorMouMoa, :jenisKerjasama, :judul_kerjasama, :jangkaWaktu, :awalKerjasama, :akhirKerjasama, :tindakan, :jurusan, :topik_kerjasama, :fileDokumen,  :mitra_idMitra, :user_idAkun)");
    return $stmt->execute([
        ":nomorMouMoa" => htmlspecialchars($data["nomorMou"]),
        ":jenisKerjasama" => htmlspecialchars($data["jenisKerjasama"]),
        ":judul_kerjasama" => htmlspecialchars($data["judulKerjasama"]),
        ":jangkaWaktu" =>  htmlspecialchars($jangkaWaktu->y),
        ":awalKerjasama" => htmlspecialchars($data["awalKerjasama"]),
        ":akhirKerjasama" => htmlspecialchars($data["akhirKerjasama"]),
        ":tindakan" => htmlspecialchars($data["tindakan"]),
        ":jurusan" => htmlspecialchars($jurusan),
        ":topik_kerjasama" => htmlspecialchars($data["topik_kerjasama"]),
        ":fileDokumen" => htmlspecialchars($namaFileBaru),
        ":mitra_idMitra" => htmlspecialchars($data["mitra_idMitra"]),
        ":user_idAkun" => htmlspecialchars($data["user_idAkun"])
    ]);
}

// Update MOU/MOA
function updateMouMoa($id, $data)
{
    global $pdo;

    $tanggal1 = new DateTime($data["awalKerjasama"]);
    $tanggla2 = new DateTime($data["akhirKerjasama"]);
    $jangkaWaktu = $tanggal1->diff($tanggla2);

    if (!empty($_FILES['fileDokumen']['name'][0])) {
        // upload file
        $fileName = $_FILES["fileDokumen"]["name"];
        $fileDirektori = "uploads/documents/";
        $fileTemporary = $_FILES["fileDokumen"]["tmp_name"];
        $file_size = $_FILES["fileDokumen"]["size"];

        // mengambil esktensi file
        $ekstensi = explode(".", $fileName);
        $ekstensi = strtolower(end($ekstensi));

        // cek ekstensi file
        $ekstensi_valid = ["pdf", "doc", "docx"];;
        if (!in_array($ekstensi, $ekstensi_valid)) {
            echo "<script>
            alert('File harus berformat pdf, doc, docx!');
            </script>";

            return false;
        }

        // cek ukuran file
        if ($file_size > 3000000) {
            echo "<script>
            alert('Ukuran file harus lebih kecil dari 3MB!');
            </script>";

            return false;
        }

        // generate nama file baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= ".";
        $namaFileBaru .= $ekstensi;

        // memindahkan file dari temporary ke direktori penyimpanan
        move_uploaded_file($fileTemporary, $fileDirektori . $namaFileBaru);
    } else {
        $namaFileBaru = $data["fileLama"];
    }

    $jurusan = implode(",", $data["jurusan"]);

    $stmt = $pdo->prepare("UPDATE tb_mou_moa SET 
    nomorMouMoa = :nomorMouMoa,
    jenisKerjasama = :jenisKerjasama,
    judul_kerjasama = :judul_kerjasama,
    jangkaWaktu = :jangkaWaktu,
    awalKerjasama = :awalKerjasama,
    akhirKerjasama = :akhirKerjasama,
    tindakan = :tindakan,
    jurusan = :jurusan,
    topik_kerjasama = :topik_kerjasama,
    fileDokumen = :fileDokumen,
    mitra_idMitra = :mitra_idMitra,
    user_idAkun = :user_idAkun
    WHERE idMouMoa = :idMouMoa");
    return $stmt->execute([
        ":nomorMouMoa" => htmlspecialchars($data["nomorMou"]),
        ":jenisKerjasama" => htmlspecialchars($data["jenisKerjasama"]),
        ":judul_kerjasama" => htmlspecialchars($data["judulKerjasama"]),
        ":jangkaWaktu" =>  htmlspecialchars($jangkaWaktu->y),
        ":awalKerjasama" => htmlspecialchars($data["awalKerjasama"]),
        ":akhirKerjasama" => htmlspecialchars($data["akhirKerjasama"]),
        ":tindakan" => htmlspecialchars($data["tindakan"]),
        ":jurusan" => htmlspecialchars($jurusan),
        ":topik_kerjasama" => htmlspecialchars($data["topik_kerjasama"]),
        ":fileDokumen" => htmlspecialchars($namaFileBaru),
        ":mitra_idMitra" => htmlspecialchars($data["mitra_idMitra"]),
        ":user_idAkun" => htmlspecialchars($data["user_idAkun"]),
        ":idMouMoa" => $id
    ]);
}

// Delete MOU/MOA
function deleteMouMoa($id)
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("DELETE FROM tb_mou_moa WHERE idMouMoa = :id");
        return $stmt->execute([":id" => $id]);
    } catch (PDOException $message) {
        // echo "Gagal menghapus data: " . $message->getMessage();
    }
}

// Create Kegiatan
function createKegiatan($data)
{
    global $pdo;

    $sql = $pdo->prepare("SELECT * FROM tb_mou_moa WHERE idMouMoa = :id");
    $sql->execute([":id" => $data["idMouMoa"]]);
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row);
    $idMitra = $row["mitra_idMitra"];

    $direktori = "uploads/images/";
    $file = [];

    foreach ($_FILES['dokumentasi']['tmp_name'] as $key => $tmpName) {
        $fileName = $_FILES['dokumentasi']['name'][$key]; // Nama file asli
        $fileTmpPath = $_FILES['dokumentasi']['tmp_name'][$key]; // Path sementara file
        $file_size = $_FILES["dokumentasi"]["size"][$key];

        // mengambil esktensi file
        $ekstensi = explode(".", $fileName);
        $ekstensi = strtolower(end($ekstensi));

        // cek ukuran file
        if ($file_size > 3000000) {
            echo "<script>
            alert('Ukuran file harus lebih kecil dari 3MB!');
            </script>";

            return false;
        }

        // generate nama file baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= ".";
        $namaFileBaru .= $ekstensi;

        $fileDestination = $direktori . $namaFileBaru; // Path tujuan

        $file[] = $namaFileBaru;

        move_uploaded_file($fileTmpPath, $fileDestination);
    }

    $namaFile = implode(",", $file);

    $stmt = $pdo->prepare("INSERT INTO tb_kegiatan_kerjasama (kegiatan, deskripsi, dokumentasi, tb_mou_moa_idMouMoa, tb_mou_moa_mitra_idMitra, tb_mou_moa_user_idAkun) VALUES (:kegiatan, :deskripsi, :dokumentasi, :tb_mou_moa_idMouMoa, :tb_mou_moa_mitra_idMitra, :tb_mou_moa_user_idAkun)");
    return $stmt->execute([
        ":kegiatan" => htmlspecialchars($data["kegiatan"]),
        ":deskripsi" => htmlspecialchars($data["deskripsi"]),
        ":dokumentasi" => htmlspecialchars($namaFile),
        ":tb_mou_moa_idMouMoa" => htmlspecialchars($data["idMouMoa"]),
        ":tb_mou_moa_mitra_idMitra" => htmlspecialchars($idMitra),
        ":tb_mou_moa_user_idAkun" => htmlspecialchars($result[0]["user_idAkun"])
    ]);
}

// Update Kegiatan
function updateKegiatan($id, $data)
{
    global $pdo;

    $sql = $pdo->prepare("SELECT * FROM tb_mou_moa WHERE idMouMoa = :id");
    $sql->execute([":id" => $data["idMouMoa"]]);
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row);
    $idMitra = $row["mitra_idMitra"];

    $direktori = "uploads/images/";
    $file = [];

    if (!empty($_FILES['files']['name'][0])) {
        foreach ($_FILES['dokumentasi']['tmp_name'] as $key => $tmpName) {
            $fileName = $_FILES['dokumentasi']['name'][$key]; // Nama file asli
            $fileTmpPath = $_FILES['dokumentasi']['tmp_name'][$key]; // Path sementara file
            $file_size = $_FILES["dokumentasi"]["size"][$key];

            // mengambil esktensi file
            $ekstensi = explode(".", $fileName);
            $ekstensi = strtolower(end($ekstensi));

            // cek ukuran file
            if ($file_size > 3000000) {
                echo "<script>
            alert('Ukuran file harus kecil dari 3MB!');
            </script>";

                return false;
            }

            // generate nama file baru
            $namaFileBaru = uniqid();
            $namaFileBaru .= ".";
            $namaFileBaru .= $ekstensi;

            $fileDestination = $direktori . $namaFileBaru; // Path tujuan

            $file[] = $namaFileBaru;

            move_uploaded_file($fileTmpPath, $fileDestination);
        }

        $namaFile = implode(",", $file);
    } else {
        $namaFile = $data["fileLama"];
    }

    $stmt = $pdo->prepare("UPDATE tb_kegiatan_kerjasama SET 
    kegiatan = :kegiatan,
    deskripsi = :deskripsi,
    dokumentasi = :dokumentasi,
    tb_mou_moa_idMouMoa = :tb_mou_moa_idMouMoa,
    tb_mou_moa_mitra_idMitra = :tb_mou_moa_mitra_idMitra,
    tb_mou_moa_user_idAkun = :tb_mou_moa_user_idAkun
    WHERE idKegiatan = :id");
    return $stmt->execute([
        ":kegiatan" => htmlspecialchars($data["kegiatan"]),
        ":deskripsi" => htmlspecialchars($data["deskripsi"]),
        ":dokumentasi" => htmlspecialchars($namaFile),
        ":tb_mou_moa_idMouMoa" => htmlspecialchars($data["idMouMoa"]),
        ":tb_mou_moa_mitra_idMitra" => htmlspecialchars($idMitra),
        ":tb_mou_moa_user_idAkun" => htmlspecialchars($result[0]["user_idAkun"]),
        ":id" => $id
    ]);
}

// Delete Kegiatan
function deleteKegiatan($id)
{
    global $pdo;

    $stmt = $pdo->prepare("DELETE FROM tb_kegiatan_kerjasama WHERE idkegiatan = :id");
    return $stmt->execute([":id" => $id]);
}

// Create Kerjasama
function createKerjasama($data)
{
    global $pdo;

    $direktori = "uploads/documents/";

    foreach ($_FILES['dokumentasi']['tmp_name'] as $key => $tmpName) {
        $fileName = $_FILES['dokumentasi']['name'][$key]; // Nama file asli
        $fileTmpPath = $_FILES['dokumentasi']['tmp_name'][$key]; // Path sementara file

        // mengambil esktensi file
        $ekstensi = explode(".", $fileName);
        $ekstensi = strtolower(end($ekstensi));

        // generate nama file baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= ".";
        $namaFileBaru .= $ekstensi;

        $fileDestination = $direktori . $namaFileBaru; // Path tujuan

        $file[] = $namaFileBaru;

        move_uploaded_file($fileTmpPath, $fileDestination);
    }

    $namaFile = implode(",", $file);

    $stmt = $pdo->prepare("INSERT INTO tb_usulan_kerjasama (namaInstansi, alamat, namaPenandaTangan, namaJabatan, namaKontakPerson, noKontak, emailUsulan, dokumenUsulan, waktu) VALUES (:namaInstansi, :alamat, :namaPenandaTangan, :namaJabatan, :namaKontakPerson, :noKontak, :emailUsulan, :dokumenUsulan, NOW())");
    return $stmt->execute([
        ":namaInstansi" => $data["nama_instansi"],
        ":alamat" => $data["alamat_instansi"],
        ":namaPenandaTangan" => $data["nama_penandatangan"],
        ":namaJabatan" => $data["jabatan"],
        ":namaKontakPerson" => $data["kontak_person"],
        ":noKontak" => $data["kontak"],
        ":emailUsulan" => $namaFile,
        ":dokumenUsulan" => $data["dokumen"]
    ]);
}

try {
    $stmt = $pdo->prepare("SELECT idMouMoa,
                                         nomorMouMoa, 
                                         judul_kerjasama,
                                         jenisKerjasama,
                                         namaInstansi,
                                         topik_kerjasama,
                                         DATE_FORMAT(awalKerjasama, '%d %M %Y') AS awalKerjasama, 
                                         DATE_FORMAT(akhirKerjasama, '%d %M %Y') AS akhirKerjasama
                                  FROM tb_mou_moa
                                  JOIN tb_mitra
                                  ON tb_mou_moa.idMouMoa = tb_mitra.idMitra
                                  WHERE akhirKerjasama BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH) AND mailing = 'belum'");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Gagal mengambil data: " . $e->getMessage();
}
