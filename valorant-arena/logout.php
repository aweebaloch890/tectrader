<?php 
/**
 * TEC TRADER VALORANT TOURNAMENT - SEASON 2
 * Logout & Session Termination
 */

include_once 'config.php';

// 1. Session variables ko khali karein
$_SESSION = array();

// 2. Session cookie ko expire karein (Security best practice)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Session destroy
session_unset();
session_destroy();

// 4. Redirect to login or home with a logout message (Optional)
header("Location: index.php?status=logged_out");
exit();
?>