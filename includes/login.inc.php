<?php
require_once '../classes/dbh.classes.php';
require_once '../classes/login.classes.php';
require_once '../classes/login-controller.classes.php';
require_once '../classes/session-manager.classes.php';

if (isset($_POST["submit"]))
{
    // Grabbing data
    $username = $_POST["username"];
    $password = $_POST["password"];

    $loginController = new LoginController($username, $password);
    $result = $loginController->loginUser();

    if (is_array($result))
    {
        $sessionManager = new SessionManager();
        $sessionManager->startSession();
        $sessionManager->setSessionData('user_id', $result[0]['userid']);
        $sessionManager->setSessionData('username', $result[0]['username']);
        $sessionManager->setSessionData('permissions', 1); // hardcoded - needs to change
        $sessionManager->checkLogin();

        header("Location: ../views/dashboard.php");
        exit();
    }
    else
    {
        header("Location: ../views/login.php?error=" . $result);
        exit();
    }
}
