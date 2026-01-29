<?php
// ===================================
// FLOOD PREDICTION API
// ===================================

require_once 'config.php';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendError('Method not allowed', 405);
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    sendError('Invalid JSON input');
}

// Validate required fields
$required = ['RR', 'RH_avg', 'Tavg'];
foreach ($required as $field) {
    if (!isset($input[$field])) {
        sendError("Missing required field: $field");
    }
}

// Prepare data for ML service
$mlData = [
    'Tn' => $input['Tn'] ?? $input['Tavg'] - 3,
    'Tx' => $input['Tx'] ?? $input['Tavg'] + 3,
    'Tavg' => floatval($input['Tavg']),
    'RH_avg' => floatval($input['RH_avg']),
    'RR' => floatval($input['RR']),
    'ss' => $input['ss'] ?? 5.0,
    'ff_x' => $input['ff_x'] ?? 3.0,
    'ff_avg' => $input['ff_avg'] ?? 2.0
];

try {
    // Call Python ML Service
    $ch = curl_init(ML_SERVICE_URL . '/predict');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($mlData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error) {
        throw new Exception("ML Service connection error: $error");
    }
    
    if ($httpCode !== 200) {
        throw new Exception("ML Service returned error: HTTP $httpCode");
    }
    
    $result = json_decode($response, true);
    
    if (!$result || !isset($result['success'])) {
        throw new Exception("Invalid response from ML Service");
    }
    
    // Return result to frontend
    sendJSON($result);
    
} catch (Exception $e) {
    error_log("Prediction error: " . $e->getMessage());
    sendError("Prediction service unavailable. Please try again later.", 503);
}
?>