<?php
// hapus session
session_start();
session_unset();
session_destroy();
header("Location: ../landingPage.php");
exit;
