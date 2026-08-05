<?php
session_start();

// Dilə görə fərqli SEO başlığı/izahı — Google axtarış nəticələrində
// istifadəçinin öz dilində görünsün deyə (xüsusilə ərəb auditoriyası üçün).
$lang = $_GET['lang'] ?? 'az';
if (!in_array($lang, ['az', 'en', 'ru', 'ar'], true)) {
    $lang = 'az';
}

$seo = [
    'az' => [
        'title' => 'Caspian Bridges | Azərbaycanda Təhsil, Tələbə Vizası və İnvestisiya',
        'desc'  => 'Azərbaycanda xarici tələbələr üçün universitet qəbulu, tələbə vizası, biznes xidmətləri, daşınmaz əmlak investisiyası və elit turizm xidmətləri. Bakıda 99% qəbul uğuru, 7/24 dəstək.',
    ],
    'en' => [
        'title' => 'Caspian Bridges | Study, Business & Investment in Azerbaijan',
        'desc'  => 'University admission, student visa, business services, real estate investment and premium tourism services for foreigners in Azerbaijan. 99% success rate, 24/7 support in Baku.',
    ],
    'ru' => [
        'title' => 'Caspian Bridges | Учёба, Бизнес и Инвестиции в Азербайджане',
        'desc'  => 'Поступление в вузы, студенческая и бизнес-виза, инвестиции в недвижимость и туристические услуги в Азербайджане. 99% успешных заявок, поддержка 24/7 в Баку.',
    ],
    'ar' => [
        'title' => 'Caspian Bridges | الدراسة، الأعمال والاستثمار في أذربيجان',
        'desc'  => 'القبول الجامعي، تأشيرة الطلاب، خدمات الأعمال، الاستثمار العقاري وخدمات السياحة الفاخرة للأجانب في أذربيجان. نسبة نجاح 99%، دعم على مدار الساعة في باكو.',
    ],
];

$html_dir = $lang === 'ar' ? 'rtl' : 'ltr';
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>" dir="<?php echo $html_dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="google-site-verification" content="t7jBm5DJx-flLg4ziS9azPNPCoI-N3b63SgMUOxe4EM" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($seo[$lang]['title']); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($seo[$lang]['desc']); ?>">
    <meta name="keywords" content="Azərbaycanda təhsil, Bakıda təhsil vizası, Azərbaycan biznes, Azərbaycana elektron viza, Azərbaycanda daşınmaz əmlak investisiyası, Şahdağ turu, Qəbələ turu, study visa Azerbaijan, university admission Azerbaijan foreign students, Azerbaijan business, e-visa Azerbaijan, invest in Azerbaijan real estate, Shahdag tour package, الدراسة في أذربيجان, الأعمال أذربيجان, تأشيرة أذربيجان الإلكترونية, الاستثمار العقاري في أذربيجان">
    <link rel="canonical" href="https://caspianbridges.com/<?php echo $lang !== 'az' ? '?lang=' . htmlspecialchars($lang) : ''; ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo htmlspecialchars($seo[$lang]['title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($seo[$lang]['desc']); ?>">
    <meta property="og:image" content="images/svgviewer-png-1.png">
    <meta property="og:locale" content="<?php echo $lang; ?>_<?php echo strtoupper($lang === 'en' ? 'US' : ($lang === 'ar' ? 'AR' : $lang)); ?>">
    <meta property="og:locale:alternate" content="az_AZ">
    <meta property="og:locale:alternate" content="en_US">
    <meta property="og:locale:alternate" content="ru_RU">
    <meta property="og:locale:alternate" content="ar_AR">
    <link rel="alternate" hreflang="az" href="https://caspianbridges.com/">
    <link rel="alternate" hreflang="en" href="https://caspianbridges.com/?lang=en">
    <link rel="alternate" hreflang="ru" href="https://caspianbridges.com/?lang=ru">
    <link rel="alternate" hreflang="ar" href="https://caspianbridges.com/?lang=ar">
    <link rel="alternate" hreflang="x-default" href="https://caspianbridges.com/">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="component.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-nav { background: rgba(6, 20, 18, 0.85); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.08); }
        .glass-card { background: rgba(12, 35, 31, 0.65); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.08); }
        .hero-glow { background: radial-gradient(circle at 50% 20%, #0f3831 0%, #061412 60%, #020a09 100%); }
        .gold-border { box-shadow: 0 0 30px rgba(245, 158, 11, 0.15); }
        .modal-overlay { position: fixed; inset: 0; background: rgba(2, 10, 9, 0.92); backdrop-filter: blur(10px); z-index: 999; display: flex; align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: all 0.3s ease; padding: 20px; }
        .modal-overlay.active { opacity: 1; visibility: visible; }
        .modal-box { background: rgba(6, 20, 18, 0.98); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 24px; max-width: 700px; width: 100%; max-height: 90vh; overflow-y: auto; transform: scale(0.95) translateY(20px); transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.9); position: relative; }
        .modal-overlay.active .modal-box { transform: scale(1) translateY(0); }
        .image-slider { position: relative; width: 100%; height: 300px; border-radius: 24px 24px 0 0; overflow: hidden; }
        .image-slider img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0; transition: opacity 1s ease-in-out; }
        .image-slider img.active { opacity: 1; }
        .close-modal { position: absolute; top: 15px; right: 20px; z-index: 10; color: white; font-size: 28px; cursor: pointer; background: rgba(0,0,0,0.5); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(255,255,255,0.1); }
    </style>
