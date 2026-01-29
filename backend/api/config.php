<?php
// ===================================
// CONFIGURATION FILE
// ===================================

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// CORS Headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// API Configuration
define('ML_SERVICE_URL', 'http://localhost:5000'); // Python Flask ML Service
define('GEMINI_API_KEY', 'AIzaSyDxmTasjGdJEWGRN3iR7bsVF7-kUikEz2U'); // Google Gemini API
define('GEMINI_API_URL', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent');

// Database Configuration (if needed later)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'floodguard');

// Timezone
date_default_timezone_set('Asia/Jakarta');

// Helper function for JSON response
function sendJSON($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}

// Helper function for error response
function sendError($message, $statusCode = 400) {
    sendJSON([
        'success' => false,
        'error' => $message
    ], $statusCode);
}
?>