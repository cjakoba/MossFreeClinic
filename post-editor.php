<?php
include('session.php');
if ($_SESSION['permissions'] < 3)
{
    header('Location: dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lloyd F. Moss Free Clinic</title>
    <!-- editor.js plugins -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="styles.css" rel="stylesheet">
</head>
<body>

<?php include("header.php"); ?>

<!-- Main Content -->
<main>
    <div class="container my-4">
        <!-- Page heading and sub-heading -->
        <div class="row mb-4">
            <div class="col-12">
                <h1>New Post</h1>
            </div>
        </div>
        <!-- Content sections -->
        <div class="row">
            <!-- Main body content -->
            <div class="col-lg-8">
                <!-- Your content here -->
                <input id="post_title" name="post_title" placeholder="Title" required></input>
                <div id="editorjs"></div>
                <button id="saveButton">Save Post</button>
                <script src="js/editor-setup.js"></script>
            </div>
            <!-- Sidebar content -->
            <div class="col-lg-4">
                <!-- Your sidebar here -->
            </div>
        </div>
    </div>
</main>
<?php include("footer.php"); ?>
</html>

