<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// COMPOSER
require 'vendor/autoload.php';

$feedback_message = "";

if (isset($_GET['status'])) {
    $feedback_message = $_GET['status'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $escaped_email = $conn->real_escape_string($email);

    $sql = "SELECT id, fullname, email FROM users WHERE email = '$escaped_email' LIMIT 1";
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

            $subject = "Password Reset Request | Caspian Bridges";
            
            $message = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8">
                <title>Password Reset | Caspian Bridges</title>
                <style>
                    body { background-color: #030f0d; font-family: \'Plus Jakarta Sans\', Helvetica, Arial, sans-serif; margin: 0; padding: 0; color: #94a3b8; }
                    .email-wrapper { width: 100%; background-color: #030f0d; padding: 40px 0; }
                    .email-container { max-width: 600px; margin: 0 auto; background: linear-gradient(135deg, #071e1a 0%, #04100e 100%); border: 1px solid rgba(245, 158, 11, 0.25); border-radius: 20px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.6); }
                    .email-header { background: #020a09; padding: 35px 20px; text-align: center; border-bottom: 1px solid rgba(255, 255, 255, 0.06); }
                    .email-logo { width: 64px; height: 64px; object-fit: contain; margin-bottom: 12px; border-radius: 14px; border: 1px solid rgba(245, 158, 11, 0.3); padding: 4px; background: #071e1a; }
                    .brand-name { color: #ffffff; font-size: 15px; font-weight: 800; letter-spacing: 3px; display: block; text-transform: uppercase; }
                    .email-body { padding: 45px 40px; text-align: left; }
                    .welcome-text { font-size: 18px; color: #ffffff; font-weight: 700; margin-bottom: 15px; }
                    .desc-text { font-size: 14px; color: #cbd5e1; line-height: 1.7; margin-bottom: 35px; }
                    .btn-container { text-align: center; margin-bottom: 35px; }
                    .reset-btn { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #030f0d !important; text-decoration: none; padding: 16px 36px; border-radius: 12px; font-weight: 800; font-size: 14px; display: inline-block; letter-spacing: 0.5px; box-shadow: 0 10px 20px rgba(245, 158, 11, 0.2); }
                    .security-note { font-size: 13px; color: #64748b; line-height: 1.5; border-top: 1px solid rgba(255, 255, 255, 0.06); padding-top: 25px; margin-top: 20px; }
                    .footer-text { font-size: 12px; color: #475569; padding: 25px; text-align: center; background: #020a09; border-top: 1px solid rgba(255, 255, 255, 0.04); letter-spacing: 0.5px; }
                </style>
            </head>
            <body>
                <div class="email-wrapper">
                    <div class="email-container">
                        <div class="email-header">
                            <img src="' . $logo_url . '" alt="Caspian Bridges" class="email-logo">
                            <span class="brand-name">Caspian Bridges</span>
                        </div>
                        <div class="email-body">
                            <div class="welcome-text">Hello, ' . htmlspecialchars($user['fullname']) . '</div>
                            <div class="desc-text">
                                We received a request to reset the password for your Caspian Bridges account. If you made this request, please click the secure button below to proceed:
                            </div>
                            <div class="btn-container">
                                <a href="' . $reset_link . '" class="reset-btn">Reset Your Password &rarr;</a>
                            </div>
                            <div class="security-note">
                                If you did not request a password reset, please ignore this email or contact support if you have questions. This link is securely generated for your account.
                            </div>
                        </div>
                        <div class="footer-text">
                            &copy; ' . date('Y') . ' Caspian Bridges Baku. All rights reserved.
                        </div>
                    </div>
                </div>
            </body>
            </html>';

            // PHPMailer SMTP (Port 465 tənzimləmələri ilə)
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = 'caspianbridges.com';                  // Şəkildəki Outgoing Server
                $mail->SMTPAuth   = true;
                $mail->Username   = 'support@caspianbridges.com';          // Şəkildəki Username
                $mail->Password   = 'redrugsocietyemail$0';           // E-poçt şifrəniz
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Port 465 üçün SMTPS
                $mail->Port       = 465;                                   // Port 465
                $mail->CharSet    = 'UTF-8';

                $mail->setFrom('support@caspianbridges.com', 'Caspian Bridges');
                $mail->addAddress($db_email, $user['fullname']);

                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = $message;

                $mail->send();
                header("Location: recovery.php?status=success");
                exit();
            } catch (Exception $e) {
                header("Location: recovery.php?status=error");
                exit();
            }
        } else {
            header("Location: recovery.php?status=error");
            exit();
        }
    } else {
        header("Location: recovery.php?status=not_found");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Caspian Bridges</title>
    <link rel="icon" type="image/png" href="images/logo.png.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(12, 35, 31, 0.85); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .bg-glow { background: radial-gradient(circle at 50% 30%, #0f3831 0%, #061412 60%, #020a09 100%); }
    </style>
</head>
<body class="bg-glow text-slate-100 min-h-screen flex items-center justify-center p-4 relative overflow-hidden antialiased">
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none"></div>
    
    <div class="w-full max-w-md z-10 my-8">
        <div class="flex justify-between items-center mb-6 px-2">
            <a href="login" class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-amber-400 transition bg-[#0b2420] px-4 py-2 rounded-full border border-slate-800" 
               data-az="← Girişə qayıt" data-en="← Back to Login" data-ru="← Назад к входу" data-ar="← عودة لتسجيل الدخول">← Back to Login</a>
        </div>

        <div class="glass-card p-8 rounded-3xl shadow-2xl relative border border-amber-500/20">
            <div class="text-center mb-6">
                <a href="index" class="inline-block mb-2">
                    <img src="images/logo.png.png" alt="Caspian Bridges Logo" class="w-14 h-14 object-contain mx-auto rounded-2xl shadow-md">
                </a>
                <span class="text-xl font-black tracking-wider text-white block">CASPIAN BRIDGES</span>
                <p class="text-xs text-slate-400 mt-1" 
                   data-az="Şifrənizi yeniləmək üçün e-poçtunuzu daxil edin" 
                   data-en="Enter your email to reset your password" 
                   data-ru="Введите свой email для сброса пароля" 
                   data-ar="أدخل بريدك الإلكتروني لإعادة تعيين كلمة المرور">Enter your email to reset your password</p>
                
                <?php if (!empty($feedback_message)): ?>
                    <div class="mt-4 text-xs font-bold text-center p-3 rounded-xl border <?php echo ($feedback_message == 'success') ? 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20' : 'text-red-400 bg-red-500/10 border-red-500/20'; ?>">
                        <span data-az="<?php echo $feedback_message=='success'?'Şifrə yeniləmə linki e-poçtunuza göndərildi!':($feedback_message=='not_found'?'Bu e-poçt ilə hesab tapılmadı!':'Xəta baş verdi, yenidən cəhd edin.'); ?>"
                              data-en="<?php echo $feedback_message=='success'?'Password reset link has been sent to your email address!':($feedback_message=='not_found'?'No account found with this email address!':'An error occurred. Please try again.'); ?>"
                              data-ru="<?php echo $feedback_message=='success'?'Ссылка для сброса пароля отправлена на ваш email!':($feedback_message=='not_found'?'Аккаунт с таким email не найден!':'Произошла ошибка, попробуйте снова.'); ?>"
                              data-ar="<?php echo $feedback_message=='success'?'تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني!':($feedback_message=='not_found'?'لم يتم العثور على حساب بهذا البريد الإلكتروني!':'حدث خطأ، يرجى المحاولة مرة أخرى.'); ?>">
                            <?php 
                                if($feedback_message=='success') echo "Password reset link has been sent to your email address!";
                                elseif($feedback_message=='not_found') echo "No account found with this email address!";
                                else echo "An error occurred. Please try again.";
                            ?>
                        </span>
                    </div>
                <?php endif; ?>
            </div>

            <form action="" method="POST" class="space-y-4">
                <div>
                    <label class="text-xs font-bold text-slate-300 block mb-1.5" 
                           data-az="E-poçt ünvanı" data-en="Email Address" data-ru="Электронная почта" data-ar="عنوان البريد الإلكتروني">Email Address</label>
                    <input type="email" name="email" placeholder="name@example.com" required 
                           data-az="ad@example.com" data-en="name@example.com" data-ru="name@example.com" data-ar="name@example.com"
                           class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 text-slate-950 font-black py-3.5 rounded-xl text-sm transition shadow-lg shadow-amber-500/20 mt-2"
                        data-az="Sıfırlama Linki Göndər →" data-en="Send Reset Link →" data-ru="Отправить ссылку →" data-ar="إرسال رابط الإعادة ←">Send Reset Link →</button>
            </form>
        </div>
    </div>

    <script>
        function changeLanguage(lang) {
            localStorage.setItem('selectedLang', lang);
            if (lang === 'ar') {
                document.documentElement.setAttribute('dir', 'rtl');
            } else {
                document.documentElement.setAttribute('dir', 'ltr');
            }
            document.querySelectorAll('[data-az][data-en][data-ru][data-ar]').forEach(el => {
                const text = el.getAttribute(`data-${lang}`);
                if (text) {
                    if (el.tagName === 'INPUT' && el.hasAttribute('placeholder')) {
                        el.placeholder = text;
                    } else {
                        el.textContent = text;
                    }
                }
            });
        }

        document.addEventListener("DOMContentLoaded", function () {
            const savedLang = localStorage.getItem('selectedLang') || 'en';
            changeLanguage(savedLang);
        });
    </script>
</body>
</html>
