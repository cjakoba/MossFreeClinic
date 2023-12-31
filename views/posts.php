<?php
require_once '../classes/text-utility.classes.php';
require_once '../classes/session-manager.classes.php';
require_once '../classes/dbh.classes.php';
require_once '../classes/post-model.classes.php';
require_once '../classes/post-view.classes.php';

$postView = new PostView();
$numberOfPosts = $postView->getTotalPosts();

$sessionManager = new SessionManager();
$sessionManager->startSession();
$sessionManager->checkLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('layouts/header.php'); ?>
</head>

<body>
    <!-- Navbar -->
    <?php include('layouts/navbar.php'); ?>

    <!-- Main Content -->
    <main>
        <div class="container my-4">
            <!-- Page heading and sub-heading -->
            <div class="row mb-4 justify-content-center">
                <div class="col-11">
                    <h1 id="title">Admin Dashboard</h1>
                    <hr>
                </div>
            </div>
            <!-- Cards Section -->
            <div class="row justify-content-center">
                <div class="row col-11">
                    <div class="col-lg-4 mb-4">
                        <div class="card" onclick="location.href='search_posts.php';">
                            <div class="card-title">Search posts</div>
                            <div class="card-description">Edit, and delete, educational material.</div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card" onclick="location.href='post-editor.php';">
                            <div class="card-title">Create post</div>
                            <div class="card-description">Create new posts</div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card" onclick="location.href='editTags.php';">
                            <div class="card-title">Edit tags</div>
                            <div class="card-description">Edit, delete, and create new tags</div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card" onclick="location.href='editTags.php';">
                            <div class="card-title">Edit categories</div>
                            <div class="card-description">Edit, delete, and create new categories</div>
                        </div>
                    </div>
                    <!-- ... Add more cards as needed -->
                </div>
            </div>

            <!-- Existing Content -->
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <!-- Your existing content -->
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include('layouts/footer.php'); ?>

    <script>
        // If needed, add JavaScript for more complex interactions
    </script>
</body>
</html>



