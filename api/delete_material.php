<?php
$servername = "localhost";
$username = "homebasedb";
$password = "homebasedb";
$db = "homebasedb";
$connection = mysqli_connect($servername, $username, $password, $db);
if (mysqli_connect_errno()){
    echo "Failed to connect to the database" . mysqli_connect_error();
    exit();
} else {
    echo "Successfully connected to the database! <br>";
}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $post_id = $_POST["post_id"];
    $sql = "SELECT FROM em_posts WHERE post_id = '$post_id'";
    $results = $connection->query($sql);
    if($results->num_rows > 0){
        $sql = "DELETE FROM em_posts WHERE post_id = '$post_id'";
    if ($connection->query($sql) === TRUE){
        echo "Educational Material has been deleted.";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
?>
<script>
    function confirmDelete(){
        var confirmed = confirm("Are you sure that you want to delete this educational material?");
        return confirmed;
    }
</script>

