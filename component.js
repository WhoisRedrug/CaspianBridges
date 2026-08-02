(function() {
    const link = document.createElement('link');
    link.icon = true;
    link.rel = 'icon';
    link.type = 'image/png';
    link.href = 'images/logo.png.png';
    document.head.appendChild(link);
})();

function changeLanguage(lang) {
    localStorage.setItem('selectedLang', lang);
    
    if (lang === 'ar') {
        document.documentElement.setAttribute('dir', 'rtl');
    } else {
        document.documentElement.setAttribute('dir', 'ltr');
    }
    
    document.querySelectorAll('[data-lang]').forEach(el => {
        if (el.getAttribute('data-lang') === lang) {
            el.classList.remove('hidden');
        } else {
            el.classList.add('hidden');
        }
    });

    document.querySelectorAll('[data-az][data-en][data-ru][data-ar]').forEach(el => {
        const text = el.getAttribute(`data-${lang}`);
        if (text) {
            if (el.tagName === 'INPUT' && el.hasAttribute('placeholder')) {
                el.placeholder = text;
            } else {
                el.textContent = text;
            }
        }
    });

    const langSelect = document.getElementById('languageSelect');
    if (langSelect) langSelect.value = lang;
    const langSelectMobile = document.getElementById('languageSelectMobile');
    if (langSelectMobile) langSelectMobile.value = lang;
}

