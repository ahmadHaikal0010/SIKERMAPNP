<?php

include_once "Database/koneksi.php";

// Register
function register($data)
{
    global $pdo;

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

    $stmt = $pdo->prepare("UPDATE tb_user SET namaUser = :namaUser, emailUser = :emailUser, username = :username, password = :password, role = :role WHERE id = :id");
    return $stmt->execute([
        ":id" => $id,
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

    $stmt = $pdo->prepare("DELETE FROM tb_user WHERE id = :id");
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
function updateMouMoa($id, $data) {
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