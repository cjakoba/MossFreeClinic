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
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8">
	<title>Create Educational Material</title>
</head>
<body>
	<h1>Create Educational Material</h1>
</body>
</html>
