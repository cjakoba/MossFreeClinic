<?php
$servername = "localhost";
$username = "homebasedb";
$password = "homebasedb";
$db = "homebasedb";
$connection = mysqli_connect($servername, $username, $password, $db);

if (mysqli_connect_errno()) {
    echo "Failed to connect to the database: " . mysqli_connect_error();
    exit();
} else {
    echo "Successfully connected to the database! <br>";
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["post_id"])) {
    $post_id = $_GET["post_id"];
    echo "<h2>Delete Educational Material</h2>";
    echo "<form method='POST' action=''>";
    echo "<input type='hidden' name='operation' value='delete'>";
    echo "<label for='post_id'>Post ID:</label>";
    echo "<input type='text' id='post_id' name='post_id' value='" . htmlspecialchars($post_id, ENT_QUOTES, 'UTF-8') . "'><br>";
    echo "<input type='submit' name='delete' value='Delete' onclick='return confirmDelete();'>";
    echo "</form>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["post_id"])) {
    $post_id = $_POST["post_id"];
    $sql = "SELECT * FROM em_posts WHERE post_id = '$post_id'";
    $results = $connection->query($sql);

    if ($results->num_rows > 0) {
        echo '<script>';
        echo 'if (confirmDelete()) {';
        $sql = "DELETE FROM em_posts WHERE post_id = '$post_id'";
        if ($connection->query($sql) === TRUE) {
            echo "alert('Educational Material successfully deleted.');";
        } else {
            echo "alert('Error deleting material: " . $connection->error . "');";
        }
        echo '} else {';
        echo 'window.history.back();';
        echo '}';
        echo '</script>';
    } else {
        echo 'Invalid post ID.';
    }
}

$connection->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Delete Educational Material</title>
</head>
<body>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this educational material?");
        }
    </script>
</body>
</html>
