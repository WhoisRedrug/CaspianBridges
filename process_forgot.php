<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Yeni şifrə təyini (Token vasitəsilə)
    if (isset($_POST['token']) && isset($_POST['password'])) {
        $token = $conn->real_escape_string($_POST['token']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'] ?? '';

        if ($password !== $confirm_password) {
            header("Location: reset_password?token=$token&status=error");
            exit();
        }

        $sql = "SELECT email FROM password_resets WHERE token = '$token' LIMIT 1";
        $result = $conn->query($sql);

        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $email = $row['email'];

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $update_sql = "UPDATE users SET password = '$hashed_password' WHERE email = '$email'";
            
            if ($conn->query($update_sql) === TRUE) {
                $conn->query("DELETE FROM password_resets WHERE email = '$email'");
                // Şifrə yenilənəndən sonra birbaşa login səhifəsinə yönləndirir
                header("Location: login?status=password_reset_success");
                exit();
            } else {
                header("Location: reset_password?token=$token&status=error");
                exit();
            }
        } else {
            header("Location: reset_password?status=invalid_token");
            exit();
        }
    }
    
    // 2. Şifrə sıfırlama linkinin göndərilməsi (recovery.php-dən gələn sorğu)
    elseif (isset($_POST['email'])) {
        $email = trim($_POST['email']);
        $escaped_email = $conn->real_escape_string($email);

        $sql = "SELECT id, fullname, email FROM users WHERE email LIKE '$escaped_email' LIMIT 1";
        $result = $conn->query($sql);

        if ($result && $result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $db_email = $user['email'];
            
            $token = bin2hex(random_bytes(32));
            
            $conn->query("DELETE FROM password_resets WHERE email = '$db_email'");

            $insert = "INSERT INTO password_resets (email, token) VALUES ('$db_email', '$token')";
            if ($conn->query($insert) === TRUE) {
                $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
                $host = $_SERVER['HTTP_HOST'];
                $reset_link = "$protocol://$host/reset_password?token=$token";
                
                $logo_url = "$protocol://$host/images/logo.png.png";

                $to = $db_email;
                $subject = "Password Reset Request | Caspian Bridges";
                
                $message = '
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <style>
                        body { background-color: #020a09; font-family: Arial, sans-serif; margin: 0; padding: 0; color: #cbd5e1; }
                        .email-container { max-width: 600px; margin: 0 auto; background: #0c231f; border: 1px solid rgba(217, 119, 6, 0.2); border-radius: 24px; overflow: hidden; }
                        .email-header { background: #061412; padding: 30px; text-align: center; border-bottom: 1px solid rgba(255, 255, 255, 0.05); }
                        .email-logo { width: 70px; height: 70px; object-fit: contain; margin-bottom: 10px; border-radius: 14px; }
                        .brand-name { color: #ffffff; font-size: 18px; font-weight: 800; letter-spacing: 2px; display: block; }
                        .email-body { padding: 40px 30px; text-align: center; }
                        .welcome-text { font-size: 16px; color: #ffffff; font-weight: 700; margin-bottom: 10px; }
                        .desc-text { font-size: 14px; color: #94a3b8; line-height: 1.6; margin-bottom: 30px; }
                        .reset-btn { background: linear-gradient(to right, #f59e0b, #eab308); color: #020a09 !important; text-decoration: none; padding: 14px 32px; border-radius: 12px; font-weight: 900; font-size: 14px; display: inline-block; }
                        .footer-text { font-size: 12px; color: #64748b; padding: 20px; text-align: center; border-top: 1px solid rgba(255, 255, 255, 0.05); }
                    </style>
                </head>
                <body>
                    <br>
                    <div class="email-container">
                        <div class="email-header">
                            <img src="' . $logo_url . '" alt="Caspian Bridges" class="email-logo">
                            <span class="brand-name">CASPIAN BRIDGES</span>
                        </div>
                        <div class="email-body">
                            <p class="welcome-text">Salam, ' . htmlspecialchars($user['fullname']) . '</p>
                            <p class="desc-text">Hesabınız üçün şifrə yeniləmə sorğusu daxil oldu. Şifrənizi yeniləmək üçün aşağıdakı düyməyə basın:</p>
                            <a href="' . $reset_link . '" class="reset-btn">Şifrəni Yenilə →</a>
                            <p style="font-size: 12px; color: #64748b; margin-top: 30px;">Əgər bu sorğunu siz etməmisinizsə, lütfən bu e-poçtu nəzərə almayın.</p>
                        </div>
                        <div class="footer-text">
                            &copy; ' . date('Y') . ' Caspian Bridges Baku. All rights reserved.
                        </div>
                    </div>
                    <br>
                </body>
                </html>';

                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                $headers .= "From: Caspian Bridges <support@caspianbridges.com>\r\n";
                $headers .= "Reply-To: support@caspianbridges.com\r\n";
                $headers .= "X-Mailer: PHP/" . phpversion();

                @mail($to, $subject, $message, $headers, "-fsupport@caspianbridges.com");

                header("Location: recovery?status=success");
                exit();
            } else {
                header("Location: recovery?status=error");
                exit();
            }
        } else {
            header("Location: recovery?status=not_found");
            exit();
        }
    }
} else {
    header("Location: recovery");
    exit();
}
?>