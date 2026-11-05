<?php

session_start();

// Clear session variables
$_SESSION = [];

// Delete session cookie
if (ini_get("session.use_cookies")) {

    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        "",
        time() - 3600,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Delete remembered email cookie
setcookie("user_email", "", time() - 3600, "/");

// Destroy session
session_destroy();

header("Location: login.php");
exit;

?>