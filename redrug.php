<?php
session_start();
include 'db.php';

$admin_user = getenv('ADMIN_USER');
$admin_pass = getenv('ADMIN_PASS');

// Status dəyişikliyi üçün AJAX sorğusu
if (isset($_POST['update_id']) && isset($_SESSION['redrug_logged_in'])) {
    header('Content-Type: application/json');
    $id = intval($_POST['update_id']);
    $status = $_POST['status'] ?? 'pending';

    $stmt = $conn->prepare("UPDATE applications SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'DB error']);
    }
    $stmt->close();
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_submit'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION['redrug_logged_in'] = true;
        header("Location: redrug");
        exit;
    } else {
        $error = "Giriş məlumatları yanlışdır!";
    }
}

if (isset($_GET['logout'])) {
    unset($_SESSION['redrug_logged_in']);
    header("Location: redrug");
    exit;
}

if (!isset($_SESSION['redrug_logged_in'])):
?>
<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <title>Secure Login // Restricted Access</title>
    <style>
        body { 
            background-color: #050505; 
            color: #00ff66; 
            font-family: 'Courier New', Courier, monospace; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
            overflow: hidden; 
        }
        canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 1;
        }
        .login-box { 
            position: relative;
            z-index: 2;
            background: rgba(10, 10, 10, 0.9); 
            border: 1px solid #00ff66; 
            padding: 40px; 
            border-radius: 8px; 
            box-shadow: 0 0 25px rgba(0, 255, 102, 0.2); 
            width: 360px; 
            text-align: center; 
        }
        h3 { 
            margin-top: 0; 
            color: #00ff66;
            letter-spacing: 2px;
            font-size: 18px;
            margin-bottom: 20px;
        }
        input { 
            width: 100%; 
            padding: 12px; 
            margin: 10px 0; 
            background: #111; 
            border: 1px solid #333; 
            color: #00ff66; 
            border-radius: 4px; 
            box-sizing: border-box; 
            font-family: 'Courier New', Courier, monospace;
        }
        input:focus {
            outline: none;
            border-color: #00ff66;
            box-shadow: 0 0 8px rgba(0, 255, 102, 0.4);
        }
        button { 
            width: 100%; 
            padding: 12px; 
            background: #00ff66; 
            color: #000; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer; 
            font-size: 14px; 
            font-weight: bold;
            font-family: 'Courier New', Courier, monospace;
            margin-top: 15px;
            transition: 0.2s;
        }
        button:hover { 
            background: #00cc52; 
        }
        .error { 
            color: #ff3333; 
            font-size: 12px; 
            margin-bottom: 15px; 
        }
    </style>
</head>
<body>
    <canvas id="matrix"></canvas>
    <div class="login-box">
        <h3>[ AUTHENTICATION ]</h3>
        <?php if($error): ?><div class="error"><?php echo $error; ?></div><?php endif; ?>
        <form method="POST" autocomplete="off">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login_submit">Daxil ol</button>
        </form>
    </div>

    <script>
        const canvas = document.getElementById('matrix');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        const katakana = '0123456789ABCDEF';
        const alphabet = katakana.split('');
        const fontSize = 14;
        const columns = canvas.width / fontSize;
        const rainDrops = [];
        for (let x = 0; x < columns; x++) { rainDrops[x] = 1; }
        function draw() {
            ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = '#003311';
            ctx.font = fontSize + 'px monospace';
            for (let i = 0; i < rainDrops.length; i++) {
                const text = alphabet[Math.floor(Math.random() * alphabet.length)];
                ctx.fillText(text, i * fontSize, rainDrops[i] * fontSize);
                if (rainDrops[i] * fontSize > canvas.height && Math.random() > 0.975) {
                    rainDrops[i] = 0;
                }
                rainDrops[i]++;
            }
        }
        setInterval(draw, 30);
    </script>
</body>
</html>
<?php exit; endif; 

