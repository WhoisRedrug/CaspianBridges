<?php
require_once __DIR__ . '/vendor/autoload.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db.php';

$token = $_GET['token'] ?? '';
$valid_token = false;

if (!empty($token)) {
    $token = $conn->real_escape_string($token);
    $sql = "SELECT * FROM password_resets WHERE token = '$token' LIMIT 1";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows == 1) {
        $valid_token = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Password | Caspian Bridges</title>
    <link rel="icon" type="image/png" href="images/logo.png.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(12, 35, 31, 0.85); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .bg-glow { background: radial-gradient(circle at 50% 30%, #0f3831 0%, #061412 60%, #020a09 100%); }
    </style>
</head>
<body class="bg-glow text-slate-100 min-h-screen flex items-center justify-center p-4 relative overflow-hidden antialiased">
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none"></div>
    
    <div class="w-full max-w-md z-10 my-8">
        <div class="glass-card p-8 rounded-3xl shadow-2xl relative border border-amber-500/20">
            <div class="text-center mb-6">
                <a href="index" class="inline-block mb-2">
                    <img src="images/logo.png.png" alt="Caspian Bridges Logo" class="w-14 h-14 object-contain mx-auto rounded-2xl shadow-md">
                </a>
                <span class="text-xl font-black tracking-wider text-white block">CASPIAN BRIDGES</span>
                <p class="text-xs text-slate-400 mt-1">Set your new password</p>
                
                <div id="message-box" class="mt-4 text-xs font-bold text-center"></div>
            </div>

            <?php if ($valid_token): ?>
                <form action="process_forgot" method="POST" onsubmit="return validatePasswords()" class="space-y-4">
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                    
                    <!-- New Password Field -->
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">New Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="••••••••" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition pr-10">
                            <button type="button" onclick="togglePassword('password', 'eye-icon-1')" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white focus:outline-none">
                                <svg id="eye-icon-1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div>
                        <label class="text-xs font-bold text-slate-300 block mb-1.5">Confirm Password</label>
                        <div class="relative">
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="••••••••" required class="w-full bg-[#061412] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 transition pr-10">
                            <button type="button" onclick="togglePassword('confirm_password', 'eye-icon-2')" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white focus:outline-none">
                                <svg id="eye-icon-2" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-400 text-slate-950 font-black py-3.5 rounded-xl text-sm transition shadow-lg shadow-amber-500/20 mt-2"> Update Password → </button>
                </form>
            <?php else: ?>
                <div class="text-center py-4">
                    <p class="text-xs text-red-400 bg-red-500/10 p-3 rounded-xl border border-red-500/20 font-bold mb-4">Invalid or expired password reset link!</p>
                    <a href="recovery" class="inline-block text-xs font-bold text-amber-400 hover:underline">Request a new link</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function togglePassword(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (field.type === 'password') {
                field.type = 'text';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.037 10.037 0 012.042-3.38m5.055-2.073A9.973 9.973 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18" />`;
            } else {
                field.type = 'password';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
            }
        }

        function validatePasswords() {
            const pass = document.getElementById('password').value;
            const confirmPass = document.getElementById('confirm_password').value;
            const msgBox = document.getElementById('message-box');

            if (pass !== confirmPass) {
                msgBox.className = "mt-4 text-xs font-bold text-center text-red-400 bg-red-500/10 p-2.5 rounded-xl border border-red-500/20";
                msgBox.innerText = 'Passwords do not match!';
                return false;
            }
            return true;
        }

        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const msgBox = document.getElementById('message-box');
        if (msgBox && status === 'error') {
            msgBox.className = "mt-4 text-xs font-bold text-center text-red-400 bg-red-500/10 p-2.5 rounded-xl border border-red-500/20";
            msgBox.innerText = 'An error occurred. Please try again.';
        }
    </script>
</body>
</html>