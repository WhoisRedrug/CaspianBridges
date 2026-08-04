<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']) ? 'true' : 'false';

$lang = $_GET['lang'] ?? 'az';
if (!in_array($lang, ['az', 'en', 'ru', 'ar'], true)) {
    $lang = 'az';
}

$seo = [
    'az' => [
        'title' => 'Azərbaycanda Universitetlər | Xarici Tələbələr üçün Tam Siyahı — Caspian Bridges',
        'desc'  => 'Azərbaycanda təhsil almaq istəyən xarici tələbələr üçün ən yaxşı universitetlərin tam siyahısı: təsis ili, təhsil haqqı, tədris dili və proqramlar. Qəbul dəstəyi Caspian Bridges ilə.',
    ],
    'en' => [
        'title' => 'Universities in Azerbaijan | Full List for International Students — Caspian Bridges',
        'desc'  => 'Complete list of top universities in Azerbaijan for foreign students: founding year, tuition, language of instruction and programs. Admission support from Caspian Bridges.',
    ],
    'ru' => [
        'title' => 'Университеты Азербайджана | Полный список для иностранных студентов — Caspian Bridges',
        'desc'  => 'Полный список лучших университетов Азербайджана: год основания, стоимость обучения, язык преподавания и программы. Помощь с поступлением от Caspian Bridges.',
    ],
    'ar' => [
        'title' => 'الجامعات في أذربيجان | القائمة الكاملة للطلاب الأجانب — Caspian Bridges',
        'desc'  => 'قائمة كاملة بأفضل الجامعات في أذربيجان: سنة التأسيس، الرسوم الدراسية، لغة التدريس والبرامج. الدعم في القبول مع Caspian Bridges.',
    ],
];
$html_dir = $lang === 'ar' ? 'rtl' : 'ltr';

// Ümumi UI etiketləri (dilə görə)
$labels = [
    'az' => ['founded' => 'Təsis ili', 'type' => 'Növ', 'public' => 'Dövlət', 'private' => 'Özəl', 'tuition' => 'Təhsil haqqı', 'per_year' => '/ il', 'instruction' => 'Tədris dili', 'programs' => 'Populyar proqramlar', 'apply' => 'Bu Universitetə Müraciət Et →', 'hero_tag' => 'Təhsil Bələdçisi', 'h1' => 'Azərbaycanda Universitetlər', 'intro' => 'Xarici tələbələr üçün Azərbaycanın aparıcı dövlət və özəl universitetlərinin ətraflı siyahısı. Hər hansı birinə qəbul üçün Caspian Bridges komandası sizə sənədləşmə, viza və yaşayış prosesində dəstək olur.', 'cta' => 'Qəbul üçün Müraciət Et →'],
    'en' => ['founded' => 'Founded', 'type' => 'Type', 'public' => 'Public', 'private' => 'Private', 'tuition' => 'Tuition', 'per_year' => '/ year', 'instruction' => 'Language of Instruction', 'programs' => 'Popular Programs', 'apply' => 'Apply to This University →', 'hero_tag' => 'Education Guide', 'h1' => 'Universities in Azerbaijan', 'intro' => "A detailed list of Azerbaijan's leading public and private universities for international students. Caspian Bridges supports you through admission, visa, and accommodation for any of them.", 'cta' => 'Apply Now →'],
    'ru' => ['founded' => 'Год основания', 'type' => 'Тип', 'public' => 'Государственный', 'private' => 'Частный', 'tuition' => 'Стоимость обучения', 'per_year' => '/ год', 'instruction' => 'Язык преподавания', 'programs' => 'Популярные программы', 'apply' => 'Подать заявку в этот университет →', 'hero_tag' => 'Гид по образованию', 'h1' => 'Университеты Азербайджана', 'intro' => 'Подробный список ведущих государственных и частных университетов Азербайджана для иностранных студентов. Caspian Bridges помогает с поступлением, визой и проживанием.', 'cta' => 'Подать заявку →'],
    'ar' => ['founded' => 'سنة التأسيس', 'type' => 'النوع', 'public' => 'حكومية', 'private' => 'خاصة', 'tuition' => 'الرسوم الدراسية', 'per_year' => '/ سنويًا', 'instruction' => 'لغة التدريس', 'programs' => 'البرامج الشائعة', 'apply' => 'قدم طلبك لهذه الجامعة ←', 'hero_tag' => 'دليل التعليم', 'h1' => 'الجامعات في أذربيجان', 'intro' => 'قائمة تفصيلية بأفضل الجامعات الحكومية والخاصة في أذربيجان للطلاب الأجانب. يدعمكم فريق Caspian Bridges في القبول والتأشيرة والسكن لأي منها.', 'cta' => 'قدم طلبك الآن ←'],
];
$L = $labels[$lang];

