<?php
include "../classes/dbh.classes.php";
include "../classes/post-model.classes.php";
include "../classes/post-view.classes.php";
include "../classes/text-utility.classes.php";
$postView = new PostView();
$postPerPage = 2;
$maxPages = ceil($postView->getTotalPosts() / $postPerPage);
var_dump($maxPages);
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
                    <h1 id="title">Educational Material Posts</h1>
                    <hr>
                </div>
            </div>
            <!-- Content sections -->
            <div class="row justify-content-center">
                <!-- Main body content -->
                <div class="col-lg-11">
                    <div id="content">
                        <?php $postView->fetchPagePostsTitleAndDescription($pageNumber,$postPerPage) ?>
						<nav>
							<?php if($pageNumber > 1):?>
								<a href="?page=<?= $pageNumber - 1;?>">Previous</a>
							<?php else:?>
								Previous
							<?php endif;?>
							<?php if($pageNumber < $maxPages):?>
								<a href="?page=<?= $pageNumber + 1;?>">Next</a>
							<?php else:?>
								Next
							<?php endif;?>
						</nav>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include("layouts/footer.php"); ?>
</body>
</html>
