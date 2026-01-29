<?php
// ===================================
// AUTHENTICATION API
// ===================================

session_start();
require_once '../database/db.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$database = new Database();
$db = $database->connect();

$action = $_GET['action'] ?? '';
$input = json_decode(file_get_contents('php://input'), true);

// ========================================
// REGISTER
// ========================================
if ($action === 'register') {
    try {
        // Validate input
        if (!isset($input['username']) || !isset($input['email']) || !isset($input['password']) || !isset($input['full_name'])) {
            echo json_encode(['success' => false, 'error' => 'All fields are required']);
            exit();
        }

        $username = trim($input['username']);
        $email = trim($input['email']);
        $password = $input['password'];
        $full_name = trim($input['full_name']);
        $phone = trim($input['phone'] ?? '');

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'error' => 'Invalid email format']);
            exit();
        }

        // Validate password strength
        if (strlen($password) < 6) {
            echo json_encode(['success' => false, 'error' => 'Password must be at least 6 characters']);
            exit();
        }

        // Check if username exists
        $stmt = $db->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            echo json_encode(['success' => false, 'error' => 'Username already exists']);
            exit();
        }

        // Check if email exists
        $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            echo json_encode(['success' => false, 'error' => 'Email already registered']);
            exit();
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user
        $stmt = $db->prepare("INSERT INTO users (username, email, password, full_name, phone) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$username, $email, $hashed_password, $full_name, $phone]);

        $user_id = $db->lastInsertId();

        // Create session
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['full_name'] = $full_name;

        echo json_encode([
            'success' => true,
            'message' => 'Registration successful',
            'user' => [
                'id' => $user_id,
                'username' => $username,
                'email' => $email,
                'full_name' => $full_name
            ]
        ]);

    } catch (PDOException $e) {
        error_log("Register Error: " . $e->getMessage());
        echo json_encode(['success' => false, 'error' => 'Registration failed']);
    }
}

// ========================================
// LOGIN
// ========================================
elseif ($action === 'login') {
    try {
        // Validate input
        if (!isset($input['username']) || !isset($input['password'])) {
            echo json_encode(['success' => false, 'error' => 'Username and password are required']);
            exit();
        }

        $username = trim($input['username']);
        $password = $input['password'];

        // Get user
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $username]);
        $user = $stmt->fetch();

        if (!$user) {
            echo json_encode(['success' => false, 'error' => 'Invalid username or password']);
            exit();
        }

        // Verify password
        if (!password_verify($password, $user['password'])) {
            echo json_encode(['success' => false, 'error' => 'Invalid username or password']);
            exit();
        }

        // Check if active
        if (!$user['is_active']) {
            echo json_encode(['success' => false, 'error' => 'Account is inactive']);
            exit();
        }

        // Update last login
        $stmt = $db->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
        $stmt->execute([$user['id']]);

        // Create session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['full_name'] = $user['full_name'];

        echo json_encode([
            'success' => true,
            'message' => 'Login successful',
            'user' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'full_name' => $user['full_name'],
                'phone' => $user['phone']
            ]
        ]);

    } catch (PDOException $e) {
        error_log("Login Error: " . $e->getMessage());
        echo json_encode(['success' => false, 'error' => 'Login failed']);
    }
}

// ========================================
// LOGOUT
// ========================================
elseif ($action === 'logout') {
    session_destroy();
    echo json_encode(['success' => true, 'message' => 'Logout successful']);
}

// ========================================
// CHECK SESSION
// ========================================
elseif ($action === 'check') {
    if (isset($_SESSION['user_id'])) {
        echo json_encode([
            'success' => true,
            'logged_in' => true,
            'user' => [
                'id' => $_SESSION['user_id'],
                'username' => $_SESSION['username'],
                'email' => $_SESSION['email'],
                'full_name' => $_SESSION['full_name']
            ]
        ]);
    } else {
        echo json_encode([
            'success' => true,
            'logged_in' => false
        ]);
    }
}

else {
    echo json_encode(['success' => false, 'error' => 'Invalid action']);
}
?>