<?php
require_once '../classes/session-manager.classes.php';
require_once '../classes/dbh.classes.php';
require_once '../classes/upload-model.classes.php';
$sessionManager = new SessionManager();
$sessionManager->startSession();
$sessionManager->checkLogin();

$uploadModel = new UploadModel();

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
if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	//var_dump($_FILES);
	
	$mime_types = ['text/plain', 'text/html', 'image/jpeg', 'image/png', 'image/gif', 
		'audio/wav', 'audio/mpeg', 'video/mp4', 'video/mpeg', 
		'application/msword', 'application/pdf', 'application/vnd.ms-powerpoint'];
	
	try 
	{
		switch ($_FILES['file']['error']) {
		case UPLOAD_ERR_OK:
			break;
		case UPLOAD_ERR_NO_FILE:
			throw new Exception('No file uploaded');
			break;
		case UPLOAD_ERR_INI_SIZE:
			throw new Exception('File too large');
			break;
		default:
			throw new Exception('An error occurred');
		}
		
		if($_FILES['file']['size'] > 1000000) {
			throw new Exception('File too large');
		}
		
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);
		
		if(! in_array($mime_type, $mime_types)) {
			throw new Exception('Invalid file type');
		}
		
		$pathinfo = pathinfo($_FILES['file']['name']);
		$base = $pathinfo['filename'];
		$base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);
		$filename = $base . "." . $pathinfo['extension'];
		
		$destination = "../uploads/$filename";
		
		$i = 1;
		
		while(file_exists($destination)) {
			$filename = $base . "-$i." . $pathinfo['extension'];
			$destination = "../uploads/$filename";
			$i++;
		}
		
		if(! move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {
			throw new Exception('Upload unsuccessful');
		} else {
			$uploadModel->addUpload($post_id, $filename);
		}
	}
	catch(Exception $e) {
		echo $e->getMessage();
	}
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
					<form method="post" enctype="multipart/form-data">
						<div>
							<label for="file">Add Additional Resources</label>
							<input type="file" name="file" id="file">
						</div>
						<button>Upload</button>
					</form>
					<br/>
                <!-- Cancel Post -->
                <a id="cancelButton" class="btn btn-primary btn-cancel" href="dashboard.php">Cancel Post</a>
                <!-- Publish Post -->
                <a id="saveButton" class="btn btn-primary">Update Post</a>
                <!-- Draft Post -->
                <a id="draftButton" class="btn btn-primary">Save as Draft</a>
                <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@latest"></script>
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
                            image: {
                                  class: ImageTool,
                                  config: {
                                    endpoints: {
                                      byFile: '../uploads', // Replace with your server endpoint for image upload
                                      types: 'image/jpeg,image/jpg',
                                    },
                                  },
                                },
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