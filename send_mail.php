<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form məlumatlarını təhlükəsiz şəkildə alırıq (guya)
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // mailim
    $to      = "support@caspianbridges.com"; 
    $subject = "Caspian Bridges - Saytdan Yeni Mesaj";
    
    $body    = "Ad: " . $name . "\n";
    $body   .= "E-poçt: " . $email . "\n\n";
    $body   .= "Mesaj:\n" . $message;

    $headers = "From: " . $email . "\r\n" .
               "Reply-To: " . $email . "\r\n";

    // check up 
    if (mail($to, $subject, $body, $headers)) {
        // Uğurlu olduqda istifadəçini geri yönləndirə və ya bildiriş göstərə bilərsiniz
        echo "Mesajınız uğurla göndərildi!";
    } else {
        echo "Xəta baş verdi. Zəhmət olmasa yenidən cəhd edin.";
    }
}
?>
// burda niye dil funksiyasi yoxdur bleeeddddddddddddddddd