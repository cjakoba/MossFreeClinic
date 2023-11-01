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
    $material_id = $_POST["materialid"];
    $sql = "SELECT FROM emdb WHERE materialid = '$material_id'";
    $results = $connection->query($sql);
    if($results->num_rows > 0){
        $sql = "DELETE FROM emdb WHERE materialid = '$material_id'";
    if ($connection->query($sql) === TRUE){
        echo "Educational Material has been deleted.";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
} else {
        echo "Invalid educational material ID. Please enter a valid ID.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <title>Delete Educational Material</title>
</head>
<body>
<h1>Delete Educational Material</h1>
<form method="POST" action="">
    <input type="hidden" name="operation" value="delete">
    <label for="materialid">EM ID:</label>
    <input type="text" id="materialid" name="materialid" value="<?php echo $material_id; ?>"<br>
    <input type="submit" name="delete" value="Delete">
</form>
<script>
    function confirmDelete(){
        var confirmed = confirm("Are you sure that you want to delete this educational material?");
        return confirmed;
    }
</script>
</body>
</html>

