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
        <div class="w-full max-w-2xl glass-card p-8 sm:p-10 rounded-3xl shadow-2xl relative z-10 border border-slate-800" id="apply-outer">

            <!-- Başlıq -->
            <div class="text-center mb-8" id="apply-header">
                <h1 class="text-2xl sm:text-3xl font-black text-white" data-az="Müraciət Formu" data-en="Application Form" data-ru="Форма заявки" data-ar="نموذج الطلب">Application Form</h1>
                <p class="text-slate-400 text-xs sm:text-sm mt-2" data-az="Zəhmət olmasa formu doldurun, komandamız qısa müddətdə sizinlə əlaqə saxlayacaq." data-en="Please fill out the form below, our team will contact you shortly." data-ru="Пожалуйста, заполните форму, наша команда свяжется с вами в ближайшее время." data-ar="يرجى تعبئة النموذج أدناه، سيتواصل معك فريقنا قريبًا.">Please fill out the form below, our team will contact you shortly.</p>
            </div>

            <!-- TƏK Forma Konteyneri (bütün dillər üçün ortaq inputlar, yalnız mətnlər dəyişir) -->
            <form id="application-form" method="POST" class="space-y-5">
                <input type="hidden" name="action" value="apply">
                <?php echo csrf_field(); ?>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5" data-az="Ad" data-en="First Name" data-ru="Имя" data-ar="الاسم الأول">First Name</label>
                        <input type="text" name="firstname" required
                               data-az="Elvin" data-en="John" data-ru="Иван" data-ar="محمد"
                               class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5" data-az="Soyad" data-en="Last Name" data-ru="Фамилия" data-ar="اسم العائلة">Last Name</label>
                        <input type="text" name="lastname" required
                               data-az="Məmmədov" data-en="Doe" data-ru="Иванов" data-ar="الأحمد"
                               class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition">
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5" data-az="E-poçt" data-en="Email Address" data-ru="Электронная почта" data-ar="البريد الإلكتروني">Email Address</label>
                        <input type="email" name="email" required
                               data-az="elvin@example.com" data-en="john@example.com" data-ru="ivan@example.com" data-ar="mohammed@example.com"
                               class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5" data-az="Telefon" data-en="Phone Number" data-ru="Телефон" data-ar="الهاتف">Phone Number</label>
                        <input type="tel" name="phone" required
                               data-az="+994 50 000 00 00" data-en="+1 (555) 000-0000" data-ru="+7 (999) 000-00-00" data-ar="+966 50 000 0000"
                               class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition">
                    </div>
                </div>

                <div>
                    <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5" data-az="Hədəf Xidmət" data-en="Target Service" data-ru="Услуга" data-ar="الخدمة المستهدفة">Target Service</label>
                    <select name="service" class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500 transition">
                        <option value="Visa Services" data-az="🛂 Viza Xidmətləri" data-en="🛂 Visa Services" data-ru="🛂 Визовые услуги" data-ar="🛂 خدمات التأشيرات">🛂 Visa Services</option>
                        <option value="Education" data-az="🎓 Təhsil" data-en="🎓 Education" data-ru="🎓 Образование" data-ar="🎓 التعليم">🎓 Education</option>
                        <option value="Investment" data-az="📈 İnvestisiya" data-en="📈 Investment" data-ru="📈 Инвестиции" data-ar="📈 الاستثمار">📈 Investment</option>
                        <option value="Travel" data-az="✈️ Səyahət" data-en="✈️ Travel" data-ru="✈️ Туризм" data-ar="✈️ السياحة">✈️ Travel</option>
                    </select>
                </div>

                <div>
                    <label class="text-xs font-bold text-slate-300 uppercase block mb-1.5" data-az="Əlavə Məlumat" data-en="Additional Information" data-ru="Дополнительная информация" data-ar="معلومات إضافية">Additional Information</label>
                    <textarea name="message" rows="3"
                              data-az="Təhsil, viza, investisiya və ya səyahət planlarınız barədə qısaca yazın..." data-en="Tell us about your requirements..." data-ru="Информация..." data-ar="معلومات..."
                              class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition resize-none"></textarea>
                </div>

                <div class="pt-4 flex flex-col items-center">
                    <div class="g-recaptcha mb-4" data-sitekey="6LdGe3ItAAAAAO9Kh2b3fSv7FXaHDh17S1DN_ePn"></div>
                    <button type="submit" id="apply-submit-btn"
                            class="w-full bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black py-4 rounded-xl text-sm transition shadow-lg shadow-emerald-500/20"
                            data-az="Müraciəti İndi Göndər →" data-en="Submit Application Now →" data-ru="Отправить заявку →" data-ar="← أرسل الطلب الآن">
                        Submit Application Now →
                    </button>
                </div>
            </form>
        </div>
    </section>

    <div id="footer-container"></div>

