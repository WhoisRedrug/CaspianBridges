<?php
require_once __DIR__ . '/vendor/autoload.php';

session_start();

include 'db.php'; 

// Bu endpoint yalnız admin panelinə (redrug.php) daxil olmuş istifadəçilər üçündür.
// Əvvəlki versiyada bu yoxlama YOX idi - istənilən kəs status dəyişə bilirdi.
if (!isset($_SESSION['redrug_logged_in']) || $_SESSION['redrug_logged_in'] !== true) {
    http_response_code(403);
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'İcazə yoxdur']);
    exit;
}

// Check if the request method is POST

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $application_id = $_POST['id'] ?? null;
    $new_status = $_POST['status'] ?? null;

    if ($application_id && $new_status) {
        // MySQLi üçün Prepared Statement istifadə edirik (Təhlükəsizlik üçün)
        $stmt = $conn->prepare("UPDATE applications SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $new_status, $application_id);
        $updated = $stmt->execute();

        if ($updated) {
            echo json_encode(['success' => true, 'message' => 'Status uğurla yeniləndi']);
            exit;
        }
    }
    
    echo json_encode(['success' => false, 'message' => 'Məlumat çatışmazlığı']);
}
?>