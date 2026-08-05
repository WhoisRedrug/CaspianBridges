<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']) ? 'true' : 'false';

// Dilə görə fərqli SEO başlığı/izahı
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
    <meta property="og:url" content="https://caspianbridges.com/universities<?php echo $lang !== 'az' ? '?lang=' . htmlspecialchars($lang) : ''; ?>">
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
    // Universitet məlumatları, real mənbə əsaslı geniş mətnlər və slayd şəkilləri massivi
    $universities = [
        [
            'name' => 'Bakı Dövlət Universiteti (BSU)',
            'city' => 'Bakı',
            'images' => ['images/bsu_1.jpg', 'images/bsu_2.jpg', 'images/bsu_3.jpg'],
            'level_az' => 'Bakalavr • Magistr • Doktorantura',
            'level_en' => 'Bachelor • Master • PhD',
            'level_ru' => 'Бакалавриат • Магистратура • Докторантура',
            'level_ar' => 'بكالوريوس • ماجستير • دكتوراه',
            'az' => '1919-cu ildə yaradılıb, ölkənin ən qədim və nüfuzlu dövlət universitetidir. Geniş fakültə spektri.',
            'en' => 'Founded in 1919, the oldest and most prestigious public university in the country, offering a wide range of faculties.',
            'ru' => 'Основан в 1919 году, старейший и самый престижный государственный университет страны с широким выбором факультетов.',
            'ar' => 'تأسست عام 1919، وهي أقدم وأعرق جامعة حكومية في البلاد، وتقدم مجموعة واسعة من التخصصات.',
            'detail_az' => 'Bakı Dövlət Universiteti (BDU) Azərbaycan Xalq Cümhuriyyətinin Parlamentinin 1 sentyabr 1919-cu il tarixli qərarı ilə təsis edilmişdir. Ölkənin elm, təhsil və mədəniyyət mərkəzlərindən biri olan BDU-nun məzunları arasında tanınmış dövlət xadimləri, elm adamları və Nobel mükafatı laureatı Lev Landau da olmuşdur. Universitetdə 16 fakültə, elmi-tədqiqat institutları, zəngin elmi kitabxana və astronavtika mərkəzi fəaliyyət göstərir. Xarici tələbələr üçün fundamental elmlər, humanitar sahələr, hüquq və beynəlxalq münasibətlər istiqamətində müasir tələblərə cavab verən proqramlar təqdim olunur.',
            'detail_en' => 'Baku State University (BSU) was established on September 1, 1919, by the decision of the Parliament of the Azerbaijan Democratic Republic. As one of the country’s prime centers of science, education, and culture, BSU’s alumni include prominent statesmen, scientists, and Nobel laureate Lev Landau. The university comprises 16 faculties, research institutes, an extensive scientific library, and an astronomical observatory. It offers international students robust academic programs in fundamental sciences, humanities, law, and international relations.',
            'detail_ru' => 'Бакинский государственный университет (БГУ) был основан 1 сентября 1919 года по решению Парламента Азербайджанской Демократической Республики. Будучи одним из главных центров науки и образования страны, БГУ выпустил множество выдающихся ученых, государственных деятелей и лауреата Нобелевской премии Льва Ландау. В структуре университета 16 факультетов, научно-исследовательские институты и богатейшая научная библиотека.',
            'detail_ar' => 'تأسست جامعة باكو الحكومية (BSU) في 1 سبتمبر 1919 بموجب قرار برلمان جمهورية أذربيجان الديمقراطية. تُعد واحدة من أبرز مراكز العلوم والتعليم والثقافة في البلاد، وقد تخرج فيها العديد من الشخصيات البارزة والعلماء. تضم الجامعة 16 كلية ومراكز بحثية متقدمة ومكتبة علمية ضخمة.',
        ],
        [
            'name' => 'ADA University',
            'city' => 'Bakı',
            'images' => ['images/ada_1.jpg', 'images/ada_2.jpg', 'images/ada_3.jpg'],
            'level_az' => 'Bakalavr • Magistr',
            'level_en' => 'Bachelor • Master',
            'level_ru' => 'Бакалавриат • Магистратура',
            'level_ar' => 'بكالوريوس • ماجستير',
            'az' => 'Xarici İşlər Nazirliyi tərəfindən yaradılmış, tam ingilisdilli tədris proqramları olan aparıcı universitet.',
            'en' => 'Established by the Ministry of Foreign Affairs, a leading university with fully English-medium academic programs.',
            'ru' => 'Основан Министерством иностранных дел, ведущий университет с полностью англоязычными программами обучения.',
            'ar' => 'أسستها وزارة الخارجية، وهي جامعة رائدة تقدم برامج أكاديمية باللغة الإنجليزية بالكامل.',
            'detail_az' => 'ADA Universiteti 2006-cı ildə Azərbaycan Respublikasının Xarici İşlər Nazirliyi nəzdində yaradılmış və daha sonra ali təhsil müəssisəsi kimi fəaliyyətini genişləndirmişdir. Şəhərcik modeli əsasında qurulan ADA Qərb ali təhsil standartlarını, şəffaflığı və tədqiqat yönümlü mühiti təşviq edir. Universitetdə İnformasiya Texnologiyaları və Mühəndislik, Biznes və İdarəetmə, İctimai və Beynəlxalq Münasibətlər fakültələri mövcuddur. Tədris tamamilə ingilis dilində aparılır və dünyanın qabaqcıl universitetləri ilə ikili diplom proqramları mövcuddur.',
            'detail_en' => 'ADA University was established in 2006 under the Ministry of Foreign Affairs of the Republic of Azerbaijan and later expanded as a full higher education institution. Built on a smart-campus model, ADA promotes Western academic standards, transparency, and a research-oriented environment. It houses faculties of IT and Engineering, Business, and Public and International Affairs, offering fully English-taught programs and prestigious dual-degree partnerships with top global universities.',
            'detail_ru' => 'Университет ADA был создан в 2006 году при Министерстве иностранных дел Азербайджанской Республики. Кампус университета спроектирован по американским стандартам и предлагает передовые программы в области IT, инженерии, бизнеса и международных отношений на английском языке, а также программы двойных дипломов с ведущими вузами мира.',
            'detail_ar' => 'تأسست جامعة ADA في عام 2006 تحت إشراف وزارة الخارجية في جمهورية أذربيجان. تعتمد على معايير التعليم الغربية والبيئة الموجهة للبحث العلمي. تضم كليات تكنولوجيا المعلومات والهندسة، الأعمال، الشؤون العامة والدولية، مع برامج أكاديمية باللغة الإنجليزية بالكامل.',
        ],
        [
            'name' => 'Xəzər Universiteti (Khazar University)',
            'city' => 'Bakı',
            'images' => ['images/khazar_1.jpg', 'images/khazar_2.jpg', 'images/khazar_3.jpg'],
            'level_az' => 'Bakalavr • Magistr • Doktorantura',
            'level_en' => 'Bachelor • Master • PhD',
            'level_ru' => 'Бакалавриат • Магистратура • Докторантура',
            'level_ar' => 'بكالوريوس • ماجستير • دكتوراه',
            'az' => 'Cənubi Qafqazda ilk müstəqil özəl universitet, tədqiqat yönümlü və ingilisdilli mühit.',
            'en' => 'The first independent private university in the South Caucasus, research-focused with an English-friendly environment.',
            'ru' => 'Первый независимый частный университет на Южном Кавказе, ориентированный на исследования с англоязычной средой.',
            'ar' => 'أول جامعة خاصة مستقلة في جنوب القوقاز، تركز على البحث العلمي في بيئة ناطقة بالإنجليزية.',
            'detail_az' => 'Xəzər Universiteti 1991-ci ildə professor Hamlet İsaxanlı tərəfindən təsis edilmişdir və Cənubi Qafqazda ilk özəl ali təhsil müəssisəsidir. Universitetdə tədris prosesi Qərb modelinə əsaslanır və kredit sistemindən (ECTS) istifadə olunur. Mühəndislik və Tətbiqi Elmlər, İqtisadiyyat və Menecment, Humanitar, Təhsil və Sosial Elmlər fakültələri daxilində çoxsaylı ixtisaslar fəaliyyət göstərir. Xarici tələbələr üçün geniş qrant və təqaüd imkanları təqdim edilir.',
            'detail_en' => 'Khazar University was founded in 1991 by Professor Hamlet Isakhanli and is the first private higher education institution in the South Caucasus. The academic process is based on Western models utilizing the ECTS credit system. It encompasses Engineering and Applied Sciences, Economics and Management, Humanities, Education, and Social Sciences faculties, offering competitive scholarship opportunities for international students.',
            'ru' => 'Университет Хазар был основан в 1991 году профессором Гамлетом Исаханлы и является первым независимым частным вузом на Южном Кавказе. Образовательный процесс строится по западным стандартам с использованием кредитной системы ECTS. Включает факультеты инженерии, экономики, гуманитарных и социальных наук.',
            'ar' => 'تأسست جامعة خزر في عام 1991 على يد البروفيسور هاملت إساخانلي، وهي أول مؤسسة تعليم عالي خاصة مستقلة في جنوب القوقاز. تعتمد العملية الأكاديمية على نظام الساعات الأوروبي (ECTS)، وتضم كليات الهندسة، والاقتصاد، والعلوم الإنسانية.',
        ],
        [
            'name' => 'Azərbaycan Dövlət Neft və Sənaye Universiteti (ASOIU)',
            'city' => 'Bakı',
            'images' => ['images/asoiu_1.jpg', 'images/asoiu_2.jpg', 'images/asoiu_3.jpg'],
            'level_az' => 'Bakalavr • Magistr • Doktorantura',
            'level_en' => 'Bachelor • Master • PhD',
            'level_ru' => 'Бакалавриат • Магистратура • Докторантура',
            'level_ar' => 'بكالوريوس • ماجستير • دكتوراه',
            'az' => 'Neft-qaz mühəndisliyi və texniki sahələr üzrə regionın ən qədim ixtisaslaşmış universitetlərindən biri.',
            'en' => 'One of the oldest specialized technical universities in the region, focused on oil & gas engineering and technical fields.',
            'ru' => 'Один из старейших специализированных технических университетов региона, специализация — нефтегазовая инженерия.',
            'ar' => 'واحدة من أقدم الجامعات التقنية المتخصصة في المنطقة، تركز على هندسة النفط والغاز والمجالات التقنية.',
            'detail_az' => 'Azərbaycan Dövlət Neft və Sənaye Universiteti (ADNSU) 1920-ci ildən fəaliyyət göstərir və regionda mühəndis kadrlarının hazırlanmasında əsas bazadır. Xüsusilə neft-qaz mühəndisliyi, geologiya, energetika və informasiya texnologiyaları üzrə qlobal nüfuza malikdir. ADNSU-nun nəzdində fəaliyyət göstərən Azərbaycan-Fransız Universiteti (UFAZ) isə Fransa hökuməti ilə birgə həyata keçirilən yüksək səviyyəli ikili diplom layihəsidir.',
            'detail_en' => 'Azerbaijan State Oil and Industry University (ASOIU) has been operating since 1920 and is a primary hub for engineering education in the region. It holds global renown specifically in petroleum engineering, geology, power engineering, and IT. Additionally, the French-Azerbaijani University (UFAZ), operating under ASOIU, offers prestigious dual-degree programs in collaboration with top French universities.',
            'ru' => 'Азербайджанский государственный университет нефти и промышленности (АГУНИП / ASOIU) ведет свою историю с 1920 года и является ведущим техническим вузом региона, всемирно известным своими достижениями в нефтегазовой инженерии, энергетике и IT. Под эгидой вуза также успешно действует франко-азербайджанский университет UFAZ.',
            'ar' => 'تاريخ جامعة أذربيجان الحكومية للنفط والصناعة (ASOIU) يعود لعام 1920، وهي مركز رئيسي للهندسة في المنطقة. تتمتع بشهرة عالمية في هندسة النفط والغاز، الجيولوجيا، وتقنية المعلومات. كما تضم جامعة أذربيجان الفرنسية (UFAZ) بالشراكة مع الجامعات الفرنسية.',
        ],
        [
            'name' => 'Azərbaycan Tibb Universiteti (AMU)',
            'city' => 'Bakı',
            'images' => ['images/amu_1.jpg', 'images/amu_2.jpg', 'images/amu_3.jpg'],
            'level_az' => 'Bakalavr • Rezidentura • Magistr',
            'level_en' => 'Bachelor • Residency • Master',
            'level_ru' => 'Бакалавриат • Резидентура • Магистратура',
            'level_ar' => 'بكالوريوس • إقامة طبية • ماجستير',
            'az' => '1930-cu ildən fəaliyyət göstərən, həkim, diş həkimi və əczaçı hazırlayan əsas tibb məktəbi.',
            'en' => 'The main medical school of the country since 1930, training doctors, dentists and pharmacists.',
            'ru' => 'Главная медицинская школа страны с 1930 года, готовит врачей, стоматологов и фармацевтов.',
            'ar' => 'المدرسة الطبية الرئيسية في البلاد منذ عام 1930، تخرّج الأطباء وأطباء الأسنان والصيادلة.',
            'detail_az' => 'Azərbaycan Tibb Universiteti (ATU) 1930-cu ildə yaradılmış və ölkənin səhiyyə sisteminin təməlini təşkil edən aparıcı ali tibb məktəbidir. Universitetdə Müalicə işi, Stomatologiya, Pediatriya, Əczaçılıq və İctimai səhiyyə fakültələri fəaliyyət göstərir. Tədris bazasına müasir kliniklər, tədris-terapevtik və cərrahiyyə klinikaları daxildir. Xarici tələbələr üçün xüsusi ingilis və rusdilli bölmələr mövcuddur.',
            'detail_en' => 'Azerbaijan Medical University (AMU), established in 1930, is the country’s primary medical higher education institution. It features faculties of General Medicine, Dentistry, Pediatrics, Pharmacy, and Public Health. The university is equipped with advanced training-therapeutic and surgical clinics, providing students with extensive hands-on medical experience. Specialized English and Russian tracks are available for international students.',
            'ru' => 'Азербайджанский медицинский университет (АМУ), основанный в 1930 году, является главным центром подготовки медицинских кадров в стране. Включает лечебно-профилактический, стоматологический, педиатрический и фармацевтический факультеты, а также собственные университетские клиники с передовым оборудованием.',
            'ar' => 'تأسست جامعة أذربيجان الطبية (AMU) في عام 1930، وهي المؤسسة الطبية الرئيسية في البلاد. تضم كليات الطب العام، طب الأسنان، الصيدلة، والصحة العامة. تمتلك الجامعات عيادات تعليمية وجراحية متقدمة تمنح الطلاب خبرة عملية واسعة.',
        ],
        [
            'name' => 'UNEC (Azərbaycan Dövlət İqtisad Universiteti)',
            'city' => 'Bakı',
            'images' => ['images/unec_1.jpg', 'images/unec_2.jpg', 'images/unec_3.jpg'],
            'level_az' => 'Bakalavr • Magistr • Doktorantura',
            'level_en' => 'Bachelor • Master • PhD',
            'level_ru' => 'Бакалавриат • Магистратура • Докторантура',
            'level_ar' => 'بكالوريوس • ماجستير • دكتوراه',
            'az' => 'Cənubi Qafqazın aparıcı biznes və iqtisadiyyat universitetlərindən biri, çoxdilli tədris proqramları.',
            'en' => 'One of the leading business and economics universities in the South Caucasus, with multi-language programs.',
            'ru' => 'Один из ведущих университетов бизнеса и экономики на Южном Кавказе с многоязычными программами.',
            'ar' => 'واحدة من الجامعات الرائدة في مجال الأعمال والاقتصاد في جنوب القوقاز، ببرامج متعددة اللغات.',
            'detail_az' => 'Azərbaycan Dövlət İqtisad Universiteti (UNEC) Cənubi Qafqazın iqtisadi yönümlü ən büyük ali təhsil müəssisəsidir. UNEC-də maliyyə, mühasibat uçotu, beynəlxalq ticarət, rəqəmsal iqtisadiyyat və biznesin idarə edilməsi (MBA) proqramları yüksək səviyyədə tədris olunur. Universitet dilli təhsil sistemi (azərbaycan, rus, ingilis, türk dilləri) və London Universiteti / LSE ilə olan akademik əməkdaşlıqları ilə seçilir.',
            'detail_en' => 'Azerbaijan State University of Economics (UNEC) is the largest economics-focused higher education institution in the South Caucasus. UNEC offers world-class programs in Finance, Accounting, International Trade, Digital Economy, and MBA. It is distinguished by its multi-language teaching model (Azerbaijani, English, Russian, Turkish) and international academic partnerships, including programs linked with the University of London / LSE.',
            'ru' => 'Азербайджанский государственный экономический университет (UNEC) — крупнейший экономический вуз Южного Кавказа. Предлагает передовые программы в области финансов, цифровой экономики, международного бизнеса и MBA на четырех языках обучения (азербайджанский, русский, английский, турецкий).',
            'ar' => 'جامعة أذربيجان الحكومية للاقتصاد (UNEC) هي أكبر مؤسسة تعليم عالٍ ذات توجه اقتصادي في جنوب القوقاز. تقدم برامج رائدة في التمويل، المحاسبة، التجارة الدولية، واقتصاد ماجستير إدارة الأعمال (MBA) بعدة لغات.',
        ],
        [
            'name' => 'Azərbaycan Texniki Universiteti (AzTU)',
            'city' => 'Bakı',
            'images' => ['images/aztu_1.jpg', 'images/aztu_2.jpg', 'images/aztu_3.jpg'],
            'level_az' => 'Bakalavr • Magistr • Doktorantura',
            'level_en' => 'Bachelor • Master • PhD',
            'level_ru' => 'Бакалавриат • Магистратура • Докторантура',
            'level_ar' => 'بكالوريوس • ماجستير • دكتوراه',
            'az' => 'Mühəndislik, kompüter elmləri və elektronika üzrə ixtisaslaşmış aparıcı dövlət texniki universiteti.',
            'en' => 'A leading state technical university specializing in engineering, computer science and electronics.',
            'ru' => 'Ведущий государственный технический университет со специализацией в инженерии, информатике и электронике.',
            'ar' => 'جامعة تقنية حكومية رائدة متخصصة في الهندسة وعلوم الحاسوب والإلكترونيات.',
            'detail_az' => 'Azərbaycan Texniki Universiteti (AzTU) 1950-ci ildən fəaliyyət göstərən və ölkənin sənaye, metallurgiya, nəqliyyat, informasiya texnologiyaları və telekommunikasiya sahələri üçün mühəndis kadrları hazırlayan əsas dövlət universitetidir. Son illərdə universitetdə aparılan genişmiqyaslı modernləşdirmə işləri, avtomatlaşdırılmış laboratoriyalar və beynəlxalq layihələr xarici tələbələrin marağını gücləndirmişdir.',
            'detail_en' => 'Azerbaijan Technical University (AzTU), operating since 1950, is a major state university training engineering professionals for industry, metallurgy, transport, IT, and telecommunications sectors. Recent large-scale modernization efforts, advanced automated laboratories, and active international collaborations have made it a preferred choice for engineering aspirants.',
            'ru' => 'Азербайджанский технический университет (AzTU), действующий с 1950 года, готовит высококвалифицированных инженеров для промышленности, транспорта, IT и телекоммуникаций. В последние годы в университете были созданы современные научно-исследовательские лаборатории и внедрены передовые учебные программы.',
            'ar' => 'تأسست جامعة أذربيجان التقنية (AzTU) في عام 1950، وهي جامعة حكومية رئيسية لإعداد المهندسين في قطاعات الصناعة والنقل وتقنية المعلومات والاتصالات. شهدت الجامعة مؤخراً عمليات تحديث واسعة ومختبرات متطورة.',
        ],
        [
            'name' => 'Bakı Mühəndislik Universiteti (BEU)',
            'city' => 'Xırdalan',
            'images' => ['images/beu_1.jpg', 'images/beu_2.jpg', 'images/beu_3.jpg'],
            'level_az' => 'Bakalavr • Magistr',
            'level_en' => 'Bachelor • Master',
            'level_ru' => 'Бакалавриат • Магистратура',
            'level_ar' => 'بكالوريوس • ماجستير',
            'az' => '2016-cı ildə yaradılan müasir universitet, rəqəmsal texnologiyalar və smart mühəndislik üzərində fokuslanıb.',
            'en' => 'A modern university founded in 2016, focused on digital technologies and smart engineering.',
            'ru' => 'Современный университет, основанный в 2016 году, специализируется на цифровых технологиях и умной инженерии.',
            'ar' => 'جامعة حديثة تأسست عام 2016، تركز على التقنيات الرقمية والهندسة الذكية.',
            'detail_az' => 'Bakı Mühəndislik Universiteti (BEU) 2016-cı ildə təsis olunmuş müasir kampus tipli ali məktəbdir. Universitet mühəndislik ixtisasları ilə yanaşı, iqtisadiyyat, idarəetmə və Pedaqoji sahələrdə də ingilisdilli kadrlar yetişdirir. BEU-nun tələbələri üçün Koreya Respublikasının qabaqcıl universitetləri ilə birgə ikili diplom proqramları və müasir texnoloji mərkəzlər mövcuddur.',
            'detail_en' => 'Baku Engineering University (BEU) is a modern campus-style institution established in 2016. In addition to engineering fields, BEU trains specialists in economics, management, and education through English-medium programs. It features prominent dual-degree opportunities in collaboration with leading universities of South Korea and state-of-the-art technological laboratories.',
            'ru' => 'Бакинский инженерный университет (BEU) — современный вуз кампусного типа, созданный в 2016 году. Наряду с инженерными специальностями, предлагает программы по экономике, управлению и педагогике на английском языке. Реализует программы двойных дипломов с ведущими вузами Южной Кореи.',
            'ar' => 'تأسست جامعة باكو للهندسة (BEU) في عام 2016 كجامعة حديثة بنظام الحرم الجامعي المتكامل. تقدم برامج أكاديمية باللغة الإنجليزية في مجالات الهندسة والاقتصاد والإدارة، مع برامج مزدوجة الشهادات بالشراكة مع جامعات كوريا الجنوبية.',
        ],
        [
            'name' => 'Qərbi Xəzər Universiteti (Western Caspian University)',
            'city' => 'Bakı',
            'images' => ['images/wcu_1.jpg', 'images/wcu_2.jpg', 'images/wcu_3.jpg'],
            'level_az' => 'Bakalavr • Magistr • Doktorantura',
            'level_en' => 'Bachelor • Master • PhD',
            'level_ru' => 'Бакалавриат • Магистратура • Докторантура',
            'level_ar' => 'بكالوريوس • ماجستير • دكتوراه',
            'az' => 'Ölkənin ilk özəl ali təhsil müəssisələrindən biri, biznes və hüquq sahələrində geniş proqramlar.',
            'en' => 'One of the country\'s first private higher education institutions, with broad programs in business and law.',
            'ru' => 'Одно из первых частных высших учебных заведений страны с широкими программами в бизнесе и праве.',
            'ar' => 'واحدة من أوائل مؤسسات التعليم العالي الخاصة في البلاد، ببرامج واسعة في الأعمال والقانون.',
            'detail_az' => 'Qərbi Xəzər Universiteti 1991-ci ildən fəaliyyət göstərən ölkənin ilk özəl universitetlərindən biridir. Universitet innovativ tədris üsulları, dizayn, politologiya, beynəlxalq hüquq, turizm menecmenti və biznes ixtisasları ilə seçilir. Qlobal akademik şəbəkələrə inteqrasiya olunan universitet Erasmus+ və digər beynəlxalq mübadilə layihələrində fəal iştirak edir.',
            'detail_en' => 'Western Caspian University, operating since 1991, is one of the country’s pioneer private higher education institutions. It is renowned for innovative teaching methods, specialized programs in design, political science, international law, tourism management, and business administration. The university is deeply integrated into global academic networks and actively participates in Erasmus+ exchange programs.',
            'ru' => 'Западно-Каспийский университет, основанный в 1991 году, является одним из первых частных вузов страны. Известен инновационными методами преподавания, программами в области дизайна, политологии, международного права и туризма. Активно участвует в программе Erasmus+.',
            'ar' => 'تعد جامعة غرب القوقاز، العاملة منذ عام 1991، واحدة من أوائل الجامعات الخاصة في البلاد. تشتهر بأساليب التدريس المبتكرة وبرامج التصميم، العلوم السياسية، القانون الدولي، وإدارة السياحة، وتشارك بفعالية في برامج التبادل مثل Erasmus+.',
        ],
        [
            'name' => 'Sumqayıt Dövlət Universiteti',
            'city' => 'Sumqayıt',
            'images' => ['images/sdu_1.jpg', 'images/sdu_2.jpg', 'images/sdu_3.jpg'],
            'level_az' => 'Bakalavr • Magistr',
            'level_en' => 'Bachelor • Master',
            'level_ru' => 'Бакалавриат • Магистратура',
            'level_ar' => 'بكالوريوس • ماجستير',
            'az' => 'Bakı yaxınlığındakı Sumqayıt şəhərində yerləşən, sənaye və təbiət elmlərinə fokuslanan dövlət universiteti.',
            'en' => 'A public university located in Sumgayit near Baku, with a focus on industrial and natural sciences.',
            'ru' => 'Государственный университет в городе Сумгайыт рядом с Баку, специализация — промышленные и естественные науки.',
            'ar' => 'جامعة حكومية تقع في مدينة سومقايت بالقرب من باكو، تركز على العلوم الصناعية والطبيعية.',
            'detail_az' => 'Sumqayıt Dövlət Universiteti (SDU) ölkənin iri sənaye mərkəzi olan Sumqayıt şəhərində yerləşən aparıcı dövlət universitetidir. Universitet kimya mühəndisliyi, texnologiya, energetika, fizika, riyaziyyat və filologiya istiqamətlərində mütəxəssislər hazırlayır. SDU sənaye müəssisələri ilə sıx əməkdaşlıq edərək tələbələrə real istehsalat mühitində təcrübə qazanmaq imkanı yaradır.',
            'detail_en' => 'Sumgayit State University (SDU) is a prominent public university located in the major industrial hub of Sumgayit, near Baku. It trains specialists in chemical engineering, technology, power engineering, physics, mathematics, and philology. SDU maintains close partnerships with industrial enterprises, offering students practical training opportunities in real industrial environments.',
            'ru' => 'Сумгайытский государственный университет (СГУ) расположен во втором по величине промышленном центре страны. Вузы готовят квалифицированные кадры в области химической инженерии, энергетики, физики и естественных наук, тесно сотрудничая с ведущими предприятиями химической и промышленной сферы.',
            'ar' => 'تعد جامعة سومقايت الحكومية (SDU) جامعة حكومية بارزة تقع في المركز الصناعي الرئيسي بالقرب من باكو. تقوم بإعداد متخصصين في الهندسة الكيميائية، وتقنية الطاقة، والعلوم الطبيعية بالشراكة مع المؤسسات الصناعية الكبرى.',
        ],
    ];
    ?>

    <!-- ================= AZERBAIJANI (AZ) ================= -->
    <div data-lang="az">
        <section class="hero-glow pt-36 pb-16 px-6 text-left">
            <div class="max-w-7xl mx-auto">
                <span class="text-amber-400 font-bold text-xs uppercase tracking-widest">Təhsil Bələdçisi</span>
                <h1 class="text-3xl sm:text-5xl font-black text-white mt-2 mb-4">Azərbaycanda Universitetlər</h1>
                <p class="text-slate-400 text-sm sm:text-base max-w-3xl">Xarici tələbələr üçün Azərbaycanın aparıcı dövlət və özəl universitetlərinin siyahısı. Ətraflı məlumat və şəkillər üçün istənilən universitet kartına klikləyin.</p>
            </div>
        </section>
        <section class="px-6 pb-20 max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($universities as $index => $u): ?>
                <div onclick="openUniversityModal(<?php echo $index; ?>, 'az')" class="glass-card rounded-3xl overflow-hidden hover:border-amber-500/40 transition flex flex-col justify-between cursor-pointer group">
                    <div>
                        <div class="h-48 w-full overflow-hidden bg-slate-900/50">
                            <img src="<?php echo htmlspecialchars($u['images'][0]); ?>" alt="<?php echo htmlspecialchars($u['name']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-white mb-2 group-hover:text-amber-400 transition"><?php echo htmlspecialchars($u['name']); ?></h3>
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-[11px] font-bold text-emerald-400 uppercase tracking-wide">📍 <?php echo htmlspecialchars($u['city']); ?></span>
                                <span class="text-slate-600">•</span>
                                <span class="text-[11px] font-medium text-amber-300/90"><?php echo htmlspecialchars($u['level_az']); ?></span>
                            </div>
                            <p class="text-slate-400 text-xs leading-relaxed mb-4"><?php echo htmlspecialchars($u['az']); ?></p>
                            <span class="text-xs font-bold text-amber-400 inline-flex items-center gap-1">Ətraflı bax →</span>
                        </div>
                    </div>
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
                <p class="text-slate-400 text-sm sm:text-base max-w-3xl">A list of Azerbaijan's leading public and private universities for international students. Click any university card for detailed insights and galleries.</p>
            </div>
        </section>
        <section class="px-6 pb-20 max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($universities as $index => $u): ?>
                <div onclick="openUniversityModal(<?php echo $index; ?>, 'en')" class="glass-card rounded-3xl overflow-hidden hover:border-amber-500/40 transition flex flex-col justify-between cursor-pointer group">
                    <div>
                        <div class="h-48 w-full overflow-hidden bg-slate-900/50">
                            <img src="<?php echo htmlspecialchars($u['images'][0]); ?>" alt="<?php echo htmlspecialchars($u['name']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-white mb-2 group-hover:text-amber-400 transition"><?php echo htmlspecialchars($u['name']); ?></h3>
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-[11px] font-bold text-emerald-400 uppercase tracking-wide">📍 <?php echo htmlspecialchars($u['city']); ?></span>
                                <span class="text-slate-600">•</span>
                                <span class="text-[11px] font-medium text-amber-300/90"><?php echo htmlspecialchars($u['level_en']); ?></span>
                            </div>
                            <p class="text-slate-400 text-xs leading-relaxed mb-4"><?php echo htmlspecialchars($u['en']); ?></p>
                            <span class="text-xs font-bold text-amber-400 inline-flex items-center gap-1">Read more →</span>
                        </div>
                    </div>
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
                <p class="text-slate-400 text-sm sm:text-base max-w-3xl">Список ведущих университетов Азербайджана для иностранных студентов. Нажмите на карточку для подробной информации и галереи.</p>
            </div>
        </section>
        <section class="px-6 pb-20 max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($universities as $index => $u): ?>
                <div onclick="openUniversityModal(<?php echo $index; ?>, 'ru')" class="glass-card rounded-3xl overflow-hidden hover:border-amber-500/40 transition flex flex-col justify-between cursor-pointer group">
                    <div>
                        <div class="h-48 w-full overflow-hidden bg-slate-900/50">
                            <img src="<?php echo htmlspecialchars($u['images'][0]); ?>" alt="<?php echo htmlspecialchars($u['name']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-white mb-2 group-hover:text-amber-400 transition"><?php echo htmlspecialchars($u['name']); ?></h3>
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-[11px] font-bold text-emerald-400 uppercase tracking-wide">📍 <?php echo htmlspecialchars($u['city']); ?></span>
                                <span class="text-slate-600">•</span>
                                <span class="text-[11px] font-medium text-amber-300/90"><?php echo htmlspecialchars($u['level_ru']); ?></span>
                            </div>
                            <p class="text-slate-400 text-xs leading-relaxed mb-4"><?php echo htmlspecialchars($u['ru']); ?></p>
                            <span class="text-xs font-bold text-amber-400 inline-flex items-center gap-1">Подробнее →</span>
                        </div>
                    </div>
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
                <p class="text-slate-400 text-sm sm:text-base max-w-3xl">قائمة بأفضل الجامعات الحكومية والخاصة في أذربيجان للطلاب الأجانب. انقر على أي بطاقة لعرض المعلومات التفصيلية والمعرض.</p>
            </div>
        </section>
        <section class="px-6 pb-20 max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($universities as $index => $u): ?>
                <div onclick="openUniversityModal(<?php echo $index; ?>, 'ar')" class="glass-card rounded-3xl overflow-hidden hover:border-amber-500/40 transition flex flex-col justify-between text-right cursor-pointer group">
                    <div>
                        <div class="h-48 w-full overflow-hidden bg-slate-900/50">
                            <img src="<?php echo htmlspecialchars($u['images'][0]); ?>" alt="<?php echo htmlspecialchars($u['name']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-white mb-2 group-hover:text-amber-400 transition"><?php echo htmlspecialchars($u['name']); ?></h3>
                            <div class="flex items-center justify-end gap-2 mb-3">
                                <span class="text-[11px] font-medium text-amber-300/90"><?php echo htmlspecialchars($u['level_ar']); ?></span>
                                <span class="text-slate-600">•</span>
                                <span class="text-[11px] font-bold text-emerald-400 uppercase tracking-wide"><?php echo htmlspecialchars($u['city']); ?> 📍</span>
                            </div>
                            <p class="text-slate-400 text-xs leading-relaxed mb-4"><?php echo htmlspecialchars($u['ar']); ?></p>
                            <span class="text-xs font-bold text-amber-400 inline-flex items-center gap-1">← اقرأ المزيد</span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-12 text-center">
                <a href="apply" class="inline-block bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 text-slate-950 font-black px-8 py-3.5 rounded-xl text-sm shadow-lg transition hover:scale-105">قدم طلبك الآن ←</a>
            </div>
        </section>
    </div>

    <!-- ================= UNIVERSAL SLIDER MODAL ================= -->
    <div id="uniModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-md hidden opacity-0 transition-opacity duration-300">
        <div id="modalContentBox" class="glass-card bg-[#091f1b] border border-emerald-500/30 w-full max-w-3xl rounded-3xl overflow-hidden shadow-2xl transform scale-95 transition-transform duration-300 max-h-[92vh] flex flex-col">
            
            <!-- Slideshow / Gallery Container -->
            <div class="relative h-64 sm:h-80 w-full bg-slate-950 flex items-center justify-center overflow-hidden">
                <img id="sliderImage" src="" alt="" class="w-full h-full object-cover transition-all duration-500">
                
                <!-- Slayd düymələri (Left / Right) -->
                <button onclick="prevSlide()" class="absolute left-4 bg-black/50 hover:bg-black text-white w-10 h-10 rounded-full flex items-center justify-center text-lg font-bold transition backdrop-blur-sm">❮</button>
                <button onclick="nextSlide()" class="absolute right-4 bg-black/50 hover:bg-black text-white w-10 h-10 rounded-full flex items-center justify-center text-lg font-bold transition backdrop-blur-sm">❯</button>
                
                <!-- Bağlamaq düyməsi -->
                <button onclick="closeUniversityModal()" class="absolute top-4 right-4 bg-black/60 hover:bg-black text-white w-9 h-9 rounded-full flex items-center justify-center text-lg font-bold transition">✕</button>
                
                <!-- Slayd İndikator nöqtələri -->
                <div id="sliderDots" class="absolute bottom-4 left-0 right-0 flex justify-center gap-2"></div>
            </div>

            <!-- Modal Body Content -->
            <div class="p-6 sm:p-8 overflow-y-auto space-y-4">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <span id="modalCity" class="text-xs font-bold text-emerald-400 uppercase tracking-wider"></span>
                    <span id="modalLevel" class="text-xs font-medium text-amber-300 bg-amber-500/10 px-3 py-1 rounded-full border border-amber-500/20"></span>
                </div>
                <h2 id="modalTitle" class="text-xl sm:text-2xl font-black text-white"></h2>
                
                <!-- Uzun real məlumat hissəsi -->
                <p id="modalDescription" class="text-slate-300 text-sm sm:text-base leading-relaxed whitespace-pre-line text-justify"></p>
                
                <div class="pt-4 border-t border-white/10 flex flex-wrap items-center justify-between gap-4">
                    <span class="text-xs text-slate-400" id="modalSupportText">Caspian Bridges dəstəyi ilə qəbul olun.</span>
                    <a href="apply" class="bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 text-slate-950 font-bold px-6 py-2.5 rounded-xl text-xs shadow transition">Müraciət Et</a>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Slider və Modal İdarəetməsi -->
    <script>
        const universitiesData = <?php echo json_encode($universities, JSON_UNESCAPED_UNICODE); ?>;

        const translations = {
            az: { support: "Caspian Bridges dəstəyi ilə qəbul olun." },
            en: { support: "Get admitted with Caspian Bridges support." },
            ru: { support: "Поступите при поддержке Caspian Bridges." },
            ar: { support: "احصل على القبول بدعم من Caspian Bridges." }
        };

        let currentImages = [];
        let currentSlideIndex = 0;

        function openUniversityModal(index, lang) {
            const uni = universitiesData[index];
            if (!uni) return;

            currentImages = uni.images;
            currentSlideIndex = 0;
            updateSliderImage();

            document.getElementById('modalTitle').innerText = uni.name;
            document.getElementById('modalCity').innerText = '📍 ' + uni.city;
            
            // Dilə uyğun səviyyə və uzun tarixi/real məlumatı təyin edirik
            if (lang === 'en') {
                document.getElementById('modalLevel').innerText = uni.level_en;
                document.getElementById('modalDescription').innerText = uni.detail_en;
            } else if (lang === 'ru') {
                document.getElementById('modalLevel').innerText = uni.level_ru;
                document.getElementById('modalDescription').innerText = uni.detail_ru;
            } else if (lang === 'ar') {
                document.getElementById('modalLevel').innerText = uni.level_ar;
                document.getElementById('modalDescription').innerText = uni.detail_ar;
                document.getElementById('modalContentBox').setAttribute('dir', 'rtl');
            } else {
                document.getElementById('modalLevel').innerText = uni.level_az;
                document.getElementById('modalDescription').innerText = uni.detail_az;
                document.getElementById('modalContentBox').setAttribute('dir', 'ltr');
            }

            document.getElementById('modalSupportText').innerText = translations[lang].support;

            const modal = document.getElementById('uniModal');
            const box = document.getElementById('modalContentBox');
            
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                box.classList.remove('scale-95');
                box.classList.add('scale-100');
            }, 10);
        }

        function updateSliderImage() {
            const imgElement = document.getElementById('sliderImage');
            imgElement.src = currentImages[currentSlideIndex];

            // Nöqtələri (dots) yeniləyirik
            const dotsContainer = document.getElementById('sliderDots');
            dotsContainer.innerHTML = '';
            currentImages.forEach((_, i) => {
                const dot = document.createElement('button');
                dot.className = `w-2.5 h-2.5 rounded-full transition-all ${i === currentSlideIndex ? 'bg-amber-400 w-6' : 'bg-white/50'}`;
                dot.onclick = () => {
                    currentSlideIndex = i;
                    updateSliderImage();
                };
                dotsContainer.appendChild(dot);
            });
        }

        function nextSlide() {
            currentSlideIndex = (currentSlideIndex + 1) % currentImages.length;
            updateSliderImage();
        }

        function prevSlide() {
            currentSlideIndex = (currentSlideIndex - 1 + currentImages.length) % currentImages.length;
            updateSliderImage();
        }

        function closeUniversityModal() {
            const modal = document.getElementById('uniModal');
            const box = document.getElementById('modalContentBox');
            
            modal.classList.add('opacity-0');
            box.classList.remove('scale-100');
            box.classList.add('scale-95');
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Kənara kliklədikdə bağlamaq
        document.getElementById('uniModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeUniversityModal();
            }
        });

        // URL-dəki 'lang' parametrini oxuyaraq səhifə açılan kimi uyğun dil blokunu göstərən funksionallıq
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            const currentLang = urlParams.get('lang') || 'az';
            
            document.querySelectorAll("[data-lang]").forEach(el => {
                if (el.getAttribute("data-lang") === currentLang) {
                    el.classList.remove("hidden");
                } else {
                    el.classList.add("hidden");
                }
            });
        });
    </script>

    <div id="footer-container"></div>
</body>
</html>