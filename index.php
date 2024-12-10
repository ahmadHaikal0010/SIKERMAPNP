<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["login"] === false) {
    header("Location: view/landingPage.php");
    exit;
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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.bootstrap5.min.css">
    <!-- CSS DataTables Responsive-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.min.css">
    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- CSS External -->
    <link rel="stylesheet" href="assets/css/style.css">
    <title>SIKERMA PNP</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <h4>SIKERMA</h4>
            <a href="?page=home"><i class="bi bi-house-door me-2"></i> Home</a>
            <?php
            if ($_SESSION["login"]) {
                if ($_SESSION["role"] === "super admin" || $_SESSION["role"] === "admin") {
            ?>
                    <a href="?action=list_mou_moa"><i class="bi bi-bar-chart"></i> Data MOU/MOA</a>
                    <a href="?action=list_kegiatan"><i class="bi bi-activity"></i> Data Kegiatan</a>
                    <a href="?action=list_mitra"><i class="bi bi-briefcase me-2"></i> Data Mitra</a>
                    <?php if ($_SESSION["role"] === "super admin"): ?>
                        <a href="?action=list_user"><i class="bi bi-person-lines-fill me-2"></i> Data Akun</a>
                    <?php endif; ?>
                    <hr>
                    <a href="view/auth/logout.php" onclick="return confirm('Apakah anda yakin mau keluar?')"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
                <?php
                }
            } else {
                ?>
                <a href="?page="><i class="bi bi-folder me-2"></i> Data MOU/MOA</a>
                <hr>
                <a href="?page=login"><i class="bi bi-box-arrow-in-left me-2"></i> Login</a>
            <?php } ?>
        </div>
        <!-- <div class="help-box">
            <h5>Need Help?</h5>
            <p>Contact support:</p>
            <a href="mailto:support@example.com">support@example.com</a>
        </div> -->
    </div>

    <!-- Header -->
    <div class="header">
        <h4>Selamat Datang</h4>
        <!-- <div class="search-bar">
            <input type="text" class="form-control" placeholder="Cari...">
            <i class="bi bi-search"></i>
        </div> -->
        <?php
        if ($_SESSION["login"]) {
            if ($_SESSION["role"] === "super admin" || $_SESSION["role"] === "admin") {
        ?>
                <div class="profile-info">
                    <i class="bi bi-person-circle fs-3"></i>
                    <div>
                        <span><?= $_SESSION["username"] ?></span><br>
                        <small><?= $_SESSION["role"] ?></small>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>

    <!-- Main Content -->
    <div class="Main">
        <?php
        // Mengecek Navigasi
        if (isset($_GET["page"])) {
            switch ($_GET["page"]) {
                case "login":
                    header("Location: view/auth/login.php");
                    break;
                case "home":
                    include_once "view/home.php";
                    break;
                case "list_mou_moa":
                    include_once "view/admin/readMouMoa.php";
                    break;
                default:
                    include_once "view/home.php";
            }
        }

        // Mengecek Level User
        if ($_SESSION["login"]) {
            if ($_SESSION["role"] === "super admin" || $_SESSION["role"] === "admin") {
                if (isset($_GET["action"])) {
                    switch ($_GET["action"]) {
                        case "tambah_user":
                            if ($_SESSION["role"] === "super admin") {
                                include_once "view/admin/createUser.php";
                            }
                            break;
                        case "list_user":
                            if ($_SESSION["role"] === "super admin") {
                                include_once "view/admin/readUser.php";
                            }
                            break;
                        case "update_user":
                            if ($_SESSION["role"] === "super admin") {
                                include_once "view/admin/updateUser.php";
                            }
                            break;
                        case "list_mou_moa":
                            include_once "view/admin/readMouMoa.php";
                            break;
                        case "list_mitra":
                            include_once "view/admin/readMitra.php";
                            break;
                        case "list_kegiatan":
                            include_once "view/admin/readKegiatan.php";
                            break;
                        case "tambah_mou_moa":
                            include_once "view/admin/createMouMoa.php";
                            break;
                        case "tambah_mitra":
                            include_once "view/admin/createMitra.php";
                            break;
                        case "tambah_kegiatan":
                            include_once "view/admin/createKegiatan.php";
                            break;
                        case "update_mou_moa":
                            include_once "view/admin/updateMouMoa.php";
                            break;
                        case "update_mitra":
                            include_once "view/admin/updateMitra.php";
                            break;
                        case "update_kegiatan":
                            include_once "view/admin/updateKegiatan.php";
                            break;
                    }
                }
            }
        }
        ?>
    </div>

    <!-- Footer -->
    <footer>
        &copy; 2024 SIKERMA | All rights reserved.
    </footer>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
    <!-- JS DataTables Responsive -->
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js"></script>
    <!-- JS External -->
    <script type="module" src="assets/js/script.js"></script>
</body>

</html>