<?php session_start(); require_once 'csrf.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Access | Caspian Bridges</title>
    <link rel="icon" type="image/png" href="images/logo.png.png">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Caspian Bridges — Account Access">
    <meta property="og:description" content="Official Study, e-Visas, and Residency Portal in Azerbaijan.">
    <meta property="og:image" content="images/logo.png.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(12, 35, 31, 0.85); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .bg-glow { background: radial-gradient(circle at 50% 30%, #0f3831 0%, #061412 60%, #020a09 100%); }
    </style>
    <script>
    window.isUserLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    </script>
</head>
<body class="bg-glow text-slate-100 min-h-screen flex items-center justify-center p-4 relative overflow-x-hidden overflow-y-auto antialiased selection:bg-emerald-400 selection:text-slate-950">
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none"></div>
    
    <div class="w-full max-w-md z-10 my-8">
        <!-- Language Selector Bar -->
        <div class="flex justify-between items-center mb-4 px-2">
            <a href="index" class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-amber-400 transition bg-[#0b2420] px-4 py-2 rounded-full border border-slate-800"> ← Back to Home </a>
            <div class="flex gap-1 bg-[#0b2420] p-1 rounded-full border border-slate-800 text-xs font-bold">
                <button onclick="setLanguage('az')" class="px-2.5 py-1 rounded-full transition text-slate-400 hover:text-white lang-btn" data-btn-lang="az">AZ</button>
                <button onclick="setLanguage('en')" class="px-2.5 py-1 rounded-full transition bg-amber-500 text-slate-950 lang-btn" data-btn-lang="en">EN</button>
                <button onclick="setLanguage('ru')" class="px-2.5 py-1 rounded-full transition text-slate-400 hover:text-white lang-btn" data-btn-lang="ru">RU</button>
                <button onclick="setLanguage('ar')" class="px-2.5 py-1 rounded-full transition text-slate-400 hover:text-white lang-btn" data-btn-lang="ar">AR</button>
            </div>
        </div>

        <div class="glass-card p-8 rounded-3xl shadow-2xl relative border border-amber-500/20 max-h-[calc(100vh-3rem)] overflow-y-auto">
            <div class="text-center mb-4">
                <a href="index" class="inline-block mb-2">
                    <img src="images/logo.png.png" alt="Caspian Bridges Logo" class="w-14 h-14 object-contain mx-auto rounded-2xl shadow-md">
                </a>
                <span class="text-xl font-black tracking-wider text-white block">CASPIAN BRIDGES</span>
                <p class="text-xs text-slate-400 mt-1 subtitle-text" data-sub-login="Sign in to track your applications" data-sub-reg="Create an account for personal portal">Sign in to track your applications</p>
                
                <!-- XƏTA VƏ UĞUR MESAJI QUTUSU -->
                <div id="message-box" class="mt-4 text-xs font-bold text-center"></div>
            </div>

            <!-- ================= AZERBAIJANI (AZ) ================= -->
            <div data-lang="az">
                <div class="grid grid-cols-2 p-1 bg-[#061412] rounded-2xl border border-slate-800 mb-4">
                    <button onclick="switchTab('az', 'login')" class="tab-login-az py-2 text-xs font-extrabold rounded-xl transition bg-amber-500 text-slate-950 shadow-md"> Daxil ol </button>
                    <button onclick="switchTab('az', 'register')" class="tab-reg-az py-2 text-xs font-bold rounded-xl transition text-slate-400 hover:text-white"> Qeydiyyat </button>
                </div>

                <!-- LOGIN FORM -->
                <form id="form-login-az" action="process" method="POST" class="space-y-3">
                    <input type="hidden" name="action" value="login">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">E-poçt Ünvanı</label>
                        <input type="email" name="email" placeholder="name@example.com" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <label class="text-xs font-bold text-slate-300">Şifrə</label>
                            <a href="recovery" class="text-[11px] font-semibold text-amber-400 hover:underline">Şifrəni unutmusunuz?</a>
                        </div>
                        <input type="password" name="password" placeholder="••••••••" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LdGe3ItAAAAAO9Kh2b3fSv7FXaHDh17S1DN_ePn"></div>
                    <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 text-slate-950 font-black py-3.5 rounded-xl text-sm transition shadow-lg shadow-amber-500/20 mt-2"> Daxil Ol → </button>
                </form>

                <!-- REGISTER FORM -->
                <form id="form-register-az" action="process" method="POST" class="space-y-3 hidden">
                    <input type="hidden" name="action" value="register">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">Ad və Soyad</label>
                        <input type="text" name="name" placeholder="Elvin Məmmədov" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">Telefon / WhatsApp</label>
                        <input type="tel" name="phone" placeholder="+994 50 000 0000" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">E-poçt Ünvanı</label>
                        <input type="email" name="email" placeholder="name@example.com" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">Şifrə</label>
                        <input type="password" name="password" placeholder="Minimum 8 simvol" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LdGe3ItAAAAAO9Kh2b3fSv7FXaHDh17S1DN_ePn"></div>
                    <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 text-slate-950 font-black py-3.5 rounded-xl text-sm transition shadow-lg shadow-amber-500/20 mt-2"> Hesab Yarat → </button>
                </form>
            </div>

            <!-- ================= ENGLISH (EN) ================= -->
            <div data-lang="en" class="hidden">
                <div class="grid grid-cols-2 p-1 bg-[#061412] rounded-2xl border border-slate-800 mb-4">
                    <button onclick="switchTab('en', 'login')" class="tab-login-en py-2 text-xs font-extrabold rounded-xl transition bg-amber-500 text-slate-950 shadow-md"> Log In </button>
                    <button onclick="switchTab('en', 'register')" class="tab-reg-en py-2 text-xs font-bold rounded-xl transition text-slate-400 hover:text-white"> Register </button>
                </div>

                <form id="form-login-en" action="process" method="POST" class="space-y-3">
                    <input type="hidden" name="action" value="login">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">Email Address</label>
                        <input type="email" name="email" placeholder="name@example.com" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <label class="text-xs font-bold text-slate-300">Password</label>
                            <a href="recovery" class="text-[11px] font-semibold text-amber-400 hover:underline">Forgot password?</a>
                        </div>
                        <input type="password" name="password" placeholder="••••••••" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LdGe3ItAAAAAO9Kh2b3fSv7FXaHDh17S1DN_ePn"></div>
                    <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 text-slate-950 font-black py-3.5 rounded-xl text-sm transition shadow-lg shadow-amber-500/20 mt-2"> Sign In → </button>
                </form>

                <form id="form-register-en" action="process" method="POST" class="space-y-3 hidden">
                    <input type="hidden" name="action" value="register">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">Full Name</label>
                        <input type="text" name="name" placeholder="John Doe" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">Phone / WhatsApp</label>
                        <input type="tel" name="phone" placeholder="+1 (555) 000-0000" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">Email Address</label>
                        <input type="email" name="email" placeholder="name@example.com" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">Password</label>
                        <input type="password" name="password" placeholder="Minimum 8 characters" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LdGe3ItAAAAAO9Kh2b3fSv7FXaHDh17S1DN_ePn"></div>
                    <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 text-slate-950 font-black py-3.5 rounded-xl text-sm transition shadow-lg shadow-amber-500/20 mt-2"> Create Account → </button>
                </form>
            </div>

            <!-- ================= RUSSIAN (RU) ================= -->
            <div data-lang="ru" class="hidden">
                <div class="grid grid-cols-2 p-1 bg-[#061412] rounded-2xl border border-slate-800 mb-4">
                    <button onclick="switchTab('ru', 'login')" class="tab-login-ru py-2 text-xs font-extrabold rounded-xl transition bg-amber-500 text-slate-950 shadow-md"> Войти </button>
                    <button onclick="switchTab('ru', 'register')" class="tab-reg-ru py-2 text-xs font-bold rounded-xl transition text-slate-400 hover:text-white"> Регистрация </button>
                </div>

                <form id="form-login-ru" action="process" method="POST" class="space-y-3">
                    <input type="hidden" name="action" value="login">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">Электронная почта</label>
                        <input type="email" name="email" placeholder="name@example.com" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <label class="text-xs font-bold text-slate-300">Пароль</label>
                            <a href="recovery" class="text-[11px] font-semibold text-amber-400 hover:underline">Забыли пароль?</a>
                        </div>
                        <input type="password" name="password" placeholder="••••••••" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LdGe3ItAAAAAO9Kh2b3fSv7FXaHDh17S1DN_ePn"></div>
                    <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 text-slate-950 font-black py-3.5 rounded-xl text-sm transition shadow-lg shadow-amber-500/20 mt-2"> Войти → </button>
                </form>

                <form id="form-register-ru" action="process" method="POST" class="space-y-3 hidden">
                    <input type="hidden" name="action" value="register">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">ФИО</label>
                        <input type="text" name="name" placeholder="Иван Иванов" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">Телефон / WhatsApp</label>
                        <input type="tel" name="phone" placeholder="+7 (999) 000-00-00" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">Электронная почта</label>
                        <input type="email" name="email" placeholder="name@example.com" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">Пароль</label>
                        <input type="password" name="password" placeholder="Минимум 8 символов" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition">
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LdGe3ItAAAAAO9Kh2b3fSv7FXaHDh17S1DN_ePn"></div>
                    <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 text-slate-950 font-black py-3.5 rounded-xl text-sm transition shadow-lg shadow-amber-500/20 mt-2"> Создать аккаунт → </button>
                </form>
            </div>

            <!-- ================= ARABIC (AR) ================= -->
            <div data-lang="ar" class="hidden">
                <div class="grid grid-cols-2 p-1 bg-[#061412] rounded-2xl border border-slate-800 mb-4">
                    <button onclick="switchTab('ar', 'login')" class="tab-login-ar py-2 text-xs font-extrabold rounded-xl transition bg-amber-500 text-slate-950 shadow-md"> تسجيل الدخول </button>
                    <button onclick="switchTab('ar', 'register')" class="tab-reg-ar py-2 text-xs font-bold rounded-xl transition text-slate-400 hover:text-white"> إنشاء حساب </button>
                </div>

                <form id="form-login-ar" action="process" method="POST" class="space-y-3 text-right">
                    <input type="hidden" name="action" value="login">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">البريد الإلكتروني</label>
                        <input type="email" name="email" placeholder="name@example.com" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition text-right">
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <label class="text-xs font-bold text-slate-300">كلمة المرور</label>
                            <a href="recovery" class="text-[11px] font-semibold text-amber-400 hover:underline">هل نسيت كلمة المرور؟</a>
                        </div>
                        <input type="password" name="password" placeholder="••••••••" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition text-right">
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LdGe3ItAAAAAO9Kh2b3fSv7FXaHDh17S1DN_ePn"></div>
                    <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 text-slate-950 font-black py-3.5 rounded-xl text-sm transition shadow-lg shadow-amber-500/20 mt-2"> تسجيل الدخول → </button>
                </form>

                <form id="form-register-ar" action="process" method="POST" class="space-y-3 hidden text-right">
                    <input type="hidden" name="action" value="register">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">الاسم الكامل</label>
                        <input type="text" name="name" placeholder="محمد الأحمد" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition text-right">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">الهاتف / واتساب</label>
                        <input type="tel" name="phone" placeholder="+966 50 000 0000" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition text-right">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">البريد الإلكتروني</label>
                        <input type="email" name="email" placeholder="name@example.com" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition text-right">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">كلمة المرور</label>
                        <input type="password" name="password" placeholder="8 أحرف على الأقل" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition text-right">
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LdGe3ItAAAAAO9Kh2b3fSv7FXaHDh17S1DN_ePn"></div>
                    <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 text-slate-950 font-black py-3.5 rounded-xl text-sm transition shadow-lg shadow-amber-500/20 mt-2"> إنشاء حساب → </button>
                </form>
            </div>

            <div class="mt-6 pt-6 border-t border-slate-800/80 text-center text-xs text-slate-500">
                <span data-lang-text="support-label">Need urgent help? (7/24 Support)</span>
                <a href="mailto:support@caspianbridges.com" class="text-amber-400 hover:underline font-bold block mt-1">support@caspianbridges.com</a>
            </div>
        </div>
    </div>

    <script>
        function setLanguage(lang) {
            document.querySelectorAll('[data-lang]').forEach(el => el.classList.add('hidden'));
            document.querySelector(`[data-lang="${lang}"]`).classList.remove('hidden');

            document.querySelectorAll('.lang-btn').forEach(btn => {
                if(btn.getAttribute('data-btn-lang') === lang) {
                    btn.className = 'px-2.5 py-1 rounded-full transition bg-amber-500 text-slate-950 lang-btn';
                } else {
                    btn.className = 'px-2.5 py-1 rounded-full transition text-slate-400 hover:text-white lang-btn';
                }
            });
            localStorage.setItem('caspian_lang', lang);

            const urlParams = new URLSearchParams(window.location.search);
            const errorParam = urlParams.get('error');
            const successParam = urlParams.get('success');
            const statusParam = urlParams.get('status');
            if (errorParam || successParam || statusParam) {
                displayMessage(errorParam, successParam, statusParam, lang);
            }
        }

        function switchTab(lang, tab) {
            const loginForm = document.getElementById(`form-login-${lang}`);
            const registerForm = document.getElementById(`form-register-${lang}`);
            const tabLogin = document.querySelector(`.tab-login-${lang}`);
            const tabReg = document.querySelector(`.tab-reg-${lang}`);
            const subTitle = document.querySelector('[data-sub-login]');

            if (tab === 'login') {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                tabLogin.className = `tab-login-${lang} py-2 text-xs font-extrabold rounded-xl transition bg-amber-500 text-slate-950 shadow-md`;
                tabReg.className = `tab-reg-${lang} py-2 text-xs font-bold rounded-xl transition text-slate-400 hover:text-white`;
                
                if(lang === 'az') subTitle.textContent = 'Müraciətlərinizi izləmək üçün daxil olun';
                else if(lang === 'en') subTitle.textContent = 'Sign in to track your applications';
                else if(lang === 'ru') subTitle.textContent = 'Войдите, чтобы отслеживать ваши заявки';
                else if(lang === 'ar') subTitle.textContent = 'تسجيل الدخول لتتبع طلباتك';
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                tabReg.className = `tab-reg-${lang} py-2 text-xs font-extrabold rounded-xl transition bg-amber-500 text-slate-950 shadow-md`;
                tabLogin.className = `tab-login-${lang} py-2 text-xs font-bold rounded-xl transition text-slate-400 hover:text-white`;

                if(lang === 'az') subTitle.textContent = 'Şəxsi portal üçün hesab yaradın';
                else if(lang === 'en') subTitle.textContent = 'Create an account for personal portal';
                else if(lang === 'ru') subTitle.textContent = 'Создайте аккаунт для личного кабинета';
                else if(lang === 'ar') subTitle.textContent = 'أنشئ حساباً للبوابة الشخصية';
            }
        }

        function displayMessage(errorParam, successParam, statusParam, lang) {
            const msgBox = document.getElementById('message-box');
            if (!msgBox) return;

            const messages = {
                az: {
                    wrong_password: 'Yanlış şifrə daxil edildi!',
                    user_not_found: 'Bu e-poçt ünvanı ilə istifadəçi tapılmadı!',
                    email_exists: 'Bu e-poçt və ya nömrə ilə artıq qeydiyyatdan keçilib!',
                    db_error: 'Qeydiyyat zamanı xəta baş verdi!',
                    too_many_attempts: 'Çox sayda uğursuz cəhd edildi. Zəhmət olmasa 15 dəqiqə sonra yenidən cəhd edin.',
                    csrf: 'Sessiya vaxtı bitib, zəhmət olmasa yenidən cəhd edin.',
                    recaptcha: 'Zəhmət olmasa "Mən robot deyiləm" qutusunu işarələyin.',
                    fake_email: 'Zəhmət olmasa real e-poçt ünvanınızı daxil edin.',
                    invalid_phone: 'Telefon nömrəsi düzgün formatda deyil. Ölkə kodu ilə daxil edin, məs: +994 50 123 45 67 və ya +1 555 123 4567',
                    registered: 'Hesab uğurla yaradıldı! İndi daxil ola bilərsiniz.',
                    password_reset_success: 'Şifrəniz uğurla yeniləndi! Yeni şifrənizlə daxil ola bilərsiniz.'
                },
                en: {
                    wrong_password: 'Wrong password entered!',
                    user_not_found: 'No user found with this email address!',
                    email_exists: 'This email or phone is already registered!',
                    db_error: 'An error occurred during registration!',
                    too_many_attempts: 'Too many failed attempts. Please try again after 15 minutes.',
                    csrf: 'Your session expired, please try again.',
                    recaptcha: 'Please check the "I\'m not a robot" box.',
                    fake_email: 'Please enter a real email address.',
                    invalid_phone: 'Phone number format is invalid. Include your country code, e.g. +1 555 123 4567 or +994 50 123 45 67',
                    registered: 'Account created successfully! You can now log in.',
                    password_reset_success: 'Password has been successfully updated! You can now log in.'
                },
                ru: {
                    wrong_password: 'Неверный пароль!',
                    user_not_found: 'Пользователь с таким email не найден!',
                    email_exists: 'Этот email или телефон уже зарегистрирован!',
                    db_error: 'Ошибка при регистрации!',
                    too_many_attempts: 'Слишком много неудачных попыток. Пожалуйста, попробуйте через 15 минут.',
                    csrf: 'Сессия истекла, пожалуйста, попробуйте снова.',
                    recaptcha: 'Пожалуйста, отметьте галочку "Я не робот".',
                    fake_email: 'Пожалуйста, введите настоящий email адрес.',
                    invalid_phone: 'Неверный формат номера телефона. Укажите код страны, напр.: +7 999 123 45 67 или +994 50 123 45 67',
                    registered: 'Аккаунт успешно создан! Теперь вы можете войти.',
                    password_reset_success: 'Пароль успешно обновлен! Теперь вы можете войти.'
                },
                ar: {
                    wrong_password: 'كلمة المرور غير صحيحة!',
                    user_not_found: 'لم يتم العثور على مستخدم بهذا البريد الإلكتروني!',
                    email_exists: 'هذا البريد الإلكتروني أو الرقم مستخدم بالفعل!',
                    db_error: 'حدث خطأ أثناء التسجيل!',
                    too_many_attempts: 'عدد كبير جداً من المحاولات الفاشلة. يرجى المحاولة مرة أخرى بعد 15 دقيقة.',
                    csrf: 'انتهت صلاحية الجلسة، يرجى المحاولة مرة أخرى.',
                    recaptcha: 'يرجى تحديد خانة "أنا لست روبوتاً".',
                    fake_email: 'يرجى إدخال بريد إلكتروني حقيقي.',
                    invalid_phone: 'صيغة رقم الهاتف غير صحيحة. يرجى تضمين رمز الدولة، مثال: +966 50 123 4567 أو +994 50 123 45 67',
                    registered: 'تم إنشاء الحساب بنجاح! يمكنك تسجيل الدخول الآن.',
                    password_reset_success: 'تم تحديث كلمة المرور بنجاح! يمكنك تسجيل الدخول الآن.'
                }
            };

            const currentLangDict = messages[lang] || messages['en'];

            if (errorParam && currentLangDict[errorParam]) {
                msgBox.className = "mt-4 text-xs font-bold text-center text-red-400 bg-red-500/10 p-2.5 rounded-xl border border-red-500/20";
                msgBox.innerText = currentLangDict[errorParam];
            } else if (successParam && currentLangDict[successParam]) {
                msgBox.className = "mt-4 text-xs font-bold text-center text-emerald-400 bg-emerald-500/10 p-2.5 rounded-xl border border-emerald-500/20";
                msgBox.innerText = currentLangDict[successParam];
            } else if (statusParam && currentLangDict[statusParam]) {
                msgBox.className = "mt-4 text-xs font-bold text-center text-emerald-400 bg-emerald-500/10 p-2.5 rounded-xl border border-emerald-500/20";
                msgBox.innerText = currentLangDict[statusParam];
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            const savedLang = localStorage.getItem('caspian_lang') || 'en';
            setLanguage(savedLang);

            const urlParams = new URLSearchParams(window.location.search);
            displayMessage(urlParams.get('error'), urlParams.get('success'), urlParams.get('status'), savedLang);
        });

        // ===== Qeydiyyat formu üçün dərhal (client-side) yoxlama =====
        // QEYD: Bu yalnız istifadəçi təcrübəsi üçündür. Əsl qorunma serverdə (process.php + validators.php) baş verir,
        // çünki client-side yoxlama həmişə keçilə (bypass) bilər.
        function hasObviouslyFakePhonePattern(digits) {
            // Eyni rəqəmin 4+ dəfə ardıcıl təkrarı
            if (/(\d)\1{3,}/.test(digits)) return true;
            // Ardıcıl artan/azalan seriya (5+ uzunluq)
            const ascending = '01234567890123456789';
            const descending = '98765432109876543210';
            for (let len = Math.min(digits.length, 10); len >= 5; len--) {
                for (let i = 0; i <= digits.length - len; i++) {
                    const chunk = digits.slice(i, i + len);
                    if (ascending.includes(chunk) || descending.includes(chunk)) return true;
                }
            }
            return false;
        }

        function isValidIntlPhoneClient(phone) {
            const digits = (phone || '').replace(/\D/g, '');
            // E.164: ölkə kodu daxil 7-15 rəqəm, ilk rəqəm 0 ola bilməz
            if (digits.length < 7 || digits.length > 15) return false;
            if (digits[0] === '0') return false;
            if (hasObviouslyFakePhonePattern(digits)) return false;
            return true;
        }

        const fakeEmailKeywordsClient = ['test', 'admin', 'asdf', 'fake', 'spam', 'noreply', 'sample', 'dummy', 'trial', 'example', 'qwerty', 'demo', 'temp', 'user'];
        function isObviouslyFakeEmailClient(email) {
            const at = (email || '').indexOf('@');
            if (at < 3) return true;
            const local = email.slice(0, at).toLowerCase();
            if (fakeEmailKeywordsClient.includes(local)) return true;
            for (const kw of fakeEmailKeywordsClient) {
                if (new RegExp('^' + kw + '\\d{0,4}$').test(local)) return true;
            }
            if (/^(.)\1{3,}$/.test(local)) return true;
            return false;
        }

        function validateRegisterForm(e, lang) {
            const form = e.target;
            const phone = form.querySelector('[name="phone"]').value;
            const email = form.querySelector('[name="email"]').value;

            if (!isValidIntlPhoneClient(phone)) {
                e.preventDefault();
                displayMessage('invalid_phone', null, null, lang);
                return false;
            }
            if (isObviouslyFakeEmailClient(email)) {
                e.preventDefault();
                displayMessage('fake_email', null, null, lang);
                return false;
            }
            return true;
        }

        ['az', 'en', 'ru', 'ar'].forEach(lang => {
            const form = document.getElementById(`form-register-${lang}`);
            if (form) {
                form.addEventListener('submit', (e) => validateRegisterForm(e, lang));
            }
        });
    </script>
</body>
</html>