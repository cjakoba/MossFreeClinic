<?php
require_once '../classes/session-manager.classes.php';
$sessionManager = new SessionManager();
$sessionManager->startSession();
$sessionManager->checkLogin();

$username = $sessionManager->getSessionData('username');
$permissions = $sessionManager->getSessionData('user_id');
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
                    <input id="post-editor-title" class="post-title" name="post_title" required>
                    <hr>
                </div>
            </div>

            <!-- Main content -->
            <div class="row justify-content-center">
                <div class="col-11">
                    <input type="hidden" id="post_id" name="post_id" value="">
                    <div id="editorjs"></div>
                    <!-- Save Post -->
                    <button id="saveButton" class="btn btn-primary">Update Post</button>
                    <script src="../js/update_post.js"></script>
                </div>
            </div>

        </div>
    </main>

    <script>
        // Fetch existing post data
        fetch('../api/fetch_posts.php', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: {
                post_id: 1,
            }
        })
        .then(response => response.json())
        .then(data => {

            data.forEach(post => {
                // Populate the title and editor with existing post data
                document.getElementById('post-editor-title').value = post.post_title;

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
            fetch('../api/update_post.php', {
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

    <!-- Footer -->
    <?php include 'layouts/footer.php' ?>

</body>

</html>

