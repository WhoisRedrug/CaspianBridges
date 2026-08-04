<?php 
require_once 'db.php';
require_once 'csrf.php';
require_once 'recaptcha.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$lang = isset($_POST['lang']) ? $_POST['lang'] : (isset($_GET['lang']) ? $_GET['lang'] : 'az');
if (!in_array($lang, ['az', 'en', 'ru', 'ar'], true)) {
    $lang = 'az';
}

$seo = [
    'az' => [
        'title' => 'Əlaqə | Caspian Bridges',
        'desc'  => 'Caspian Bridges ilə əlaqə saxlayın — Azərbaycanda təhsil, viza, investisiya və turizm sualları üçün Bakı ofisimiz 7/24 dəstək göstərir.',
    ],
    'en' => [
        'title' => 'Contact Us | Caspian Bridges',
        'desc'  => 'Get in touch with Caspian Bridges for study, visa, investment, and tourism inquiries in Azerbaijan. Our Baku office offers 24/7 support.',
    ],
    'ru' => [
        'title' => 'Контакты | Caspian Bridges',
        'desc'  => 'Свяжитесь с Caspian Bridges по вопросам учёбы, визы, инвестиций и туризма в Азербайджане. Наш офис в Баку работает 24/7.',
    ],
    'ar' => [
        'title' => 'اتصل بنا | Caspian Bridges',
        'desc'  => 'تواصل مع Caspian Bridges لاستفسارات الدراسة والتأشيرة والاستثمار والسياحة في أذربيجان. مكتبنا في باكو يقدم دعمًا على مدار الساعة.',
    ],
];
$html_dir = $lang === 'ar' ? 'rtl' : 'ltr';

