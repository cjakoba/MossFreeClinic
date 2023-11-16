<?php
include "classes/dbh.classes.php";
include "classes/post-model.classes.php";
include "classes/post-view.classes.php";
//$postInfo = new PostView();
//$post_content = json_encode($postInfo->fetchContent($post_id));
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
                    <?php if (empty($posts)) : ?>
                        <h>No materials found.</h>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Content sections -->
            <div class="row justify-content-center">
                <!-- Main body content -->
                <div class="col-lg-11">
                    <div id="content">
                        <?php if (!empty($posts)) : ?>
                            <ul id="all-posts-ul">
                                <?php foreach ($posts as $post) : ?>

                                    <?php
                                    $preview = $post['content'];

                                    //limit EM content to 200 characters
                                    if (strlen($preview) >= 200) {
                                        $preview = substr($post['content'], 0, 200) . "...";
                                    }
                                    ?>
                                    <li>
                                        <article>
                                            <!-- display EM title and content -->
                                            <h2><a href="view_material.php?id=<?=$post['post_id']?>"> <?= $post['post_title']; ?></a></h2>
                                            <p><?= $preview ?></p>
                                        </article>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include("layouts/footer.php"); ?>
</body>
</html>
