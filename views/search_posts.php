<?php
require_once "../classes/dbh.classes.php";
require_once "../classes/post-model.classes.php";
require_once "../classes/post-view.classes.php";
require_once "../classes/text-utility.classes.php";
require_once '../classes/session-manager.classes.php';

$sessionManager = new SessionManager();
$sessionManager->startSession();
$permissions = $sessionManager->getSessionData('user_id');
$loggedIn = $sessionManager->isLoggedIn();
$postView = new PostView();
$postPerPage = 10;
$totalPosts = $postView->getTotalPosts();
$maxPages = ceil($totalPosts / $postPerPage);
$pageNumber = NULL;

if(isset($_GET['page']))
{
	$pageNumber = filter_var($_GET['page'], FILTER_VALIDATE_INT, [
		'option'=> [
			'default'=> 1,
			'min_range'=> 1,
			'max_range'=> $maxPages
		]
	]);
} else
{
	$pageNumber = 1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'layouts/header-editorjs.php'; ?>
</head>
<body>
    <!-- Navbar -->
    <?php include 'layouts/navbar.php'; ?>

    <!-- Main Content -->
    <main>
        <div class="container my-4">
            <!-- Page heading and sub-heading -->
            <div class="row mb-2 justify-content-center">
                <div class="col-11">
                    <h1 id="title">Search For Posts</h1>
                    <hr>
                </div>
            </div>
            <!-- Content sections -->
            <div class="row justify-content-center">
                <!-- Main body content -->
                <div class="col-lg-11">
                    <div id="content">
						<nav>
							<!-- Sumbit form -->
							<form action="" method="GET">
								<div class="input-group mb-3">
									<input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" class="form-control" placeholder="What are you searching for?">
									<button type="submit" class="btn-custom">Search</button>
								</div>
							</form>
							
							<!-- if the search button was clicked -->
							<?php if (isset($_GET['search'])) {
								$searchedString = $_GET['search'];
							} else {
								$searchedString = "";
							} ?>

								<!-- navigate prev/next pages -->
								<nav>
									<?php if($pageNumber > 1):?>
										<a href="?page=<?= $pageNumber - 1;?>">&#8249; Previous</a>
									<?php else:?>
										&#8249;
										Previous
									<?php endif;?>
									<?php if($pageNumber < $maxPages):?>
										<a href="?page=<?= $pageNumber + 1;?>">Next &#8250;</a>
									<?php else:?>
										Next
										&#8250;
									<?php endif;?>
									<br/><br/>
								</nav>

								<!-- display the relevant posts -->
								<?php $postView->fetchMatchingPagePostsTitleAndDescription($searchedString, $pageNumber, $postPerPage, $loggedIn); ?>
							
								<nav>
									<?php if($pageNumber > 1):?>
										<a href="?page=<?= $pageNumber - 1;?>">Previous</a>
									<?php endif;?>
									<?php if($pageNumber < $maxPages):?>
										<a href="?page=<?= $pageNumber + 1;?>">Next</a>
									<?php endif;?>
								</nav>
						</nav>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include("layouts/footer.php"); ?>
</body>
</html>
