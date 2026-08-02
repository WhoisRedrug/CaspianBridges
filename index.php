<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caspian Bridges | Study, Tourism & Visa Gateway in Azerbaijan</title>
    <meta property="og:type" content="website">
    <meta property="og:title" content="Caspian Bridges — Study, Tourism & Visa Portal">
    <meta property="og:description" content="Official University Admissions, Student Placement, e-Visas, and Tourism in Azerbaijan.">
    <meta property="og:image" content="images/svgviewer-png-1.png">
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
                        <span>🇦🇿</span> Caspian Bridges • Rəsmi Təhsil və Turizm Portalı 2026
                    </div>
                    <h1 class="text-4xl sm:text-6xl font-black tracking-tight text-white leading-tight">
                        Azərbaycanda <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">Oxu və Kəşf Et</span>
                    </h1>
                    <p class="text-slate-200 font-semibold text-base sm:text-lg">
                        Caspian Bridges — Təhsil, Yaşayış və Turizm üzrə Etibarlı Körpünüz
                    </p>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Beynəlxalq tələbələrə və səyahətçilərə universitet qəbulu, sənəd hazırlığı, təhlükəsiz yerləşdirmə və unudulmaz turizm təcrübələri təqdim edirik.
                    </p>
                    <div class="flex items-center gap-6 pt-2">
                        <div><div class="text-2xl font-black text-emerald-400">99%</div><div class="text-[11px] text-slate-400 font-semibold">Qəbul Uğuru</div></div>
                        <div class="h-8 w-[1px] bg-slate-800"></div>
                        <div><div class="text-2xl font-black text-amber-400">24/7</div><div class="text-[11px] text-slate-400 font-semibold">Tələbə Dəstəyi</div></div>
                        <div class="h-8 w-[1px] bg-slate-800"></div>
                        <div><div class="text-2xl font-black text-emerald-300">5k+</div><div class="text-[11px] text-slate-400 font-semibold">Qlobal Tələbə</div></div>
                    </div>
                    <p class="text-lg font-medium text-slate-300 italic pt-1"> "Gələcəyinizi Bakıdakı imkanlarla birləşdiririk." </p>
                </div>
                <div class="lg:col-span-6 relative">
                    <div class="glass-card p-8 rounded-3xl border border-amber-500/20 gold-border relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-tr from-emerald-500/5 via-transparent to-amber-500/10 pointer-events-none"></div>
                        <div class="relative z-10 flex flex-col h-full gap-6">
                            <div>
                                <h3 class="text-2xl font-black text-white mb-2">Əsas Xidmətlər Mərkəzi</h3>
                                <p class="text-slate-400 text-sm">Azərbaycana rahat keçid üçün lazım olan hər şey.</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4 flex-grow">
                                <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80"><div class="text-2xl mb-1">🎓</div><h4 class="font-bold text-white text-sm">Universitet Qəbulu</h4><p class="text-[10px] text-slate-400">Bakalavr, Magistr və Doktorantura</p></div>
                                <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80"><div class="text-2xl mb-1">🏠</div><h4 class="font-bold text-white text-sm">Yaşayış</h4><p class="text-[10px] text-slate-400">Yataqxana və Mənzil</p></div>
                                <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80"><div class="text-2xl mb-1">📄</div><h4 class="font-bold text-white text-sm">Sənəd Hazırlığı</h4><p class="text-[10px] text-slate-400">Tərcümə və Hüquqi Qeydiyyat</p></div>
                                <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80"><div class="text-2xl mb-1">✈️</div><h4 class="font-bold text-white text-sm">Turizm & E-Viza</h4><p class="text-[10px] text-slate-400">Bələdçili Turlar və İcazələr</p></div>
                            </div>
                            <div class="mt-2 flex items-center justify-between gap-4 border-t border-slate-800/80 pt-5">
                                <div><h4 class="text-white font-bold text-sm">Başlamağa Hazırsınız?</h4><p class="text-slate-400 text-xs">Bu gün müraciət edin.</p></div>
                                <a href="apply" class="bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 text-slate-950 font-extrabold px-5 py-2.5 rounded-xl text-xs shadow-lg transition hover:scale-105"> Müraciət Et → </a>
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
                    <h2 class="text-3xl sm:text-4xl font-black text-white mt-2">Təhsil Mərkəzləri və Turizm İstiqamətləri</h2>
                </div>
                <a href="services" class="text-xs font-bold text-emerald-400 hover:underline mt-4 md:mt-0"> Bütün Proqramlar və Turlar → </a>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div data-target="#modal-baku" class="glass-card rounded-3xl overflow-hidden group hover:border-amber-500/50 transition cursor-pointer">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/baku.jpg" alt="Baku" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1584646098378-0874589d76b1?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-amber-400">Paytaxt və Universitetlər</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Bakı Tələbə Mərkəzi</h3>
                        <p class="text-slate-400 text-xs mb-4">Aparıcı universitetlər, modern kampus həyatı və zəngin mədəniyyət.</p>
                        <span class="text-xs font-bold text-amber-400">Bakını kəşf et →</span>
                    </div>
                </div>
                <div data-target="#modal-shahdag" class="glass-card rounded-3xl overflow-hidden group hover:border-emerald-500/50 transition cursor-pointer">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/shahdag.jpg" alt="Shahdag" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1548685913-fe6678babe8d?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-400">Kurort və İstirahət</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Şahdağ Dağları</h3>
                        <p class="text-slate-400 text-xs mb-4">Dağ macəraları, qış kurortu və unudulmaz istirahət zonaları.</p>
                        <span class="text-xs font-bold text-emerald-400">Kurortu kəşf et →</span>
                    </div>
                </div>
                <div data-target="#modal-gabala" class="glass-card rounded-3xl overflow-hidden group hover:border-emerald-500/50 transition cursor-pointer">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=1000&auto=format&fit=crop" alt="Gabala" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-400">Təbiət</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Qəbələ Meşələri</h3>
                        <p class="text-slate-400 text-xs mb-4">Mənzərəli göllər, sıx meşələr və dincəlmək üçün ideal məkanlar.</p>
                        <span class="text-xs font-bold text-emerald-400">Təbiəti kəşf et →</span>
                    </div>
                </div>
                <div data-target="#modal-shusha" class="glass-card rounded-3xl overflow-hidden group hover:border-amber-500/50 transition cursor-pointer">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/susha.jpg" alt="Shusha" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-amber-400">Mədəniyyət</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Şuşa və Qarabağ</h3>
                        <p class="text-slate-400 text-xs mb-4">Tarixi irsimiz, abidələr və mədəniyyət turları.</p>
                        <span class="text-xs font-bold text-amber-400">Mərkəzi ziyarət et →</span>
                    </div>
                </div>
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
                        <span>🇦🇿</span> Caspian Bridges • Official Study & Tourism Portal 2026
                    </div>
                    <h1 class="text-4xl sm:text-6xl font-black tracking-tight text-white leading-tight">
                        Study & Discover <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">Azerbaijan</span>
                    </h1>
                    <p class="text-slate-200 font-semibold text-base sm:text-lg">
                        Caspian Bridges — Your Trusted Bridge to Education, Housing & Tourism
                    </p>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        We guide international students and travelers through university admissions, document preparation, secure local accommodation, and unforgettable tourism experiences in Azerbaijan.
                    </p>
                    <div class="flex items-center gap-6 pt-2">
                        <div><div class="text-2xl font-black text-emerald-400">99%</div><div class="text-[11px] text-slate-400 font-semibold">Admission Success</div></div>
                        <div class="h-8 w-[1px] bg-slate-800"></div>
                        <div><div class="text-2xl font-black text-amber-400">24/7</div><div class="text-[11px] text-slate-400 font-semibold">Student Support</div></div>
                        <div class="h-8 w-[1px] bg-slate-800"></div>
                        <div><div class="text-2xl font-black text-emerald-300">5k+</div><div class="text-[11px] text-slate-400 font-semibold">Global Students</div></div>
                    </div>
                    <p class="text-lg font-medium text-slate-300 italic pt-1"> "Connecting your future to opportunities in Baku." </p>
                </div>
                <div class="lg:col-span-6 relative">
                    <div class="glass-card p-8 rounded-3xl border border-amber-500/20 gold-border relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-tr from-emerald-500/5 via-transparent to-amber-500/10 pointer-events-none"></div>
                        <div class="relative z-10 flex flex-col h-full gap-6">
                            <div>
                                <h3 class="text-2xl font-black text-white mb-2">Core Services Hub</h3>
                                <p class="text-slate-400 text-sm">Everything you need for a seamless transition to Azerbaijan.</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4 flex-grow">
                                <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80"><div class="text-2xl mb-1">🎓</div><h4 class="font-bold text-white text-sm">University Admissions</h4><p class="text-[10px] text-slate-400">Bachelor, Master & PhD</p></div>
                                <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80"><div class="text-2xl mb-1">🏠</div><h4 class="font-bold text-white text-sm">Accommodation</h4><p class="text-[10px] text-slate-400">Secure Placement & Housing</p></div>
                                <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80"><div class="text-2xl mb-1">📄</div><h4 class="font-bold text-white text-sm">Document Prep</h4><p class="text-[10px] text-slate-400">Translation & Legal Filing</p></div>
                                <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80"><div class="text-2xl mb-1">✈️</div><h4 class="font-bold text-white text-sm">Tourism & E-Visa</h4><p class="text-[10px] text-slate-400">Guided Tours & Permits</p></div>
                            </div>
                            <div class="mt-2 flex items-center justify-between gap-4 border-t border-slate-800/80 pt-5">
                                <div><h4 class="text-white font-bold text-sm">Ready to Begin?</h4><p class="text-slate-400 text-xs">Start your application today.</p></div>
                                <a href="apply" class="bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 text-slate-950 font-extrabold px-5 py-2.5 rounded-xl text-xs shadow-lg transition hover:scale-105"> Apply Now → </a>
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
                    <h2 class="text-3xl sm:text-4xl font-black text-white mt-2">Study Destinations & Tourism Highlights</h2>
                </div>
                <a href="services" class="text-xs font-bold text-emerald-400 hover:underline mt-4 md:mt-0"> View All Programs & Tours → </a>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div data-target="#modal-baku" class="glass-card rounded-3xl overflow-hidden group hover:border-amber-500/50 transition cursor-pointer">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/baku.jpg" alt="Baku" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1584646098378-0874589d76b1?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-amber-400">Capital & Universities</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Baku Student Hub</h3>
                        <p class="text-slate-400 text-xs mb-4">Top universities, modern campus life, and vibrant culture.</p>
                        <span class="text-xs font-bold text-amber-400">Explore Baku →</span>
                    </div>
                </div>
                <div data-target="#modal-shahdag" class="glass-card rounded-3xl overflow-hidden group hover:border-emerald-500/50 transition cursor-pointer">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/shahdag.jpg" alt="Shahdag" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1548685913-fe6678babe8d?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-400">Resort & Leisure</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Shahdag Mountains</h3>
                        <p class="text-slate-400 text-xs mb-4">Mountain adventures and ski resort excursions.</p>
                        <span class="text-xs font-bold text-emerald-400">Explore Resort →</span>
                    </div>
                </div>
                <div data-target="#modal-gabala" class="glass-card rounded-3xl overflow-hidden group hover:border-emerald-500/50 transition cursor-pointer">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=1000&auto=format&fit=crop" alt="Gabala" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-400">Nature</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Gabala Forests</h3>
                        <p class="text-slate-400 text-xs mb-4">Scenic lakes, forests, and relaxation spots.</p>
                        <span class="text-xs font-bold text-emerald-400">Explore Nature →</span>
                    </div>
                </div>
                <div data-target="#modal-shusha" class="glass-card rounded-3xl overflow-hidden group hover:border-amber-500/50 transition cursor-pointer">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/susha.jpg" alt="Shusha" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-amber-400">Culture</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Shusha & Karabakh</h3>
                        <p class="text-slate-400 text-xs mb-4">Historical heritage and cultural tours.</p>
                        <span class="text-xs font-bold text-amber-400">Visit Hub →</span>
                    </div>
                </div>
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
                        Учеба и туризм в <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">Азербайджане</span>
                    </h1>
                    <p class="text-slate-200 font-semibold text-base sm:text-lg">
                        Caspian Bridges — Ваш надежный мост к образованию, жилью и туризму
                    </p>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Мы помогаем иностранным студентам и туристам с поступлением в университеты, подготовкой документов, безопасным размещением и незабываемыми турами.
                    </p>
                    <div class="flex items-center gap-6 pt-2">
                        <div><div class="text-2xl font-black text-emerald-400">99%</div><div class="text-[11px] text-slate-400 font-semibold">Поступлений</div></div>
                        <div class="h-8 w-[1px] bg-slate-800"></div>
                        <div><div class="text-2xl font-black text-amber-400">24/7</div><div class="text-[11px] text-slate-400 font-semibold">Поддержка студентов</div></div>
                        <div class="h-8 w-[1px] bg-slate-800"></div>
                        <div><div class="text-2xl font-black text-emerald-300">5k+</div><div class="text-[11px] text-slate-400 font-semibold">Студентов со всего мира</div></div>
                    </div>
                    <p class="text-lg font-medium text-slate-300 italic pt-1"> "Связываем ваше будущее с возможностями в Баку." </p>
                </div>
                <div class="lg:col-span-6 relative">
                    <div class="glass-card p-8 rounded-3xl border border-amber-500/20 gold-border relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-tr from-emerald-500/5 via-transparent to-amber-500/10 pointer-events-none"></div>
                        <div class="relative z-10 flex flex-col h-full gap-6">
                            <div>
                                <h3 class="text-2xl font-black text-white mb-2">Центр Услуг</h3>
                                <p class="text-slate-400 text-sm">Все необходимое для плавного переезда в Азербайджан.</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4 flex-grow">
                                <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80"><div class="text-2xl mb-1">🎓</div><h4 class="font-bold text-white text-sm">Поступление в ВУЗы</h4><p class="text-[10px] text-slate-400">Бакалавриат и Магистратура</p></div>
                                <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80"><div class="text-2xl mb-1">🏠</div><h4 class="font-bold text-white text-sm">Проживание</h4><p class="text-[10px] text-slate-400">Общежития и квартиры</p></div>
                                <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80"><div class="text-2xl mb-1">📄</div><h4 class="font-bold text-white text-sm">Подготовка документов</h4><p class="text-[10px] text-slate-400">Перевод и легализация</p></div>
                                <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80"><div class="text-2xl mb-1">✈️</div><h4 class="font-bold text-white text-sm">Туризм и визы</h4><p class="text-[10px] text-slate-400">Экскурсии и E-Visa</p></div>
                            </div>
                            <div class="mt-2 flex items-center justify-between gap-4 border-t border-slate-800/80 pt-5">
                                <div><h4 class="text-white font-bold text-sm">Говы начать?</h4><p class="text-slate-400 text-xs">Подайте заявку сегодня.</p></div>
                                <a href="apply" class="bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 text-slate-950 font-extrabold px-5 py-2.5 rounded-xl text-xs shadow-lg transition hover:scale-105"> Подать заявку → </a>
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
                    <h2 class="text-3xl sm:text-4xl font-black text-white mt-2">Учебные центры и туристические направления</h2>
                </div>
                <a href="services" class="text-xs font-bold text-emerald-400 hover:underline mt-4 md:mt-0"> Все программы и туры → </a>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div data-target="#modal-baku" class="glass-card rounded-3xl overflow-hidden group hover:border-amber-500/50 transition cursor-pointer">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/baku.jpg" alt="Baku" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1584646098378-0874589d76b1?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-amber-400">Столица и ВУЗы</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Студенческий хаб в Баку</h3>
                        <p class="text-slate-400 text-xs mb-4">Ведущие университеты, современный кампус и культура.</p>
                        <span class="text-xs font-bold text-amber-400">Исследовать Баку →</span>
                    </div>
                </div>
                <div data-target="#modal-shahdag" class="glass-card rounded-3xl overflow-hidden group hover:border-emerald-500/50 transition cursor-pointer">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/shahdag.jpg" alt="Shahdag" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1548685913-fe6678babe8d?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-400">Курорты</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Горы Шахдаг</h3>
                        <p class="text-slate-400 text-xs mb-4">Горные приключения и лыжный курорт.</p>
                        <span class="text-xs font-bold text-emerald-400">Исследовать курорт →</span>
                    </div>
                </div>
                <div data-target="#modal-gabala" class="glass-card rounded-3xl overflow-hidden group hover:border-emerald-500/50 transition cursor-pointer">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=1000&auto=format&fit=crop" alt="Gabala" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-400">Природа</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Леса Габалы</h3>
                        <p class="text-slate-400 text-xs mb-4">Живописные озера, леса и места для отдыха.</p>
                        <span class="text-xs font-bold text-emerald-400">Исследовать природу →</span>
                    </div>
                </div>
                <div data-target="#modal-shusha" class="glass-card rounded-3xl overflow-hidden group hover:border-amber-500/50 transition cursor-pointer">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/susha.jpg" alt="Shusha" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 left-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-amber-400">Культура</span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">Шуша и Карабах</h3>
                        <p class="text-slate-400 text-xs mb-4">Историческое наследие и культурные туры.</p>
                        <span class="text-xs font-bold text-amber-400">Посетить хаб →</span>
                    </div>
                </div>
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
                        <span>🇦🇿</span> جسور بحر قزوين • البوابة الرسمية للتعليم والسياحة 2026
                    </div>
                    <h1 class="text-4xl sm:text-6xl font-black tracking-tight text-white leading-tight">
                        دراسة واكتشاف <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">أذربيجان</span>
                    </h1>
                    <p class="text-slate-200 font-semibold text-base sm:text-lg ml-auto">
                        جسور بحر قزوين — بوابتك الموثوقة للتعليم والسكن والسياحة
                    </p>
                    <p class="text-slate-400 text-sm leading-relaxed ml-auto">
                        نساعد الطلاب والمسافرين الدوليين في القبول الجامعي، إعداد المستندات، السكن الآمن، والتجارب السياحية التي لا تُنسى في أذربيجان.
                    </p>
                    <div class="flex items-center gap-6 pt-2 ml-auto justify-end">
                        <div><div class="text-2xl font-black text-emerald-300">5k+</div><div class="text-[11px] text-slate-400 font-semibold">طلاب عالميون</div></div>
                        <div class="h-8 w-[1px] bg-slate-800"></div>
                        <div><div class="text-2xl font-black text-amber-400">24/7</div><div class="text-[11px] text-slate-400 font-semibold">دعم الطلاب</div></div>
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
                                <p class="text-slate-400 text-sm">كل ما تحتاجه لانتقال سلس إلى أذربيجان.</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4 flex-grow">
                                <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80"><div class="text-2xl mb-1">🎓</div><h4 class="font-bold text-white text-sm">القبول الجامعي</h4><p class="text-[10px] text-slate-400">بكالوريوس، ماجستير ودكتوراه</p></div>
                                <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80"><div class="text-2xl mb-1">🏠</div><h4 class="font-bold text-white text-sm">السكن</h4><p class="text-[10px] text-slate-400">إسكان آمن وشقق</p></div>
                                <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80"><div class="text-2xl mb-1">📄</div><h4 class="font-bold text-white text-sm">إعداد المستندات</h4><p class="text-[10px] text-slate-400">الترجمة والتسجيل القانوني</p></div>
                                <div class="bg-[#0b2420] p-4 rounded-2xl border border-slate-800/80"><div class="text-2xl mb-1">✈️</div><h4 class="font-bold text-white text-sm">السياحة والتأشيرة</h4><p class="text-[10px] text-slate-400">جولات مرشدة وتصاريح</p></div>
                            </div>
                            <div class="mt-2 flex items-center justify-between gap-4 border-t border-slate-800/80 pt-5 flex-row-reverse">
                                <div><h4 class="text-white font-bold text-sm">هل أنت مستعد للبدء؟</h4><p class="text-slate-400 text-xs">ابدأ طلبك اليوم.</p></div>
                                <a href="apply" class="bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 text-slate-950 font-extrabold px-5 py-2.5 rounded-xl text-xs shadow-lg transition hover:scale-105"> قدم الآن → </a>
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
                    <h2 class="text-3xl sm:text-4xl font-black text-white mt-2">وجهات الدراسة والابرز السياحية</h2>
                </div>
                <a href="services" class="text-xs font-bold text-emerald-400 hover:underline mt-4 md:mt-0"> عرض جميع البرامج والجولات ← </a>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div data-target="#modal-baku" class="glass-card rounded-3xl overflow-hidden group hover:border-amber-500/50 transition cursor-pointer">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/baku.jpg" alt="Baku" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1584646098378-0874589d76b1?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 right-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-amber-400">العاصمة والجامعات</span>
                    </div>
                    <div class="p-5 text-right">
                        <h3 class="text-lg font-bold text-white mb-1">مركز باكو للطلاب</h3>
                        <p class="text-slate-400 text-xs mb-4">أفضل الجامعات، حياة الحرم الجامعي الحديثة، والثقافة النابضة بالحياة.</p>
                        <span class="text-xs font-bold text-amber-400">استكشف باكو ←</span>
                    </div>
                </div>
                <div data-target="#modal-shahdag" class="glass-card rounded-3xl overflow-hidden group hover:border-emerald-500/50 transition cursor-pointer">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/shahdag.jpg" alt="Shahdag" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1548685913-fe6678babe8d?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 right-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-400">منتجع وترفيه</span>
                    </div>
                    <div class="p-5 text-right">
                        <h3 class="text-lg font-bold text-white mb-1">جبال شاهداغ</h3>
                        <p class="text-slate-400 text-xs mb-4">مغامرات جبلية ورحلات منتجعات التزلج.</p>
                        <span class="text-xs font-bold text-emerald-400">استكشف المنتجع ←</span>
                    </div>
                </div>
                <div data-target="#modal-gabala" class="glass-card rounded-3xl overflow-hidden group hover:border-emerald-500/50 transition cursor-pointer">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=1000&auto=format&fit=crop" alt="Gabala" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <span class="absolute top-3 right-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-400">طبيعة</span>
                    </div>
                    <div class="p-5 text-right">
                        <h3 class="text-lg font-bold text-white mb-1">غابات غابالا</h3>
                        <p class="text-slate-400 text-xs mb-4">بحيرات خلابة وغابات وأماكن للاسترخاء.</p>
                        <span class="text-xs font-bold text-emerald-400">استكشف الطبيعة ←</span>
                    </div>
                </div>
                <div data-target="#modal-shusha" class="glass-card rounded-3xl overflow-hidden group hover:border-amber-500/50 transition cursor-pointer">
                    <div class="h-48 overflow-hidden relative">
                        <img src="images/susha.jpg" alt="Shusha" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=1000&auto=format&fit=crop'">
                        <span class="absolute top-3 right-3 bg-[#061412]/90 px-3 py-1 rounded-full text-[11px] font-bold text-amber-400">ثقافة</span>
                    </div>
                    <div class="p-5 text-right">
                        <h3 class="text-lg font-bold text-white mb-1">شوشا وقره باغ</h3>
                        <p class="text-slate-400 text-xs mb-4">التراث التاريخي والجولات الثقافية.</p>
                        <span class="text-xs font-bold text-amber-400">زيارة المركز ←</span>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div id="footer-container"></div>

    <!-- Modals -->
    <div id="modal-baku" class="modal-overlay">
        <div class="modal-box text-left">
            <span class="close-modal">&times;</span>
            <div class="image-slider">
                <img src="https://images.unsplash.com/photo-1584646098378-0874589d76b1?q=80&w=1000&auto=format&fit=crop" class="active" alt="Baku">
                <img src="https://images.unsplash.com/photo-1539650116574-8efeb43e2750?q=80&w=1000&auto=format&fit=crop" alt="Old City">
            </div>
            <div class="p-6">
                <h2 class="text-2xl font-black text-white mb-2">🇦🇿 Baku Student & Tourist Hub</h2>
                <p class="text-slate-300 text-sm mb-4">Baku hosts top-tier universities with international accreditation, modern student residences, and a rich cultural environment.</p>
                <a href="apply" class="inline-block bg-amber-500 text-slate-950 font-bold px-6 py-2.5 rounded-xl text-xs">Apply for Study Program</a>
            </div>
        </div>
    </div>
    <div id="modal-shahdag" class="modal-overlay">
        <div class="modal-box text-left">
            <span class="close-modal">&times;</span>
            <div class="image-slider">
                <img src="https://images.unsplash.com/photo-1548685913-fe6678babe8d?q=80&w=1000&auto=format&fit=crop" class="active" alt="Shahdag">
            </div>
            <div class="p-6">
                <h2 class="text-2xl font-black text-white mb-2">⛷️ Shahdag Mountain Resort</h2>
                <p class="text-slate-300 text-sm mb-4">Premier alpine resort offering winter skiing and summer mountain getaways for our students and travelers.</p>
                <a href="apply" class="inline-block bg-emerald-500 text-slate-950 font-bold px-6 py-2.5 rounded-xl text-xs">Book Tour Package</a>
            </div>
        </div>
    </div>
    <div id="modal-gabala" class="modal-overlay">
        <div class="modal-box text-left">
            <span class="close-modal">&times;</span>
            <div class="image-slider">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=1000&auto=format&fit=crop" class="active" alt="Gabala">
            </div>
            <div class="p-6">
                <h2 class="text-2xl font-black text-white mb-2">🌲 Gabala Nature Tours</h2>
                <p class="text-slate-300 text-sm mb-4">Explore forests, waterfalls, and Nohur Lake during orientation trips organized by Caspian Bridges.</p>
                <a href="apply" class="inline-block bg-emerald-500 text-slate-950 font-bold px-6 py-2.5 rounded-xl text-xs">Book Gabala Trip</a>
            </div>
        </div>
    </div>
    <div id="modal-shusha" class="modal-overlay">
        <div class="modal-box text-left">
            <span class="close-modal">&times;</span>
            <div class="image-slider">
                <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=1000&auto=format&fit=crop" class="active" alt="Shusha">
            </div>
            <div class="p-6">
                <h2 class="text-2xl font-black text-white mb-2">🏛️ Shusha Heritage</h2>
                <p class="text-slate-300 text-sm mb-4">Cultural capital of Azerbaijan showcasing historic monuments and breathtaking landscapes.</p>
                <a href="apply" class="inline-block bg-amber-500 text-slate-950 font-bold px-6 py-2.5 rounded-xl text-xs">Learn More</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[data-target]').forEach(card => {
                card.addEventListener('click', () => {
                    const modal = document.querySelector(card.getAttribute('data-target'));
                    if (modal) modal.classList.add('active');
                });
            });
            document.querySelectorAll('.modal-overlay').forEach(modal => {
                modal.querySelector('.close-modal')?.addEventListener('click', () => modal.classList.remove('active'));
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) modal.classList.remove('active');
                });
            });
        });
    </script>
</body>
</html>