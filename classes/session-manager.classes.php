<?php

class SessionManager
{
    public function startSession()
    {
        if (session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }
    }

    public function setSessionData($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function getSessionData($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function destroySession()
    {
        session_destroy();
    }

    public function checkLogin()
    {
        if (!isset($_SESSION['username']))
        {
            $this->redirectWithAlert('../views/login.php?error=', 'You must be logged in to access this website.');
        }
        else
        {
            $this->checkSessionExpiry();
            $this->updateSessionExpiry();
            $this->checkPermissions();
        }
    }

    public function isLoggedIn() {
        // Check if a specific session variable is set and not empty
        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
            return true;
        } else {
            return false;
        }
    }

    private function redirectWithAlert($url, $message)
    {
        echo "<script>alert('$message')</script>";
        header("location: " . $url);
        exit();
    }

    private function checkSessionExpiry()
    {
        $now = time();
        if (isset($_SESSION['expire']) && $now > $_SESSION['expire']) {
            session_unset();
            session_destroy();
            $this->redirectWithAlert('../views/login.php?error=', 'Your session has expired. Please log in again.');
        }
    }

    private function updateSessionExpiry()
    {
        $_SESSION['expire'] = time() + (30 * 60); // Session expires after 30 minutes of inactivity
    }

    private function checkPermissions()
    {
        if (!isset($_SESSION['permissions'])) {
            echo "Error: Permission level not found in session";
            exit();
        }
    }
}
