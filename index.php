<?php
session_start();
if (!isset($_SESSION["login"])) {
    $_SESSION["login"] = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CSS Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <title>SIKERMA PNP</title>
</head>

<body>
    <div class="container">
        <?php
        if (isset($_GET["page"])) {
            if ($_GET["page"] == "login") {
                header("Location: view/auth/login.php");
            }
            if ($_GET["page"] == "register") {
                header("Location: view/auth/register.php");
            }
        }
        if ($_SESSION["login"]) {
            if ($_SESSION["role"] === "super admin" || $_SESSION["role"] === "admin") {
                if (isset($_GET["action"])) {
                    switch ($_GET["action"]) {
                        case "tambahAkun":
                            if ($_SESSION["role"] === "super admin") {
                                include_once "view/superAdmin/createUser.php";
                            }
                            break;
                        case "list_mou_moa":
                            include_once "view/superAdmin/readMouMoa.php";
                            break;
                        case "list_mitra":
                            include_once "view/superAdmin/readMitra.php";
                            break;
                        case "tambah_mou_moa":
                            include_once "view/superAdmin/createMouMoa.php";
                            break;
                        case "tambah_mitra":
                            include_once "view/superAdmin/createMitra.php";
                            break;
                    }
                } 
            }
        } else {
            include_once "view/home.php";
        }
        ?>

        <a href="?page=home">Home</a>
        <a href="?page=register">Register</a>
        <a href="?page=login">Login</a>

        <?php
        if ($_SESSION["login"] === true):
            if ($_SESSION["role"] === "admin" || $_SESSION["role"] === "super admin"):
        ?>
                <?php if ($_SESSION["role"] === "super admin"): ?>
                    <a href="?action=tambahAkun">Tambah Akun</a>
                <?php endif; ?>
                <a href="?action=list_mou_moa">List MOU MOA</a>
                <a href="?action=list_mitra">List Mitra</a>
                <a href="?action=tambah_mou_moa">Tambah MOU MOA</a>
                <a href="?action=tambah_mitra">Tambah Mitra</a>
                <a href="view/auth/logout.php">Logout</a>
        <?php
            endif;
        endif;
        ?>
    </div>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- JS DataTables -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <!-- JS External -->
    <script src="assets/js/script.js"></script>
</body>

</html>