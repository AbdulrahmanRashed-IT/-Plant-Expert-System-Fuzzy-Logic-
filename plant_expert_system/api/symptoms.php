<?php
error_reporting(0); // Suppress error reporting for production, but consider enabling for debugging
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

try {
    require_once '../classes/ExpertSystem.php';
    
    $expertSystem = new ExpertSystem();
    
    if (!$expertSystem) {
        throw new Exception("Failed to initialize expert system");
    }
    
    $symptoms = $expertSystem->getAllSymptoms();
    
    if ($symptoms === false) {
        throw new Exception("Failed to retrieve symptoms from database");
    }
    
    echo json_encode([
        'success' => true,
        'symptoms' => $symptoms
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Gagal memuat data gejala',
        'message' => $e->getMessage()
    ]);
}
?>