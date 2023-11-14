<?php
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

// Fetch the educational material posts from the database

$input = file_get_contents('php://input');
$post_id = $input['post_id']


$stmt = $pdo->query("SELECT post_title, post_content, post_id FROM em_posts WHERE post_id=:post_id");

$stmt->execute([
    'post_id' => $post_id,
]);


$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output the posts as JSON
header('Content-Type: application/json');

echo json_encode($posts);
?>
