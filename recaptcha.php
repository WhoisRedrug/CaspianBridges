<?php
// Google reCAPTCHA v2 server-tərəfi yoxlaması.
// İstifadə: recaptcha_verify($_POST['g-recaptcha-response'] ?? '')
// Qaytarır: true (insan) / false (bot və ya token yoxdur/yanlışdır)

function recaptcha_verify($response_token) {
    if (empty($response_token)) {
        return false;
    }

    $secret = $_ENV['RECAPTCHA_SECRET_KEY'] ?? getenv('RECAPTCHA_SECRET_KEY');
    if (empty($secret)) {
        // Açar tənzimlənməyibsə, təhlükəsizlik xatasına yol verməmək üçün rədd edirik.
        return false;
    }

    $verify_url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        'secret'   => $secret,
        'response' => $response_token,
        'remoteip' => $_SERVER['REMOTE_ADDR'] ?? '',
    ];

    $options = [
        'http' => [
            'method'  => 'POST',
            'header'  => 'Content-Type: application/x-www-form-urlencoded',
            'content' => http_build_query($data),
            'timeout' => 5,
        ],
    ];

    $context = stream_context_create($options);
    $result = @file_get_contents($verify_url, false, $context);

    if ($result === false) {
        return false;
    }

    $json = json_decode($result, true);
    return isset($json['success']) && $json['success'] === true;
}