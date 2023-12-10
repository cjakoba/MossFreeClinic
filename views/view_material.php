<?php
	include_once '../classes/dbh.classes.php';
	include_once '../classes/text-utility.classes.php';
	include_once '../classes/post-model.classes.php';
	include_once '../classes/post-view.classes.php';
	include_once '../classes/rating-model.classes.php';
	include_once '../classes/rating-controller.classes.php';

	// Initialize variables
	$post_id = null;

	// Check if ID is passed through URL (GET request)
	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
		$post_id = $_GET['id'];
	} // Check if the form is submitted (POST request)
	elseif (isset($_POST['submit']) && isset($_POST['id']) && is_numeric($_POST['id'])) {
		$post_id = $_POST['id'];
	}

	$ratingController = new RatingController();
	if (isset($_POST["Submit"])) {
		$post_id = $_POST["post_id"];
		$rating = $_POST["rating"];

		$ratingController->updateRating($post_id, $rating);
	}

	

	$postInfo = new PostView();
	$post_type = $postInfo->fetchType($post_id);
	if($post_type == "blog") {
		$post_content = json_encode($postInfo->fetchContent($post_id));
	} else if($post_type == "file") {
		$post_content = $postInfo->fetchContent($post_id);
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime_type = finfo_file($finfo, "../uploads/$post_content");
		//var_dump($mime_type);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'layouts/header.php'; ?>
    <!-- editor.js plugins -->
    <script src="https://cdn.jsdelivr.net/npm/editorjs-html@3.4.0/build/edjsHTML.js"></script>
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
                    <h1 id="title"><?php $postInfo->fetchTitle($post_id); ?></h1>
                    <hr>
                </div>
            </div>
            <!-- Content sections -->
            <div class="row justify-content-center">
                <!-- Main body content -->
                <div class="col-lg-11">
                    <div id="content"></div>
                    <br>
                    <form method="post">
                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                        <h2>Rate this post:</h2>
                        <span onclick="rate(1)" id="star1">&#9733;</span>
                        <span onclick="rate(2)" id="star2">&#9733;</span>
                        <span onclick="rate(3)" id="star3">&#9733;</span>
                        <span onclick="rate(4)" id="star4">&#9733;</span>
                        <span onclick="rate(5)" id="star5">&#9733;</span>
                        <input type="hidden" name="rating" value=" ">
                        <button type="submit" name="Submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            const renderer = new edjsHTML();
			<?php if ($post_type == "blog"): ?>
				const postHTML = renderer.parse(JSON.parse(<?php echo $post_content; ?>));
				document.getElementById('content').innerHTML = postHTML.join('');
			<?php elseif($post_type == "file"): 
					if ($mime_type == "application/vnd.oasis.opendocument.text"): //|| $mime_type == "application/pdf"):?>
					<!-- ViewerJS -->
					document.getElementById('content').innerHTML = "<iframe src='ViewerJS/#../../uploads/<?php echo $post_content; ?>'	width='100%' height='600px'></iframe>";
					<?php else: ?>
					<!-- Default -->
					document.getElementById('content').innerHTML = "<iframe src='../uploads/<?php echo $post_content; ?>'	width='100%' height='600px'></iframe>";
				<?php endif; ?>
			<?php endif; ?>

            let selectRating = 0;
            function rate(rating) {
                selectRating = rating;

                for(let i = 1; i <= 5; i++){
                    document.getElementById('star' + i).style.color = (i <= rating) ? 'yellow' : 'black';
                }
            }

            document.querySelector('form').addEventListener('submit', function () {
                document.querySelector('input[name="rating"]').value = selectRating;
            });
        </script>
    </main>
    <?php include 'layouts/footer.php'; ?>
</body>
</html>
