<!DOCTYPE html>
<html>
<head>
</head>
<body>
<form method ="post">
<h2> Rate this educational material:</h2>
<span class ="star" onclick="rate(1)">&#9733;</span>
<span class ="star" onclick="rate(2)">&#9733;</span>
<span class ="star" onclick="rate(3)">&#9733;</span>
<span class ="star" onclick="rate(4)">&#9733;</span>
<span class ="star" onclick="rate(5)">&#9733;</span>
<button type="submit" name="Submit">Submit</button>
</form>
<?php
	$message = "Thanks for your review.";

	if(isset($_POST['Submit'])){
		echo $message;
	} else {
		echo "You haven't submitted a review yet.";
	}
?>
</body>
</html>
