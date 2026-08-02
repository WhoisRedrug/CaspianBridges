<?php
// Configuration (.env)
$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER'); 
$pass = getenv('DB_PASS');    

// CONNECTION
$conn = new mysqli($host, $user, $pass, $db);

// Bağlantı xətasının yoxlanılması
if ($conn->connect_error) {
    die("Verilənlər bazasına bağlantı xətası: " . $conn->connect_error);
}

// Character set configuration
$conn->set_charset("utf8mb4");
?>