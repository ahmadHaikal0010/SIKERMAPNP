<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/PHPMailer/src/Exception.php';
require '../assets/PHPMailer/src/PHPMailer.php';
require '../assets/PHPMailer/src/SMTP.php';

include_once "../database/koneksi.php";

global $pdo;


if (isset($_POST["submit"])) {


    // Create Kerjasama
    // upload file
    $fileName = $_FILES["dokumen"]["name"];
    $fileDirektori = "../uploads/documents/";
    $fileTemporary = $_FILES["dokumen"]["tmp_name"];

    // mengambil esktensi file
    $ekstensi = explode(".", $fileName);
    $ekstensi = strtolower(end($ekstensi));

    // generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensi;

    // memindahkan file dari temporary ke direktori penyimpanan
    move_uploaded_file($fileTemporary, $fileDirektori . $namaFileBaru);

    $stmt = $pdo->prepare("INSERT INTO tb_usulan_kerjasama (namaInstansi, alamat, namaPenandaTangan, namaJabatan, namaKontakPerson, noKontak, emailUsulan, dokumenUsulan, waktu) VALUES (:namaInstansi, :alamat, :namaPenandaTangan, :namaJabatan, :namaKontakPerson, :noKontak, :emailUsulan, :dokumenUsulan, NOW())");
    $stmt->execute([
        ":namaInstansi" => $_POST["nama_instansi"],
        ":alamat" => $_POST["alamat_instansi"],
        ":namaPenandaTangan" => $_POST["nama_penandatangan"],
        ":namaJabatan" => $_POST["jabatan"],
        ":namaKontakPerson" => $_POST["kontak_person"],
        ":noKontak" => $_POST["kontak"],
        ":emailUsulan" => $_POST["email"],
        ":dokumenUsulan" => $namaFileBaru
    ]);




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
        $mail->addAttachment('../uploads/documents/' . $namaFileBaru);         //Add attachments
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
} else {
    header("Location: landingPage.php");
    exit(0);
}
