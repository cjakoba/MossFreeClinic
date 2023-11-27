<?php
require_once '../classes/session-manager.classes.php';
$sessionManager = new SessionManager();
$sessionManager->startSession();
$sessionManager->checkLogin();

// Initialize variables
$post_id = null;
// Check if ID is passed through URL (GET request)
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $post_id = $_GET['id'];
} // Check if the form is submitted (POST request)
elseif (isset($_POST['submit']) && isset($_POST['id']) && is_numeric($_POST['id'])) {
    $post_id = $_POST['id'];
}


// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$db   = 'homebasedb'; // The name of your database
$user = 'homebasedb'; // Your database username
$pass = 'homebasedb'; // Your database password
$charset = 'utf8mb4';

// Set up the DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Set options for PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Create a PDO instance (connect to the database)
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Check if $post_id is set and is a valid number
if (isset($post_id) && is_numeric($post_id)) {
    // Prepare the statement with parameter placeholders
    $stmt = $pdo->prepare("SELECT post_title, post_content, post_id FROM em_posts WHERE post_id = :post_id");

    // Execute the statement with the actual parameter value
    $stmt->execute(['post_id' => $post_id]);

    // Fetch the result
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Handle the case where post_id is not set or invalid
    $posts = []; // or handle this scenario as needed
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('layouts/header-editorjs.php'); ?>
</head>
<body>

<!-- Navbar -->
<?php include('layouts/navbar.php'); ?>

<!-- Main Content -->
<main>
    <div class="container my-4">
        <!-- Page heading and sub-heading -->
        <div class="row mb-2 justify-content-center">
            <div class="col-11">
                <input id="post-editor-title" class="post-title" name="post_title" placeholder="New Post Title" value="<?php echo $posts[0]['post_title'] ?? null; ?>" required>
                <hr>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row justify-content-center">
            <div class="col-11">
                <div id="editorjs"></div>

                <!-- Cancel Post -->
                <a id="cancelButton" class="btn btn-primary btn-cancel" href="dashboard.php">Cancel Post</a>
                <!-- Publish Post -->
                <a id="saveButton" class="btn btn-primary">Update Post</a>
                <!-- Draft Post -->
                <a id="draftButton" class="btn btn-primary">Save as Draft</a>

                <script>
                    // editor-setup.js
                    const editor = new EditorJS({
                        autofocus: !0,
                        holder: 'editorjs',
                        placeholder: "Type text or paste a link",
                        tools: {
                            header: {
                                class: Header,
                                inlineToolbar: ['link']
                            },
                            list: {
                                class: List,
                                inlineToolbar: true
                            },
                            embed: Embed,
                        },
                        data: <?php echo $posts[0]['post_content'] ?? null; ?>,
                    });

                    var titleInput = document.getElementById('post-editor-title');
                    var postId = <?php echo $post_id; ?>

                    function saveData() {
                        if (titleInput.value.trim() === '') {
                            event.preventDefault();
                            alert('Please enter a title before saving.');
                            return false;
                        }

                        editor.save().then((outputData) => {
                            console.log('Article data: ', outputData);
                            postData('../api/update_post.php', { post_id: postId, post_title: titleInput.value, post_content: outputData });
                        }).catch((error) => {
                            console.error('Saving failed: ', error);
                        });
                    }

                    document.getElementById('saveButton').addEventListener('click', saveData);

                    function postData(url, data) {
                        fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                post_id: data.post_id,
                                post_title: data.post_title,
                                post_content: data.post_content
                            }),
                        })
                            .then(response => response.text()) // Expecting text response here
                            .then(text => {
                                window.location.href = "view_material.php?id=" + postId;
                            })
                            .catch((error) => {
                                console.error('Error:', error);
                            });
                    }
                </script>
            </div>
        </div>

    </div>
</main>

<!-- Footer -->
<?php include('layouts/footer.php'); ?>
</html>