<?php

include_once "Database/koneksi.php";

// Register
function createUser($data)
{
    global $pdo;

    if ($data["password"] !== $data["password2"]) {
        echo "<script>alert('Password tidak sama');</script>";

        return false;
    }

    $stmt = $pdo->prepare("INSERT INTO tb_user (namaUser, emailUser, username, password, role) VALUES (:namaUser, :emailUser, :username, :password, :role)");
    return $stmt->execute([
        ":namaUser" => $data["namaUser"],
        ":emailUser" => $data["emailUser"],
        ":username" => $data["username"],
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
        ":namaUser" => $data["namaUser"],
        ":emailUser" => $data["emailUser"],
        ":username" => $data["username"],
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
        ":namaInstansi" => $data["namaInstansi"],
        ":namaPimpinan" => $data["namaPimpinan"],
        ":alamatMitra" => $data["alamatMitra"],
        ":emailMitra" => $data["emailMitra"],
        ":teleponMitra" => $data["teleponMitra"],
        ":bidangUsaha" => $data["bidangUsaha"],
        ":websiteMitra" => $data["websiteMitra"],
        ":provinsi" => $data["provinsi"],
        ":kota" => $data["kota"]
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
        ":namaInstansi" => $data["namaInstansi"],
        ":namaPimpinan" => $data["namaPimpinan"],
        ":alamatMitra" => $data["alamatMitra"],
        ":emailMitra" => $data["emailMitra"],
        ":teleponMitra" => $data["teleponMitra"],
        ":bidangUsaha" => $data["bidangUsaha"],
        ":websiteMitra" => $data["websiteMitra"],
        ":provinsi" => $data["provinsi"],
        ":kota" => $data["kota"],
        ":idMitra" => $id
    ]);
}

// Delete Mitra
function deleteMitra($id)
{
    global $pdo;

    $stmt = $pdo->prepare("DELETE FROM tb_mitra WHERE idMitra = :id");
    return $stmt->execute([":id" => $id]);
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

    // mengambil esktensi file
    $ekstensi = explode(".", $fileName);
    $ekstensi = strtolower(end($ekstensi));

    // generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensi;

    // memindahkan file dari temporary ke direktori penyimpanan
    move_uploaded_file($fileTemporary, $fileDirektori . $namaFileBaru);

    $jurusan = implode(",", $data["jurusan"]);

    $stmt = $pdo->prepare("INSERT INTO tb_mou_moa (nomorMouMoa, jenisKerjasama, jangkaWaktu, awalKerjasama, akhirKerjasama, keterangan, tindakan, jurusan, topik_kerjasama, fileDokumen,  mitra_idMitra, user_idAkun) VALUES (:nomorMouMoa, :jenisKerjasama, :jangkaWaktu, :awalKerjasama, :akhirKerjasama, :keterangan, :tindakan, :jurusan, :topik_kerjasama, :fileDokumen,  :mitra_idMitra, :user_idAkun)");
    return $stmt->execute([
        ":nomorMouMoa" => $data["nomorMou"],
        ":jenisKerjasama" => $data["jenisKerjasama"],
        ":jangkaWaktu" =>  $jangkaWaktu->y,
        ":awalKerjasama" => $data["awalKerjasama"],
        ":akhirKerjasama" => $data["akhirKerjasama"],
        ":keterangan" => $data["keterangan"],
        ":tindakan" => $data["tindakan"],
        ":jurusan" => $jurusan,
        ":topik_kerjasama" => $data["topik_kerjasama"],
        ":fileDokumen" => $namaFileBaru,
        ":mitra_idMitra" => $data["mitra_idMitra"],
        ":user_idAkun" => $data["user_idAkun"]
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

        // mengambil esktensi file
        $ekstensi = explode(".", $fileName);
        $ekstensi = strtolower(end($ekstensi));

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
    jangkaWaktu = :jangkaWaktu,
    awalKerjasama = :awalKerjasama,
    akhirKerjasama = :akhirKerjasama,
    keterangan = :keterangan,
    tindakan = :tindakan,
    jurusan = :jurusan,
    topik_kerjasama = :topik_kerjasama,
    fileDokumen = :fileDokumen,
    mitra_idMitra = :mitra_idMitra,
    user_idAkun = :user_idAkun
    WHERE idMouMoa = :idMouMoa");
    return $stmt->execute([
        ":nomorMouMoa" => $data["nomorMou"],
        ":jenisKerjasama" => $data["jenisKerjasama"],
        ":jangkaWaktu" =>  $jangkaWaktu->y,
        ":awalKerjasama" => $data["awalKerjasama"],
        ":akhirKerjasama" => $data["akhirKerjasama"],
        ":keterangan" => $data["keterangan"],
        ":tindakan" => $data["tindakan"],
        ":jurusan" => $jurusan,
        ":topik_kerjasama" => $data["topik_kerjasama"],
        ":fileDokumen" => $namaFileBaru,
        ":mitra_idMitra" => $data["mitra_idMitra"],
        ":user_idAkun" => $data["user_idAkun"],
        ":idMouMoa" => $id
    ]);
}

// Delete MOU/MOA
function deleteMouMoa($id)
{
    global $pdo;

    $stmt = $pdo->prepare("DELETE FROM tb_mou_moa WHERE idMouMoa = :id");
    return $stmt->execute([":id" => $id]);
}

// Create Kegiatan
function createKegiatan($data)
{
    global $pdo;

    $sql = $pdo->prepare("SELECT * FROM tb_mou_moa WHERE mitra_idMitra = :id");
    $sql->execute([":id" => $data["idMitra"]]);
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    if (!$sql->rowCount()) {
        echo "<script>alert('MOU/MOA dengan Mitra Tidak Cocok');</script>";

        return false;
    }

    $direktori = "uploads/images/";
    $file = [];

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

    $stmt = $pdo->prepare("INSERT INTO tb_kegiatan_kerjasama (kegiatan, deskripsi, dokumentasi, tb_mou_moa_idMouMoa, tb_mou_moa_mitra_idMitra, tb_mou_moa_user_idAkun) VALUES (:kegiatan, :deskripsi, :dokumentasi, :tb_mou_moa_idMouMoa, :tb_mou_moa_mitra_idMitra, :tb_mou_moa_user_idAkun)");
    return $stmt->execute([
        ":kegiatan" => $data["kegiatan"],
        ":deskripsi" => $data["deskripsi"],
        ":dokumentasi" => $namaFile,
        ":tb_mou_moa_idMouMoa" => $data["idMouMoa"],
        ":tb_mou_moa_mitra_idMitra" => $data["idMitra"],
        ":tb_mou_moa_user_idAkun" => $result[0]["user_idAkun"]
    ]);
}

// Update Kegiatan
function updateKegiatan($id, $data)
{
    global $pdo;

    $sql = $pdo->prepare("SELECT * FROM tb_mou_moa WHERE mitra_idMitra = :id");
    $sql->execute([":id" => $data["idMitra"]]);
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    if (!$sql->rowCount()) {
        echo "<script>alert('MOU/MOA dengan Mitra Tidak Cocok');</script>";

        return false;
    }

    $direktori = "uploads/images/";
    $file = [];

    if (!empty($_FILES['files']['name'][0])) {
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
        ":kegiatan" => $data["kegiatan"],
        ":deskripsi" => $data["deskripsi"],
        ":dokumentasi" => $namaFile,
        ":tb_mou_moa_idMouMoa" => $data["idMouMoa"],
        ":tb_mou_moa_mitra_idMitra" => $data["idMitra"],
        ":tb_mou_moa_user_idAkun" => $result[0]["user_idAkun"],
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
