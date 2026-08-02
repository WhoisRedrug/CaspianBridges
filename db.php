<?php
$host = getenv('DB_HOST') ?: 'localhost';
$db   = getenv('DB_NAME') ?: 'caspsoof_caspian_db';
$user = getenv('DB_USER') ?: 'caspsoof_redrug';
$pass = getenv('DB_PASS') ?: 'redrugsociety$0';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Bazaya qoşulma xətası: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>