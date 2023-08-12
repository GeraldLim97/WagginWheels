<?php
include_once "./redirect.php";
$redirect= $redirect??true;
// Unset all of the session variables.
if (session_status() === PHP_SESSION_NONE) {
    //session_status() returns three constants:
        //PHP_SESSION_DISABLED if sessions are disabled.
        //PHP_SESSION_NONE if sessions are enabled, but none exists.
        //PHP_SESSION_ACTIVE if sessions are enabled, and one exists.
    session_start();
}
$_SESSION = array(); //set the session array to blank

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $cookieInfo = session_get_cookie_params();
    //Returns an array with the current session cookie information.
    setcookie(session_name(), '', time() - 42000,
        $cookieInfo["path"], $cookieInfo["domain"], $cookieInfo["secure"], $cookieInfo["httponly"]
    );
}
// Finally, destroy the session.
session_destroy();
if ($redirect===true){
    redirect();
}
?>