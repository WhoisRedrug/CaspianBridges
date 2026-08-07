<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'csrf.php';
$isLoggedIn = isset($_SESSION['user_id']) ? 'true' : 'false';
?>
<script>
    window.isUserLoggedIn = <?php echo $isLoggedIn; ?>;
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Application | Caspian Bridges</title>
    <meta property="og:type" content="website">
    <meta property="og:title" content="Caspian Bridges — Application Portal">
    <meta property="og:description" content="Apply for Visa, Education, Investment, and Travel solutions in Azerbaijan.">
    <meta property="og:image" content="images/svgviewer-png-1.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="component.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(12, 35, 31, 0.85); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .hero-bg { background: radial-gradient(circle at 50% 0%, #0f3831 0%, #061412 60%, #020a09 100%); }
        .glass-nav { background: rgba(6, 20, 18, 0.85); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.08); }
    </style>
</head>
<body class="bg-[#061412] text-slate-100 antialiased selection:bg-emerald-400 selection:text-slate-950 min-h-screen">
    <div id="header-container"></div>

    <section class="hero-bg pt-32 pb-20 px-6 min-h-screen flex items-center justify-center relative overflow-hidden">
        <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none"></div>
        <div class="w-full max-w-2xl glass-card p-8 sm:p-10 rounded-3xl shadow-2xl relative z-10 border border-slate-800">
            
            <!-- Tək Form Konteyneri -->
            <form id="application-form" method="POST" class="space-y-5">
                <input type="hidden" name="action" value="apply">
                <?php echo csrf_field(); ?>

                <!-- ================= AZERBAIJANI (AZ) ================= -->
                <div data-lang="az" class="text-left space-y-5">
                    <div class="text-center mb-8">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold mb-3"> ⚡ Sürətli və Təhlükəsiz Müraciət </span>
                        <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight"> Müraciətə <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">Başlayın</span> </h1>
                        <p class="text-slate-400 text-xs sm:text-sm mt-2"> Zəhmət olmasa formanı doldurun. Mütəxəssislərimiz 24 saat ərzində sizinlə əlaqə saxlayacaqlar. </p>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">Ad</label>
                            <input type="text" name="firstname" placeholder="Elvin" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">Soyad</label>
                            <input type="text" name="lastname" placeholder="Məmmədov" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition">
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">E-poçt Ünvanı</label>
                            <input type="email" name="email" placeholder="elvin@example.com" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">Telefon / WhatsApp</label>
                            <input type="tel" name="phone" placeholder="+994 50 000 00 00" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition">
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">Hədəf Xidmət</label>
                        <select name="service" class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500 transition">
                            <option value="Visa Services">🛂 Viza Xidmətləri (Visa)</option>
                            <option value="Education">🎓 Təhsil (Education)</option>
                            <option value="Investment">📈 İnvestisiya (Invest)</option>
                            <option value="Travel">✈️ Turizm (Travel)</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">Əlavə Məlumat (İstəyə bağlı)</label>
                        <textarea name="message" rows="3" placeholder="Təhsil, viza, investisiya və ya səyahət planlarınız barədə qısaca yazın..." class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition resize-none"></textarea>
                    </div>
                </div>

                <!-- ================= ENGLISH (EN) ================= -->
                <div data-lang="en" class="hidden text-left space-y-5">
                    <div class="text-center mb-8">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold mb-3"> ⚡ Fast & Secure Application </span>
                        <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight"> Start Your <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">Application</span> </h1>
                        <p class="text-slate-400 text-xs sm:text-sm mt-2"> Please fill out the form below. Our specialists will review your details within 24 hours. </p>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">First Name</label>
                            <input type="text" name="firstname" placeholder="John" class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">Last Name</label>
                            <input type="text" name="lastname" placeholder="Doe" class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition">
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">Email Address</label>
                            <input type="email" name="email" placeholder="john@example.com" class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">Phone / WhatsApp</label>
                            <input type="tel" name="phone" placeholder="+1 (555) 000-0000" class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition">
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">Target Service</label>
                        <select name="service" class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500 transition">
                            <option value="Visa Services">🛂 Visa Services</option>
                            <option value="Education">🎓 Education (Study)</option>
                            <option value="Investment">📈 Investment (Invest)</option>
                            <option value="Travel">✈️ Travel & Tourism</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">Additional Information (Optional)</label>
                        <textarea name="message" rows="3" placeholder="Tell us about your requirements..." class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition resize-none"></textarea>
                    </div>
                </div>

                <!-- ================= RUSSIAN (RU) ================= -->
                <div data-lang="ru" class="hidden text-left space-y-5">
                    <div class="text-center mb-8">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold mb-3"> ⚡ Быстрая заявка </span>
                        <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight"> Начать <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">Заявку</span> </h1>
                        <p class="text-slate-400 text-xs sm:text-sm mt-2"> Заполните форму ниже. </p>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">Имя</label>
                            <input type="text" name="firstname" placeholder="Иван" class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">Фамилия</label>
                            <input type="text" name="lastname" placeholder="Иванов" class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition">
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">Электронная почта</label>
                            <input type="email" name="email" placeholder="ivan@example.com" class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">Телефон</label>
                            <input type="tel" name="phone" placeholder="+7 (999) 000-00-00" class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition">
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">Целевая услуга</label>
                        <select name="service" class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500 transition">
                            <option value="Visa Services">🛂 Визовые услуги</option>
                            <option value="Education">🎓 Образование</option>
                            <option value="Investment">📈 Инвестиции</option>
                            <option value="Travel">✈️ Туризм</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">Информация</label>
                        <textarea name="message" rows="3" placeholder="Информация..." class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition resize-none"></textarea>
                    </div>
                </div>

                <!-- ================= ARABIC (AR) ================= -->
                <div data-lang="ar" class="hidden text-right space-y-5">
                    <div class="text-center mb-8">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold mb-3"> ⚡ طلب سريع وآمن </span>
                        <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight"> ابدأ <span class="bg-gradient-to-r from-emerald-400 via-amber-300 to-amber-500 text-transparent bg-clip-text">طلبك</span> </h1>
                        <p class="text-slate-400 text-xs sm:text-sm mt-2"> يرجى تعبئة النموذج أدناه. </p>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">الاسم الأول</label>
                            <input type="text" name="firstname" placeholder="محمد" class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition text-right">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">اسم العائلة</label>
                            <input type="text" name="lastname" placeholder="الأحمد" class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition text-right">
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">البريد الإلكتروني</label>
                            <input type="email" name="email" placeholder="mohammed@example.com" class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition text-right">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">الهاتف</label>
                            <input type="tel" name="phone" placeholder="+966 50 000 0000" class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition text-right">
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">الخدمة المستهدفة</label>
                        <select name="service" class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500 transition text-right">
                            <option value="Visa Services">🛂 خدمات التأشيرات</option>
                            <option value="Education">🎓 التعليم</option>
                            <option value="Investment">📈 الاستثمار</option>
                            <option value="Travel">✈️ السياحة</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5">معلومات إضافية</label>
                        <textarea name="message" rows="3" placeholder="معلومات..." class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition resize-none text-right"></textarea>
                    </div>
                </div>

                <!-- Ümumi reCAPTCHA və Göndərmə Düyməsi -->
                <div class="pt-4 flex flex-col items-center">
                    <div class="g-recaptcha mb-4" data-sitekey="6LdGe3ItAAAAAO9Kh2b3fSv7FXaHDh17S1DN_ePn"></div>
                    <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black py-4 rounded-xl text-sm transition shadow-lg shadow-emerald-500/20"> Müraciəti İndi Göndər / Submit → </button>
                </div>
            </form>
        </div>
    </section>

    <div id="footer-container"></div>

<script>
    document.getElementById('application-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Aktiv dili tapırıq
        let currentLang = 'en';
        document.querySelectorAll('[data-lang]').forEach(el => {
            if (!el.classList.contains('hidden')) {
                currentLang = el.getAttribute('data-lang');
            }
        });

        // Yalnız aktiv olan dildəki inputların required yoxlamasını aktiv edirik, gizli olanları söndürürük
        document.querySelectorAll('[data-lang]').forEach(el => {
            const inputs = el.querySelectorAll('input, select, textarea');
            if (el.getAttribute('data-lang') === currentLang) {
                inputs.forEach(input => {
                    if (input.name === 'firstname' || input.name === 'lastname' || input.name === 'email' || input.name === 'phone') {
                        input.setAttribute('required', 'required');
                    }
                });
            } else {
                inputs.forEach(input => {
                    input.removeAttribute('required');
                });
            }
        });

        const formData = new FormData(this);
        formData.append('lang', currentLang);

        fetch('process.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            const formContainer = document.getElementById('application-form');
            if (data.trim() === 'success') {
                const successTexts = {
                    'az': { title: 'Müraciətiniz uğurla göndərildi!', desc: 'Müraciətinizin statusunu profil səhifənizdən izləyə bilərsiniz.', btn: 'Profilə Keç →' },
                    'en': { title: 'Application submitted successfully!', desc: 'You can track the status of your application from your profile page.', btn: 'Go to Profile →' },
                    'ru': { title: 'Заявка успешно отправлена!', desc: 'Вы можете отслеживать статус вашей заявки в личном кабинете.', btn: 'В профиль →' },
                    'ar': { title: 'تم إرسال الطلب بنجاح!', desc: 'يمكنك تتبع حالة طلبك من صفحة ملفك الشخصي.', btn: '← اذهب إلى الملف الشخصي' }
                };
                const t = successTexts[currentLang] || successTexts['en'];

                formContainer.innerHTML = `
                    <div class="text-center py-10 space-y-4">
                        <div class="w-16 h-16 bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 rounded-full flex items-center justify-center mx-auto text-2xl font-bold">✓</div>
                        <h3 class="text-2xl font-bold text-white">${t.title}</h3>
                        <p class="text-slate-400 text-sm">${t.desc}</p>
                        <a href="profile" class="inline-block bg-emerald-500 text-slate-950 font-bold px-6 py-3 rounded-xl text-sm transition hover:bg-emerald-400">${t.btn}</a>
                    </div>
                `;
            } else if (data.trim() === 'not_logged_in') {
                const loginTexts = {
                    'az': { title: 'Giriş Tələb Olunur', desc: 'Müraciət göndərmək üçün əvvəlcə sistemə daxil olmalısınız.', btn: 'Daxil Ol', retry: 'Yenidən cəhd et' },
                    'en': { title: 'Login Required', desc: 'You must log in first to submit an application.', btn: 'Sign In', retry: 'Try Again' },
                    'ru': { title: 'Требуется вход', desc: 'Вы должны войти в систему.', btn: 'Войти', retry: 'Повторить' },
                    'ar': { title: 'تسجيل الدخول مطلوب', desc: 'يجب عليك تسجيل الدخول أولاً.', btn: 'تسجيل الدخول', retry: 'حاول مرة أخرى' }
                };
                const l = loginTexts[currentLang] || loginTexts['en'];

                formContainer.innerHTML = `
                    <div class="text-center py-8 space-y-4 bg-amber-500/10 border border-amber-500/30 rounded-2xl p-6">
                        <div class="w-12 h-12 bg-amber-500/20 text-amber-400 rounded-full flex items-center justify-center mx-auto text-xl font-bold">!</div>
                        <h3 class="text-xl font-bold text-white">${l.title}</h3>
                        <p class="text-slate-300 text-sm">${l.desc}</p>
                        <div class="flex justify-center gap-4 pt-2">
                            <a href="login" class="bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold px-6 py-3 rounded-xl text-sm transition">${l.btn}</a>
                            <a href="apply" class="bg-slate-800 hover:bg-slate-700 text-white font-semibold px-4 py-3 rounded-xl text-sm transition">${l.retry}</a>
                        </div>
                    </div>
                `;
            } else {
                const errorTexts = {
                    'az': { title: 'Xəta baş verdi', desc: 'Zəhmət olmasa səhifəni yeniləyib yenidən cəhd edin.', btn: 'Yenilə' },
                    'en': { title: 'An Error Occurred', desc: 'Please refresh the page and try again.', btn: 'Refresh' },
                    'ru': { title: 'Произошла ошибка', desc: 'Пожалуйста, обновите страницу.', btn: 'Обновить' },
                    'ar': { title: 'حدث خطأ', desc: 'يرجى تحديث الصفحة.', btn: 'تحديث' }
                };
                const err = errorTexts[currentLang] || errorTexts['en'];

                formContainer.innerHTML = `
                    <div class="text-center py-8 space-y-4 bg-red-500/10 border border-red-500/30 rounded-2xl p-6">
                        <h3 class="text-xl font-bold text-white">${err.title}</h3>
                        <p class="text-slate-300 text-sm">${err.desc}</p>
                        <a href="apply" class="inline-block bg-slate-800 hover:bg-slate-700 text-white font-semibold px-6 py-3 rounded-xl text-sm transition">${err.btn}</a>
                    </div>
                `;
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
</body>
</html>