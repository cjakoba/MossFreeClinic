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

include 'layouts/header-editorjs.php';
include 'layouts/navbar.php';
?>

<div class='container'>
    <h2>Delete Educational Material</h2>
    <form id='deleteForm' method='POST' action=''>
        <input type='hidden' name='operation' value='delete'>
        <label for='post_id'>Post ID:</label>
        <input type='text' id='post_id' name='post_id' readonly><br>
        <button type='button' onclick='showCustomConfirmation()'>Delete</button>
    </form>
</div>

<div id="customConfirmation" style="display: none;">
    Are you sure you want to delete this?
    <button onclick="deleteConfirmed()">Yes</button>
    <button onclick="deleteCanceled()">No</button>
</div>

<?php include 'layouts/footer.php'; ?>

<script>
    document.getElementById('post_id').value = '<?php echo isset($_GET["post_id"]) ? $_GET["post_id"] : ""; ?>';

    function showCustomConfirmation() {
        var confirmation = document.getElementById('customConfirmation');
        if (confirmation) {
            confirmation.style.display = 'block';
        } else {
            console.error('Custom confirmation element not found');
        }
    }

    function deleteConfirmed() {
        var postForm = document.getElementById('deleteForm');
        if (postForm) {
            postForm.submit();
        } else {
            console.error('Delete form not found');
        }
    }

    function deleteCanceled() {
        var confirmation = document.getElementById('customConfirmation');
        if (confirmation) {
            confirmation.style.display = 'none';
        } else {
            console.error('Custom confirmation element not found');
        }
    }
</script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["operation"]) && $_POST["operation"] == "delete") {
    $post_id = $_POST["post_id"];

    $deleteRatingsQuery = "DELETE FROM ratingdb WHERE em_post_id = '$post_id'";
    if ($connection->query($deleteRatingsQuery) === TRUE) {
        $deletePostQuery = "DELETE FROM em_posts WHERE post_id = '$post_id'";
        if ($connection->query($deletePostQuery) === TRUE) {
            echo '<script>window.location.href = "list_em_posts.php";</script>';
            exit();
        } else {
            echo 'console.error("Error deleting post: ' . $connection->error . '");';
            exit();
        }
    } else {
        echo 'console.error("Error deleting ratings: ' . $connection->error . '");';
        exit();
    }

    $connection->close();
}
?>

</body>
</html>
