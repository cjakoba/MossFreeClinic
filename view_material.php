<?php
    include "classes/dbh.classes.php";
    include "classes/post-model.classes.php";
    include "classes/post-view.classes.php";
    $postInfo = new PostView();
    $post_id = $_GET["id"];
    $post_content = json_encode($postInfo->fetchContent($post_id));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lloyd F. Moss Free Clinic</title>
    <!-- editor.js plugins -->
    <script src="https://cdn.jsdelivr.net/npm/editorjs-html@3.4.0/build/edjsHTML.js"></script>
    <!-- Bootstrap CSS --> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="styles.css" rel="stylesheet">
</head>
<body>

<?php
$server = "localhost";
$username = "homebasedb";
$password = "homebasedb";
$db = "homebasedb";

$connection = mysqli_connect($server, $username, $password, $db);

if(!$connection){
    die("Connection failed: " . mysqlierror());
}
include("header.php"); 
?>

<!-- Main Content -->
<main>
    <div class="container my-4">
        <!-- Page heading and sub-heading -->
        <div class="row mb-4">
            <div class="col-12">
            </div>
        </div>
        <!-- Content sections -->
        <div class="row justify-content-center">
            <!-- Main body content -->
            <div class="col-lg-11">
                <p><?php $postInfo->fetchTitle($post_id); ?></p>
                <div id="content"></div>
                <form method="post">
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <h2>Rate this educational material:</h2>
                    <span onclick="rate(1)" id="star1">&#9733;</span>
                    <span onclick="rate(2)" id="star2">&#9733;</span>
                    <span onclick="rate(3)" id="star3">&#9733;</span>
                    <span onclick="rate(4)" id="star4">&#9733;</span>
                    <span onclick="rate(5)" id="star5">&#9733;</span>
                    <input type="hidden" name="rating" value=" ">
                    <button type="submit" name="Submit">Submit</button>
                </form>
                <?php
                $message = "";
                if(isset($_POST["Submit"])){
                    $post_id = $_POST["post_id"];
                    $rating = $_POST["rating"];
                    $sql_select = "SELECT COUNT(*) as count, SUM(rating) as total FROM em_posts WHERE post_id = '$post_id'";
                    $stmt = mysqli_prepare($connection, $sql_select);
                    mysqli_stmt_bind_param($stmt, "s", $post_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_query($connection, $sql_select);

                    if($result){
                        $row = mysqli_fetch_assoc($result);
                        $count = $row['count'];
                        $totalRating = $row['total'];

                        $newTotalRating = $totalRating + $rating;
                        $newAvgRating = $newTotalRating / ($count + 1);

                        $sql_update = "UPDATE em_posts SET rating = '$newAvgRating' WHERE post_id = '$post_id'";
                        $stmt = mysqli_prepare($connection, $sql_select);
                        mysqli_stmt_bind_param($stmt, "s", $post_id);
                        mysqli_stmt_execute($stmt);
                        if(mysqli_query($connection, $sql_update)){
                            $message = "Thanks for the review.";
                        } else {
                            $message = "Error updating the average rating: ". mysqli_error($connection);
                        }
                    } else {
                        $message = "Error retrieving existing ratings: ". mysqli_error($connection);
                    }
                } else {
                        $message = "You haven't submitted a review yet.";
                }
                echo $message;
                mysqli_close($connection);
                ?>
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
            document.getElementById('rating').value = selectRating;
        });
    </script>
</main>
<?php include("footer.php"); ?>
</html>
