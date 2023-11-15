<?php
require_once '../classes/session-manager.classes.php';
$sessionManager = new SessionManager();
$sessionManager->startSession();
$sessionManager->checkLogin();

$username = $sessionManager->getSessionData('username');
$permissions = $sessionManager->getSessionData('user_id');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('layouts/header-editorjs.php'); ?>
</head>
<body>

    <!-- Navbar -->
    <?php include('layouts/navbar.php'); ?>

    <!-- Main Content -->
    <main>
        <div class="container my-4">
            <!-- Page heading and sub-heading -->
            <div class="row mb-4">
                <div class="col-12">
                    <h1>New Post</h1>
                </div>
            </div>
            <!-- Content sections -->
            <div class="row">
                <!-- Main body content -->
                <div class="col-lg-8">
                    <!-- Your content here -->
                    <input id="post_title" name="post_title" placeholder="Title" required></input>
                    <div id="editorjs"></div>
                    <button id="saveButton">Save Post</button>
                    <script src="../js/editor-setup.js"></script>
                </div>
                <!-- Sidebar content -->
                <div class="col-lg-4">
                    <!-- Your sidebar here -->
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include('layouts/footer.php'); ?>
</html>

