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
            <div class="row mb-2 justify-content-center">
                <div class="col-11">
                    <input id="post-editor-title" class="post-title" name="post_title" placeholder="New Post Title" required>
                    <hr>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row justify-content-center">
                <div class="col-11">
                    <div id="editorjs"></div>

                    <!-- Cancel Post -->
                    <a id="cancelButton" class="btn btn-primary btn-cancel" href="dashboard.php">Cancel Post</a>
                    <!-- Publish Post -->
                    <a id="saveButton" class="btn btn-primary">Publish Post</a>
                    <!-- Draft Post -->
                    <a id="draftButton" class="btn btn-primary">Save as Draft</a>

                    <script src="../js/editor-setup.js"></script>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <?php include('layouts/footer.php'); ?>
</html>

