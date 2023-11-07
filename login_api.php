<?php
session_start();
include_once('database/dbinfo.php'); // Include your database connection file
$error = '';

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $conn = connect();

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $stmt = $conn->prepare("SELECT username, pass, userType, archive FROM persondb WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($username, $hashed_password, $userType, $archive);
            $stmt->fetch();

            if ($archive == 1) {
                echo "<script>alert('Your account has been inactivated.\nPlease contact an administrator for assistance.')</script>";
                echo "<meta http-equiv='refresh' content='0'>";
                exit;
            }

            if (password_verify($password, $hashed_password)) {
                $_SESSION['username'] = $username;

                $permissions = 1; // Default permissions for Tier 1 (Recruit)
                if ($userType == 'Trainer') {
                    $permissions = 2; // Tier 2
                } elseif ($userType == 'Head Trainer') {
                    $permissions = 3; // Tier 3
                }elseif ($userType == 'Viewer') {
                    $permissions = 4; // Tier 3
                }elseif ($userType == 'Admin') {
                    $permissions = 5; // Tier 3
                }
                $_SESSION['permissions'] = $permissions;

                header("Location: dashboard.php"); // Redirect to the main page
                exit;
            } else {
                $error = "Invalid username or password";
            }
        } else {
            $error = "Invalid username or password";
        }

        $stmt->close();
        $conn->close();
    } else {
        $error = "Please enter both username and password";
    }
}
?>
