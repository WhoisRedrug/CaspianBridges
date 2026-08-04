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
    // Universitet məlumatları, geniş təsvirlər və digər detallar
    $universities = [
        [
            'name' => 'Bakı Dövlət Universiteti (BSU)',
            'city' => 'Bakı',
            'image' => 'images/bsu.jpg',
            'level_az' => 'Bakalavr • Magistr • Doktorantura',
            'level_en' => 'Bachelor • Master • PhD',
            'level_ru' => 'Бакалавриат • Магистратура • Докторантура',
            'level_ar' => 'بكالوريوس • ماجستير • دكتوراه',
            'az' => '1919-cu ildə yaradılıb, ölkənin ən qədim və nüfuzlu dövlət universitetidir. Geniş fakültə spektri.',
            'en' => 'Founded in 1919, the oldest and most prestigious public university in the country, offering a wide range of faculties.',
            'ru' => 'Основан в 1919 году, старейший и самый престижный государственный университет страны с широким выбором факультетов.',
            'ar' => 'تأسست عام 1919، وهي أقدم وأعرق جامعة حكومية في البلاد، وتقدم مجموعة واسعة من التخصصات.',
            'detail_az' => 'Bakı Dövlət Universiteti Azərbaycanda ali təhsilin qurulmasında müstəsna rol oynamışdır. Burada hüquq, mexanika-riyaziyyat, tətbiqi riyaziyyat və kibernetika, fizika, kimya, biologiya, tarix, filologiya və s. kimi aparıcı fakültələr fəaliyyət göstərir. Xarici tələbələr üçün həm azərbaycan, həm də rus və ingilis dillərində ixtisaslar mövcuddur.',
            'detail_en' => 'Baku State University has played an exceptional role in establishing higher education in Azerbaijan. It features leading faculties such as Law, Mechanics and Mathematics, Physics, Chemistry, Biology, History, Philology, and more. Programs are available in Azerbaijani, Russian, and English for international students.',
            'detail_ru' => 'Бакинский государственный университет сыграл исключительную роль в становлении высшего образования в Азербайджане. Здесь функционируют ведущие факультеты: юридический, механико-математический, физический, химический, биологический, исторический, филологический и др. Доступны программы на азербайджанском, русском и английском языках.',
            'detail_ar' => 'لعبت جامعة باكو الحكومية دوراً استثنائياً في تأسيس التعليم العالي في أذربيجان. تضم كليات رائدة مثل الحقوق، الميكانيكا والرياضيات، الفيزياء، الكيمياء، التاريخ، وعلوم أخرى. تتوفر البرامج باللغات الأذربيجانية والروسية والإنجليزية.',
        ],
        [
            'name' => 'ADA University',
            'city' => 'Bakı',
            'image' => 'images/ada.jpg',
            'level_az' => 'Bakalavr • Magistr',
            'level_en' => 'Bachelor • Master',
            'level_ru' => 'Бакалавриат • Магистратура',
            'level_ar' => 'بكالوريوس • ماجستير',
            'az' => 'Xarici İşlər Nazirliyi tərəfindən yaradılmış, tam ingilisdilli tədris proqramları olan aparıcı universitet.',
            'en' => 'Established by the Ministry of Foreign Affairs, a leading university with fully English-medium academic programs.',
            'ru' => 'Основан Министерством иностранных дел, ведущий университет с полностью англоязычными программами обучения.',
            'ar' => 'أسستها وزارة الخارجية، وهي جامعة رائدة تقدم برامج أكاديمية باللغة الإنجليزية بالكامل.',
            'detail_az' => 'ADA Universiteti müasir kampusu, Qərb standartlarına uyğun təhsil sistemi və güclü beynəlxalq əlaqələri ilə seçilir. Biznes idarəçiliyi, İstinadlar və Beynəlxalq Münasibətlər, İnformasiya Texnologiyaları və Mühəndislik fakültələri üzrə xarici tələbələrin ən çox seçdiyi ali məktəblərdəndir.',
            'detail_en' => 'ADA University stands out with its modern campus, Western-standard education system, and strong international relations. It is one of the top choices for international students in Business Administration, International Relations, IT, and Engineering.',
            'detail_ru' => 'Университет ADA выделяется современным кампусом, системой образования по западным стандартам и прочными международными связями. Это один из лучших выборов для иностранных студентов в области бизнес-администрирования, международных отношений и IT.',
            'detail_ar' => 'تتميز جامعة ADA بحرمها الجامعي الحديث، ونظامها التعليمي المتوافق مع المعايير الغربية، وعلاقاتها الدولية القوية. وهي واحدة من أفضل الخيارات للطلاب الأجانب في تخصصات إدارة الأعمال والعلاقات الدولية وتكنولوجيا المعلومات.',
        ],
        [
            'name' => 'Xəzər Universiteti (Khazar University)',
            'city' => 'Bakı',
            'image' => 'images/khazar.jpg',
            'level_az' => 'Bakalavr • Magistr • Doktorantura',
            'level_en' => 'Bachelor • Master • PhD',
            'level_ru' => 'Бакалавриат • Магистратура • Докторантура',
            'level_ar' => 'بكالوريوس • ماجستير • دكتوراه',
            'az' => 'Cənubi Qafqazda ilk müstəqil özəl universitet, tədqiqat yönümlü və ingilisdilli mühit.',
            'en' => 'The first independent private university in the South Caucasus, research-focused with an English-friendly environment.',
            'ru' => 'Первый независимый частный университет на Южном Кавказе, ориентированный на исследования с англоязычной средой.',
            'ar' => 'أول جامعة خاصة مستقلة في جنوب القوقاز، تركز على البحث العلمي في بيئة ناطقة بالإنجليزية.',
            'detail_az' => 'Xəzər Universiteti yüksək akademik standartları və tədqiqat mərkəzləri ilə tanınır. Universitetdə mühəndislik, tətbiqi elmlər, humanitar, sosial elmlər və təhsil fakültələri mövcuddur. Tamamilə ingilis dilində təhsil almaq istəyən əcnəbi tələbələr üçün ideal mühit yaradılıb.',
            'detail_en' => 'Khazar University is known for high academic standards and research centers. The university offers engineering, applied sciences, humanities, social sciences, and education faculties, providing an ideal environment for international students studying entirely in English.',
            'detail_ru' => 'Университет Хазар известен своими высокими академическими стандартами и научно-исследовательскими центрами. Предлагает факультеты инженерии, гуманитарных и социальных наук, создавая идеальную среду для обучения на английском языках.',
            'detail_ar' => 'تشتهر جامعة خزر بمعاييرها الأكاديمية العالية ومراكزها البحثية. تقدم كليات الهندسة، والعلوم التطبيقية، والعلوم الإنسانية، وتوفر بيئة مثالية للطلاب الأجانب الذين يدرسون باللغة الإنجليزية.',
        ],
        [
            'name' => 'Azərbaycan Dövlət Neft və Sənaye Universiteti (ASOIU)',
            'city' => 'Bakı',
            'image' => 'images/asoiu.jpg',
            'level_az' => 'Bakalavr • Magistr • Doktorantura',
            'level_en' => 'Bachelor • Master • PhD',
            'level_ru' => 'Бакалавриат • Магистратура • Докторантура',
            'level_ar' => 'بكالوريوس • ماجستير • دكتوراه',
            'az' => 'Neft-qaz mühəndisliyi və texniki sahələr üzrə regionın ən qədim ixtisaslaşmış universitetlərindən biri.',
            'en' => 'One of the oldest specialized technical universities in the region, focused on oil & gas engineering and technical fields.',
            'ru' => 'Один из старейших специализированных технических университетов региона, специализация — нефтегазовая инженерия.',
            'ar' => 'واحدة من أقدم الجامعات التقنية المتخصصة في المنطقة، تركز على هندسة النفط والغاز والمجالات التقنية.',
            'detail_az' => 'ADNSU (ASOIU) xüsusilə mühəndislik, neft-qaz sənayesi, avtomatlaşdırma və kompüter elmləri sahələrində dünya miqyasında tanınır. Universitetin nəzdində "Fransız-Azərbaycan Universiteti" (UFAK) də fəaliyyət göstərir ki, bu da tələbələrə ikili diplom imkanı qazandırır.',
            'detail_en' => 'ASOIU is globally recognized especially in engineering, oil and gas industry, automation, and computer science. The French-Azerbaijani University (UFAZ) also operates under its umbrella, offering double-degree opportunities to students.',
            'ru' => 'АЗИ (ASOIU) всемирно признан в области инженерии, нефтегазовой промышленности, автоматизации и компьютерных наук. Под его эгидой также действует Французско-азербайджанский университет (UFAZ).',
            'ar' => 'تحظى جامعة أذربيجان الحكومية للنفط والصناعة بشهرة عالمية خاصة في هندسة النفط والغاز، والاتتمتة، وعلوم الحاسوب. تعمل تحت مظلتها أيضاً جامعة أذربيجان الفرنسية (UFAZ).',
        ],
        [
            'name' => 'Azərbaycan Tibb Universiteti (AMU)',
            'city' => 'Bakı',
            'image' => 'images/amu.jpg',
            'level_az' => 'Bakalavr • Rezidentura • Magistr',
            'level_en' => 'Bachelor • Residency • Master',
            'level_ru' => 'Бакалавриат • Резидентура • Магистратура',
            'level_ar' => 'بكالوريوس • إقامة طبية • ماجستير',
            'az' => '1930-cu ildən fəaliyyət göstərən, həkim, diş həkimi və əczaçı hazırlayan əsas tibb məktəbi.',
            'en' => 'The main medical school of the country since 1930, training doctors, dentists and pharmacists.',
            'ru' => 'Главная медицинская школа страны с 1930 года, готовит врачей, стоматологов и фармацевтов.',
            'ar' => 'المدرسة الطبية الرئيسية في البلاد منذ عام 1930، تخرّج الأطباء وأطباء الأسنان والصيادلة.',
            'detail_az' => 'Azərbaycan Tibb Universiteti ölkənin səhiyyə sistemi üçün yüksək ixtisaslı kadrlar yetişdirən aparıcı mərkəzdir. Müalicə işi, stomatologiya, əczaçılıq və tibbi profilaktika fakültələri mövcuddur. Xarici tələbələr üçün xüsusi ingilisdilli qruplar fəaliyyət göstərir.',
            'detail_en' => 'Azerbaijan Medical University is the leading center training highly qualified personnel for the healthcare system. It includes General Medicine, Dentistry, Pharmacy, and Public Health faculties, with specialized English-medium groups for international students.',
            'ru' => 'Азербайджанский медицинский университет — ведущий центр подготовки кадров для системы здравоохранения. Включает факультеты лечебного дела, стоматологии, фармации и общественного здравоохранения.',
            'ar' => 'جامعة أذربيجان الطبية هي المركز الرائد لإعداد الكوادر المؤهلة لنظام الرعاية الصحية. تضم كليات الطب العام، طب الأسنان، الصيدلة، مع مجموعات خاصة باللغة الإنجليزية للطلاب الأجانب.',
        ],
        [
            'name' => 'UNEC (Azərbaycan Dövlət İqtisad Universiteti)',
            'city' => 'Bakı',
            'image' => 'images/unec.jpg',
            'level_az' => 'Bakalavr • Magistr • Doktorantura',
            'level_en' => 'Bachelor • Master • PhD',
            'level_ru' => 'Бакалавриат • Магистратура • Докторантура',
            'level_ar' => 'بكالوريوس • ماجستير • دكتوراه',
            'az' => 'Cənubi Qafqazın aparıcı biznes və iqtisadiyyat universitetlərindən biri, çoxdilli tədris proqramları.',
            'en' => 'One of the leading business and economics universities in the South Caucasus, with multi-language programs.',
            'ru' => 'Один из ведущих университетов бизнеса и экономики на Южном Кавказе с многоязычными программами.',
            'ar' => 'واحدة من الجامعات الرائدة في مجال الأعمال والاقتصاد في جنوب القوقاز، ببرامج متعددة اللغات.',
            'detail_az' => 'UNEC regionun ən böyük iqtisadi yönümlü ali məktəbidir. Maliyyə, mühasibat uçotu, beynəlxalq ticarət, biznesin idarə edilməsi (MBA) proqramları ilə məşhurdur. Tədris dörd dildə (azərbaycan, rus, ingilis, türk) həyata keçirilir.',
            'detail_en' => 'UNEC is the largest economics-oriented higher education institution in the region. It is famous for Finance, Accounting, International Trade, and MBA programs. Teaching is conducted in four languages (Azerbaijani, Russian, English, Turkish).',
            'ru' => 'UNEC — крупнейший экономический вуз в регионе. Известен программами по финансам, бухучету, международной торговле и MBA. Обучение ведется на четырех языках.',
            'ar' => 'UNEC هي أكبر مؤسسة تعليم عالي ذات توجه اقتصادي في المنطقة. تشتهر ببرامج التمويل والمحاسبة والتجارة الدولية وماجستير إدارة الأعمال (MBA).',
        ],
        [
            'name' => 'Azərbaycan Texniki Universiteti (AzTU)',
            'city' => 'Bakı',
            'image' => 'images/aztu.jpg',
            'level_az' => 'Bakalavr • Magistr • Doktorantura',
            'level_en' => 'Bachelor • Master • PhD',
            'level_ru' => 'Бакалавриат • Магистратура • Докторантура',
            'level_ar' => 'بكالوريوس • ماجستير • دكتوراه',
            'az' => 'Mühəndislik, kompüter elmləri və elektronika üzrə ixtisaslaşmış aparıcı dövlət texniki universiteti.',
            'en' => 'A leading state technical university specializing in engineering, computer science and electronics.',
            'ru' => 'Ведущий государственный технический университет со специализацией в инженерии, информатике и электронике.',
            'ar' => 'جامعة تقنية حكومية رائدة متخصصة في الهندسة وعلوم الحاسوب والإلكترونيات.',
            'detail_az' => 'AzTU informasiya texnologiyaları, telekommunikasiya, nəqliyyat, maşınqayırma və metallurgiya sahələrində mütəxəssislər hazırlayır. Müasir laboratoriyaları və sənaye müəssisələri ilə sıx əməkdaşlığı tələbələrə praktiki biliklər qazandırır.',
            'detail_en' => 'AzTU trains specialists in information technology, telecommunications, transport, mechanical engineering, and metallurgy. Its modern laboratories and close cooperation with industrial enterprises provide students with practical skills.',
            'ru' => 'AzTU готовит специалистов в области информационных технологий, телекоммуникаций, транспорта, машиностроения и металлургии. Современные лаборатории обеспечивают практические навыки.',
            'ar' => 'تقوم جامعة أذربيجان التقنية بإعداد متخصصين في تكنولوجيا المعلومات، والاتصالات، والنقل، والهندسة الميكانيكية. توفر مختبراتها الحديثة للمطلاب مهارات عملية واسعة.',
        ],
        [
            'name' => 'Bakı Mühəndislik Universiteti (BEU)',
            'city' => 'Xırdalan',
            'image' => 'images/beu.jpg',
            'level_az' => 'Bakalavr • Magistr',
            'level_en' => 'Bachelor • Master',
            'level_ru' => 'Бакалавриат • Магистратура',
            'level_ar' => 'بكالوريوس • ماجستير',
            'az' => '2016-cı ildə yaradılan müasir universitet, rəqəmsal texnologiyalar və smart mühəndislik üzərində fokuslanıb.',
            'en' => 'A modern university founded in 2016, focused on digital technologies and smart engineering.',
            'ru' => 'Современный университет, основанный в 2016 году, специализируется на цифровых технологиях и умной инженерии.',
            'ar' => 'جامعة حديثة تأسست عام 2016، تركز على التقنيات الرقمية والهندسة الذكية.',
            'detail_az' => 'BEU geniş kampus infrastrukturu, ingilisdilli mühəndislik fakültələri və İqtisadiyyat-idarəetmə ixtisasları ilə seçilir. Tələbələrə beynəlxalq standartlara cavab verən təhsil və ikili diplom proqramları təklif olunur.',
            'detail_en' => 'BEU stands out with its broad campus infrastructure, English-medium engineering faculties, and Economics-Management specialties. It offers students education meeting international standards and double-degree programs.',
            'ru' => 'BEU выделяется развитой инфраструктурой кампуса, англоязычными инженерными факультетами и специальностями экономики и управления.',
            'ar' => 'تتميز جامعة باكو للهندسة ببنية تحتية واسعة للحرم الجامعي، وكليات هندسة باللغة الإنجليزية، وتخصصات الاقتصاد والإدارة.',
        ],
        [
            'name' => 'Qərbi Xəzər Universiteti (Western Caspian University)',
            'city' => 'Bakı',
            'image' => 'images/wcu.jpg',
            'level_az' => 'Bakalavr • Magistr • Doktorantura',
            'level_en' => 'Bachelor • Master • PhD',
            'level_ru' => 'Бакалавриат • Магистратура • Докторантура',
            'level_ar' => 'بكالوريوس • ماجستير • دكتوراه',
            'az' => 'Ölkənin ilk özəl ali təhsil müəssisələrindən biri, biznes və hüquq sahələrində geniş proqramlar.',
            'en' => 'One of the country\'s first private higher education institutions, with broad programs in business and law.',
            'ru' => 'Одно из первых частных высших учебных заведений страны с широкими программами в бизнесе и праве.',
            'ar' => 'واحدة من أوائل مؤسسات التعليم العالي الخاصة في البلاد، ببرامج واسعة في الأعمال والقانون.',
            'detail_az' => 'Qərbi Xəzər Universiteti innovativ tədris metodları, dizayn, politologiya, turizm menecmenti və biznes idarəçiliyi sahələrindəki xüsusi proqramları ilə tanınır. Universitet qlobal akademik şəbəkələrə və tələbə mübadilə proqramlarına (Erasmus və s.) qoşulub.',
            'detail_en' => 'Western Caspian University is known for innovative teaching methods, special programs in design, political science, tourism management, and business administration. It is integrated into global academic networks and exchange programs like Erasmus.',
            'ru' => 'Западно-Каспийский университет известен инновационными методами обучения, специальными программами в области дизайна, политологии, менеджмента туризма.',
            'ar' => 'تشتهر جامعة غرب القوقاز بأساليب التدريس المبتكرة وبرامجها الخاصة في التصميم والعلوم السياسية وإدارة السياحة.',
        ],
        [
            'name' => 'Sumqayıt Dövlət Universiteti',
            'city' => 'Sumqayıt',
            'image' => 'images/sdu.jpg',
            'level_az' => 'Bakalavr • Magistr',
            'level_en' => 'Bachelor • Master',
            'level_ru' => 'Бакалавриат • Магистратура',
            'level_ar' => 'بكالوريوس • ماجستير',
            'az' => 'Bakı yaxınlığındakı Sumqayıt şəhərində yerləşən, sənaye və təbiət elmlərinə fokuslanan dövlət universiteti.',
            'en' => 'A public university located in Sumgayit near Baku, with a focus on industrial and natural sciences.',
            'ru' => 'Государственный университет в городе Сумгайыт рядом с Баку, специализация — промышленные и естественные науки.',
            'ar' => 'جامعة حكومية تقع في مدينة سومقايت بالقرب من باكو، تركز على العلوم الصناعية والطبيعية.',
            'detail_az' => 'Sumqayıt Dövlət Universiteti regionun sənaye potensialına uyğun olaraq kimya mühəndisliyi, fizika, riyaziyyat, tarix və filologiya istiqamətlərində mütəxəssislər hazırlayır. Tələbələr üçün əlverişli təhsil və yaşayış şəraiti mövcuddur.',
            'detail_en' => 'Sumgayit State University trains specialists in chemical engineering, physics, mathematics, history, and philology, aligning with the region\'s industrial potential. Favorable education and living conditions are available.',
            'ru' => 'Сумгайытский государственный университет готовит специалистов в области химической инженерии, физики, математики, истории и филологии в соответствии с промышленным потенциалом региона.',
            'ar' => 'تقوم جامعة سومقايت الحكومية بإعداد متخصصين في الهندسة الكيميائية، والفيزياء، والرياضيات، والتاريخ، بما يتناسب مع الإمكانات الصناعية للمنطقة.',
        ],
    ];
    ?>

    <!-- ================= AZERBAIJANI (AZ) ================= -->
    <div data-lang="az">
        <section class="hero-glow pt-36 pb-16 px-6 text-left">
            <div class="max-w-7xl mx-auto">
                <span class="text-amber-400 font-bold text-xs uppercase tracking-widest">Təhsil Bələdçisi</span>
                <h1 class="text-3xl sm:text-5xl font-black text-white mt-2 mb-4">Azərbaycanda Universitetlər</h1>
                <p class="text-slate-400 text-sm sm:text-base max-w-3xl">Xarici tələbələr üçün Azərbaycanın aparıcı dövlət və özəl universitetlərinin siyahısı. Ətraflı məlumat üçün istənilən universitet kartının üzərinə klikləyin.</p>
            </div>
        </section>
        <section class="px-6 pb-20 max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($universities as $index => $u): ?>
                <div onclick="openUniversityModal(<?php echo $index; ?>, 'az')" class="glass-card rounded-3xl overflow-hidden hover:border-amber-500/40 transition flex flex-col justify-between cursor-pointer group">
                    <div>
                        <div class="h-48 w-full overflow-hidden bg-slate-900/50">
                            <img src="<?php echo htmlspecialchars($u['image']); ?>" alt="<?php echo htmlspecialchars($u['name']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
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
                <p class="text-slate-400 text-sm sm:text-base max-w-3xl">A list of Azerbaijan's leading public and private universities for international students. Click on any university card for detailed information.</p>
            </div>
        </section>
        <section class="px-6 pb-20 max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($universities as $index => $u): ?>
                <div onclick="openUniversityModal(<?php echo $index; ?>, 'en')" class="glass-card rounded-3xl overflow-hidden hover:border-amber-500/40 transition flex flex-col justify-between cursor-pointer group">
                    <div>
                        <div class="h-48 w-full overflow-hidden bg-slate-900/50">
                            <img src="<?php echo htmlspecialchars($u['image']); ?>" alt="<?php echo htmlspecialchars($u['name']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
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
                <p class="text-slate-400 text-sm sm:text-base max-w-3xl">Список ведущих государственных и частных университетов Азербайджана для иностранных студентов. Нажмите на карточку для подробной информации.</p>
            </div>
        </section>
        <section class="px-6 pb-20 max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($universities as $index => $u): ?>
                <div onclick="openUniversityModal(<?php echo $index; ?>, 'ru')" class="glass-card rounded-3xl overflow-hidden hover:border-amber-500/40 transition flex flex-col justify-between cursor-pointer group">
                    <div>
                        <div class="h-48 w-full overflow-hidden bg-slate-900/50">
                            <img src="<?php echo htmlspecialchars($u['image']); ?>" alt="<?php echo htmlspecialchars($u['name']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
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
                <p class="text-slate-400 text-sm sm:text-base max-w-3xl">قائمة بأفضل الجامعات الحكومية والخاصة في أذربيجان للطلاب الأجانب. انقر على أي بطاقة لعرض التفاصيل الكاملة.</p>
            </div>
        </section>
        <section class="px-6 pb-20 max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($universities as $index => $u): ?>
                <div onclick="openUniversityModal(<?php echo $index; ?>, 'ar')" class="glass-card rounded-3xl overflow-hidden hover:border-amber-500/40 transition flex flex-col justify-between text-right cursor-pointer group">
                    <div>
                        <div class="h-48 w-full overflow-hidden bg-slate-900/50">
                            <img src="<?php echo htmlspecialchars($u['image']); ?>" alt="<?php echo htmlspecialchars($u['name']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
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

    <!-- ================= UNIVERSAL POPUP MODAL ================= -->
    <div id="uniModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md hidden opacity-0 transition-opacity duration-300">
        <div id="modalContentBox" class="glass-card bg-[#091f1b] border border-emerald-500/30 w-full max-w-2xl rounded-3xl overflow-hidden shadow-2xl transform scale-95 transition-transform duration-300 max-h-[90vh] flex flex-col">
            <!-- Modal Header Image -->
            <div class="relative h-60 w-full bg-slate-900">
                <img id="modalImg" src="" alt="" class="w-full h-full object-cover">
                <button onclick="closeUniversityModal()" class="absolute top-4 right-4 bg-black/60 hover:bg-black text-white w-9 h-9 rounded-full flex items-center justify-center text-lg font-bold transition">✕</button>
            </div>
            <!-- Modal Body Content -->
            <div class="p-6 sm:p-8 overflow-y-auto space-y-4">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <span id="modalCity" class="text-xs font-bold text-emerald-400 uppercase tracking-wider"></span>
                    <span id="modalLevel" class="text-xs font-medium text-amber-300 bg-amber-500/10 px-3 py-1 rounded-full border border-amber-500/20"></span>
                </div>
                <h2 id="modalTitle" class="text-xl sm:text-2xl font-black text-white"></h2>
                <p id="modalDescription" class="text-slate-300 text-sm leading-relaxed"></p>
                
                <div class="pt-4 border-t border-white/10 flex flex-wrap items-center justify-between gap-4">
                    <span class="text-xs text-slate-400" id="modalSupportText">Caspian Bridges dəstəyi ilə qəbul olunun.</span>
                    <a href="apply" class="bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 text-slate-950 font-bold px-6 py-2.5 rounded-xl text-xs shadow transition">Müraciət Et</a>
                </div>
            </div>
        </div>
    </div>

    <!-- PHP Array-i JavaScript obyektinə ötürürük -->
    <script>
        const universitiesData = <?php echo json_encode($universities, JSON_UNESCAPED_UNICODE); ?>;

        const translations = {
            az: { support: "Caspian Bridges dəstəyi ilə qəbul olunun." },
            en: { support: "Get admitted with Caspian Bridges support." },
            ru: { support: "Поступите при поддержке Caspian Bridges." },
            ar: { support: "احصل على القبول بدعم من Caspian Bridges." }
        };

        function openUniversityModal(index, lang) {
            const uni = universitiesData[index];
            if (!uni) return;

            document.getElementById('modalImg').src = uni.image;
            document.getElementById('modalImg').alt = uni.name;
            document.getElementById('modalTitle').innerText = uni.name;
            document.getElementById('modalCity').innerText = '📍 ' + uni.city;
            
            // Dilə uyğun səviyyə və geniş mətni təyin edirik
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

        // Pəncərədən kənara (qara fon bölgəsinə) kliklədikdə bağlanması
        document.getElementById('uniModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeUniversityModal();
            }
        });
    </script>

    <div id="footer-container"></div>
</body>
</html>