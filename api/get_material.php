<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "homebasedb";
$password = "homebasedb";
$dbname = "homebasedb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$materialId = $_GET['materialId'];
$sql = "SELECT * FROM emdb WHERE materialid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $materialId);

$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

echo json_encode($data);

$stmt->close();
$conn->close();
?>

