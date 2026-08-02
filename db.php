<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['DB_HOST'] ?? 'localhost';
$db   = $_ENV['DB_NAME'] ?? '';
$user = $_ENV['DB_USER'] ?? '';
$pass = $_ENV['DB_PASS'] ?? '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Bazaya qoşulma xətası: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>