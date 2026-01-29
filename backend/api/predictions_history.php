<?php
// ===================================
// PREDICTIONS HISTORY API
// ===================================

session_start();
require_once '../database/db.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit();
}

$database = new Database();
$db = $database->connect();
$user_id = $_SESSION['user_id'];

// ========================================
// SAVE PREDICTION
// ========================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $input = json_decode(file_get_contents('php://input'), true);

        // Validate
        $required = ['rainfall', 'humidity', 'temp_avg', 'temp_min', 'temp_max', 'sunshine', 'wind_max', 'wind_avg', 'prediction_result', 'probability', 'risk_level'];
        foreach ($required as $field) {
            if (!isset($input[$field])) {
                echo json_encode(['success' => false, 'error' => "Missing field: $field"]);
                exit();
            }
        }

        // Insert prediction
        $stmt = $db->prepare("
            INSERT INTO predictions 
            (user_id, rainfall, humidity, temp_avg, temp_min, temp_max, sunshine, wind_max, wind_avg, prediction_result, probability, risk_level) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $user_id,
            $input['rainfall'],
            $input['humidity'],
            $input['temp_avg'],
            $input['temp_min'],
            $input['temp_max'],
            $input['sunshine'],
            $input['wind_max'],
            $input['wind_avg'],
            $input['prediction_result'],
            $input['probability'],
            $input['risk_level']
        ]);

        echo json_encode([
            'success' => true,
            'message' => 'Prediction saved',
            'prediction_id' => $db->lastInsertId()
        ]);

    } catch (PDOException $e) {
        error_log("Save Prediction Error: " . $e->getMessage());
        echo json_encode(['success' => false, 'error' => 'Failed to save prediction', 'details' => $e->getMessage()]);
    }
}

// ========================================
// GET HISTORY
// ========================================
elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

        // Get predictions with proper binding
        $stmt = $db->prepare("
            SELECT * FROM predictions 
            WHERE user_id = :user_id 
            ORDER BY created_at DESC 
            LIMIT :limit OFFSET :offset
        ");
        
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        $predictions = $stmt->fetchAll();

        // Get total count
        $stmt = $db->prepare("SELECT COUNT(*) as total FROM predictions WHERE user_id = :user_id");
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $total = $stmt->fetch()['total'];

        echo json_encode([
            'success' => true,
            'predictions' => $predictions,
            'total' => (int)$total,
            'limit' => $limit,
            'offset' => $offset
        ]);

    } catch (PDOException $e) {
        error_log("Get History Error: " . $e->getMessage());
        echo json_encode([
            'success' => false, 
            'error' => 'Failed to get history',
            'details' => $e->getMessage(),
            'predictions' => [],
            'total' => 0
        ]);
    }
}

// ========================================
// DELETE PREDICTION
// ========================================
elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    try {
        $input = json_decode(file_get_contents('php://input'), true);
        $prediction_id = $input['id'] ?? 0;

        // Delete (only if belongs to user)
        $stmt = $db->prepare("DELETE FROM predictions WHERE id = ? AND user_id = ?");
        $stmt->execute([$prediction_id, $user_id]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'Prediction deleted']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Prediction not found']);
        }

    } catch (PDOException $e) {
        error_log("Delete Prediction Error: " . $e->getMessage());
        echo json_encode(['success' => false, 'error' => 'Failed to delete prediction']);
    }
}

else {
    echo json_encode(['success' => false, 'error' => 'Invalid method']);
}
?>