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
    }
} else {
    include_once "view/home.php";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKERMA PNP</title>
</head>

<body>
    <a href="?page=home">Home</a>
    <a href="?page=register">Register</a>
    <a href="?page=login">Login</a>
    <a href="?page=tambahAkun">Tambah Akun</a>
</body>

</html>