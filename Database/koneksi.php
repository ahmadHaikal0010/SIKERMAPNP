<?php 

// Konfigurasi database
$host = 'localhost';
$dbname = 'sikerma_pnp';
$username = 'root';
$password = '';

try {
    // Membuat koneksi PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Mengatur mode error agar PDO melempar exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Menangani error koneksi
    echo "Koneksi gagal: " . $e->getMessage();
}