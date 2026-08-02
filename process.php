<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = isset($_POST['action']) ? $_POST['action'] : 'login';

    // MÜRACİƏT (APPLY) MƏNTİQİ
    if ($action === 'apply') {
        if (!isset($_SESSION['user_id'])) {
            echo "not_logged_in";
            exit();
        }

        $user_id   = $_SESSION['user_id'];
        $firstname = $conn->real_escape_string($_POST['firstname']);
        $lastname  = $conn->real_escape_string($_POST['lastname']);
        $email     = $conn->real_escape_string($_POST['email']);
        $phone     = $conn->real_escape_string($_POST['phone']);
        $service   = $conn->real_escape_string($_POST['service']);
        $message   = $conn->real_escape_string($_POST['message']);

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
        $name     = $conn->real_escape_string($_POST['name']);
        $phone    = $conn->real_escape_string($_POST['phone']);
        $email    = trim($conn->real_escape_string($_POST['email']));
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // 1. Check if the email already exists in the database
        $check_sql = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
        $check_result = $conn->query($check_sql);

        if ($check_result && $check_result->num_rows > 0) {
            header("Location: login.php?error=email_exists");
            exit();
        }

        // 2. for new User
        $insert_sql = "INSERT INTO users (fullname, phone, email, password) VALUES ('$name', '$phone', '$email', '$password')";
        
        if ($conn->query($insert_sql) === TRUE) {
            header("Location: login.php?success=registered");
            exit();
        } else {
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
            
            //  check if the password matches (hashed or plain text)
            if (password_verify($password, $user_data['password']) || $password === $user_data['password']) {
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