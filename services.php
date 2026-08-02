<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']) ? 'true' : 'false';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services | Caspian Bridges - Study, Invest & Tourism in Azerbaijan</title>
    <meta property="og:type" content="website">
    <meta property="og:title" content="Caspian Bridges — Services">
    <meta property="og:description" content="Visa Services, University Admissions & Education, Investment, and Travel solutions in Azerbaijan.">
    <meta property="og:image" content="images/svgviewer-png-1.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="component.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-nav { background: rgba(6, 20, 18, 0.85); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.08); }
        .glass-card { background: rgba(12, 35, 31, 0.65); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.08); }
        .hero-bg { background: radial-gradient(circle at 50% 0%, #0f3831 0%, #061412 70%, #020a09 100%); }
    </style>
    <script>
    window.isUserLoggedIn = <?php echo $isLoggedIn; ?>;
    </script>
</head>
<body class="bg-[#061412] text-slate-100 antialiased selection:bg-emerald-400 selection:text-slate-950">
    <div id="header-container"></div>

    <!-- ================= AZERBAIJANI (AZ) ================= -->
    <div data-lang="az">
        <section class="hero-bg pt-36 pb-16 px-6 relative overflow-hidden text-center">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none"></div>
            <div class="max-w-4xl mx-auto relative z-10">
                <div class="mb-6">
                    <a href="index" class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-emerald-400 transition bg-[#0b2420] px-4 py-2 rounded-full border border-slate-800"> ← Ana Səhifəyə Qayıt </a>
                </div>
                <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight leading-tight mb-4"> Hərtərəfli <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">Xidmətlərimiz</span> </h1>
                <p class="text-slate-400 text-sm sm:text-base max-w-2xl mx-auto"> Azərbaycanda Viza, Təhsil, İnvestisiya və Turizm istiqamətləri üzrə peşəkar və etibarlı həllər. </p>
            </div>
        </section>

        <section class="py-12 px-6 max-w-7xl mx-auto relative z-10 text-left">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="glass-card p-8 rounded-3xl hover:border-emerald-500/50 transition-all duration-300 hover:-translate-y-2 group">
                    <div class="w-14 h-14 bg-emerald-500/10 text-emerald-400 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform"> 🛂 </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Viza Xidmətləri</h3>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed mb-6"> Elektron viza, miqrasiya dəstəyi, sənədlərin rəsmiləşdirilməsi və hüquqi məsləhət xidmətləri. </p>
                    <a href="apply" class="inline-flex items-center text-xs font-bold text-emerald-400 hover:text-emerald-300 gap-1.5"> Viza üçün Müraciət Et → </a>
                </div>
                <div class="glass-card p-8 rounded-3xl hover:border-amber-500/50 transition-all duration-300 hover:-translate-y-2 group">
                    <div class="w-14 h-14 bg-amber-500/10 text-amber-400 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform"> 🎓 </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Təhsil (Education)</h3>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed mb-6"> Bakalavr, Magistr, Doktorantura proqramlarına qəbul, təqaüd yardımı və tələbə yataqxanası. </p>
                    <a href="apply" class="inline-flex items-center text-xs font-bold text-amber-400 hover:text-amber-300 gap-1.5"> Təhsil üçün Müraciət → </a>
                </div>
                <div class="glass-card p-8 rounded-3xl hover:border-emerald-500/50 transition-all duration-300 hover:-translate-y-2 group">
                    <div class="w-14 h-14 bg-emerald-500/10 text-emerald-400 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform"> 📈 </div>
                    <h3 class="text-2xl font-bold text-white mb-3">İnvestisiya (Invest)</h3>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed mb-6"> Azərbaycanda biznes qurmaq, daşınmaz əmlak yatırımları və kommersiya layihə dəstəyi. </p>
                    <a href="apply" class="inline-flex items-center text-xs font-bold text-emerald-400 hover:text-emerald-300 gap-1.5"> İnvestisiya Et → </a>
                </div>
                <div class="glass-card p-8 rounded-3xl hover:border-amber-500/50 transition-all duration-300 hover:-translate-y-2 group">
                    <div class="w-14 h-14 bg-amber-500/10 text-amber-400 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform"> ✈️ </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Turizm (Travel)</h3>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed mb-6"> Bakı və regionlar üzrə elit turlar, otel rezervasiyaları, transferlər və fərdi bələdçilər. </p>
                    <a href="apply" class="inline-flex items-center text-xs font-bold text-amber-400 hover:text-amber-300 gap-1.5"> Turizm Sifariş Et → </a>
                </div>
            </div>
        </section>
    </div>

    <!-- ================= ENGLISH (EN) ================= -->
    <div data-lang="en" class="hidden">
        <section class="hero-bg pt-36 pb-16 px-6 relative overflow-hidden text-center">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none"></div>
            <div class="max-w-4xl mx-auto relative z-10">
                <div class="mb-6">
                    <a href="index" class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-emerald-400 transition bg-[#0b2420] px-4 py-2 rounded-full border border-slate-800"> ← Back to Homepage </a>
                </div>
                <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight leading-tight mb-4"> Our Comprehensive <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">Services</span> </h1>
                <p class="text-slate-400 text-sm sm:text-base max-w-2xl mx-auto"> Professional and reliable solutions in Visa, Education, Investment, and Travel sectors in Azerbaijan. </p>
            </div>
        </section>

        <section class="py-12 px-6 max-w-7xl mx-auto relative z-10 text-left">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="glass-card p-8 rounded-3xl hover:border-emerald-500/50 transition-all duration-300 hover:-translate-y-2 group">
                    <div class="w-14 h-14 bg-emerald-500/10 text-emerald-400 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform"> 🛂 </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Visa Services</h3>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed mb-6"> e-Visa processing, migration support, legal documentation, and official consulting. </p>
                    <a href="apply" class="inline-flex items-center text-xs font-bold text-emerald-400 hover:text-emerald-300 gap-1.5"> Apply for Visa → </a>
                </div>
                <div class="glass-card p-8 rounded-3xl hover:border-amber-500/50 transition-all duration-300 hover:-translate-y-2 group">
                    <div class="w-14 h-14 bg-amber-500/10 text-amber-400 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform"> 🎓 </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Education</h3>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed mb-6"> Full guidance for Bachelor's, Master's, PhD admissions, scholarship support, and housing. </p>
                    <a href="apply" class="inline-flex items-center text-xs font-bold text-amber-400 hover:text-amber-300 gap-1.5"> Apply for Study → </a>
                </div>
                <div class="glass-card p-8 rounded-3xl hover:border-emerald-500/50 transition-all duration-300 hover:-translate-y-2 group">
                    <div class="w-14 h-14 bg-emerald-500/10 text-emerald-400 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform"> 📈 </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Investment (Invest)</h3>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed mb-6"> Business setup in Azerbaijan, real estate investments, and commercial project support. </p>
                    <a href="apply" class="inline-flex items-center text-xs font-bold text-emerald-400 hover:text-emerald-300 gap-1.5"> Invest Now → </a>
                </div>
                <div class="glass-card p-8 rounded-3xl hover:border-amber-500/50 transition-all duration-300 hover:-translate-y-2 group">
                    <div class="w-14 h-14 bg-amber-500/10 text-amber-400 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform"> ✈️ </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Travel & Tourism</h3>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed mb-6"> Bespoke tourism packages, private guides, hotel bookings, and airport transfers. </p>
                    <a href="apply" class="inline-flex items-center text-xs font-bold text-amber-400 hover:text-amber-300 gap-1.5"> Book Tour → </a>
                </div>
            </div>
        </section>
    </div>

    <!-- ================= RUSSIAN (RU) ================= -->
    <div data-lang="ru" class="hidden">
        <section class="hero-bg pt-36 pb-16 px-6 relative overflow-hidden text-center">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none"></div>
            <div class="max-w-4xl mx-auto relative z-10">
                <div class="mb-6">
                    <a href="index" class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-emerald-400 transition bg-[#0b2420] px-4 py-2 rounded-full border border-slate-800"> ← На главную </a>
                </div>
                <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight leading-tight mb-4"> Наши комплексные <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">услуги</span> </h1>
                <p class="text-slate-400 text-sm sm:text-base max-w-2xl mx-auto"> Профессиональные и надежные решения в сфере виз, образования, инвестиций и туризма в Азербайджане. </p>
            </div>
        </section>

        <section class="py-12 px-6 max-w-7xl mx-auto relative z-10 text-left">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="glass-card p-8 rounded-3xl hover:border-emerald-500/50 transition-all duration-300 hover:-translate-y-2 group">
                    <div class="w-14 h-14 bg-emerald-500/10 text-emerald-400 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform"> 🛂 </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Визовые услуги</h3>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed mb-6"> Оформление электронных виз, миграционная поддержка и юридическая консультация. </p>
                    <a href="apply" class="inline-flex items-center text-xs font-bold text-emerald-400 hover:text-emerald-300 gap-1.5"> Оформить визу → </a>
                </div>
                <div class="glass-card p-8 rounded-3xl hover:border-amber-500/50 transition-all duration-300 hover:-translate-y-2 group">
                    <div class="w-14 h-14 bg-amber-500/10 text-amber-400 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform"> 🎓 </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Образование</h3>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed mb-6"> Поступление на бакалавриат, магистратуру, PhD, стипендиальная поддержка и общежитие. </p>
                    <a href="apply" class="inline-flex items-center text-xs font-bold text-amber-400 hover:text-amber-300 gap-1.5"> Поступить на учебу → </a>
                </div>
                <div class="glass-card p-8 rounded-3xl hover:border-emerald-500/50 transition-all duration-300 hover:-translate-y-2 group">
                    <div class="w-14 h-14 bg-emerald-500/10 text-emerald-400 rounded-2xl flex items-center justify-center text-3xl mb=6 group-hover:scale=110 transition-transform"> 📈 </div>
                    <h3 class="text-2xl font-bold text-white mb=3">Инвестиции (Invest)</h3>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed mb-6"> Открытие бизнеса в Азербайджане, инвестиции в недвижимость и коммерческие проекты. </p>
                    <a href="apply" class="inline-flex items-center text-xs font-bold text-emerald-400 hover:text-emerald-300 gap-1.5"> Инвестировать → </a>
                </div>
                <div class="glass-card p-8 rounded-3xl hover:border-amber-500/50 transition-all duration-300 hover:-translate-y-2 group">
                    <div class="w-14 h-14 bg-amber-500/10 text-amber-400 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform"> ✈️ </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Туризм (Travel)</h3>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed mb-6"> Индивидуальные туры по Баку и регионам, бронирование отелей и трансферы. </p>
                    <a href="apply" class="inline-flex items-center text-xs font-bold text-amber-400 hover:text-amber-300 gap-1.5"> Заказать тур → </a>
                </div>
            </div>
        </section>
    </div>

    <!-- ================= ARABIC (AR) ================= -->
    <div data-lang="ar" class="hidden text-right">
        <section class="hero-bg pt-36 pb-16 px-6 relative overflow-hidden text-center">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none"></div>
            <div class="max-w-4xl mx-auto relative z-10">
                <div class="mb-6 flex justify-center">
                    <a href="index.html" class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-emerald-400 transition bg-[#0b2420] px-4 py-2 rounded-full border border-slate-800"> ← العودة إلى الرئيسية </a>
                </div>
                <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight leading-tight mb-4"> خدماتنا <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">الشاملة</span> </h1>
                <p class="text-slate-400 text-sm sm:text-base max-w-2xl mx-auto"> حلول احترافية وموثوقة في مجالات التأشيرات، التعليم، الاستثمار، والسياحة في أذربيجان. </p>
            </div>
        </section>

        <section class="py-12 px-6 max-w-7xl mx-auto relative z-10">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="glass-card p-8 rounded-3xl hover:border-emerald-500/50 transition-all duration-300 hover:-translate-y-2 group text-right">
                    <div class="w-14 h-14 bg-emerald-500/10 text-emerald-400 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform ml-auto"> 🛂 </div>
                    <h3 class="text-2xl font-bold text-white mb-3">خدمات التأشيرات</h3>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed mb-6"> معالجة التأشيرات الإلكترونية، دعم الهجرة، وتوثيق المستندات القانونية. </p>
                    <a href="apply" class="inline-flex items-center text-xs font-bold text-emerald-400 hover:text-emerald-300 gap-1.5"> طلب تأشيرة ← </a>
                </div>
                <div class="glass-card p-8 rounded-3xl hover:border-amber-500/50 transition-all duration-300 hover:-translate-y-2 group text-right">
                    <div class="w-14 h-14 bg-amber-500/10 text-amber-400 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform ml-auto"> 🎓 </div>
                    <h3 class="text-2xl font-bold text-white mb-3">التعليم (Education)</h3>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed mb-6"> إرشادات كاملة للقبول في برامج البكالوريوس، الماجستير， والدكتوراه، وتوفير السكن. </p>
                    <a href="apply" class="inline-flex items-center text-xs font-bold text-amber-400 hover:text-amber-300 gap-1.5"> التقديم للدراسة ← </a>
                </div>
                <div class="glass-card p-8 rounded-3xl hover:border-emerald-500/50 transition-all duration-300 hover:-translate-y-2 group text-right">
                    <div class="w-14 h-14 bg-emerald-500/10 text-emerald-400 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform ml-auto"> 📈 </div>
                    <h3 class="text-2xl font-bold text-white mb-3">الاستثمار (Invest)</h3>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed mb-6"> تأسيس الشركات في أذربيجان، الاستثمار العقاري، ودعم المشاريع التجارية. </p>
                    <a href="apply" class="inline-flex items-center text-xs font-bold text-emerald-400 hover:text-emerald-300 gap-1.5"> الاستثمار الآن ← </a>
                </div>
                <div class="glass-card p-8 rounded-3xl hover:border-amber-500/50 transition-all duration-300 hover:-translate-y-2 group text-right">
                    <div class="w-14 h-14 bg-amber-500/10 text-amber-400 rounded-2xl flex items-center justify-center text-3xl mb=6 group-hover:scale=110 transition-transform ml-auto"> ✈️ </div>
                    <h3 class="text-2xl font-bold text-white mb-3">السياحة (Travel)</h3>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed mb-6"> باقات سياحية مخصصة، مرشدون سياحيون خاصون، حجز الفنادق، والاستقبال بالمطار. </p>
                    <a href="apply" class="inline-flex items-center text-xs font-bold text-amber-400 hover:text-amber-300 gap-1.5"> حجز رحلة ← </a>
                </div>
            </div>
        </section>
    </div>

    <div id="footer-container"></div>
</body>
</html>