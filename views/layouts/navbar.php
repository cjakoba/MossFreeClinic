<?php
if (file_exists('../classes/session-manager.classes.php')){
    include_once '../classes/session-manager.classes.php';
}
else if (file_exists('classes/session-manager.classes.php')){
    include_once 'classes/session-manager.classes.php';
}
$sessionManager = new SessionManager();
$sessionManager->startSession();
$loggedIn = $sessionManager->isLoggedIn();
if (file_exists('../classes/session-manager.classes.php')):
?>
<header class="nav-bar">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="https://mossfreeclinic.org">
                    <img src="../img/logo.png" alt="Clinic logo">
                </a>
                <div class="navbar-links">
                    <a href="search_posts.php">Search Posts</a>
                    <a href="list_em_posts.php">View Posts</a>
                    <a href="take-survey.php">Patient Care Survey</a>
                    <a href="https://mossfreeclinic.org/">Return to MossFreeClinic</a>

                    <?php if ($loggedIn): ?>
                        <a href="dashboard.php">Admin Dashboard</a>
                        <a href="posts.php">Posts</a>
                        <a href="survey.php">Survey</a>
                        <a href="user-editor.php">Profile</a>
                        <a href="../includes/logout.inc.php">Sign out</a>
                    <?php else: ?>
                        <a href="search_posts.php">Posts</a>
                        <a href="take-survey.php">Survey</a>
                        <a href="login.php">Sign in</a>
                    <?php endif; ?>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                </div>
            </div>
        </nav>
    </div>
</header>
<?php else: ?>
<header class="nav-bar">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="https://mossfreeclinic.org">
                    <img src="img/logo.png" alt="Clinic logo">
                </a>
                <div class="navbar-links">
                    <a href="https://mossfreeclinic.org/">Return to MossFreeClinic</a>

                    <?php if ($loggedIn): ?>
                        <a href="views/dashboard.php">Admin Dashboard</a>
                        <a href="views/posts.php">Posts</a>
                        <a href="views/survey.php">Survey</a>
                        <a href="views/user-editor.php">Profile</a>
                        <a href="includes/logout.inc.php">Sign out</a>
                    <?php else: ?>
                        <a href="views/search_posts.php">Posts</a>
                        <a href="views/take-survey.php">Survey</a>
                        <a href="views/login.php">Sign in</a>
                    <?php endif; ?>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                </div>
            </div>
        </nav>
    </div>
</header>
<?php endif;?>

