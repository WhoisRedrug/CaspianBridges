<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$user_id = $_SESSION['user_id'];

// 1. pull the user's full name from the users table
$user_name = 'İstifadəçi';
$user_sql = "SELECT fullname FROM users WHERE id = $user_id LIMIT 1";
$user_result = $conn->query($user_sql);
if ($user_result && $user_result->num_rows > 0) {
    $user_row = $user_result->fetch_assoc();
    $user_name = $user_row['fullname'] ?? 'İstifadəçi';
}

// 2. pull the user's applications from the applications table
$sql = "SELECT * FROM applications WHERE user_id = $user_id ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şəxsi Kabinet | Caspian Bridges</title>
    <link rel="icon" type="image/png" href="images/logo.png.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(12, 35, 31, 0.85); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .bg-glow { background: radial-gradient(circle at 50% 30%, #0f3831 0%, #061412 60%, #020a09 100%); }
    </style>
</head>
<body class="bg-glow text-slate-100 min-h-screen p-6 antialiased">
    <div class="max-w-5xl mx-auto">
        <!-- Top Bar -->
        <div class="flex justify-between items-center mb-8 bg-[#0b2420] p-4 rounded-2xl border border-slate-800">
            <div class="flex items-center gap-3">
                <img src="images/logo.png.png" alt="Logo" class="w-10 h-10 object-contain rounded-xl">
                <div>
                    <h1 class="text-sm font-black text-white">
                        <span data-lang-text="welcome">Xoş gəldiniz</span>, <?php echo htmlspecialchars($user_name); ?>!
                    </h1>
                    <p class="text-xs text-slate-400" data-lang-text="subtitle">Şəxsi İdarəetmə Paneli</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <!-- Dil Seçimi (Dropdown) -->
                <select id="profileLangSelect" onchange="changeProfileLang(this.value)" class="bg-[#061412] text-slate-200 text-xs border border-slate-700 rounded-xl px-3 py-2 outline-none focus:border-emerald-500 cursor-pointer">
                    <option value="az">AZ</option>
                    <option value="en">EN</option>
                    <option value="ru">RU</option>
                    <option value="ar">AR</option>
                </select>
                <a href="index" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-xs font-bold rounded-xl transition" data-lang-text="home">Ana Səhifə</a>
                <a href="logout.php" class="px-4 py-2 bg-red-500/10 hover:bg-red-500/20 text-red-400 text-xs font-bold rounded-xl border border-red-500/20 transition" data-lang-text="logout">Çıxış</a>
            </div>
        </div>

        <!-- Applications Section -->
        <div class="glass-card p-6 rounded-3xl shadow-2xl border border-amber-500/20">
            <h2 class="text-base font-black text-white mb-4" data-lang-text="my_applications">Müraciətlərim və Statuslar</h2>
            
            <?php if ($result && $result->num_rows > 0): ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-800 text-xs text-slate-400">
                                <th class="py-3 px-4" data-lang-text="th_service">Xidmət</th>
                                <th class="py-3 px-4" data-lang-text="th_name">Ad Soyad</th>
                                <th class="py-3 px-4" data-lang-text="th_contact">Əlaqə</th>
                                <th class="py-3 px-4" data-lang-text="th_status">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60 text-xs">
                            <?php while($row = $result->fetch_assoc()): 
                                $raw_service = trim($row['service']);
                                $service_key = 'service_other';
                                if (stripos($raw_service, 'visa') !== false || stripos($raw_service, 'viza') !== false) {
                                    $service_key = 'service_visa';
                                } elseif (stripos($raw_service, 'travel') !== false || stripos($raw_service, 'turizm') !== false || stripos($raw_service, 'туризм') !== false) {
                                    $service_key = 'service_travel';
                                } elseif (stripos($raw_service, 'university') !== false || stripos($raw_service, 'təhsil') !== false || stripos($raw_service, 'поступление') !== false) {
                                    $service_key = 'service_uni';
                                } elseif (stripos($raw_service, 'accommodation') !== false || stripos($raw_service, 'yaşayış') !== false || stripos($raw_service, 'проживание') !== false) {
                                    $service_key = 'service_acc';
                                }
                            ?>
                                <tr class="hover:bg-slate-800/30 transition">
                                    <td class="py-3.5 px-4 font-bold text-amber-400 service-cell" data-service-key="<?php echo $service_key; ?>"><?php echo htmlspecialchars($row['service']); ?></td>
                                    <td class="py-3.5 px-4"><?php echo htmlspecialchars($row['firstname'] . ' ' . $row['lastname']); ?></td>
                                    <td class="py-3.5 px-4 text-slate-400"><?php echo htmlspecialchars($row['phone']); ?></td>
                                    <td class="py-3.5 px-4">
                                        <?php 
                                            $status = $row['status'] ?? 'pending';
                                            if ($status == 'approved') {
                                                echo '<span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 status-badge" data-status="approved">✅ Təsdiqləndi</span>';
                                            } elseif ($status == 'rejected') {
                                                echo '<span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-red-500/10 text-red-400 border border-red-500/20 status-badge" data-status="rejected">❌ İmtina edildi</span>';
                                            } else {
                                                echo '<span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-500/10 text-amber-400 border border-amber-500/20 status-badge" data-status="pending">⏳ Gözləmədədir</span>';
                                            }
                                        ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-12 text-slate-400">
                    <p class="text-sm" data-lang-text="no_apps">Hələ ki heç bir müraciətiniz yoxdur.</p>
                    <a href="apply" class="inline-block mt-4 px-6 py-2.5 bg-amber-500 text-slate-950 font-bold rounded-xl text-xs hover:bg-amber-400 transition" data-lang-text="apply_btn">Müraciət Et →</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        const translations = {
            az: {
                welcome: "Xoş gəldiniz",
                subtitle: "Şəxsi İdarəetmə Paneli",
                home: "Ana Səhifə",
                logout: "Çıxış",
                my_applications: "Müraciətlərim və Statuslar",
                th_service: "Xidmət",
                th_name: "Ad Soyad",
                th_contact: "Əlaqə",
                th_status: "Status",
                no_apps: "Hələ ki heç bir müraciətiniz yoxdur.",
                apply_btn: "Müraciət Et →",
                pending: "⏳ Gözləmədədir",
                approved: "✅ Təsdiqləndi",
                rejected: "❌ İmtina edildi",
                service_visa: "Visa Services",
                service_travel: "Travel",
                service_uni: "University Admissions",
                service_acc: "Accommodation",
                service_other: "General Service"
            },
            en: {
                welcome: "Welcome",
                subtitle: "Personal Management Panel",
                home: "Home",
                logout: "Sign Out",
                my_applications: "My Applications & Statuses",
                th_service: "Service",
                th_name: "Full Name",
                th_contact: "Contact",
                th_status: "Status",
                no_apps: "You don't have any applications yet.",
                apply_btn: "Apply Now →",
                pending: "⏳ Pending",
                approved: "✅ Approved",
                rejected: "❌ Rejected",
                service_visa: "Visa Services",
                service_travel: "Travel",
                service_uni: "University Admissions",
                service_acc: "Accommodation",
                service_other: "General Service"
            },
            ru: {
                welcome: "Добро пожаловать",
                subtitle: "Личный кабинет",
                home: "Главная",
                logout: "Выйти",
                my_applications: "Мои заявки и статусы",
                th_service: "Услуга",
                th_name: "Имя Фамилия",
                th_contact: "Контакты",
                th_status: "Статус",
                no_apps: "У вас пока нет заявок.",
                apply_btn: "Подать заявку →",
                pending: "⏳ В ожидании",
                approved: "✅ Одобрено",
                rejected: "❌ Отклонено",
                service_visa: "Визовые услуги",
                service_travel: "Туризм / Путешествия",
                service_uni: "Поступление в вузы",
                service_acc: "Проживание",
                service_other: "Общая услуга"
            },
            ar: {
                welcome: "أهلاً بك",
                subtitle: "لوحة الإدارة الشخصية",
                home: "الرئيسية",
                logout: "تسجيل الخروج",
                my_applications: "طلباتي والحالات",
                th_service: "الخدمة",
                th_name: "الاسم الكامل",
                th_contact: "اتصل",
                th_status: "الحالة",
                no_apps: "ليس لديك أي طلبات حتى الآن.",
                apply_btn: "قدم طلبك الآن ←",
                pending: "⏳ قيد الانتظار",
                approved: "✅ تم الموافقة",
                rejected: "❌ مرفوض",
                service_visa: "خدمات التأشيرات",
                service_travel: "السفر والسياحة",
                service_uni: "القبول الجامعي",
                service_acc: "السكن والإقامة",
                service_other: "خدمة عامة"
            }
        };

        function changeProfileLang(lang) {
            localStorage.setItem('selected_lang', lang);
            const selectEl = document.getElementById('profileLangSelect');
            if (selectEl) selectEl.value = lang;
            
            document.querySelectorAll('[data-lang-text]').forEach(el => {
                const key = el.getAttribute('data-lang-text');
                if (translations[lang] && translations[lang][key]) {
                    el.textContent = translations[lang][key];
                }
            });

            document.querySelectorAll('.service-cell').forEach(cell => {
                const sKey = cell.getAttribute('data-service-key');
                if (translations[lang] && translations[lang][sKey]) {
                    cell.textContent = translations[lang][sKey];
                }
            });

            document.querySelectorAll('.status-badge').forEach(badge => {
                const status = badge.getAttribute('data-status');
                if (translations[lang] && translations[lang][status]) {
                    badge.textContent = translations[lang][status];
                }
            });

            if (lang === 'ar') {
                document.documentElement.setAttribute('dir', 'rtl');
            } else {
                document.documentElement.setAttribute('dir', 'ltr');
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            const savedLang = localStorage.getItem('selected_lang') || 'az';
            changeProfileLang(savedLang);
        });
    </script>
</body>
</html>