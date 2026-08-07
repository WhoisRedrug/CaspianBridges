<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db.php';
require_once 'csrf.php';
require_once 'recaptcha.php';
require_once 'validators.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = isset($_POST['action']) ? $_POST['action'] : 'login';

    // Bütün formalarda CSRF tokeni yoxlanılır. Yanlış/köhnə token = sorğu rədd edilir.
    if (!csrf_verify($_POST['csrf_token'] ?? '')) {
        if ($action === 'apply') {
            echo "error";
            exit();
        }
        header("Location: login.php?error=csrf");
        exit();
    }

    // reCAPTCHA yoxlaması - bot/spam qorunması
    if (!recaptcha_verify($_POST['g-recaptcha-response'] ?? '')) {
        if ($action === 'apply') {
            echo "error";
            exit();
        }
        header("Location: login.php?error=recaptcha");
        exit();
    }

    // MÜRACİƏT (APPLY) MƏNTİQİ
    if ($action === 'apply') {
        if (!isset($_SESSION['user_id'])) {
            echo "not_logged_in";
            exit();
        }

        $user_id   = $_SESSION['user_id'];
        $firstname = $conn->real_escape_string($_POST['firstname'] ?? '');
        $lastname  = $conn->real_escape_string($_POST['lastname'] ?? '');
        $email     = $conn->real_escape_string($_POST['email'] ?? '');
        $phone     = $conn->real_escape_string($_POST['phone'] ?? '');
        $service   = $conn->real_escape_string($_POST['service'] ?? '');
        $message   = $conn->real_escape_string($_POST['message'] ?? '');

        $insert_sql = "INSERT INTO applications (user_id, firstname, lastname, email, phone, service, message, status) 
                       VALUES ('$user_id', '$firstname', '$lastname', '$email', '$phone', '$service', '$message', 'pending')";
        
        if ($conn->query($insert_sql) === TRUE) {
            echo "success";
            exit();
        } else {
            echo "error";
            exit();
        }
    }

    // Registration logic   
    elseif ($action === 'register') {
        $name      = trim($_POST['name'] ?? '');
        $phone_raw = trim($_POST['phone'] ?? '');
        $email     = strtolower(trim($_POST['email'] ?? ''));
        $password_raw = $_POST['password'] ?? '';

        if (strlen($name) < 2) {
            header("Location: login.php?error=db_error");
            exit();
        }

        // 1. Saxta/uydurma e-poçt yoxlaması ("test@gmail.com", "admin@...", disposable domenlər və s.)
        if (is_fake_email($email)) {
            header("Location: login.php?error=fake_email");
            exit();
        }

        // 2. Beynəlxalq telefon nömrəsi formatı yoxlaması (E.164: + və 7-15 rəqəm,
        //    təkrarlanan/ardıcıl rəqəmli saxta naxışlar bloklanır)
        if (!is_valid_intl_phone($phone_raw)) {
            header("Location: login.php?error=invalid_phone");
            exit();
        }
        $normalized_phone = normalize_intl_phone($phone_raw);

        if (strlen($password_raw) < 8) {
            header("Location: login.php?error=db_error");
            exit();
        }
        $password = password_hash($password_raw, PASSWORD_DEFAULT);

        // 3. E-poçt və ya telefon artıq mövcuddursa (prepared statement)
        $check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR phone = ? LIMIT 1");
        $check_stmt->bind_param("ss", $email, $normalized_phone);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result && $check_result->num_rows > 0) {
            $check_stmt->close();
            header("Location: login.php?error=email_exists");
            exit();
        }
        $check_stmt->close();

        // 4. Yeni istifadəçi (prepared statement)
        $insert_stmt = $conn->prepare("INSERT INTO users (fullname, phone, email, password) VALUES (?, ?, ?, ?)");
        $insert_stmt->bind_param("ssss", $name, $normalized_phone, $email, $password);

        if ($insert_stmt->execute()) {
            $insert_stmt->close();
            header("Location: login.php?success=registered");
            exit();
        } else {
            $insert_stmt->close();
            header("Location: login.php?error=db_error");
            exit();
        }
    }
    
    // Login logic
    else {
        $email    = trim($conn->real_escape_string($_POST['email']));
        $password = $_POST['password'];
        $ip       = $_SERVER['REMOTE_ADDR'];

        // 1. check the total number of failed attempts in the last 24 hours
        $check_all = $conn->query("SELECT COUNT(*) as total FROM login_attempts WHERE ip_address = '$ip' AND attempt_time > (NOW() - INTERVAL 24 HOUR)");
        $row_all = $check_all->fetch_assoc();
        $total_fails = $row_all['total'];

        $lock_time_sql = "15 MINUTE";
        if ($total_fails >= 15) {
            $lock_time_sql = "3 HOUR";
        } elseif ($total_fails >= 10) {
            $lock_time_sql = "1 HOUR";
        } elseif ($total_fails >= 5) {
            $lock_time_sql = "15 MINUTE";
        }

        if ($total_fails >= 5) {
            $check_time = $conn->query("SELECT COUNT(*) as active_block FROM login_attempts WHERE ip_address = '$ip' AND attempt_time > (NOW() - INTERVAL $lock_time_sql)");
            $block_row = $check_time->fetch_assoc();

            if ($block_row['active_block'] > 0) {
                header("Location: login.php?error=too_many_attempts");
                exit();
            }
        }

        $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $result = $conn->query($sql);

        if ($result && $result->num_rows == 1) {
            $user_data = $result->fetch_assoc();
            
            //  Yalnız hash-lənmiş şifrə yoxlanılır. Əvvəlki versiyada "$password === $user_data['password']"
            //  aşkar mətn müqayisəsi də var idi - bu, verilənlər bazasında hash-lənməmiş şifrələrin
            //  qalmasına şərait yaradırdı və bazanın sızması halında bütün şifrələri açıq edərdi.
            if (password_verify($password, $user_data['password'])) {
                // Uğurlu giriş olduqda həmin IP-nin səhv cəhdlərini təmizləyirik
                $conn->query("DELETE FROM login_attempts WHERE ip_address = '$ip'");

                $_SESSION['user_id'] = $user_data['id'];
                $_SESSION['user_name'] = isset($user_data['fullname']) ? $user_data['fullname'] : '';

                if (isset($_SESSION['redirect_after_login'])) {
                    $redirect_url = $_SESSION['redirect_after_login'];
                    unset($_SESSION['redirect_after_login']);
                    header("Location: " . $redirect_url);
                    exit();
                } else {
                    header("Location: profile.php");
                    exit();
                }
            } else {
                // If password is wrong, log the attempt and redirect with an error
                $conn->query("INSERT INTO login_attempts (ip_address) VALUES ('$ip')");
                header("Location: login.php?error=wrong_password");
                exit();
            }
        } else {
            // If user not found, log the attempt and redirect with an error
            $conn->query("INSERT INTO login_attempts (ip_address) VALUES ('$ip')");
            header("Location: login.php?error=user_not_found");
            exit();
        }
    }
} else {
    header("Location: login.php");
    exit();
}
?>