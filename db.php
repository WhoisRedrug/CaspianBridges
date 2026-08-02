<?php
// Məlumatlar yalnız .env faylından və ya server mühitindən oxunur
$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER'); 
$pass = getenv('DB_PASS');    

// Bağlantının yaradılması
$conn = new mysqli($host, $user, $pass, $db);

// Bağlantı xətasının yoxlanılması
if ($conn->connect_error) {
    die("Verilənlər bazasına bağlantı xətası: " . $conn->connect_error);
}

// Azərbaycan, rus və ərəb hərflərinin bazada düzgün işləməsi üçün utf8mb4 tənzimləməsi
$conn->set_charset("utf8mb4");
?>