// Universitet məlumatları — image: images/universities/ qovluğuna əsl şəkilləri özünüz əlavə edin.
// onerror fallback ilə müvəqqəti stok şəkillər göstərilir ki, şəkillər yüklənənə qədər səhifə boş görünməsin.
$universities = [
    [
        'name' => 'Bakı Dövlət Universiteti (BSU)', 'city' => 'Bakı', 'image' => 'images/universities/bsu.jpg',
        'fallback' => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=1000&auto=format&fit=crop',
        'founded' => 1919, 'type' => 'public', 'tuition' => '1,600 – 3,500 AZN',
        'instruction' => 'AZ, RU, EN',
        'az' => ['desc' => 'Ölkənin ən qədim və nüfuzlu dövlət universitetidir, geniş fakültə spektri ilə humanitar və dəqiq elmlər üzrə təhsil verir.', 'programs' => 'Hüquq, Filologiya, Riyaziyyat, Beynəlxalq Münasibətlər'],
        'en' => ['desc' => 'The oldest and most prestigious public university in the country, offering a wide range of humanities and natural sciences faculties.', 'programs' => 'Law, Philology, Mathematics, International Relations'],
        'ru' => ['desc' => 'Старейший и самый престижный государственный университет страны с широким выбором гуманитарных и естественнонаучных факультетов.', 'programs' => 'Право, Филология, Математика, Международные отношения'],
        'ar' => ['desc' => 'أقدم وأعرق جامعة حكومية في البلاد، تقدم مجموعة واسعة من التخصصات في العلوم الإنسانية والطبيعية.', 'programs' => 'القانون، اللغويات، الرياضيات، العلاقات الدولية'],
    ],
    [
        'name' => 'ADA University', 'city' => 'Bakı', 'image' => 'images/universities/ada.jpg',
        'fallback' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1000&auto=format&fit=crop',
        'founded' => 2006, 'type' => 'public', 'tuition' => '9,900 – 10,700 USD',
        'instruction' => 'EN',
        'az' => ['desc' => 'Xarici İşlər Nazirliyi tərəfindən yaradılmış, tam ingilisdilli tədris proqramları olan aparıcı beynəlxalq yönümlü universitet.', 'programs' => 'Biznes, İT, İctimai Siyasət, Mühəndislik'],
        'en' => ['desc' => 'Established by the Ministry of Foreign Affairs, a leading internationally oriented university with fully English-medium programs.', 'programs' => 'Business, IT, Public Policy, Engineering'],
        'ru' => ['desc' => 'Основан Министерством иностранных дел, ведущий международно-ориентированный университет с полностью англоязычными программами.', 'programs' => 'Бизнес, ИТ, Государственная политика, Инженерия'],
        'ar' => ['desc' => 'أسستها وزارة الخارجية، جامعة رائدة ذات توجه دولي وبرامج أكاديمية باللغة الإنجليزية بالكامل.', 'programs' => 'إدارة الأعمال، تكنولوجيا المعلومات، السياسة العامة، الهندسة'],
    ],
    [
        'name' => 'Xəzər Universiteti (Khazar University)', 'city' => 'Bakı', 'image' => 'images/universities/khazar.jpg',
        'fallback' => 'https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=1000&auto=format&fit=crop',
        'founded' => 1991, 'type' => 'private', 'tuition' => '4,500 – 5,200 USD',
        'instruction' => 'EN, AZ',
        'az' => ['desc' => 'Cənubi Qafqazda ilk müstəqil özəl universitet, tədqiqat yönümlü və ingilisdilli tədris mühiti ilə tanınır.', 'programs' => 'Mühəndislik, İqtisadiyyat, Hüquq, Kompüter Elmləri'],
        'en' => ['desc' => 'The first independent private university in the South Caucasus, known for its research focus and English-friendly environment.', 'programs' => 'Engineering, Economics, Law, Computer Science'],
        'ru' => ['desc' => 'Первый независимый частный университет на Южном Кавказе, известен исследовательской направленностью и англоязычной средой.', 'programs' => 'Инженерия, Экономика, Право, Информатика'],
        'ar' => ['desc' => 'أول جامعة خاصة مستقلة في جنوب القوقاز، تشتهر بتركيزها البحثي وبيئتها الناطقة بالإنجليزية.', 'programs' => 'الهندسة، الاقتصاد، القانون، علوم الحاسوب'],
    ],
    [
        'name' => 'Azərbaycan Dövlət Neft və Sənaye Universiteti (ASOIU)', 'city' => 'Bakı', 'image' => 'images/universities/asoiu.jpg',
        'fallback' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=1000&auto=format&fit=crop',
        'founded' => 1920, 'type' => 'public', 'tuition' => '1,800 – 3,000 AZN',
        'instruction' => 'AZ, RU, EN',
        'az' => ['desc' => 'Neft-qaz mühəndisliyi və texniki sahələr üzrə regionun ən qədim ixtisaslaşmış universitetlərindən biridir.', 'programs' => 'Neft Mühəndisliyi, Geologiya, Kimya Texnologiyası'],
        'en' => ['desc' => 'One of the oldest specialized technical universities in the region, focused on oil & gas engineering and technical fields.', 'programs' => 'Petroleum Engineering, Geology, Chemical Technology'],
        'ru' => ['desc' => 'Один из старейших специализированных технических университетов региона со специализацией в нефтегазовой инженерии.', 'programs' => 'Нефтяная инженерия, Геология, Химическая технология'],
        'ar' => ['desc' => 'واحدة من أقدم الجامعات التقنية المتخصصة في المنطقة، تركز على هندسة النفط والغاز والمجالات التقنية.', 'programs' => 'هندسة البترول، الجيولوجيا، التكنولوجيا الكيميائية'],
    ],
    [
        'name' => 'Azərbaycan Tibb Universiteti (AMU)', 'city' => 'Bakı', 'image' => 'images/universities/amu.jpg',
        'fallback' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?q=80&w=1000&auto=format&fit=crop',
        'founded' => 1930, 'type' => 'public', 'tuition' => '4,500 – 7,000 USD',
        'instruction' => 'EN, AZ, RU',
        'az' => ['desc' => 'Ölkənin əsas tibb məktəbidir, həkim, diş həkimi və əczaçı hazırlığı üzrə beynəlxalq tanınmış proqramlar təqdim edir.', 'programs' => 'Ümumi Tibb (MD), Diş Həkimliyi, Əczaçılıq'],
        'en' => ['desc' => "The country's main medical school, offering internationally recognized programs for doctors, dentists and pharmacists.", 'programs' => 'General Medicine (MD), Dentistry, Pharmacy'],
        'ru' => ['desc' => 'Главная медицинская школа страны с международно признанными программами для врачей, стоматологов и фармацевтов.', 'programs' => 'Общая медицина (MD), Стоматология, Фармация'],
        'ar' => ['desc' => 'المدرسة الطبية الرئيسية في البلاد، تقدم برامج معترف بها دوليًا لإعداد الأطباء وأطباء الأسنان والصيادلة.', 'programs' => 'الطب العام (MD)، طب الأسنان، الصيدلة'],
    ],
    [
        'name' => 'UNEC (Azərbaycan Dövlət İqtisad Universiteti)', 'city' => 'Bakı', 'image' => 'images/universities/unec.jpg',
        'fallback' => 'https://images.unsplash.com/photo-1554774853-b415df9eeb92?q=80&w=1000&auto=format&fit=crop',
        'founded' => 1930, 'type' => 'public', 'tuition' => '2,000 – 4,000 AZN',
        'instruction' => 'AZ, RU, EN',
        'az' => ['desc' => 'Cənubi Qafqazın aparıcı biznes və iqtisadiyyat universitetlərindən biri, çoxdilli tədris proqramları ilə seçilir.', 'programs' => 'Maliyyə, Marketinq, Logistika, Beynəlxalq İqtisadiyyat'],
        'en' => ['desc' => 'One of the leading business and economics universities in the South Caucasus, distinguished by multi-language programs.', 'programs' => 'Finance, Marketing, Logistics, International Economics'],
        'ru' => ['desc' => 'Один из ведущих университетов бизнеса и экономики на Южном Кавказе, отличается многоязычными программами.', 'programs' => 'Финансы, Маркетинг, Логистика, Международная экономика'],
        'ar' => ['desc' => 'واحدة من الجامعات الرائدة في الأعمال والاقتصاد في جنوب القوقاز، تتميز ببرامج متعددة اللغات.', 'programs' => 'التمويل، التسويق، اللوجستيات، الاقتصاد الدولي'],
    ],
    [
        'name' => 'Azərbaycan Texniki Universiteti (AzTU)', 'city' => 'Bakı', 'image' => 'images/universities/aztu.jpg',
        'fallback' => 'https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=1000&auto=format&fit=crop',
        'founded' => 1950, 'type' => 'public', 'tuition' => '1,700 – 3,000 AZN',
        'instruction' => 'AZ, RU, EN',
        'az' => ['desc' => 'Mühəndislik, kompüter elmləri və elektronika üzrə ixtisaslaşmış aparıcı dövlət texniki universitetidir.', 'programs' => 'Kompüter Mühəndisliyi, Elektronika, Robototexnika'],
        'en' => ['desc' => 'A leading state technical university specializing in engineering, computer science and electronics.', 'programs' => 'Computer Engineering, Electronics, Robotics'],
        'ru' => ['desc' => 'Ведущий государственный технический университет со специализацией в инженерии, информатике и электронике.', 'programs' => 'Компьютерная инженерия, Электроника, Робототехника'],
        'ar' => ['desc' => 'جامعة تقنية حكومية رائدة متخصصة في الهندسة وعلوم الحاسوب والإلكترونيات.', 'programs' => 'هندسة الحاسوب، الإلكترونيات، الروبوتات'],
    ],
    [
        'name' => 'Bakı Mühəndislik Universiteti (BEU)', 'city' => 'Xırdalan', 'image' => 'images/universities/beu.jpg',
        'fallback' => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=1000&auto=format&fit=crop',
        'founded' => 2016, 'type' => 'private', 'tuition' => '3,000 – 5,500 USD',
        'instruction' => 'EN, AZ',
        'az' => ['desc' => 'Müasir kampus infrastrukturu ilə rəqəmsal texnologiyalar və smart mühəndislik üzərində fokuslanan gənc universitetdir.', 'programs' => 'Süni İntellekt, Data Elmi, Proqram Mühəndisliyi'],
        'en' => ['desc' => 'A modern university with contemporary campus infrastructure, focused on digital technologies and smart engineering.', 'programs' => 'Artificial Intelligence, Data Science, Software Engineering'],
        'ru' => ['desc' => 'Современный университет с новой инфраструктурой кампуса, специализируется на цифровых технологиях и умной инженерии.', 'programs' => 'Искусственный интеллект, Data Science, Программная инженерия'],
        'ar' => ['desc' => 'جامعة حديثة ببنية تحتية عصرية، تركز على التقنيات الرقمية والهندسة الذكية.', 'programs' => 'الذكاء الاصطناعي، علم البيانات، هندسة البرمجيات'],
    ],
    [
        'name' => 'Qərbi Xəzər Universiteti (Western Caspian University)', 'city' => 'Bakı', 'image' => 'images/universities/wcu.jpg',
        'fallback' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1000&auto=format&fit=crop',
        'founded' => 1996, 'type' => 'private', 'tuition' => '2,500 – 4,000 USD',
        'instruction' => 'EN, AZ, RU',
        'az' => ['desc' => 'Ölkənin ilk özəl ali təhsil müəssisələrindən biri, biznes və hüquq sahələrində geniş proqramlar təklif edir.', 'programs' => 'Biznes İdarəetməsi, Hüquq, Turizm'],
        'en' => ["desc" => "One of the country's first private higher education institutions, offering broad programs in business and law.", 'programs' => 'Business Administration, Law, Tourism'],
        'ru' => ['desc' => 'Одно из первых частных высших учебных заведений страны с широкими программами в бизнесе и праве.', 'programs' => 'Управление бизнесом, Право, Туризм'],
        'ar' => ['desc' => 'واحدة من أوائل مؤسسات التعليم العالي الخاصة في البلاد، تقدم برامج واسعة في الأعمال والقانون.', 'programs' => 'إدارة الأعمال، القانون، السياحة'],
    ],
    [
        'name' => 'Sumqayıt Dövlət Universiteti', 'city' => 'Sumqayıt', 'image' => 'images/universities/sdu.jpg',
        'fallback' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=1000&auto=format&fit=crop',
        'founded' => 1945, 'type' => 'public', 'tuition' => '1,200 – 2,200 AZN',
        'instruction' => 'AZ, RU',
        'az' => ['desc' => 'Bakı yaxınlığındakı Sumqayıt şəhərində yerləşən, sənaye və təbiət elmlərinə fokuslanan dövlət universiteti.', 'programs' => 'Kimya, Fizika, Sənaye Mühəndisliyi'],
        'en' => ['desc' => 'A public university located in Sumgayit near Baku, with a focus on industrial and natural sciences.', 'programs' => 'Chemistry, Physics, Industrial Engineering'],
        'ru' => ['desc' => 'Государственный университет в городе Сумгайыт рядом с Баку, специализация — промышленные и естественные науки.', 'programs' => 'Химия, Физика, Промышленная инженерия'],
        'ar' => ['desc' => 'جامعة حكومية تقع في مدينة سومقايت بالقرب من باكو، تركز على العلوم الصناعية والطبيعية.', 'programs' => 'الكيمياء، الفيزياء، الهندسة الصناعية'],
    ],
];
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

    <section class="hero-glow pt-36 pb-12 px-6 <?php echo $lang === 'ar' ? 'text-right' : 'text-left'; ?>">
        <div class="max-w-7xl mx-auto">
            <span class="text-amber-400 font-bold text-xs uppercase tracking-widest"><?php echo htmlspecialchars($L['hero_tag']); ?></span>
            <h1 class="text-3xl sm:text-5xl font-black text-white mt-2 mb-4"><?php echo htmlspecialchars($L['h1']); ?></h1>
            <p class="text-slate-400 text-sm sm:text-base max-w-3xl"><?php echo htmlspecialchars($L['intro']); ?></p>
        </div>
    </section>

    <section class="px-6 pb-20 max-w-7xl mx-auto">
        <div class="grid md:grid-cols-2 gap-8">
            <?php foreach ($universities as $u):
                $type_label = $u['type'] === 'public' ? $L['public'] : $L['private'];
                $d = $u[$lang];
            ?>
            <div class="glass-card rounded-3xl overflow-hidden hover:border-amber-500/40 transition <?php echo $lang === 'ar' ? 'text-right' : 'text-left'; ?>">
                <div class="h-52 overflow-hidden relative">
                    <img src="<?php echo htmlspecialchars($u['image']); ?>" alt="<?php echo htmlspecialchars($u['name']); ?>" class="w-full h-full object-cover" onerror="this.src='<?php echo htmlspecialchars($u['fallback']); ?>'">
                    <span class="absolute top-3 <?php echo $lang === 'ar' ? 'right-3' : 'left-3'; ?> bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-amber-400">📍 <?php echo htmlspecialchars($u['city']); ?></span>
                    <span class="absolute top-3 <?php echo $lang === 'ar' ? 'left-3' : 'right-3'; ?> bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-400"><?php echo htmlspecialchars($type_label); ?></span>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2"><?php echo htmlspecialchars($u['name']); ?></h3>
                    <p class="text-slate-400 text-xs leading-relaxed mb-4"><?php echo htmlspecialchars($d['desc']); ?></p>
                    <div class="grid grid-cols-2 gap-3 text-[11px] mb-4">
                        <div class="bg-[#0b2420] rounded-xl p-3">
                            <span class="block text-slate-500 font-semibold"><?php echo htmlspecialchars($L['founded']); ?></span>
                            <span class="text-white font-bold"><?php echo $u['founded']; ?></span>
                        </div>
                        <div class="bg-[#0b2420] rounded-xl p-3">
                            <span class="block text-slate-500 font-semibold"><?php echo htmlspecialchars($L['instruction']); ?></span>
                            <span class="text-white font-bold"><?php echo htmlspecialchars($u['instruction']); ?></span>
                        </div>
                        <div class="bg-[#0b2420] rounded-xl p-3 col-span-2">
                            <span class="block text-slate-500 font-semibold"><?php echo htmlspecialchars($L['tuition']); ?></span>
                            <span class="text-amber-400 font-bold"><?php echo htmlspecialchars($u['tuition']); ?> <?php echo htmlspecialchars($L['per_year']); ?></span>
                        </div>
                    </div>
                    <p class="text-[11px] text-slate-500 mb-4"><span class="font-semibold text-slate-400"><?php echo htmlspecialchars($L['programs']); ?>:</span> <?php echo htmlspecialchars($d['programs']); ?></p>
                    <a href="apply" class="inline-block w-full text-center bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 text-slate-950 font-black py-2.5 rounded-xl text-xs shadow-lg transition"><?php echo htmlspecialchars($L['apply']); ?></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-4 text-center text-[11px] text-slate-600 italic">
            * <?php echo $lang === 'az' ? 'Təhsil haqqı təxmini məbləğdir, universitetin rəsmi saytında yoxlanılmalıdır.' : ($lang === 'en' ? 'Tuition figures are approximate; please verify with the official university website.' : ($lang === 'ru' ? 'Стоимость обучения приблизительна, уточняйте на официальном сайте университета.' : 'الرسوم الدراسية تقريبية، يرجى التحقق من الموقع الرسمي للجامعة.')); ?>
        </div>
    </section>

    <div id="footer-container"></div>
</body>
</html>