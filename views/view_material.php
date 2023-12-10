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
$post_content = json_encode($postInfo->fetchContent($post_id));
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
            const postHTML = renderer.parse(JSON.parse(<?php echo $post_content; ?>));
            document.getElementById('content').innerHTML = postHTML.join('');

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