$apps = $conn->query("SELECT * FROM applications ORDER BY id DESC");
$contacts = $conn->query("SELECT * FROM contacts ORDER BY id DESC");
$users = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard // Control Panel</title>
    <style>
        :root {
            --bg-color: #12141c;
            --card-bg: #1a1d26;
            --border-color: #2a2e3d;
            --text-main: #e2e8f0;
            --text-muted: #94a3b8;
            --accent: #3b82f6;
            --accent-hover: #2563eb;
        }
        body { 
            background-color: var(--bg-color); 
            color: var(--text-main); 
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; 
            margin: 0; 
            padding: 30px; 
        }
        .main-container { max-width: 1400px; margin: auto; }
        
        /* Top Navigation */
        .top-bar { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            background: var(--card-bg); 
            border: 1px solid var(--border-color); 
            padding: 20px 30px; 
            border-radius: 8px; 
            margin-bottom: 30px; 
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }
        h1 { margin: 0; font-size: 20px; font-weight: 600; color: #fff; letter-spacing: 0.5px; }
        .logout-btn { 
            background: #ef4444; 
            color: #fff; 
            padding: 10px 20px; 
            text-decoration: none; 
            border-radius: 6px; 
            font-size: 13px; 
            font-weight: 600;
            transition: background 0.2s;
        }
        .logout-btn:hover { background: #dc2626; }
        
        /* Sections */
        .panel-section { 
            background: var(--card-bg); 
            border: 1px solid var(--border-color); 
            border-radius: 8px; 
            padding: 25px; 
            margin-bottom: 30px; 
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }
        .panel-header { 
            font-size: 15px; 
            font-weight: 600; 
            color: var(--text-main); 
            border-bottom: 1px solid var(--border-color); 
            padding-bottom: 15px; 
            margin-bottom: 20px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }
        .record-count { 
            background: rgba(255,255,255,0.05); 
            border: 1px solid var(--border-color); 
            padding: 4px 10px; 
            font-size: 12px; 
            border-radius: 20px; 
            color: var(--text-muted);
        }

        /* Tables */
        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        th, td { padding: 14px 16px; border-bottom: 1px solid var(--border-color); text-align: left; }
        th { background-color: rgba(0,0,0,0.2); color: var(--text-muted); font-weight: 600; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; }
        tr:hover { background-color: rgba(255,255,255,0.02); }
        tr:last-child td { border-bottom: none; }

        /* Form elements */
        select { 
            background: #111318; 
            color: var(--text-main); 
            border: 1px solid var(--border-color); 
            padding: 8px 12px; 
            border-radius: 6px; 
            font-size: 13px; 
            cursor: pointer;
            transition: border-color 0.2s;
        }
        select:focus { outline: none; border-color: var(--accent); }
        .sub-text { color: var(--text-muted); font-size: 12px; margin-top: 3px; display: block; }
        .empty-row { text-align: center; color: var(--text-muted); padding: 30px; }
    </style>
</head>
<body>

<div class="main-container">
    <div class="top-bar">
        <h1>Admin İdarəetmə Paneli</h1>
        <a href="redrug?logout=true" class="logout-btn">Çıxış</a>
    </div>

    <!-- 1. APPLICATIONS -->
    <div class="panel-section">
        <div class="panel-header">
            <span>Müraciətlər (Applications)</span>
            <span class="record-count">Cəmi: <?php echo $apps->num_rows; ?></span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ad Soyad</th>
                    <th>Əlaqə</th>
                    <th>Xidmət</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($apps && $apps->num_rows > 0): while($row = $apps->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td style="font-weight: 500;"><?php echo htmlspecialchars($row['firstname'].' '.$row['lastname']); ?></td>
                        <td>
                            <?php echo htmlspecialchars($row['email']); ?>
                            <span class="sub-text"><?php echo htmlspecialchars($row['phone']); ?></span>
                        </td>
                        <td><?php echo htmlspecialchars($row['service']); ?></td>
                        <td>
                            <select onchange="updateStatus(<?php echo $row['id']; ?>, this.value)">
                                <option value="pending" <?php if($row['status'] == 'pending') echo 'selected'; ?>>Gözləmədə (pending)</option>
                                <option value="approved" <?php if($row['status'] == 'approved') echo 'selected'; ?>>Təsdiqləndi (approved)</option>
                                <option value="rejected" <?php if($row['status'] == 'rejected') echo 'selected'; ?>>Rədd edildi (rejected)</option>
                            </select>
                        </td>
                    </tr>
                <?php endwhile; else: ?>
                    <tr><td colspan="5" class="empty-row">Məlumat tapılmadı.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- 2. CONTACTS -->
    <div class="panel-section">
        <div class="panel-header">
            <span>Əlaqə Mesajları (Contacts)</span>
            <span class="record-count">Cəmi: <?php echo $contacts->num_rows; ?></span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Göndərən</th>
                    <th>Email</th>
                    <th>Mesaj</th>
                    <th>Tarix</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($contacts && $contacts->num_rows > 0): while($c = $contacts->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $c['id']; ?></td>
                        <td style="font-weight: 500;"><?php echo htmlspecialchars($c['name'] ?? $c['fullname'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($c['email'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($c['message'] ?? 'N/A'); ?></td>
                        <td style="color: var(--text-muted); font-size: 12px;"><?php echo htmlspecialchars($c['created_at'] ?? 'N/A'); ?></td>
                    </tr>
                <?php endwhile; else: ?>
                    <tr><td colspan="5" class="empty-row">Mesaj yoxdur.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- 3. USERS -->
    <div class="panel-section">
        <div class="panel-header">
            <span>Qeydiyyatdan Keçmiş İstifadəçilər (Users)</span>
            <span class="record-count">Cəmi: <?php echo $users->num_rows; ?></span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>İstifadəçi / Email</th>
                    <th>Şifrə / Hash</th>
                    <th>Rol</th>
                    <th>Qeydiyyat Tarixi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($users && $users->num_rows > 0): while($u = $users->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $u['id']; ?></td>
                        <td style="font-weight: 500;"><?php echo htmlspecialchars($u['email'] ?? $u['username'] ?? 'N/A'); ?></td>
                        <td><code style="background: #111318; padding: 4px 8px; border-radius: 4px; color: #f87171; font-size: 12px;"><?php echo htmlspecialchars($u['password'] ?? $u['pass'] ?? 'N/A'); ?></code></td>
                        <td><?php echo htmlspecialchars($u['role'] ?? $u['status'] ?? 'Standard'); ?></td>
                        <td style="color: var(--text-muted); font-size: 12px;"><?php echo htmlspecialchars($u['created_at'] ?? 'N/A'); ?></td>
                    </tr>
                <?php endwhile; else: ?>
                    <tr><td colspan="5" class="empty-row">İstifadəçi tapılmadı.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<script>
function updateStatus(id, status) {
    fetch('redrug.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'update_id=' + id + '&status=' + encodeURIComponent(status)
    })
    .then(res => res.json())
    .then(data => {
        if(!data.success) {
            alert('Xəta baş verdi: Status yenilənmədi.');
        }
    })
    .catch(err => {
        alert('Şəbəkə xətası.');
    });
}
</script>

</body>
</html>