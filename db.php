<?php
// Verilənlər bazası bağlantı parametrləri
$host = 'localhost';
$db   = 'caspsoof_caspian_db';
$user = 'caspsoof_redrug'; 
$pass = 'redrugsociety$0';     

// Bağlantının yaradılması
$conn = new mysqli($host, $user, $pass, $db);

// Bağlantı xətasının yoxlanılması
if ($conn->connect_error) {
    die("Verilənlər bazasına bağlantı xətası: " . $conn->connect_error);
}

// Azərbaycan, rus və ərəb hərflərinin bazada düzgün işləməsi üçün utf8mb4 tənzimləməsi
$conn->set_charset("utf8mb4");
?>