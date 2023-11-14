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
                <h1>Edit Post</h1>
            </div>
        </div>
        <!-- Content sections -->
        <div class="row">
            <!-- Main body content -->
            <div class="col-lg-8">
                <!-- Your content here -->
                <input id="post_title" name="post_title" placeholder="Title" required></input>
                <input type="hidden" id="post_id" name="post_id" value="">
                <div id="editorjs"></div>
                <button id="saveButton">Update Post</button>
                <script src="js/update_post.js"></script>
            </div>
            <!-- Sidebar content -->
            <div class="col-lg-4">
                <!-- Your sidebar here -->
            </div>
        </div>
    </div>
</main>
<?php include("footer.php"); ?>

<script>
    // Fetch existing post data
    fetch('fetch_posts.php')
        .then(response => response.json())
        .then(data => {
            
            data.forEach(post => {
                // Populate the title and editor with existing post data
                document.getElementById('post_title').value = post.post_title;
                       
                document.getElementById('post_id').value = post.post_id;

                editor.render(JSON.parse(post.post_content));

            });

        })
        .catch(error => console.error('Error fetching post data:', error));

    // Update the button click event for updating the post
    document.getElementById('saveButton').addEventListener('click', function () {
        const updatedTitle = document.getElementById('post_title').value;
        const post_id = document.getElementById('post_id').value;
        const updatedContent = JSON.stringify(editor.getData());

        // Send the updated data to the server for storage
        fetch('update_post.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                post_id: post_id,
                updatedTitle: updatedTitle,
                updatedContent: updatedContent,
            }),
        })
        .then(response => response.json())

        .then(data => {
         // Handle the response as needed
         console.log('Post updated:', data);
         })
         .catch(error => console.error('Error updating post:', error));
    });
    
</script>

</body>

</html>

</html>

