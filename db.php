<?php
// .env faylından və ya server mühitindən məlumatları oxuyuruq
$host = getenv('DB_HOST') ?: 'localhost';
$db   = getenv('DB_NAME') ?: 'caspsoof_caspian_db';
$user = getenv('DB_USER') ?: 'caspsoof_redrug'; 
$pass = getenv('DB_PASS') ?: 'redrugsociety$0';    

// Bağlantının yaradılması
$conn = new mysqli($host, $user, $pass, $db);

// Bağlantı xətasının yoxlanılması
if ($conn->connect_error) {
    die("Verilənlər bazasına bağlantı xətası: " . $conn->connect_error);
}

// Azərbaycan, rus və ərəb hərflərinin bazada düzgün işləməsi üçün utf8mb4 tənzimləməsi
$conn->set_charset("utf8mb4");
?>