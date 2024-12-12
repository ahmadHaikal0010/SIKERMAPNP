<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

    $stmt = $pdo->prepare("INSERT INTO tb_mou_moa (nomorMouMoa, jenisKerjasama, judul_kerjasama, jangkaWaktu, awalKerjasama, akhirKerjasama, tindakan, jurusan, topik_kerjasama, fileDokumen,  mitra_idMitra, user_idAkun) VALUES (:nomorMouMoa, :jenisKerjasama, :judul_kerjasama, :jangkaWaktu, :awalKerjasama, :akhirKerjasama, :tindakan, :jurusan, :topik_kerjasama, :fileDokumen,  :mitra_idMitra, :user_idAkun)");
    return $stmt->execute([
        ":nomorMouMoa" => $data["nomorMou"],
        ":jenisKerjasama" => $data["jenisKerjasama"],
        ":judul_kerjasama" => $data["judulKerjasama"],
        ":jangkaWaktu" =>  $jangkaWaktu->y,
        ":awalKerjasama" => $data["awalKerjasama"],
        ":akhirKerjasama" => $data["akhirKerjasama"],
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
        ":nomorMouMoa" => $data["nomorMou"],
        ":jenisKerjasama" => $data["jenisKerjasama"],
        ":judul_kerjasama" => $data["judulKerjasama"],
        ":jangkaWaktu" =>  $jangkaWaktu->y,
        ":awalKerjasama" => $data["awalKerjasama"],
        ":akhirKerjasama" => $data["akhirKerjasama"],
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
        ":tb_mou_moa_mitra_idMitra" => $idMitra,
        ":tb_mou_moa_user_idAkun" => $result[0]["user_idAkun"]
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
        ":tb_mou_moa_mitra_idMitra" => $idMitra,
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

// Send Mail
function sendEmail()
{
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->Username   = 'haikala154@gmail.com';                     //SMTP username
        $mail->Password   = 'qbkkrineryaqadzg';                               //SMTP password

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //ENCRYPTION_SMTPS 465 - Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('haikala154@gmail.com', 'Ahmad Haikal');
        $mail->addAddress('haikala154@gmail.com', 'Ahmad Haikal');     //Add a recipient

        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        $mail->addAttachment('../uploads/documents/' );         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Mengusulkan Kerjasama Baru';
        $mail->Body    = '<h5>Hi</h5>
        <h6>Nama Instansi: ' . $_POST["nama_instansi"] . '</h6>
        <h6>Alamat Instansi: ' . $_POST["alamat_instansi"] . '</h6>
        <h6>No Kontak: ' . $_POST["kontak"] . '</h6>
        <h6>Nama Penanda Tangan: ' . $_POST["nama_penandatangan"] . '</h6>
        <h6>Jabatan: ' . $_POST["jabatan"] . '</h6>
        <h6>Kontak Person: ' . $_POST["kontak_person"] . '</h6>
        <h6>Email: ' . $_POST["email"] . '</h6>
    ';
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


        if ($mail->send()) {
            $_SESSION["status"] = "Thank You For Contact Us";
            header("Location: landingPage.php");
            exit(0);
        } else {
            $_SESSION["status"] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}