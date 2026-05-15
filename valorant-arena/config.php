<?php
/**
 * TEC TRADER VALORANT TOURNAMENT - SEASON 2
 * Core Configuration File (Final Optimized Version)
 */

// 1. Session Start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Database Connection Parameters
// Aapke phpMyAdmin ke mutabiq 'tectrader' database use ho raha hai
$db_host = "localhost";
$db_user = "root";
$db_pass = ""; 
$db_name = "tectrader"; 

// Connection establish karna
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check Connection
if (!$conn) {
    die("<div style='color:#ff4655; font-family:sans-serif; text-align:center; padding:50px; background:#0f1923; min-height:100vh;'>
            <h1 style='font-size:40px; margin-bottom:10px;'>CORE CONNECTION FAILED</h1>
            <p style='color:#ece8e1;'>System could not reach the database. Error: " . mysqli_connect_error() . "</p>
         </div>");
}

// Set Charset
mysqli_set_charset($conn, "utf8mb4");

// 3. Global Constants
define('SITE_NAME', 'Tec Trader');
define('TOURNAMENT_TITLE', 'Tec Trader Valorant Tournament Season 2');

// Base URL: Aapke folder 'valorant-arena' ke mutabiq
define('BASE_URL', 'http://localhost/valorant-arena/');

// 4. Role System Definitions (SQL ke ENUMs ke mutabiq)
define('ROLE_USER', 'User');
define('ROLE_ORGANIZER', 'Organizer');
define('ROLE_ADMIN', 'Admin');

// 5. Security & Helper Functions
function clean($data) {
    global $conn;
    if (empty($data)) return "";
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return mysqli_real_escape_string($conn, $data);
}

// Check if user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Role Authorization Logic
function has_role($required_role) {
    if (!isset($_SESSION['role'])) {
        return false;
    }
    
    // Admin has access to everything
    if ($_SESSION['role'] === ROLE_ADMIN) {
        return true;
    }
    
    // Specific role check
    return ($_SESSION['role'] === $required_role);
}

// 6. Regional Settings
date_default_timezone_set('Asia/Karachi');

// 7. Tactical Branding Assets
$site_logo = BASE_URL . "assets/images/logo.png"; 

// --- CONFIGURATION COMPLETE ---
?>