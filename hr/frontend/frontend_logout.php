<?php
session_start(); // Correctly start the session

$_SESSION = array(); // Clear the session variables

// If it's desired to kill the session, also delete the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy(); // Destroy the session

header("Location: ../../index.php"); // Redirect to the index page
exit();
?>