<script>
    // ===== Formun dilini müəyyən edib mətnləri (label/placeholder/option/düymə) tərcümə edən yardımçı =====
    function currentSiteLang() {
        return localStorage.getItem('selectedLang') || 'az';
    }

    function translateApplyForm(lang) {
        const scope = document.getElementById('apply-outer');
        if (!scope) return;

        scope.querySelectorAll('[data-az][data-en][data-ru][data-ar]').forEach(el => {
            const text = el.getAttribute(`data-${lang}`);
            if (text === null) return;
            if ((el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') && (el.hasAttribute('placeholder') || el.tagName === 'TEXTAREA' || el.type === 'text' || el.type === 'email' || el.type === 'tel')) {
                el.setAttribute('placeholder', text);
            } else {
                el.textContent = text;
            }
        });

        scope.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr');
        scope.classList.toggle('text-right', lang === 'ar');
    }

    // Səhifə yüklənəndə cari dilə uyğun tərcümə et
    document.addEventListener('DOMContentLoaded', function () {
        translateApplyForm(currentSiteLang());

        // Naviqasiya menyusundakı dil seçicisi dəyişdikdə formu da yenilə
        // (component.js header-i asinxron yaratdığı üçün bir az gözləyib bağlayırıq)
        const bindLangSelectors = () => {
            document.querySelectorAll('#languageSelect, #languageSelectMobile').forEach(sel => {
                if (sel.dataset.applyBound) return;
                sel.dataset.applyBound = '1';
                sel.addEventListener('change', () => translateApplyForm(sel.value));
            });
        };
        bindLangSelectors();
        setTimeout(bindLangSelectors, 300);
        setTimeout(bindLangSelectors, 1000);
    });

    // ===== Forma göndərmə məntiqi =====
    const applyForm = document.getElementById('application-form');
    if (applyForm) {
        applyForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const currentLang = currentSiteLang();
            const submitBtn = document.getElementById('apply-submit-btn');
            const originalBtnText = submitBtn ? submitBtn.textContent : '';
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = { az: 'Göndərilir...', en: 'Submitting...', ru: 'Отправка...', ar: 'جارٍ الإرسال...' }[currentLang] || 'Submitting...';
            }

            const formData = new FormData(this);
            formData.append('lang', currentLang);

            // ÖNƏMLİ: "process.php" yox, "process" (uzantısız) çağırılır — .htaccess
            // .php sorğularını 301 ilə uzantısız URL-ə yönləndirir, bu da POST metodunu
            // GET-ə çevirib bütün forma məlumatlarını itirirdi.
            fetch('process', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                const formContainer = document.getElementById('apply-outer');
                const result = data.trim();

                if (result === 'success') {
                    const successTexts = {
                        az: { badge: 'Qeydə Alındı', status: '⏳ Gözləmədədir', title: 'Müraciətiniz Uğurla Göndərildi!', desc: 'Müraciətiniz artıq sistemimizdə qeydə alınıb. Komandamız qısa müddətdə onu nəzərdən keçirəcək — statusunu istənilən vaxt profil səhifənizdən izləyə bilərsiniz.', note: 'Hər xidmət üçün yalnız bir aktiv müraciət kifayətdir — təkrar göndərməyə ehtiyac yoxdur.', btn: 'Profilə Keç →', home: 'Ana Səhifə' },
                        en: { badge: 'On File', status: '⏳ Pending', title: 'Application Submitted Successfully!', desc: 'Your application is now on file with us. Our team will review it shortly — you can track its status anytime from your profile page.', note: 'One active application per service is enough — no need to submit again.', btn: 'Go to Profile →', home: 'Home' },
                        ru: { badge: 'Зарегистрировано', status: '⏳ В ожидании', title: 'Заявка Успешно Отправлена!', desc: 'Ваша заявка уже зарегистрирована в нашей системе. Наша команда рассмотрит её в ближайшее время — статус можно отслеживать в личном кабинете.', note: 'Достаточно одной активной заявки на услугу — повторно отправлять не нужно.', btn: 'В профиль →', home: 'Главная' },
                        ar: { badge: 'تم التسجيل', status: '⏳ قيد الانتظار', title: 'تم إرسال طلبك بنجاح!', desc: 'طلبك الآن مسجّل لدينا. سيقوم فريقنا بمراجعته قريبًا — يمكنك متابعة حالته في أي وقت من صفحة ملفك الشخصي.', note: 'يكفي طلب واحد نشط لكل خدمة — لا حاجة لإعادة الإرسال.', btn: '← اذهب إلى الملف الشخصي', home: 'الرئيسية' }
                    };
                    const t = successTexts[currentLang] || successTexts.en;
                    const rtl = currentLang === 'ar';

                    formContainer.innerHTML = `
                        <div class="text-center py-6 space-y-5 ${rtl ? 'text-right' : ''}">
                            <div class="relative w-20 h-20 mx-auto">
                                <div class="absolute inset-0 rounded-full bg-emerald-500/20 blur-xl"></div>
                                <div class="relative w-20 h-20 bg-emerald-500/15 border-2 border-emerald-500/40 text-emerald-400 rounded-full flex items-center justify-center mx-auto text-3xl font-bold">✓</div>
                            </div>
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-[11px] font-bold">${t.badge}</div>
                            <h3 class="text-2xl font-black text-white">${t.title}</h3>
                            <p class="text-slate-400 text-sm max-w-md mx-auto leading-relaxed">${t.desc}</p>
                            <div class="inline-block px-3 py-1.5 rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20 text-[11px] font-bold">${t.status}</div>
                            <p class="text-slate-500 text-xs max-w-sm mx-auto">${t.note}</p>
                            <div class="flex items-center justify-center gap-4 pt-2">
                                <a href="profile" class="inline-block bg-gradient-to-r from-emerald-500 to-emerald-400 text-slate-950 font-black px-6 py-3 rounded-xl text-sm transition hover:from-emerald-400 hover:to-emerald-300 shadow-lg shadow-emerald-500/20">${t.btn}</a>
                                <a href="index" class="inline-block bg-slate-800/80 hover:bg-slate-700 text-white font-semibold px-5 py-3 rounded-xl text-sm transition">${t.home}</a>
                            </div>
                        </div>
                    `;
                } else if (result === 'not_logged_in') {
                    const loginTexts = {
                        az: { title: 'Giriş Tələb Olunur', desc: 'Müraciət göndərmək üçün əvvəlcə sistemə daxil olmalısınız.', btn: 'Daxil Ol', retry: 'Yenidən cəhd et' },
                        en: { title: 'Login Required', desc: 'You must log in first to submit an application.', btn: 'Sign In', retry: 'Try Again' },
                        ru: { title: 'Требуется вход', desc: 'Вы должны войти в систему.', btn: 'Войти', retry: 'Повторить' },
                        ar: { title: 'تسجيل الدخول مطلوب', desc: 'يجب عليك تسجيل الدخول أولاً.', btn: 'تسجيل الدخول', retry: 'حاول مرة أخرى' }
                    };
                    const l = loginTexts[currentLang] || loginTexts.en;
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
                        az: { title: 'Xəta baş verdi', desc: 'Zəhmət olmasa səhifəni yeniləyib yenidən cəhd edin.', btn: 'Yenilə' },
                        en: { title: 'An Error Occurred', desc: 'Please refresh the page and try again.', btn: 'Refresh' },
                        ru: { title: 'Произошла ошибка', desc: 'Пожалуйста, обновите страницу.', btn: 'Обновить' },
                        ar: { title: 'حدث خطأ', desc: 'يرجى تحديث الصفحة.', btn: 'تحديث' }
                    };
                    const err = errorTexts[currentLang] || errorTexts.en;
                    formContainer.innerHTML = `
                        <div class="text-center py-8 space-y-4 bg-red-500/10 border border-red-500/30 rounded-2xl p-6">
                            <h3 class="text-xl font-bold text-white">${err.title}</h3>
                            <p class="text-slate-300 text-sm">${err.desc}</p>
                            <a href="apply" class="inline-block bg-slate-800 hover:bg-slate-700 text-white font-semibold px-6 py-3 rounded-xl text-sm transition">${err.btn}</a>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Apply form error:', error);
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalBtnText;
                }
            });
        });
    }
</script>
</body>
</html>