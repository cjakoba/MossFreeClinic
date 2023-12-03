<?php
$servername = "localhost";
$username = "homebasedb";
$password = "homebasedb";
$db = "homebasedb";
$connection = mysqli_connect($servername, $username, $password, $db);

if (mysqli_connect_errno()) {
    echo "Failed to connect to the database: " . mysqli_connect_error();
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["post_id"])) {
    $post_id = $_GET["post_id"];
    echo "<h2>Delete Educational Material</h2>";
    echo "<form id='deleteForm' method='POST' action=''>";
    echo "<input type='hidden' name='operation' value='delete'>";
    echo "<label for='post_id'>Post ID:</label>";
    echo "<input type='text' id='post_id' name='post_id' readonly><br>";
    echo "<button type='button' onclick='showCustomConfirmation()'>Delete</button>";
    echo "</form>";

    echo "<script>
            document.getElementById('post_id').value = '$post_id';

            function showCustomConfirmation() {
                var confirmation = document.getElementById('customConfirmation');
                confirmation.style.display = 'block';
            }

            function deleteConfirmed() {
                // Continue with the deletion of the post
                var postForm = document.getElementById('deleteForm');
                postForm.submit();
            }

            function deleteCanceled() {
                var confirmation = document.getElementById('customConfirmation');
                confirmation.style.display = 'none';
            }
          </script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["post_id"])) {
    $post_id = $_POST["post_id"];

    $deleteRatingsQuery = "DELETE FROM ratingdb WHERE em_post_id = '$post_id'";
    if ($connection->query($deleteRatingsQuery) === TRUE) {
        // Ratings deleted, now delete the post
        $deletePostQuery = "DELETE FROM em_posts WHERE post_id = '$post_id'";
        if ($connection->query($deletePostQuery) === TRUE) {
            echo 'Educational Material and Ratings successfully deleted.';
            // Redirect the user back to the previous page
            echo '<script>window.location.href = "../views/list_em_posts.php";</script>';
        } else {
            echo 'Error deleting post: ' . $connection->error;
            echo '<script>window.history.back();</script>';
        }
    } else {
        echo 'Error deleting ratings: ' . $connection->error;
        echo '<script>window.history.back();</script>';
    }
}

$connection->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Delete Educational Material</title>
    <style>
        #customConfirmation {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        #customConfirmation button {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div id="customConfirmation">
        <p>Are you sure you want to delete this educational material?</p>
        <button onclick="deleteConfirmed()">Yes</button>
        <button onclick="deleteCanceled()">No</button>
    </div>
</body>
</html>
