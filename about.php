<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']) ? 'true' : 'false';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Caspian Bridges - Study & Tourism Gateway</title>
    <link rel="icon" type="image/png" href="images/logo.png.png">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Caspian Bridges — About Us">
    <meta property="og:description" content="Learn more about Caspian Bridges, offering 7/24 support for your study and tourism in Azerbaijan.">
    <meta property="og:image" content="images/logo.png.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="component.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(12, 35, 31, 0.75); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.08); }
        .hero-bg { background: radial-gradient(circle at 50% 0%, #0f3831 0%, #061412 70%, #020617 100%); }
        .glass-nav { background: rgba(6, 20, 18, 0.85); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.08); }
    </style>
    <script>
    window.isUserLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    </script>
</head>
<body class="bg-[#061412] text-slate-100 antialiased selection:bg-emerald-400 selection:text-slate-950">
    <div id="header-container"></div>

    <!-- ================= AZERBAIJANI (AZ) ================= -->
    <div data-lang="az">
        <section class="hero-bg pt-36 pb-20 px-6 relative overflow-hidden text-left">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none"></div>
            <div class="max-w-4xl mx-auto text-center relative z-10">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold mb-6"> 🇦🇿 Caspian Bridges Agentliyi • 7/24 Dəstək Aktivdir </span>
                <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight leading-tight mb-6"> Etibar və Təcrübə ilə <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">Qlobal Gələcəyi Qururuq</span> </h1>
                <p class="text-slate-400 text-base sm:text-lg max-w-2xl mx-auto leading-relaxed"> Caspian Bridges Bakıda yerləşən aparıcı konsaltinq və yerləşdirmə şirkətidir, Azərbaycan üzrə beynəlxalq tələbə qəbulu, yaşayış, sənəd hazırlığı və turizm sahəsində ixtisaslaşmışdır. </p>
            </div>
        </section>

        <section class="py-16 px-6 max-w-7xl mx-auto text-left">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <span class="text-emerald-400 font-bold text-xs uppercase tracking-widest">Biz Kimik</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white"> Azərbaycana Açılan Qapınız </h2>
                    <p class="text-slate-300 text-sm leading-relaxed"> Beynəlxalq tələbələri və səyahətçiləri Azərbaycandakı inanılmaz imkanlarla birləşdirmək üçün yaradılmış <strong>Caspian Bridges</strong> hər mərhələdə tam dəstək təmin edir. </p>
                    <p class="text-slate-400 text-sm leading-relaxed"> Universitet qəbulundan tutmuş etibarlı yaşayış yerinin tapılmasına və rəsmi sənəd qeydiyyatına qədər komandamız <strong>7/24 müştəri xidməti və dəstəyi</strong> ilə qüsursuz təcrübə təqdim edir. </p>
                    <div class="pt-2 flex flex-wrap gap-4">
                        <div class="flex items-center gap-3 bg-[#0b2420] border border-slate-800 px-4 py-3 rounded-xl">
                            <span class="text-2xl">⚡</span>
                            <div>
                                <h4 class="text-white text-xs font-bold">Sürətli Qəbul</h4>
                                <p class="text-slate-500 text-[11px]">Birbaşa universitet prosesi</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 bg-[#0b2420] border border-slate-800 px-4 py-3 rounded-xl">
                            <span class="text-2xl">🛡️</span>
                            <div>
                                <h4 class="text-white text-xs font-bold">7/24 Dəstək</h4>
                                <p class="text-slate-500 text-[11px]">Həmişə köməyə hazırıq</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="glass-card p-6 rounded-3xl border border-slate-800 text-center">
                        <div class="text-4xl font-black text-emerald-400 mb-1">99%</div>
                        <h3 class="text-white font-bold text-sm">Uğur Faizi</h3>
                        <p class="text-slate-400 text-xs mt-1">Qəbullarda yüksək göstərici.</p>
                    </div>
                    <div class="glass-card p-6 rounded-3xl border border-slate-800 text-center">
                        <div class="text-4xl font-black text-amber-400 mb-1">7/24</div>
                        <h3 class="text-white font-bold text-sm">Aktiv Dəstək</h3>
                        <p class="text-slate-400 text-xs mt-1">Fasiləsiz xidmət.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- ================= ENGLISH (EN) ================= -->
    <div data-lang="en" class="hidden">
        <section class="hero-bg pt-36 pb-20 px-6 relative overflow-hidden text-left">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none"></div>
            <div class="max-w-4xl mx-auto text-center relative z-10">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold mb-6"> 🇦🇿 Caspian Bridges Agency • 7/24 Support Active </span>
                <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight leading-tight mb-6"> Connecting Global Futures with <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">Trust & Expertise</span> </h1>
                <p class="text-slate-400 text-base sm:text-lg max-w-2xl mx-auto leading-relaxed"> Caspian Bridges is a premier consulting and placement firm in Baku, specializing in international student admissions, housing, document preparation, and tourism in Azerbaijan. </p>
            </div>
        </section>

        <section class="py-16 px-6 max-w-7xl mx-auto text-left">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <span class="text-emerald-400 font-bold text-xs uppercase tracking-widest">Who We Are</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white"> Your Gateway to Azerbaijan </h2>
                    <p class="text-slate-300 text-sm leading-relaxed"> Founded to bridge international students and travelers with the incredible opportunities in Azerbaijan, <strong>Caspian Bridges</strong> provides end-to-end support. </p>
                    <p class="text-slate-400 text-sm leading-relaxed"> From university enrollment to secure accommodation placement and official document filing, our team ensures a seamless experience with dedicated <strong>7/24 client service and support</strong>. </p>
                    <div class="pt-2 flex flex-wrap gap-4">
                        <div class="flex items-center gap-3 bg-[#0b2420] border border-slate-800 px-4 py-3 rounded-xl">
                            <span class="text-2xl">⚡</span>
                            <div>
                                <h4 class="text-white text-xs font-bold">Fast Admission</h4>
                                <p class="text-slate-500 text-[11px]">Direct university processing</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 bg-[#0b2420] border border-slate-800 px-4 py-3 rounded-xl">
                            <span class="text-2xl">🛡️</span>
                            <div>
                                <h4 class="text-white text-xs font-bold">7/24 Assistance</h4>
                                <p class="text-slate-500 text-[11px]">Always ready to help you</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="glass-card p-6 rounded-3xl border border-slate-800 text-center">
                        <div class="text-4xl font-black text-emerald-400 mb-1">99%</div>
                        <h3 class="text-white font-bold text-sm">Success Rate</h3>
                        <p class="text-slate-400 text-xs mt-1">High success in admissions.</p>
                    </div>
                    <div class="glass-card p-6 rounded-3xl border border-slate-800 text-center">
                        <div class="text-4xl font-black text-amber-400 mb-1">7/24</div>
                        <h3 class="text-white font-bold text-sm">Active Support</h3>
                        <p class="text-slate-400 text-xs mt-1">Round-the-clock service.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- ================= RUSSIAN (RU) ================= -->
    <div data-lang="ru" class="hidden">
        <section class="hero-bg pt-36 pb-20 px-6 relative overflow-hidden text-left">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none"></div>
            <div class="max-w-4xl mx-auto text-center relative z-10">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold mb-6"> 🇦🇿 Агентство Caspian Bridges • Поддержка 24/7 </span>
                <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight leading-tight mb-6"> Соединяя глобальное будущее с <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">доверием и опытом</span> </h1>
                <p class="text-slate-400 text-base sm:text-lg max-w-2xl mx-auto leading-relaxed"> Caspian Bridges — ведущая консалтинговая компания в Баку, специализирующаяся на поступлении студентов, размещении и туризме в Азербайджане. </p>
            </div>
        </section>

        <section class="py-16 px-6 max-w-7xl mx-auto text-left">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <span class="text-emerald-400 font-bold text-xs uppercase tracking-widest">О нас</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white"> Ваш путь в Азербайджан </h2>
                    <p class="text-slate-300 text-sm leading-relaxed"> Компания <strong>Caspian Bridges</strong>, созданная для того, чтобы связать иностранных студентов с возможностями в Азербайджане, оказывает полную поддержку на всех этапах. </p>
                    <p class="text-slate-400 text-sm leading-relaxed"> От зачисления в университет до поиска безопасного жилья и оформления документов — наша команда обеспечивает безупречный сервис с поддержкой <strong>24/7</strong>. </p>
                    <div class="pt-2 flex flex-wrap gap-4">
                        <div class="flex items-center gap-3 bg-[#0b2420] border border-slate-800 px-4 py-3 rounded-xl">
                            <span class="text-2xl">⚡</span>
                            <div>
                                <h4 class="text-white text-xs font-bold">Быстрое поступление</h4>
                                <p class="text-slate-500 text-[11px]">Прямое оформление в ВУЗы</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 bg-[#0b2420] border border-slate-800 px-4 py-3 rounded-xl">
                            <span class="text-2xl">🛡️</span>
                            <div>
                                <h4 class="text-white text-xs font-bold">Поддержка 24/7</h4>
                                <p class="text-slate-500 text-[11px]">Всегда готовы помочь</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="glass-card p-6 rounded-3xl border border-slate-800 text-center">
                        <div class="text-4xl font-black text-emerald-400 mb-1">99%</div>
                        <h3 class="text-white font-bold text-sm">Успех поступления</h3>
                        <p class="text-slate-400 text-xs mt-1">Высокий процент зачислений.</p>
                    </div>
                    <div class="glass-card p-6 rounded-3xl border border-slate-800 text-center">
                        <div class="text-4xl font-black text-amber-400 mb-1">24/7</div>
                        <h3 class="text-white font-bold text-sm">Активная поддержка</h3>
                        <p class="text-slate-400 text-xs mt-1">Круглосуточный сервис.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- ================= ARABIC (AR) ================= -->
    <div data-lang="ar" class="hidden text-right">
        <section class="hero-bg pt-36 pb-20 px-6 relative overflow-hidden">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none"></div>
            <div class="max-w-4xl mx-auto text-center relative z-10">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold mb-6 ml-auto"> 🇦🇿 وكالة جسور بحر قزوين • دعم 7/24 نشط </span>
                <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight leading-tight mb-6"> ربط المستقبل العالمي بـ <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">الثقة والخبرة</span> </h1>
                <p class="text-slate-400 text-base sm:text-lg max-w-2xl mx-auto leading-relaxed"> جسور بحر قزوين هي شركة استشارات وتنسيق رائدة في باكو، متخصصة في قبول الطلاب الدوليين والإسكان وإعداد المستندات والسياحة في أذربيجان. </p>
            </div>
        </section>

        <section class="py-16 px-6 max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center flex-row-reverse">
                <div class="space-y-6 text-right">
                    <span class="text-emerald-400 font-bold text-xs uppercase tracking-widest">من نحن</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white"> بوابتك إلى أذربيجان </h2>
                    <p class="text-slate-300 text-sm leading-relaxed"> تأسست <strong>جسور بحر قزوين</strong> لربط الطلاب الدوليين والمسافرين بالفرص المذهلة في أذربيجان، وهي توفر دعماً متكاملاً من البداية للنهاية. </p>
                    <p class="text-slate-400 text-sm leading-relaxed"> من القبول الجامعي إلى تأمين السكن وملفات المستندات الرسمية، يضمن فريقنا تجربة سلسة مع <strong>خدمة ودعم العملاء على مدار الساعة 7/24</strong>. </p>
                    <div class="pt-2 flex flex-wrap gap-4 justify-end">
                        <div class="flex items-center gap-3 bg-[#0b2420] border border-slate-800 px-4 py-3 rounded-xl flex-row-reverse">
                            <span class="text-2xl">⚡</span>
                            <div class="text-right">
                                <h4 class="text-white text-xs font-bold">قبول سريع</h4>
                                <p class="text-slate-500 text-[11px]">معالجة مباشرة للجامعات</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 bg-[#0b2420] border border-slate-800 px-4 py-3 rounded-xl flex-row-reverse">
                            <span class="text-2xl">🛡️</span>
                            <div class="text-right">
                                <h4 class="text-white text-xs font-bold">دعم 7/24</h4>
                                <p class="text-slate-500 text-[11px]">دائماً مستعدون للمساعدة</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="glass-card p-6 rounded-3xl border border-slate-800 text-center">
                        <div class="text-4xl font-black text-emerald-400 mb-1">99%</div>
                        <h3 class="text-white font-bold text-sm">معدل النجاح</h3>
                        <p class="text-slate-400 text-xs mt-1">نجاح عالٍ في القبول.</p>
                    </div>
                    <div class="glass-card p-6 rounded-3xl border border-slate-800 text-center">
                        <div class="text-4xl font-black text-amber-400 mb-1">7/24</div>
                        <h3 class="text-white font-bold text-sm">دعم نشط</h3>
                        <p class="text-slate-400 text-xs mt-1">خدمة على مدار الساعة.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div id="footer-container"></div>
</body>
</html>