// If user logged in and has pending contact data
if (isset($_SESSION['user_id']) && isset($_SESSION['pending_contact'])) {
    $p_data = $_SESSION['pending_contact'];
    unset($_SESSION['pending_contact']);
    if (isset($_SESSION['redirect_after_login'])) {
        unset($_SESSION['redirect_after_login']);
    }
    
    $cf_name  = $p_data['fullname'];
    $cf_email = trim($p_data['email']);
    $cf_msg   = htmlspecialchars(trim($p_data['message']));

    $stmt = $conn->prepare("INSERT INTO contacts (fullname, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $cf_name, $cf_email, $cf_msg);

    if ($stmt->execute()) {
        $stmt->close();
        if (filter_var($cf_email, FILTER_VALIDATE_EMAIL)) {
            $to      = "support@caspianbridges.com"; 
            $subject = "Caspian Bridges - Saytdan Yeni Mesaj";
            
            $body    = "Ad və Soyad: " . $cf_name . "\n";
            $body   .= "E-poçt: " . $cf_email . "\n\n";
            $body   .= "Mesaj:\n" . $cf_msg;

            $safe_email = str_replace(["\r", "\n", "%0a", "%0d"], '', $cf_email);
            $headers = "From: " . $safe_email . "\r\n" .
                       "Reply-To: " . $safe_email . "\r\n";

            @mail($to, $subject, $body, $headers);
        }

        header("Location: contact?status=success&lang=" . $lang);
        exit();
    }
}

// Contact form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'contact') {

    if (!csrf_verify($_POST['csrf_token'] ?? '')) {
        header("Location: contact?status=error&lang=" . $lang);
        exit();
    }

    if (!recaptcha_verify($_POST['g-recaptcha-response'] ?? '')) {
        header("Location: contact?status=error&lang=" . $lang);
        exit();
    }

    // If user is not logged in save data )
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['redirect_after_login'] = 'contact';
        $_SESSION['pending_contact'] = $_POST;
        
        header("Location: login?lang=" . $lang);
        exit();
    }

    $fullname = $_POST['fullname'];
    $email    = trim($_POST['email']);
    $message  = htmlspecialchars(trim($_POST['message']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact?status=error&lang=" . $lang);
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO contacts (fullname, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fullname, $email, $message);

    if ($stmt->execute()) {
        $stmt->close();
        $to      = "support@caspianbridges.com"; 
        $subject = "Caspian Bridges - Saytdan Yeni Mesaj";
        
        $body    = "Ad və Soyad: " . $fullname . "\n";
        $body   .= "E-poçt: " . $email . "\n\n";
        $body   .= "Mesaj:\n" . $message;

        $safe_email = str_replace(["\r", "\n", "%0a", "%0d"], '', $email);
        $headers = "From: " . $safe_email . "\r\n" .
                   "Reply-To: " . $safe_email . "\r\n";

        @mail($to, $subject, $body, $headers);

        header("Location: contact?status=success&lang=" . $lang);
        exit();
    } else {
        header("Location: contact?status=error&lang=" . $lang);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>" dir="<?php echo $html_dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($seo[$lang]['title']); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($seo[$lang]['desc']); ?>">
    <meta name="keywords" content="Caspian Bridges əlaqə, Bakı ofis, Azərbaycanda təhsil məsləhəti, viza məsləhəti Bakı, contact Caspian Bridges Baku, اتصل بـ Caspian Bridges">
    <link rel="canonical" href="https://caspianbridges.com/contact<?php echo $lang !== 'az' ? '?lang=' . htmlspecialchars($lang) : ''; ?>">
    <link rel="alternate" hreflang="az" href="https://caspianbridges.com/contact">
    <link rel="alternate" hreflang="en" href="https://caspianbridges.com/contact?lang=en">
    <link rel="alternate" hreflang="ru" href="https://caspianbridges.com/contact?lang=ru">
    <link rel="alternate" hreflang="ar" href="https://caspianbridges.com/contact?lang=ar">
    <link rel="alternate" hreflang="x-default" href="https://caspianbridges.com/contact">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo htmlspecialchars($seo[$lang]['title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($seo[$lang]['desc']); ?>">
    <meta property="og:image" content="images/svgviewer-png-1.png">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($seo[$lang]['title']); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($seo[$lang]['desc']); ?>">
    <meta name="twitter:image" content="images/svgviewer-png-1.png">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="component.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(12, 35, 31, 0.85); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .hero-bg { background: radial-gradient(circle at 50% 0%, #0f3831 0%, #061412 60%, #020617 100%); }
        .glass-nav { background: rgba(6, 20, 18, 0.85); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.08); }
    </style>
</head>
<body class="bg-[#061412] text-slate-100 antialiased selection:bg-emerald-400 selection:text-slate-950 min-h-screen">
    <script>
    window.isUserLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    </script>
    <div id="header-container"></div>

    <!-- ================= AZERBAIJANI (AZ) ================= -->
    <div data-lang="az">
        <section class="hero-bg pt-32 pb-20 px-6 min-h-screen flex items-center justify-center relative overflow-hidden">
            <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none"></div>
            <div class="w-full max-w-xl glass-card p-8 sm:p-10 rounded-3xl shadow-2xl relative z-10 border border-slate-800 text-center">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold mb-3"> 📞 24/7 Dəstək </span>
                <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-3"> Bizimlə Əlaqə <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">Caspian Bridges</span> </h1>
                <p class="text-slate-400 text-xs sm:text-sm mb-8"> Viza, təhsil, investisiya və ya turizm xidmətləri ilə bağlı suallarınız var? Bakı ofisimizlə əlaqə saxlayın və ya bizə yazın. </p>
                
                <div class="space-y-4 text-left mb-8">
                    <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800">
                        <h4 class="text-emerald-400 font-bold text-xs uppercase tracking-wider mb-1">Rəsmi E-poçt</h4>
                        <p class="text-white text-sm font-semibold">support@caspianbridges.com</p>
                    </div>
                    <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800">
                        <h4 class="text-amber-400 font-bold text-xs uppercase tracking-wider mb-1">Bakı Ofisinin Ünvanı</h4>
                        <p class="text-white text-sm font-semibold">Bakı, Azərbaycan — İmkanları birləşdiririk</p>
                    </div>
                </div>

                <!-- Əlaqə Formu -->
                <form action="contact" method="POST" class="space-y-4 text-left contact-form">
                    <input type="hidden" name="action" value="contact">
                    <input type="hidden" name="lang" value="az">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Ad və Soyad</label>
                        <input type="text" name="fullname" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">E-poçt ünvanı</label>
                        <input type="email" name="email" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Mesajınız</label>
                        <textarea name="message" rows="3" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500"></textarea>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LdGe3ItAAAAAO9Kh2b3fSv7FXaHDh17S1DN_ePn"></div>
                    <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black py-3.5 rounded-xl text-sm transition shadow-lg cursor-pointer"> Mesajı Göndər → </button>
                </form>
            </div>
        </section>
    </div>

    <!-- ================= ENGLISH (EN) ================= -->
    <div data-lang="en" class="hidden">
        <section class="hero-bg pt-32 pb-20 px-6 min-h-screen flex items-center justify-center relative overflow-hidden">
            <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none"></div>
            <div class="w-full max-w-xl glass-card p-8 sm:p-10 rounded-3xl shadow-2xl relative z-10 border border-slate-800 text-center">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold mb-3"> 📞 24/7 Support </span>
                <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-3"> Get in Touch with <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">Caspian Bridges</span> </h1>
                <p class="text-slate-400 text-xs sm:text-sm mb-8"> Have questions about visa, education, investment, or tourism? Reach out to our Baku office or send us a message. </p>
                
                <div class="space-y-4 text-left mb-8">
                    <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800">
                        <h4 class="text-emerald-400 font-bold text-xs uppercase tracking-wider mb-1">Official Email</h4>
                        <p class="text-white text-sm font-semibold">support@caspianbridges.com</p>
                    </div>
                    <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800">
                        <h4 class="text-amber-400 font-bold text-xs uppercase tracking-wider mb-1">Baku Office Location</h4>
                        <p class="text-white text-sm font-semibold">Baku, Azerbaijan — Connecting Opportunities</p>
                    </div>
                </div>

                <form action="contact" method="POST" class="space-y-4 text-left contact-form">
                    <input type="hidden" name="action" value="contact">
                    <input type="hidden" name="lang" value="en">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Full Name</label>
                        <input type="text" name="fullname" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Email Address</label>
                        <input type="email" name="email" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Your Message</label>
                        <textarea name="message" rows="3" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500"></textarea>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LdGe3ItAAAAAO9Kh2b3fSv7FXaHDh17S1DN_ePn"></div>
                    <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black py-3.5 rounded-xl text-sm transition shadow-lg cursor-pointer"> Send Message → </button>
                </form>
            </div>
        </section>
    </div>

    <!-- ================= RUSSIAN (RU) ================= -->
    <div data-lang="ru" class="hidden">
        <section class="hero-bg pt-32 pb-20 px-6 min-h-screen flex items-center justify-center relative overflow-hidden">
            <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none"></div>
            <div class="w-full max-w-xl glass-card p-8 sm:p-10 rounded-3xl shadow-2xl relative z-10 border border-slate-800 text-center">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold mb-3"> 📞 Поддержка 24/7 </span>
                <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-3"> Свяжитесь с <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">Caspian Bridges</span> </h1>
                <p class="text-slate-400 text-xs sm:text-sm mb-8"> Есть вопросы по визам, образованию, инвестициям или туризму? Обратитесь в наш офис или отправьте сообщение. </p>
                
                <div class="space-y-4 text-left mb-8">
                    <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800">
                        <h4 class="text-emerald-400 font-bold text-xs uppercase tracking-wider mb-1">Официальный Email</h4>
                        <p class="text-white text-sm font-semibold">support@caspianbridges.com</p>
                    </div>
                    <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800">
                        <h4 class="text-amber-400 font-bold text-xs uppercase tracking-wider mb-1">Адрес офиса в Баку</h4>
                        <p class="text-white text-sm font-semibold">Баку, Азербайджан — Соединяя возможности</p>
                    </div>
                </div>

                <form action="contact" method="POST" class="space-y-4 text-left contact-form">
                    <input type="hidden" name="action" value="contact">
                    <input type="hidden" name="lang" value="ru">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Имя и Фамилия</label>
                        <input type="text" name="fullname" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Email адрес</label>
                        <input type="email" name="email" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Ваше сообщение</label>
                        <textarea name="message" rows="3" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500"></textarea>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LdGe3ItAAAAAO9Kh2b3fSv7FXaHDh17S1DN_ePn"></div>
                    <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black py-3.5 rounded-xl text-sm transition shadow-lg cursor-pointer"> Отправить сообщение → </button>
                </form>
            </div>
        </section>
    </div>

    <!-- ================= ARABIC (AR) ================= -->
    <div data-lang="ar" class="hidden">
        <section class="hero-bg pt-32 pb-20 px-6 min-h-screen flex items-center justify-center relative overflow-hidden">
            <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none"></div>
            <div class="w-full max-w-xl glass-card p-8 sm:p-10 rounded-3xl shadow-2xl relative z-10 border border-slate-800 text-center">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold mb-3"> 📞 دعم على مدار الساعة </span>
                <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-3"> تواصل مع <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">Caspian Bridges</span> </h1>
                <p class="text-slate-400 text-xs sm:text-sm mb-8"> هل لديك استفسارات حول التأشيرات، التعليم، الاستثمار، أو السياحة؟ تواصل معنا عبر النموذج أدناه. </p>
                
                <div class="space-y-4 text-right mb-8">
                    <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800">
                        <h4 class="text-emerald-400 font-bold text-xs uppercase tracking-wider mb-1">البريد الإلكتروني الرسمي</h4>
                        <p class="text-white text-sm font-semibold">support@caspianbridges.com</p>
                    </div>
                    <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800">
                        <h4 class="text-amber-400 font-bold text-xs uppercase tracking-wider mb-1">موقع مكتب باكو</h4>
                        <p class="text-white text-sm font-semibold">باكو، أذربيجان — نربط الفرص</p>
                    </div>
                </div>

                <form action="contact" method="POST" class="space-y-4 text-right contact-form">
                    <input type="hidden" name="action" value="contact">
                    <input type="hidden" name="lang" value="ar">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">الاسم الكامل</label>
                        <input type="text" name="fullname" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">عنوان البريد الإلكتروني</label>
                        <input type="email" name="email" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">رسالتك</label>
                        <textarea name="message" rows="3" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500"></textarea>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LdGe3ItAAAAAO9Kh2b3fSv7FXaHDh17S1DN_ePn"></div>
                    <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black py-3.5 rounded-xl text-sm transition shadow-lg cursor-pointer"> إرسال الرسالة ← </button>
                </form>
            </div>
        </section>
    </div>

    <div id="footer-container"></div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const lang = urlParams.get('lang');

        if (lang) {
            changeLanguage(lang);
        }

        if (status === 'success') {
            const messages = {
                'az': 'Mesajınız uğurla göndərildi! Tezliklə sizinlə əlaqə saxlanılacaq.',
                'en': 'Your message has been sent successfully! We will contact you soon.',
                'ru': 'Ваше сообщение успешно отправлено! Мы свяжемся с вами в ближайшее время.',
                'ar': 'تم إرسال رسالتك بنجاح! سنتواصل معك قريبا.'
            };

            const currentLang = lang || localStorage.getItem('selectedLang') || 'en';
            
            document.querySelectorAll('[data-lang]').forEach(container => {
                if (container.getAttribute('data-lang') === currentLang) {
                    const alertDiv = document.createElement('div');
                    alertDiv.className = "p-4 rounded-2xl text-sm font-medium text-center mb-6 bg-emerald-500/20 border border-emerald-500/40 text-emerald-300";
                    alertDiv.innerText = messages[currentLang] || messages['en'];
                    
                    const form = container.querySelector('form');
                    if (form) {
                        form.parentNode.insertBefore(alertDiv, form);
                    }
                }
            });
        }
    });
    </script>
</body>
</html>