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

<?php include("header.php"); ?>

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
                <div id="content"></div>
            </div>
        </div>
    </div>
    <script>
            fetch('fetch_posts.php')
                .then(response => response.json())
                .then(data => {
                    const renderer = new edjsHTML();

                    // Loop through each post and render it using external js library
                    data.forEach(post => {
                        const title = "<h1 id='title'>" + post.post_title + "</h1><hr>";
                        const postHTML = renderer.parse(JSON.parse(post.post_content));

                        // Append each post to the content div
                        document.getElementById('content').innerHTML += title + postHTML;
                    });
                })
                .catch(error => console.error('Error:', error));
        </script>

</main>
<?php include("footer.php"); ?>
</html>