document.addEventListener("DOMContentLoaded", function () {
    const headerContainer = document.getElementById("header-container");
    if (headerContainer) {
        headerContainer.innerHTML = `
            <nav class="fixed top-0 left-0 right-0 z-50 glass-nav transition-all duration-300 bg-[#061412]/85 backdrop-blur-md border-b border-slate-800">
                <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
                    <a href="index" class="flex items-center gap-3 group">
                        <img src="images/logo.png.png" alt="Caspian Bridges Logo" class="w-10 h-10 object-contain rounded-xl group-hover:scale-105 transition shadow-lg">
                        <div>
                            <span class="text-lg font-black tracking-wider text-white block leading-none">CASPIAN BRIDGES</span>
                            <span class="text-[10px] uppercase tracking-widest text-amber-400 font-semibold block mt-1">Baku • Global Gateway</span>
                        </div>
                    </a>

                    <div class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-300">
                        <a href="index" class="hover:text-amber-400 transition" data-az="Ana Səhifə" data-en="Home" data-ru="Главная" data-ar="الرئيسية">Home</a>
                        <a href="services" class="hover:text-amber-400 transition" data-az="Xidmətlər" data-en="Services" data-ru="Услуги" data-ar="الخدمات">Services</a>
                        <a href="about" class="hover:text-amber-400 transition" data-az="Haqqımızda" data-en="About Us" data-ru="О нас" data-ar="من نحن">About Us</a>
                        <a href="contact" class="hover:text-amber-400 transition" data-az="Əlaqə" data-en="Contact" data-ru="Контакты" data-ar="اتصل بنا">Contact</a>
                    </div>

                    <div class="hidden md:flex items-center gap-4">
                        <select id="languageSelect" onchange="changeLanguage(this.value)" class="bg-[#0b2420] text-emerald-400 border border-emerald-500/35 rounded-xl px-2.5 py-1.5 text-xs font-bold outline-none cursor-pointer">
                            <option value="az">AZ</option>
                            <option value="en">EN</option>
                            <option value="ru">RU</option>
                            <option value="ar">AR</option>
                        </select>
                        <div id="desktop-auth-slot"></div>
                        <a href="apply" class="bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 hover:to-yellow-400 text-slate-950 font-extrabold px-5 py-2.5 rounded-xl text-xs shadow-lg transition hover:scale-105" data-az="Müraciət Et" data-en="Apply Now" data-ru="Подать заявку" data-ar="قدم الآن">Apply Now</a>
                    </div>

                    <button id="mobile-menu-btn" class="md:hidden text-white text-2xl focus:outline-none">☰</button>
                </div>

                <div id="mobile-menu" class="hidden md:hidden bg-[#061412] border-b border-slate-800 px-6 py-6 space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b border-slate-800">
                        <span class="text-xs text-slate-400 font-bold" data-az="Dil / Language:" data-en="Language / Dil:" data-ru="Язык / Language:" data-ar="اللغة:">Language / Dil:</span>
                        <select id="languageSelectMobile" onchange="changeLanguage(this.value)" class="bg-[#0b2420] text-emerald-400 border border-emerald-500/35 rounded-xl px-3 py-1 text-xs font-bold outline-none">
                            <option value="az">AZ</option>
                            <option value="en">EN</option>
                            <option value="ru">RU</option>
                            <option value="ar">AR</option>
                        </select>
                    </div>
                    <a href="index" class="block text-slate-300 font-semibold hover:text-amber-400" data-az="Ana Səhifə" data-en="Home" data-ru="Главная" data-ar="الرئيسية">Home</a>
                    <a href="services" class="block text-slate-300 font-semibold hover:text-amber-400" data-az="Xidmətlər" data-en="Services" data-ru="Услуги" data-ar="الخدمات">Services</a>
                    <a href="about" class="block text-slate-300 font-semibold hover:text-amber-400" data-az="Haqqımızda" data-en="About Us" data-ru="О нас" data-ar="من نحن">About Us</a>
                    <a href="contact" class="block text-slate-300 font-semibold hover:text-amber-400" data-az="Əlaqə" data-en="Contact" data-ru="Контакты" data-ar="اتصل بنا">Contact</a>
                    <div class="pt-2 flex flex-col gap-2">
                        <div id="mobile-auth-slot"></div>
                        <a href="apply" class="block text-center bg-amber-500 text-slate-950 font-bold py-3 rounded-xl text-xs shadow-lg" data-az="Müraciət Et" data-en="Apply Now" data-ru="Подать заявку" data-ar="قدم الآن">Apply Now</a>
                    </div>
                </div>
            </nav>
        `;

        const desktopAuth = document.getElementById('desktop-auth-slot');
        const mobileAuth = document.getElementById('mobile-auth-slot');
        
        // Session check (window.isUserLoggedIn is already defined in apply.php and other files)
        if (typeof window.isUserLoggedIn !== 'undefined' && window.isUserLoggedIn === true) {
            if (desktopAuth) {
                desktopAuth.innerHTML = `<a href="profile" class="bg-amber-500/10 border border-amber-500/30 text-amber-400 px-4 py-2 rounded-xl text-xs font-bold hover:bg-amber-500/20 transition" data-az="👤 Profilim" data-en="👤 My Profile" data-ru="👤 Мой профиль" data-ar="👤 ملفي الشخصي">👤 Profilim</a>`;
            }
            if (mobileAuth) {
                mobileAuth.innerHTML = `<a href="profile" class="block text-center bg-amber-500/10 border border-amber-500/30 text-amber-400 font-bold py-2.5 rounded-xl text-xs" data-az="👤 Profilim" data-en="👤 My Profile" data-ru="👤 Мой профиль" data-ar="👤 ملفي الشخصي">👤 Profilim</a>`;
            }
        } else {
            if (desktopAuth) {
                desktopAuth.innerHTML = `<a href="login" class="text-xs font-bold text-slate-300 hover:text-amber-400 transition px-2 py-2" data-az="Daxil ol" data-en="Sign In" data-ru="Войти" data-ar="تسجيل الدخول">Sign In</a>`;
            }
            if (mobileAuth) {
                mobileAuth.innerHTML = `<a href="login" class="block text-center bg-slate-800 text-amber-400 font-bold py-2.5 rounded-xl text-xs" data-az="Daxil ol" data-en="Sign In" data-ru="Войти" data-ar="تسجيل الدخول">Sign In</a>`;
            }
        }

        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
        }
    }

    const footerContainer = document.getElementById("footer-container");
    if (footerContainer) {
        footerContainer.innerHTML = `
            <footer class="bg-[#040d0b] border-t border-slate-800 pt-16 pb-12 px-6 text-slate-400 text-sm">
                <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <img src="images/logo.png.png" alt="Logo" class="w-8 h-8 object-contain rounded-lg">
                            <span class="text-white font-black tracking-wider text-base">CASPIAN BRIDGES</span>
                        </div>
                        <p class="text-xs leading-relaxed text-slate-400" data-az="Bakı, Azərbaycan üzrə təhsil qəbulu, hüquqi yaşayış və elit turizm həllərini birləşdiririk." data-en="Connecting opportunities, education admissions, legal residency, and elite tourism solutions in Baku, Azerbaijan." data-ru="Объединяем возможности, поступление в вузы, легальное проживание и элитный туризм в Баку, Азербайджан." data-ar="ربط الفرص، القبول التعليمي، الإقامة القانونية، وحلول السياحة الفاخرة في باكو، أذربيجان.">Connecting opportunities, education admissions, legal residency, and elite tourism solutions in Baku, Azerbaijan.</p>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-xs uppercase tracking-widest mb-4" data-az="Sürətli Keçidlər" data-en="Quick Links" data-ru="Быстрые ссылки" data-ar="روابط سريعة">Quick Links</h4>
                        <ul class="space-y-2 text-xs">
                            <li><a href="index" class="hover:text-amber-400 transition" data-az="Ana Səhifə" data-en="Home Portal" data-ru="Главная" data-ar="الرئيسية">Home Portal</a></li>
                            <li><a href="services" class="hover:text-amber-400 transition" data-az="Xidmətlərimiz" data-en="Our Services" data-ru="Наши услуги" data-ar="خدماتنا">Our Services</a></li>
                            <li><a href="about" class="hover:text-amber-400 transition" data-az="Şirkət Haqqında" data-en="About Company" data-ru="О компании" data-ar="عن الشركة">About Company</a></li>
                            <li><a href="contact" class="hover:text-amber-400 transition" data-az="Bizimlə Əlaqə" data-en="Contact Us" data-ru="Связаться с нами" data-ar="اتصل بنا">Contact Us</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-xs uppercase tracking-widest mb-4" data-az="Xidmətlər" data-en="Services" data-ru="Услуги" data-ar="الخدمات">Services</h4>
                        <ul class="space-y-2 text-xs">
                            <li><a href="services" class="hover:text-amber-400 transition" data-az="Universitet Qəbulu" data-en="University Admissions" data-ru="Поступление в вузы" data-ar="القبول الجامعي">University Admissions</a></li>
                            <li><a href="services" class="hover:text-amber-400 transition" data-az="E-Viza və Sənədlər" data-en="e-Visa & Documents" data-ru="Электронная виза и документы" data-ar="التأشيرة الإلكترونية والمستندات">e-Visa & Documents</a></li>
                            <li><a href="services" class="hover:text-amber-400 transition" data-az="Yaşayış və Mənzil" data-en="Accommodation" data-ru="Проживание" data-ar="السكن">Accommodation</a></li>
                            <li><a href="services" class="hover:text-amber-400 transition" data-az="Lüks Turizm" data-en="Luxury Tourism" data-ru="Элитный туризм" data-ar="السياحة الفاخرة">Luxury Tourism</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-xs uppercase tracking-widest mb-4" data-az="Rəsmi Ofis" data-en="Official Office" data-ru="Официальный офис" data-ar="المكتب الرسمي">Official Office</h4>
                        <p class="text-xs text-slate-400 mb-2" data-az="Bakı, Azərbaycan — 7/24 Dəstək" data-en="Baku, Azerbaijan — 7/24 Support" data-ru="Баку, Азербайджан — Поддержка 7/24" data-ar="باكو، أذربيجان — دعم 7/24">Baku, Azerbaijan — 7/24 Support</p>
                        <p class="text-xs text-amber-400 font-semibold">support@caspianbridges.com</p>
                    </div>
                </div>
                <div class="max-w-7xl mx-auto border-t border-slate-800 pt-6 flex flex-col sm:flex-row items-center justify-between text-xs">
                    <p data-az="&copy; 2026 Caspian Bridges Baku. Bütün hüquqlar qorunur." data-en="&copy; 2026 Caspian Bridges Baku. All rights reserved." data-ru="&copy; 2026 Caspian Bridges Baku. Все права защищены." data-ar="&copy; 2026 جسور بحر قزوين باكو. جميع الحقوق محفوظة.">&copy; 2026 Caspian Bridges Baku. All rights reserved.</p>
                    <div class="flex gap-6 mt-4 sm:mt-0">
                        <a href="login" class="hover:text-amber-400 transition" data-az="Hesab Portalı" data-en="Account Portal" data-ru="Личный кабинет" data-ar="بوابة الحساب">Account Portal</a>
                        <a href="privacy-policy" class="hover:text-amber-400 transition" data-az="Məxfilik Siyasəti" data-en="Privacy Policy" data-ru="Политика конфиденциальности" data-ar="سياسة الخصوصية">Privacy Policy</a>
                    </div>
                </div>
            </footer>
        `;
    }

    const savedLang = localStorage.getItem('selectedLang') || 'en';
    changeLanguage(savedLang);
});