</head>
<body class="bg-[#061412] text-slate-100 antialiased selection:bg-emerald-400 selection:text-slate-950">
    <script>
    window.isUserLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    </script>
    <div id="header-container"></div>

    <!-- ================= AZERBAIJANI (AZ) ================= -->
    <div data-lang="az">
        <section class="hero-glow pt-36 pb-24 px-6 min-h-screen flex items-center relative overflow-hidden">
            <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-emerald-500/10 rounded-full blur-[160px] pointer-events-none"></div>
            <div class="max-w-7xl mx-auto grid lg:grid-cols-12 gap-12 items-center relative z-10 w-full text-left">
                <div class="lg:col-span-6 space-y-6">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold">
                        <span>🇦🇿</span> Caspian Bridges • Rəsmi Təhsil, Viza və İnvestisiya Portalı 2026
                    </div>
                    <h1 class="text-4xl sm:text-6xl font-black tracking-tight text-white leading-tight">
                        Azərbaycanda <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">Təhsil və İnvestisiya</span>
                    </h1>
                    <p class="text-slate-200 font-semibold text-base sm:text-lg">
                        Caspian Bridges — Təhsil, Biznes, İnvestisiya və Turizm üzrə Etibarlı Körpünüz
                    </p>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Beynəlxalq tələbələrə və sərmayəçilərə universitet qəbulu, daşınmaz əmlak investisiyası, təhlükəsiz yerləşdirmə və unudulmaz turizm təcrübələri təqdim edirik.
                    </p>
                    <div class="flex items-center gap-6 pt-2">
                        <div><div class="text-2xl font-black text-emerald-400">99%</div><div class="text-[11px] text-slate-400 font-semibold">Qəbul Uğuru</div></div>
                        <div class="h-8 w-[1px] bg-slate-800"></div>
                        <div><div class="text-2xl font-black text-amber-400">24/7</div><div class="text-[11px] text-slate-400 font-semibold">Tələbə Dəstəyi</div></div>
                        <div class="h-8 w-[1px] bg-slate-800"></div>
                        <div><div class="text-2xl font-black text-emerald-300">5k+</div><div class="text-[11px] text-slate-400 font-semibold">Qlobal Müştəri</div></div>
                    </div>
                    <p class="text-lg font-medium text-slate-300 italic pt-1"> "Gələcəyinizi Bakıdakı imkanlarla birləşdiririk." </p>
                </div>
                <div class="lg:col-span-6 relative">
                    <div class="glass-card p-8 rounded-3xl border border-amber-500/20 gold-border relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-tr from-emerald-500/5 via-transparent to-amber-500/10 pointer-events-none"></div>
                        <div class="relative z-10 flex flex-col h-full gap-6">
                            <div>
                                <h3 class="text-2xl font-black text-white mb-2">Əsas Xidmətlər Mərkəzi</h3>
                                <p class="text-slate-400 text-sm">Azərbaycana rahat keçid və investisiya üçün lazım olan hər şey.</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4 flex-grow">
                                <a href="universities.php?lang=az" class="block bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80 hover:border-amber-500/50 transition"><div class="text-2xl mb-1">🎓</div><h4 class="font-bold text-white text-sm">Universitet Qəbulu</h4><p class="text-[10px] text-slate-400">Bakalavr, Magistr və Doktorantura</p></a>
                                <a href="investments.php?lang=az" class="block bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80 hover:border-amber-500/50 transition"><div class="text-2xl mb-1">💼</div><h4 class="font-bold text-white text-sm">İnvestisiya & Biznes</h4><p class="text-[10px] text-slate-400">Daşınmaz Əmlak və Xidmətlər</p></a>
                                <a href="visas.php?lang=az" class="block bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80 hover:border-amber-500/50 transition"><div class="text-2xl mb-1">📄</div><h4 class="font-bold text-white text-sm">Viza və Sənəd Hazırlığı</h4><p class="text-[10px] text-slate-400">Tərcümə, Viza və Hüquqi Qeydiyyat</p></a>
                                <a href="tours.php?lang=az" class="block bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80 hover:border-amber-500/50 transition"><div class="text-2xl mb-1">✈️</div><h4 class="font-bold text-white text-sm">Turizm & E-Viza</h4><p class="text-[10px] text-slate-400">Bələdçili Turlar və İcazələr</p></a>
                            </div>
                            <div class="mt-2 flex items-center justify-between gap-4 border-t border-slate-800/80 pt-5">
                                <div><h4 class="text-white font-bold text-sm">Başlamağa Hazırsınız?</h4><p class="text-slate-400 text-xs">Bu gün müraciət edin.</p></div>
                                <a href="apply.php" class="bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 text-slate-950 font-extrabold px-5 py-2.5 rounded-xl text-xs shadow-lg transition hover:scale-105"> Müraciət Et → </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 px-6 max-w-7xl mx-auto text-left">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div>
                    <span class="text-amber-400 font-bold text-xs uppercase tracking-widest">Azərbaycanı Kəşf Et</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-white mt-2">Təhsil, Biznes və Səyahət</h2>
                </div>
                <a href="services.php" class="text-xs font-bold text-emerald-400 hover:underline mt-4 md:mt-0"> Bütün Proqramlar və Turlar → </a>
            </div>
            <div class="grid md:grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Tehsil -->
                <a href="universities.php?lang=az" class="glass-card rounded-3xl overflow-hidden group hover:border-amber-500/50 transition block">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/baku.jpg" alt="Tehsil" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1584646098378-0874589d76b1?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-amber-400">Təhsil</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Universitetlər və Təhsil</h3>
                        <p class="text-slate-400 text-xs mb-4">Azərbaycanın aparıcı universitetləri, ixtisaslar və qəbul şərtləri.</p>
                        <span class="text-xs font-bold text-amber-400">Universitetlərə bax →</span>
                    </div>
                </a>
                <!-- Business -->
                <a href="business.php?lang=az" class="glass-card rounded-3xl overflow-hidden group hover:border-emerald-500/50 transition block">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/investments.jpg" alt="Business" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-400">Biznes</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Biznes</h3>
                        <p class="text-slate-400 text-xs mb-4">Sahibkarlar və investorlar üçün biznes dəstəyi, qeydiyyat və vizalar.</p>
                        <span class="text-xs font-bold text-emerald-400">Ətraflı öyrən →</span>
                    </div>
                </a>
                <!-- Travel -->
                <a href="travel.php?lang=az" class="glass-card rounded-3xl overflow-hidden group hover:border-emerald-500/50 transition block">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/shahdag.jpg" alt="Travel" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1548685913-fe6678babe8d?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-400">Səyahət</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Səyahət</h3>
                        <p class="text-slate-400 text-xs mb-4">Azərbaycanın təbiəti, kurortlar, unudulmaz turlar və səyahət paketləri.</p>
                        <span class="text-xs font-bold text-emerald-400">Turları kəşf et →</span>
                    </div>
                </a>
            </div>
        </section>
    </div>

    <!-- ================= ENGLISH (EN) ================= -->
    <div data-lang="en" class="hidden">
        <section class="hero-glow pt-36 pb-24 px-6 min-h-screen flex items-center relative overflow-hidden">
            <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-emerald-500/10 rounded-full blur-[160px] pointer-events-none"></div>
            <div class="max-w-7xl mx-auto grid lg:grid-cols-12 gap-12 items-center relative z-10 w-full text-left">
                <div class="lg:col-span-6 space-y-6">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold">
                        <span>🇦🇿</span> Caspian Bridges • Official Study, Business & Investment Portal 2026
                    </div>
                    <h1 class="text-4xl sm:text-6xl font-black tracking-tight text-white leading-tight">
                        Study, Invest & Discover <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">Azerbaijan</span>
                    </h1>
                    <p class="text-slate-200 font-semibold text-base sm:text-lg">
                        Caspian Bridges — Your Trusted Bridge to Education, Business & Tourism
                    </p>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        We guide international students and investors through university admissions, business setup, secure accommodation, and unforgettable tourism experiences.
                    </p>
                    <div class="flex items-center gap-6 pt-2">
                        <div><div class="text-2xl font-black text-emerald-400">99%</div><div class="text-[11px] text-slate-400 font-semibold">Admission Success</div></div>
                        <div class="h-8 w-[1px] bg-slate-800"></div>
                        <div><div class="text-2xl font-black text-amber-400">24/7</div><div class="text-[11px] text-slate-400 font-semibold">Student Support</div></div>
                        <div class="h-8 w-[1px] bg-slate-800"></div>
                        <div><div class="text-2xl font-black text-emerald-300">5k+</div><div class="text-[11px] text-slate-400 font-semibold">Global Clients</div></div>
                    </div>
                    <p class="text-lg font-medium text-slate-300 italic pt-1"> "Connecting your future to opportunities in Baku." </p>
                </div>
                <div class="lg:col-span-6 relative">
                    <div class="glass-card p-8 rounded-3xl border border-amber-500/20 gold-border relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-tr from-emerald-500/5 via-transparent to-amber-500/10 pointer-events-none"></div>
                        <div class="relative z-10 flex flex-col h-full gap-6">
                            <div>
                                <h3 class="text-2xl font-black text-white mb-2">Core Services Hub</h3>
                                <p class="text-slate-400 text-sm">Everything you need for a seamless transition and investment in Azerbaijan.</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4 flex-grow">
                                <a href="universities.php?lang=en" class="block bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80 hover:border-amber-500/50 transition"><div class="text-2xl mb-1">🎓</div><h4 class="font-bold text-white text-sm">University Admissions</h4><p class="text-[10px] text-slate-400">Bachelor, Master & PhD</p></a>
                                <a href="investments.php?lang=en" class="block bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80 hover:border-amber-500/50 transition"><div class="text-2xl mb-1">💼</div><h4 class="font-bold text-white text-sm">Investment & Business</h4><p class="text-[10px] text-slate-400">Business Setup & Assets</p></a>
                                <a href="visas.php?lang=en" class="block bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80 hover:border-amber-500/50 transition"><div class="text-2xl mb-1">📄</div><h4 class="font-bold text-white text-sm">Document Prep</h4><p class="text-[10px] text-slate-400">Translation & Legal Filing</p></a>
                                <a href="tours.php?lang=en" class="block bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80 hover:border-amber-500/50 transition"><div class="text-2xl mb-1">✈️</div><h4 class="font-bold text-white text-sm">Tourism & E-Visa</h4><p class="text-[10px] text-slate-400">Guided Tours & Permits</p></a>
                            </div>
                            <div class="mt-2 flex items-center justify-between gap-4 border-t border-slate-800/80 pt-5">
                                <div><h4 class="text-white font-bold text-sm">Ready to Begin?</h4><p class="text-slate-400 text-xs">Start your application today.</p></div>
                                <a href="apply.php" class="bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 text-slate-950 font-extrabold px-5 py-2.5 rounded-xl text-xs shadow-lg transition hover:scale-105"> Apply Now → </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 px-6 max-w-7xl mx-auto text-left">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div>
                    <span class="text-amber-400 font-bold text-xs uppercase tracking-widest">Discover Azerbaijan</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-white mt-2">Education, Business & Travel</h2>
                </div>
                <a href="services.php" class="text-xs font-bold text-emerald-400 hover:underline mt-4 md:mt-0"> View All Programs & Tours → </a>
            </div>
            <div class="grid md:grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Education -->
                <a href="universities.php?lang=en" class="glass-card rounded-3xl overflow-hidden group hover:border-amber-500/50 transition block">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/baku.jpg" alt="Education" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1584646098378-0874589d76b1?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-amber-400">Education</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Universities & Education</h3>
                        <p class="text-slate-400 text-xs mb-4">Top universities in Azerbaijan, degree programs, and admission requirements.</p>
                        <span class="text-xs font-bold text-amber-400">View Universities →</span>
                    </div>
                </a>
                <!-- Business -->
                <a href="business.php?lang=en" class="glass-card rounded-3xl overflow-hidden group hover:border-emerald-500/50 transition block">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/investments.jpg" alt="Business" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-400">Business</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Business</h3>
                        <p class="text-slate-400 text-xs mb-4">Corporate support, company registration, and business visas for entrepreneurs.</p>
                        <span class="text-xs font-bold text-emerald-400">Learn More →</span>
                    </div>
                </a>
                <!-- Travel -->
                <a href="travel.php?lang=en" class="glass-card rounded-3xl overflow-hidden group hover:border-emerald-500/50 transition block">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/shahdag.jpg" alt="Travel" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1548685913-fe6678babe8d?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-400">Travel</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Travel</h3>
                        <p class="text-slate-400 text-xs mb-4">Explore Azerbaijan's nature, mountain resorts, and unforgettable travel packages.</p>
                        <span class="text-xs font-bold text-emerald-400">Explore Travel →</span>
                    </div>
                </a>
            </div>
        </section>
    </div>

    <!-- ================= RUSSIAN (RU) ================= -->
    <div data-lang="ru" class="hidden">
        <section class="hero-glow pt-36 pb-24 px-6 min-h-screen flex items-center relative overflow-hidden">
            <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-emerald-500/10 rounded-full blur-[160px] pointer-events-none"></div>
            <div class="max-w-7xl mx-auto grid lg:grid-cols-12 gap-12 items-center relative z-10 w-full text-left">
                <div class="lg:col-span-6 space-y-6">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold">
                        <span>🇦🇿</span> Caspian Bridges • Официальный портал 2026
                    </div>
                    <h1 class="text-4xl sm:text-6xl font-black tracking-tight text-white leading-tight">
                        Учеба, бизнес и туризм в <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">Азербайджане</span>
                    </h1>
                    <p class="text-slate-200 font-semibold text-base sm:text-lg">
                        Caspian Bridges — Ваш надежный мост к образованию, бизнесу и туризму
                    </p>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Мы помогаем иностранцам с поступлением в университеты, открытием бизнеса, подготовкой документов и незабываемыми турами.
                    </p>
                    <div class="flex items-center gap-6 pt-2">
                        <div><div class="text-2xl font-black text-emerald-400">99%</div><div class="text-[11px] text-slate-400 font-semibold">Поступлений</div></div>
                        <div class="h-8 w-[1px] bg-slate-800"></div>
                        <div><div class="text-2xl font-black text-amber-400">24/7</div><div class="text-[11px] text-slate-400 font-semibold">Поддержка клиентов</div></div>
                        <div class="h-8 w-[1px] bg-slate-800"></div>
                        <div><div class="text-2xl font-black text-emerald-300">5k+</div><div class="text-[11px] text-slate-400 font-semibold">Клиентов со всего мира</div></div>
                    </div>
                    <p class="text-lg font-medium text-slate-300 italic pt-1"> "Связываем ваше будущее с возможностями в Баку." </p>
                </div>
                <div class="lg:col-span-6 relative">
                    <div class="glass-card p-8 rounded-3xl border border-amber-500/20 gold-border relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-tr from-emerald-500/5 via-transparent to-amber-500/10 pointer-events-none"></div>
                        <div class="relative z-10 flex flex-col h-full gap-6">
                            <div>
                                <h3 class="text-2xl font-black text-white mb-2">Центр Услуг</h3>
                                <p class="text-slate-400 text-sm">Все необходимое для переезда и инвестиций в Азербайджан.</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4 flex-grow">
                                <a href="universities.php?lang=ru" class="block bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80 hover:border-amber-500/50 transition"><div class="text-2xl mb-1">🎓</div><h4 class="font-bold text-white text-sm">Поступление в ВУЗы</h4><p class="text-[10px] text-slate-400">Бакалавриат и Магистратура</p></a>
                                <a href="investments.php?lang=ru" class="block bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80 hover:border-amber-500/50 transition"><div class="text-2xl mb-1">💼</div><h4 class="font-bold text-white text-sm">Инвестиции и Бизнес</h4><p class="text-[10px] text-slate-400">Регистрация и визы</p></a>
                                <a href="visas.php?lang=ru" class="block bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80 hover:border-amber-500/50 transition"><div class="text-2xl mb-1">📄</div><h4 class="font-bold text-white text-sm">Подготовка документов</h4><p class="text-[10px] text-slate-400">Перевод и легализация</p></a>
                                <a href="tours.php?lang=ru" class="block bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80 hover:border-amber-500/50 transition"><div class="text-2xl mb-1">✈️</div><h4 class="font-bold text-white text-sm">Туризм и визы</h4><p class="text-[10px] text-slate-400">Экскурсии и E-Visa</p></a>
                            </div>
                            <div class="mt-2 flex items-center justify-between gap-4 border-t border-slate-800/80 pt-5">
                                <div><h4 class="text-white font-bold text-sm">Готовы начать?</h4><p class="text-slate-400 text-xs">Подайте заявку сегодня.</p></div>
                                <a href="apply.php" class="bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 text-slate-950 font-extrabold px-5 py-2.5 rounded-xl text-xs shadow-lg transition hover:scale-105"> Подать заявку → </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 px-6 max-w-7xl mx-auto text-left">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div>
                    <span class="text-amber-400 font-bold text-xs uppercase tracking-widest">Откройте Азербайджан</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-white mt-2">Учеба, Бизнес и Путешествия</h2>
                </div>
                <a href="services.php" class="text-xs font-bold text-emerald-400 hover:underline mt-4 md:mt-0"> Все программы и туры → </a>
            </div>
            <div class="grid md:grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Education -->
                <a href="universities.php?lang=ru" class="glass-card rounded-3xl overflow-hidden group hover:border-amber-500/50 transition block">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/baku.jpg" alt="Education" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1584646098378-0874589d76b1?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-amber-400">Учеба</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Университеты и Обучение</h3>
                        <p class="text-slate-400 text-xs mb-4">Ведущие вузы Азербайджана, специальности и требования для поступления.</p>
                        <span class="text-xs font-bold text-amber-400">Смотреть вузы →</span>
                    </div>
                </a>
                <!-- Business -->
                <a href="business.php?lang=ru" class="glass-card rounded-3xl overflow-hidden group hover:border-emerald-500/50 transition block">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/investments.jpg" alt="Business" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-400">Бизнес</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Бизнес</h3>
                        <p class="text-slate-400 text-xs mb-4">Корпоративная поддержка, регистрация компаний и визы для предпринимателей.</p>
                        <span class="text-xs font-bold text-emerald-400">Узнать больше →</span>
                    </div>
                </a>
                <!-- Travel -->
                <a href="travel.php?lang=ru" class="glass-card rounded-3xl overflow-hidden group hover:border-emerald-500/50 transition block">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/shahdag.jpg" alt="Travel" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1548685913-fe6678babe8d?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-400">Путешествия</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Путешествия</h3>
                        <p class="text-slate-400 text-xs mb-4">Природа Азербайджана, горные курорты, незабываемые туры и пакеты услуг.</p>
                        <span class="text-xs font-bold text-emerald-400">Исследовать туры →</span>
                    </div>
                </a>
            </div>
        </section>
    </div>

    <!-- ================= ARABIC (AR) ================= -->
    <div data-lang="ar" class="hidden text-right">
        <section class="hero-glow pt-36 pb-24 px-6 min-h-screen flex items-center relative overflow-hidden">
            <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-emerald-500/10 rounded-full blur-[160px] pointer-events-none"></div>
            <div class="max-w-7xl mx-auto grid lg:grid-cols-12 gap-12 items-center relative z-10 w-full">
                <div class="lg:col-span-6 space-y-6 text-right">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold ml-auto">
                        <span>🇦🇿</span> جسور بحر قزوين • البوابة الرسمية للتعليم والأعمال والسياحة 2026
                    </div>
                    <h1 class="text-4xl sm:text-6xl font-black tracking-tight text-white leading-tight">
                        الدراسة، الأعمال واكتشاف <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">أذربيجان</span>
                    </h1>
                    <p class="text-slate-200 font-semibold text-base sm:text-lg ml-auto">
                        جسور بحر قزوين — بوابتك الموثوقة للتعليم وتأسيس الأعمال والسياحة
                    </p>
                    <p class="text-slate-400 text-sm leading-relaxed ml-auto">
                        نساعد الأجانب في القبول الجامعي، تأسيس الشركات، إعداد المستندات، والتجارب السياحية في أذربيجان.
                    </p>
                    <div class="flex items-center gap-6 pt-2 ml-auto justify-end">
                        <div><div class="text-2xl font-black text-emerald-300">5k+</div><div class="text-[11px] text-slate-400 font-semibold">عملاء عالميون</div></div>
                        <div class="h-8 w-[1px] bg-slate-800"></div>
                        <div><div class="text-2xl font-black text-amber-400">24/7</div><div class="text-[11px] text-slate-400 font-semibold">دعم العملاء</div></div>
                        <div class="h-8 w-[1px] bg-slate-800"></div>
                        <div><div class="text-2xl font-black text-emerald-400">99%</div><div class="text-[11px] text-slate-400 font-semibold">نجاح القبول</div></div>
                    </div>
                    <p class="text-lg font-medium text-slate-300 italic pt-1"> "نربط مستقبلك بالفرص في باكو." </p>
                </div>
                <div class="lg:col-span-6 relative">
                    <div class="glass-card p-8 rounded-3xl border border-amber-500/20 gold-border relative overflow-hidden text-right">
                        <div class="absolute inset-0 bg-gradient-to-tr from-emerald-500/5 via-transparent to-amber-500/10 pointer-events-none"></div>
                        <div class="relative z-10 flex flex-col h-full gap-6">
                            <div>
                                <h3 class="text-2xl font-black text-white mb-2">مركز الخدمات الأساسية</h3>
                                <p class="text-slate-400 text-sm">كل ما تحتاجه للانتقال والاستثمار السلس في أذربيجان.</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4 flex-grow">
                                <a href="universities.php?lang=ar" class="block bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80 hover:border-amber-500/50 transition"><div class="text-2xl mb-1">🎓</div><h4 class="font-bold text-white text-sm">القبول الجامعي</h4><p class="text-[10px] text-slate-400">بكالوريوس، ماجستير ودكتوراه</p></a>
                                <a href="investments.php?lang=ar" class="block bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80 hover:border-amber-500/50 transition"><div class="text-2xl mb-1">💼</div><h4 class="font-bold text-white text-sm">الاستثمار والأعمال</h4><p class="text-[10px] text-slate-400">تأسيس الشركات والتأشيرات</p></a>
                                <a href="visas.php?lang=ar" class="block bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80 hover:border-amber-500/50 transition"><div class="text-2xl mb-1">📄</div><h4 class="font-bold text-white text-sm">إعداد المستندات</h4><p class="text-[10px] text-slate-400">الترجمة والتسجيل القانوني</p></a>
                                <a href="tours.php?lang=ar" class="block bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80 hover:border-amber-500/50 transition"><div class="text-2xl mb-1">✈️</div><h4 class="font-bold text-white text-sm">السياحة والتأشيرة</h4><p class="text-[10px] text-slate-400">جولات مرشدة وتصاريح</p></a>
                            </div>
                            <div class="mt-2 flex items-center justify-between gap-4 border-t border-slate-800/80 pt-5 flex-row-reverse">
                                <div><h4 class="text-white font-bold text-sm">هل أنت مستعد للبدء؟</h4><p class="text-slate-400 text-xs">ابدأ طلبك اليوم.</p></div>
                                <a href="apply.php" class="bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 text-slate-950 font-extrabold px-5 py-2.5 rounded-xl text-xs shadow-lg transition hover:scale-105"> قدم الآن → </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 px-6 max-w-7xl mx-auto text-right">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 flex-row-reverse">
                <div class="text-right">
                    <span class="text-amber-400 font-bold text-xs uppercase tracking-widest">اكتشف أذربيجان</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-white mt-2">التعليم، الأعمال والسفر</h2>
                </div>
                <a href="services.php" class="text-xs font-bold text-emerald-400 hover:underline mt-4 md:mt-0"> عرض جميع البرامج والجولات ← </a>
            </div>
            <div class="grid md:grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Education -->
                <a href="universities.php?lang=ar" class="glass-card rounded-3xl overflow-hidden group hover:border-amber-500/50 transition block">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/baku.jpg" alt="Education" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1584646098378-0874589d76b1?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 right-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-amber-400">التعليم</span>
                    </div>
                    <div class="p-5 text-right">
                        <h3 class="text-lg font-bold text-white mb-1">الجامعات والتعليم</h3>
                        <p class="text-slate-400 text-xs mb-4">أفضل الجامعات في أذربيجان، البرامج الدراسية وشروط القبول.</p>
                        <span class="text-xs font-bold text-amber-400">عرض الجامعات ←</span>
                    </div>
                </a>
                <!-- Business -->
                <a href="business.php?lang=ar" class="glass-card rounded-3xl overflow-hidden group hover:border-emerald-500/50 transition block">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/investments.jpg" alt="Business" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 right-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-400">الأعمال</span>
                    </div>
                    <div class="p-5 text-right">
                        <h3 class="text-lg font-bold text-white mb-1">الأعمال</h3>
                        <p class="text-slate-400 text-xs mb-4">الدعم المؤسسي، تسجيل الشركات وتأشيرات الأعمال لرواد الأعمال.</p>
                        <span class="text-xs font-bold text-emerald-400">اعرف المزيد ←</span>
                    </div>
                </a>
                <!-- Travel -->
                <a href="travel.php?lang=ar" class="glass-card rounded-3xl overflow-hidden group hover:border-emerald-500/50 transition block">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/shahdag.jpg" alt="Travel" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1548685913-fe6678babe8d?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 right-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-400">السفر</span>
                    </div>
                    <div class="p-5 text-right">
                        <h3 class="text-lg font-bold text-white mb-1">السفر</h3>
                        <p class="text-slate-400 text-xs mb-4">استكشف طبيعة أذربيجان، منتجعات الجبال، والباقات السياحية التي لا تُنسى.</p>
                        <span class="text-xs font-bold text-amber-400">استكشف السفر ←</span>
                    </div>
                </a>
            </div>
        </section>
    </div>

    <div id="footer-container"></div>
</body>
</html>