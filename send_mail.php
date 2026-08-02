<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // İstifadəçinin daxil etdiyi məlumatları təhlükəsiz şəkildə alırıq
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Mesajın göndəriləcəyi ünvan (Sizin yaratdığınız rəsmi e-poçt)
    $to      = "support@caspianbridges.com"; 
    $subject = "Caspian Bridges - Saytdan Yeni Mesaj";
    
    $body    = "Ad: " . $name . "\n";
    $body   .= "E-poçt: " . $email . "\n\n";
    $body   .= "Mesaj:\n" . $message;

    $headers = "From: " . $email . "\r\n" .
               "Reply-To: " . $email . "\r\n";

    // E-poçtun göndərilmə yoxlanışı
    if (mail($to, $subject, $body, $headers)) {
        // Uğurlu olduqda istifadəçini geri yönləndirə və ya bildiriş göstərə bilərsiniz
        echo "Mesajınız uğurla göndərildi!";
    } else {
        echo "Xəta baş verdi. Zəhmət olmasa yenidən cəhd edin.";
    }
}
?>