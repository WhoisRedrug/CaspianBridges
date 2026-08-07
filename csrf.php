<?php
// Bu fayl yalnız daxili require_once/include üçündür.
// Brauzerdən birbaşa açılmağa çalışılarsa, əsas səhifəyə yönləndirilir.
if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    header('Location: /');
    exit;
}

// CSRF qoruması üçün ortaq köməkçi fayl.
// Hər forma göstərən səhifədə (login, apply, contact, recovery, reset_password)
// require_once 'csrf.php'; edib csrf_token() ilə token yaradın və formaya
// hidden input kimi əlavə edin. Hər POST qəbul edən skriptdə isə
// csrf_verify($_POST['csrf_token'] ?? '') ilə yoxlayın.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_verify($token) {
    return isset($_SESSION['csrf_token']) && is_string($token) && $token !== '' && hash_equals($_SESSION['csrf_token'], $token);
}

function csrf_field() {
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars(csrf_token()) . '">';
}