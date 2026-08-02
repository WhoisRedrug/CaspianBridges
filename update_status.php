<?php
session_start();

// Mərkəzi db.php faylını çağırırıq (artıq təkrar tənzimləmə yazmırıq)
// Qeyd: Əgər update_status.php ilə db.php eyni qovluqdadırsa aşağıdakı kimi yazılır:
include 'db.php'; 

// DİQQƏT: Sənin db.php faylın mysqli ilə yazdığı üçün, 
// yuxarıdakı kodda PDO əvəzinə mysqli sorğularından istifadə etməliyik.

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