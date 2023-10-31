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
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8">
	<title>Delete Educational Material</title>
</head>
<body>
	<form method="POST" action="">
		<input type="hidden" name="operation" value="delete">
		<label for="materialid">EM ID:</label>
		<input type="text" id="materialid" name="materialid" value="<?php echo $material_id; ?>"<br>
		<input type="submit" name="delete" value="Delete">	
	</form>
</body>
</html>
