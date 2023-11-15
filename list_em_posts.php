<?php
    include "classes/dbh.classes.php";
    include "classes/post-model.classes.php";
    include "classes/post-view.classes.php";
    //$postInfo = new PostView();
    //$post_content = json_encode($postInfo->fetchContent($post_id));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lloyd F. Moss Free Clinic</title>
    <!-- editor.js plugins -->
    <script src="https://cdn.jsdelivr.net/npm/editorjs-html@3.4.0/build/edjsHTML.js"></script>
    <!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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

$sql_select_posts = "SELECT post_id, post_title, post_content as content FROM em_posts ORDER BY post_date";
$result = mysqli_query($connection,$sql_select_posts);
$posts = NULL;
if($result) {
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>
<?php include("header.php"); ?>

<!-- Main Content -->
<body> 
<?php if (empty($posts)) : ?>
    <p>No materials found.</p>
<?php else : ?>
    <h1 style="text-align: center";>Educational Material Posts</h1>

    <ul>
        <?php foreach ($posts as $post) : ?>

        <?php
        $preview = substr($post['content'], 0, 200);    //only display the first 200 characters
        ?>
            <li>
                <article>
                    <h2><a href="view_material.php?id=<?=$post['post_id']?>"> <?= $post['post_title']; ?></a></h2>
                    <p> <?= $preview . "..."; ?></p>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>
</body>
<main>
    <!-- main tags needed to to force footer to stay at the bottom of the page -->
</main>
<?php include("footer.php"); ?>
</html>
