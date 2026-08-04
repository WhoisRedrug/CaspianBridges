<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']) ? 'true' : 'false';

// Dilə görə fərqli SEO başlığı/izahı (index.php ilə eyni məntiq)
$lang = $_GET['lang'] ?? 'az';
if (!in_array($lang, ['az', 'en', 'ru', 'ar'], true)) {
    $lang = 'az';
}

$seo = [
    'az' => [
        'title' => 'Azərbaycanda Universitetlər | Xarici Tələbələr üçün Tam Siyahı — Caspian Bridges',
        'desc'  => 'Azərbaycanda təhsil almaq istəyən xarici tələbələr üçün ən yaxşı universitetlərin tam siyahısı: Bakı Dövlət Universiteti, ADA University, Xəzər Universiteti və digərləri. Qəbul şərtləri və Caspian Bridges dəstəyi ilə.',
    ],
    'en' => [
        'title' => 'Universities in Azerbaijan | Full List for International Students — Caspian Bridges',
        'desc'  => 'Complete list of top universities in Azerbaijan for foreign students: Baku State University, ADA University, Khazar University and more. Admission guidance and support from Caspian Bridges.',
    ],
    'ru' => [
        'title' => 'Университеты Азербайджана | Полный список для иностранных студентов — Caspian Bridges',
        'desc'  => 'Полный список лучших университетов Азербайджана для иностранных студентов: Бакинский государственный университет, ADA University, Университет Хазар и другие. Помощь с поступлением от Caspian Bridges.',
    ],
    'ar' => [
        'title' => 'الجامعات في أذربيجان | القائمة الكاملة للطلاب الأجانب — Caspian Bridges',
        'desc'  => 'قائمة كاملة بأفضل الجامعات في أذربيجان للطلاب الأجانب: جامعة باكو الحكومية، جامعة ADA، جامعة خزر وغيرها. الدعم والقبول الجامعي مع Caspian Bridges.',
    ],
];
$html_dir = $lang === 'ar' ? 'rtl' : 'ltr';
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>" dir="<?php echo $html_dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($seo[$lang]['title']); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($seo[$lang]['desc']); ?>">
    <meta name="keywords" content="Azərbaycanda universitetlər, Bakı Dövlət Universiteti, ADA University, Xəzər Universiteti, universities in Azerbaijan, study in Baku, الجامعات في أذربيجان, الدراسة في باكو, университеты Азербайджана">
    <link rel="icon" type="image/png" href="images/logo.png.png">
    <link rel="canonical" href="https://caspianbridges.com/universities<?php echo $lang !== 'az' ? '?lang=' . htmlspecialchars($lang) : ''; ?>">
    <link rel="alternate" hreflang="az" href="https://caspianbridges.com/universities">
    <link rel="alternate" hreflang="en" href="https://caspianbridges.com/universities?lang=en">
    <link rel="alternate" hreflang="ru" href="https://caspianbridges.com/universities?lang=ru">
    <link rel="alternate" hreflang="ar" href="https://caspianbridges.com/universities?lang=ar">
    <link rel="alternate" hreflang="x-default" href="https://caspianbridges.com/universities">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://caspianbridges.com/universities">
    <meta property="og:title" content="<?php echo htmlspecialchars($seo[$lang]['title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($seo[$lang]['desc']); ?>">
    <meta property="og:image" content="images/svgviewer-png-1.png">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($seo[$lang]['title']); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($seo[$lang]['desc']); ?>">
    <meta name="twitter:image" content="images/svgviewer-png-1.png">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="component.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(12, 35, 31, 0.65); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.08); }
        .hero-glow { background: radial-gradient(circle at 50% 20%, #0f3831 0%, #061412 60%, #020a09 100%); }
    </style>
</head>
<body class="bg-[#061412] text-slate-100 antialiased selection:bg-emerald-400 selection:text-slate-950">
    <script>
    window.isUserLoggedIn = <?php echo $isLoggedIn; ?>;
    </script>
    <div id="header-container"></div>

    <?php
    // Universitet məlumatları (AZ/EN/RU/AR) — hər biri: ad, şəhər, təsvir
    $universities = [
        [
            'name' => 'Bakı Dövlət Universiteti (BSU)',
            'city' => 'Bakı',
            'az' => '1919-cu ildə yaradılıb, ölkənin ən qədim və nüfuzlu dövlət universitetidir. Geniş fakültə spektri.',
            'en' => 'Founded in 1919, the oldest and most prestigious public university in the country, offering a wide range of faculties.',
            'ru' => 'Основан в 1919 году, старейший и самый престижный государственный университет страны с широким выбором факультетов.',
            'ar' => 'تأسست عام 1919، وهي أقدم وأعرق جامعة حكومية في البلاد، وتقدم مجموعة واسعة من التخصصات.',
        ],
        [
            'name' => 'ADA University',
            'city' => 'Bakı',
            'az' => 'Xarici İşlər Nazirliyi tərəfindən yaradılmış, tam ingilisdilli tədris proqramları olan aparıcı universitet.',
            'en' => 'Established by the Ministry of Foreign Affairs, a leading university with fully English-medium academic programs.',
            'ru' => 'Основан Министерством иностранных дел, ведущий университет с полностью англоязычными программами обучения.',
            'ar' => 'أسستها وزارة الخارجية، وهي جامعة رائدة تقدم برامج أكاديمية باللغة الإنجليزية بالكامل.',
        ],
        [
            'name' => 'Xəzər Universiteti (Khazar University)',
            'city' => 'Bakı',
            'az' => 'Cənubi Qafqazda ilk müstəqil özəl universitet, tədqiqat yönümlü və ingilisdilli mühit.',
            'en' => 'The first independent private university in the South Caucasus, research-focused with an English-friendly environment.',
            'ru' => 'Первый независимый частный университет на Южном Кавказе, ориентированный на исследования с англоязычной средой.',
            'ar' => 'أول جامعة خاصة مستقلة في جنوب القوقاز، تركز على البحث العلمي في بيئة ناطقة بالإنجليزية.',
        ],
        [
            'name' => 'Azərbaycan Dövlət Neft və Sənaye Universiteti (ASOIU)',
            'city' => 'Bakı',
            'az' => 'Neft-qaz mühəndisliyi və texniki sahələr üzrə regionun ən qədim ixtisaslaşmış universitetlərindən biri.',
            'en' => 'One of the oldest specialized technical universities in the region, focused on oil & gas engineering and technical fields.',
            'ru' => 'Один из старейших специализированных технических университетов региона, специализация — нефтегазовая инженерия.',
            'ar' => 'واحدة من أقدم الجامعات التقنية المتخصصة في المنطقة، تركز على هندسة النفط والغاز والمجالات التقنية.',
        ],
        [
            'name' => 'Azərbaycan Tibb Universiteti (AMU)',
            'city' => 'Bakı',
            'az' => '1930-cu ildən fəaliyyət göstərən, həkim, diş həkimi və əczaçı hazırlayan əsas tibb məktəbi.',
            'en' => 'The main medical school of the country since 1930, training doctors, dentists and pharmacists.',
            'ru' => 'Главная медицинская школа страны с 1930 года, готовит врачей, стоматологов и фармацевтов.',
            'ar' => 'المدرسة الطبية الرئيسية في البلاد منذ عام 1930، تخرّج الأطباء وأطباء الأسنان والصيادلة.',
        ],
        [
            'name' => 'UNEC (Azərbaycan Dövlət İqtisad Universiteti)',
            'city' => 'Bakı',
            'az' => 'Cənubi Qafqazın aparıcı biznes və iqtisadiyyat universitetlərindən biri, çoxdilli tədris proqramları.',
            'en' => 'One of the leading business and economics universities in the South Caucasus, with multi-language programs.',
            'ru' => 'Один из ведущих университетов бизнеса и экономики на Южном Кавказе с многоязычными программами.',
            'ar' => 'واحدة من الجامعات الرائدة في مجال الأعمال والاقتصاد في جنوب القوقاز، ببرامج متعددة اللغات.',
        ],
        [
            'name' => 'Azərbaycan Texniki Universiteti (AzTU)',
            'city' => 'Bakı',
            'az' => 'Mühəndislik, kompüter elmləri və elektronika üzrə ixtisaslaşmış aparıcı dövlət texniki universiteti.',
            'en' => 'A leading state technical university specializing in engineering, computer science and electronics.',
            'ru' => 'Ведущий государственный технический университет со специализацией в инженерии, информатике и электронике.',
            'ar' => 'جامعة تقنية حكومية رائدة متخصصة في الهندسة وعلوم الحاسوب والإلكترونيات.',
        ],
        [
            'name' => 'Bakı Mühəndislik Universiteti (BEU)',
            'city' => 'Xırdalan',
            'az' => '2016-cı ildə yaradılan müasir universitet, rəqəmsal texnologiyalar və smart mühəndislik üzərində fokuslanıb.',
            'en' => 'A modern university founded in 2016, focused on digital technologies and smart engineering.',
            'ru' => 'Современный университет, основанный в 2016 году, специализируется на цифровых технологиях и умной инженерии.',
            'ar' => 'جامعة حديثة تأسست عام 2016، تركز على التقنيات الرقمية والهندسة الذكية.',
        ],
        [
            'name' => 'Qərbi Xəzər Universiteti (Western Caspian University)',
            'city' => 'Bakı',
            'az' => 'Ölkənin ilk özəl ali təhsil müəssisələrindən biri, biznes və hüquq sahələrində geniş proqramlar.',
            'en' => 'One of the country\'s first private higher education institutions, with broad programs in business and law.',
            'ru' => 'Одно из первых частных высших учебных заведений страны с широкими программами в бизнесе и праве.',
            'ar' => 'واحدة من أوائل مؤسسات التعليم العالي الخاصة في البلاد، ببرامج واسعة في الأعمال والقانون.',
        ],
        [
            'name' => 'Sumqayıt Dövlət Universiteti',
            'city' => 'Sumqayıt',
            'az' => 'Bakı yaxınlığındakı Sumqayıt şəhərində yerləşən, sənaye və təbiət elmlərinə fokuslanan dövlət universiteti.',
            'en' => 'A public university located in Sumgayit near Baku, with a focus on industrial and natural sciences.',
            'ru' => 'Государственный университет в городе Сумгайыт рядом с Баку, специализация — промышленные и естественные науки.',
            'ar' => 'جامعة حكومية تقع في مدينة سومقايت بالقرب من باكو، تركز على العلوم الصناعية والطبيعية.',
        ],
    ];
    ?>

    <!-- ================= AZERBAIJANI (AZ) ================= -->
    <div data-lang="az">
        <section class="hero-glow pt-36 pb-16 px-6 text-left">
            <div class="max-w-7xl mx-auto">
                <span class="text-amber-400 font-bold text-xs uppercase tracking-widest">Təhsil Bələdçisi</span>
                <h1 class="text-3xl sm:text-5xl font-black text-white mt-2 mb-4">Azərbaycanda Universitetlər</h1>
                <p class="text-slate-400 text-sm sm:text-base max-w-3xl">Xarici tələbələr üçün Azərbaycanın aparıcı dövlət və özəl universitetlərinin siyahısı. Hər hansı birinə qəbul üçün Caspian Bridges komandası sizə sənədləşmə, viza və yaşayış prosesində dəstək olur.</p>
            </div>
        </section>
        <section class="px-6 pb-20 max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($universities as $u): ?>
                <div class="glass-card rounded-3xl p-6 hover:border-amber-500/40 transition">
                    <h3 class="text-lg font-bold text-white mb-1"><?php echo htmlspecialchars($u['name']); ?></h3>
                    <span class="text-[11px] font-bold text-emerald-400 uppercase tracking-wide">📍 <?php echo htmlspecialchars($u['city']); ?></span>
                    <p class="text-slate-400 text-xs mt-3 leading-relaxed"><?php echo htmlspecialchars($u['az']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-12 text-center">
                <a href="apply" class="inline-block bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 text-slate-950 font-black px-8 py-3.5 rounded-xl text-sm shadow-lg transition hover:scale-105">Qəbul üçün Müraciət Et →</a>
            </div>
        </section>
    </div>

    <!-- ================= ENGLISH (EN) ================= -->
    <div data-lang="en" class="hidden">
        <section class="hero-glow pt-36 pb-16 px-6 text-left">
            <div class="max-w-7xl mx-auto">
                <span class="text-amber-400 font-bold text-xs uppercase tracking-widest">Education Guide</span>
                <h1 class="text-3xl sm:text-5xl font-black text-white mt-2 mb-4">Universities in Azerbaijan</h1>
                <p class="text-slate-400 text-sm sm:text-base max-w-3xl">A list of Azerbaijan's leading public and private universities for international students. Caspian Bridges supports you through admission, visa, and accommodation for any of them.</p>
            </div>
        </section>
        <section class="px-6 pb-20 max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($universities as $u): ?>
                <div class="glass-card rounded-3xl p-6 hover:border-amber-500/40 transition">
                    <h3 class="text-lg font-bold text-white mb-1"><?php echo htmlspecialchars($u['name']); ?></h3>
                    <span class="text-[11px] font-bold text-emerald-400 uppercase tracking-wide">📍 <?php echo htmlspecialchars($u['city']); ?></span>
                    <p class="text-slate-400 text-xs mt-3 leading-relaxed"><?php echo htmlspecialchars($u['en']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-12 text-center">
                <a href="apply" class="inline-block bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 text-slate-950 font-black px-8 py-3.5 rounded-xl text-sm shadow-lg transition hover:scale-105">Apply Now →</a>
            </div>
        </section>
    </div>

    <!-- ================= RUSSIAN (RU) ================= -->
    <div data-lang="ru" class="hidden">
        <section class="hero-glow pt-36 pb-16 px-6 text-left">
            <div class="max-w-7xl mx-auto">
                <span class="text-amber-400 font-bold text-xs uppercase tracking-widest">Гид по образованию</span>
                <h1 class="text-3xl sm:text-5xl font-black text-white mt-2 mb-4">Университеты Азербайджана</h1>
                <p class="text-slate-400 text-sm sm:text-base max-w-3xl">Список ведущих государственных и частных университетов Азербайджана для иностранных студентов. Caspian Bridges помогает с поступлением, визой и проживанием.</p>
            </div>
        </section>
        <section class="px-6 pb-20 max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($universities as $u): ?>
                <div class="glass-card rounded-3xl p-6 hover:border-amber-500/40 transition">
                    <h3 class="text-lg font-bold text-white mb-1"><?php echo htmlspecialchars($u['name']); ?></h3>
                    <span class="text-[11px] font-bold text-emerald-400 uppercase tracking-wide">📍 <?php echo htmlspecialchars($u['city']); ?></span>
                    <p class="text-slate-400 text-xs mt-3 leading-relaxed"><?php echo htmlspecialchars($u['ru']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-12 text-center">
                <a href="apply" class="inline-block bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 text-slate-950 font-black px-8 py-3.5 rounded-xl text-sm shadow-lg transition hover:scale-105">Подать заявку →</a>
            </div>
        </section>
    </div>

    <!-- ================= ARABIC (AR) ================= -->
    <div data-lang="ar" class="hidden">
        <section class="hero-glow pt-36 pb-16 px-6 text-right">
            <div class="max-w-7xl mx-auto">
                <span class="text-amber-400 font-bold text-xs uppercase tracking-widest">دليل التعليم</span>
                <h1 class="text-3xl sm:text-5xl font-black text-white mt-2 mb-4">الجامعات في أذربيجان</h1>
                <p class="text-slate-400 text-sm sm:text-base max-w-3xl">قائمة بأفضل الجامعات الحكومية والخاصة في أذربيجان للطلاب الأجانب. يدعمكم فريق Caspian Bridges في القبول والتأشيرة والسكن لأي منها.</p>
            </div>
        </section>
        <section class="px-6 pb-20 max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($universities as $u): ?>
                <div class="glass-card rounded-3xl p-6 hover:border-amber-500/40 transition text-right">
                    <h3 class="text-lg font-bold text-white mb-1"><?php echo htmlspecialchars($u['name']); ?></h3>
                    <span class="text-[11px] font-bold text-emerald-400 uppercase tracking-wide"><?php echo htmlspecialchars($u['city']); ?> 📍</span>
                    <p class="text-slate-400 text-xs mt-3 leading-relaxed"><?php echo htmlspecialchars($u['ar']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-12 text-center">
                <a href="apply" class="inline-block bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 text-slate-950 font-black px-8 py-3.5 rounded-xl text-sm shadow-lg transition hover:scale-105">قدم طلبك الآن ←</a>
            </div>
        </section>
    </div>

    <div id="footer-container"></div>
</body>
</html>