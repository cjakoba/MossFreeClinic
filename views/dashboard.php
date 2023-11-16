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
            <div class="row justify-content-center">
                <!-- Main body content -->
                <div class="col-lg-11">
                    <div id="content">
                        <p>Welcome, <?php echo htmlspecialchars($username); ?>!</p>
                        <p>Permissions = <?php echo htmlspecialchars($permissions); ?>.</p>

                        <form action="edit_material.php" method="post">
                            <label for="id">Edit Post (select using ID):</label>
                            <input type="number" id="id" name ="id" min="0" max="25655">
                            <input type="submit" name="submit" class="btn btn-primary">
                        </form>
                        <br>
                        <form action="view_material.php" method="post">
                            <label for="id">View Post (select using ID):</label>
                            <input type="number" id="id" name ="id" min="0" max="25655">
                            <input type="submit" name="submit" class="btn btn-primary">
                        </form>
                        <br>
                        <button onclick="window.location.href='post-editor.php';" type="button" class="btn btn-primary">Create New Post</button>
                        <button onclick="window.location.href='../includes/logout.inc.php';" type="button" class="btn btn-primary">logout</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include('layouts/footer.php'); ?>

</body>
</html>



