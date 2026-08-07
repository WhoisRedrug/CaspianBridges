<?php
// Qeydiyyat zamanı bot/saxta məlumatların qarşısını almaq üçün köməkçi funksiyalar.
// İstifadə: require_once 'validators.php';
//           is_fake_email($email)          -> true/false
//           is_valid_intl_phone($phone)    -> true/false (istənilən ölkə, E.164)
//           normalize_intl_phone($phone)   -> "+15551234567" formatında sətir və ya null (yanlışdırsa)

// Bilinən "disposable" (birdəfəlik/müvəqqəti) e-poçt provayderləri
function get_disposable_email_domains() {
    return [
        'mailinator.com', 'tempmail.com', 'temp-mail.org', '10minutemail.com',
        'guerrillamail.com', 'guerrillamail.info', 'yopmail.com', 'trashmail.com',
        'fakeinbox.com', 'sharklasers.com', 'getnada.com', 'dispostable.com',
        'throwawaymail.com', 'maildrop.cc', 'mailnesia.com', 'moakt.com',
        'discard.email', 'spamgourmet.com', 'mytemp.email', 'emailondeck.com',
        'mohmal.com', 'crazymailing.com', 'mintemail.com', '33mail.com',
        'example.com', 'example.org', 'example.net', 'test.com',
    ];
}

// @ işarəsindən əvvəlki hissədə (local part) tez-tez rast gəlinən saxta/uydurma sözlər
function get_fake_email_keywords() {
    return [
        'test', 'testtest', 'testing', 'admin', 'administrator', 'asdf', 'asdfasdf',
        'fake', 'fakeemail', 'spam', 'noreply', 'no-reply', 'sample', 'dummy',
        'trial', 'example', 'qwerty', 'foo', 'foobar', 'user', 'demo',
        'xxx', 'yyy', 'zzz', 'temp', 'tempuser', 'aaa', 'bbb', 'qwe', 'asd',
    ];
}

function is_fake_email($email) {
    $email = strtolower(trim($email));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true; // format yanlışdırsa saxta hesab edirik
    }

    $parts = explode('@', $email, 2);
    $local  = $parts[0];
    $domain = $parts[1] ?? '';

    // 1. Bilinən disposable (müvəqqəti) domenlər
    if (in_array($domain, get_disposable_email_domains(), true)) {
        return true;
    }

    // 2. Local part tam olaraq bilinən saxta sözlərdən biridirsə ("test@gmail.com")
    if (in_array($local, get_fake_email_keywords(), true)) {
        return true;
    }

    // 3. Saxta söz + rəqəm kombinasiyasıdırsa ("test123", "admin01")
    foreach (get_fake_email_keywords() as $kw) {
        if (preg_match('/^' . preg_quote($kw, '/') . '\d{0,4}$/', $local)) {
            return true;
        }
    }

    // 4. Eyni simvolun təkrarı ("aaaaaa", "111111") və ya çox qısa local part
    if (preg_match('/^(.)\1{3,}$/', $local) || strlen($local) < 3) {
        return true;
    }

    // 5. Klaviatura ardıcıllığı ("qwerty", "asdfgh", "123456")
    $keyboard_patterns = ['qwerty', 'asdfgh', 'zxcvbn', '123456', '1234567', '12345678'];
    foreach ($keyboard_patterns as $pattern) {
        if (strpos($local, $pattern) !== false) {
            return true;
        }
    }

    return false;
}

// Beynəlxalq telefon nömrəsi yoxlaması (E.164-ə əsaslanır).
// Bakcell/Nar/Naxtel kimi konkret AZ operator kodlarına ARTIQ bağlı deyil -
// sayt beynəlxalq istifadəçilər üçün nəzərdə tutulduğundan istənilən ölkənin
// düzgün formatlı nömrəsi qəbul edilir. Əvəzində botların atdığı açıq-aşkar
// saxta naxışlar (təkrarlanan rəqəmlər, ardıcıl seriyalar) ayrıca bloklanır.
//
// Qəbul edilən formatlar: +994501234567, +1 555 123 4567, +44 20 7946 0958 və s.
function normalize_intl_phone($phone) {
    $digits = preg_replace('/\D/', '', (string)$phone);

    if ($digits === '') {
        return null;
    }

    // E.164: ölkə kodu daxil ümumi uzunluq 7-15 rəqəm, ilk rəqəm 0 ola bilməz
    if (strlen($digits) < 7 || strlen($digits) > 15) {
        return null;
    }
    if ($digits[0] === '0') {
        return null;
    }

    return '+' . $digits;
}

// Botların tez-tez istifadə etdiyi "saxta amma formal olaraq düzgün" nömrə naxışları:
// eyni rəqəmin təkrarı (994501111111), tam eyni rəqəmlər, ardıcıl artan/azalan seriyalar (123456789)
function is_obviously_fake_phone_pattern($digits) {
    // 4 və ya daha çox eyni rəqəmin ardıcıl təkrarı
    if (preg_match('/(\d)\1{3,}/', $digits)) {
        return true;
    }

    // Ardıcıl artan/azalan seriya (5+ uzunluqda): 12345, 98765, 234567 və s.
    $ascending  = '01234567890123456789';
    $descending = '98765432109876543210';
    for ($len = min(strlen($digits), 10); $len >= 5; $len--) {
        for ($i = 0; $i <= strlen($digits) - $len; $i++) {
            $chunk = substr($digits, $i, $len);
            if (strpos($ascending, $chunk) !== false || strpos($descending, $chunk) !== false) {
                return true;
            }
        }
    }

    return false;
}

function is_valid_intl_phone($phone) {
    $normalized = normalize_intl_phone($phone);
    if ($normalized === null) {
        return false;
    }

    $digits = substr($normalized, 1); // öndəki '+' işarəsini çıxarırıq
    if (is_obviously_fake_phone_pattern($digits)) {
        return false;
    }

    return true;
}