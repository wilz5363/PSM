<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/25/2016
 * Time: 5:16 PM
 */
include "../inc/constants.php";
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

if(session_destroy()) // Destroying All Sessions
{
    header("Location:".BASE_URL); // Redirecting To Home Page
}
?>