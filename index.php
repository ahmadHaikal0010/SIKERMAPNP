<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>SIKERMA PNP</title>
</head>

<body>
    <div class="container">
        <?php
        if (isset($_GET["page"])) {
            switch ($_GET["page"]) {
                case "login":
                    include_once "view/auth/login.php";
                    break;
                case "register":
                    include_once "view/auth/register.php";
                    break;
                case "home":
                    include_once "view/home.php";
                    break;
                case "tambahAkun":
                    include_once "view/superAdmin/createUser.php";
                    break;
                case "mou_moa":
                    include_once "view/superAdmin/dashboardSuperAdmin.php";
                    break;
            }
        } else {
            include_once "view/home.php";
        }

        ?>
        <a href="?page=home">Home</a>
        <a href="?page=register">Register</a>
        <a href="?page=login">Login</a>
        <a href="?page=tambahAkun">Tambah Akun</a>
        <a href="?page=mou_moa">List MOU MOA</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>