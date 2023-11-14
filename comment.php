<?php
// Start the session
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']);
if ($_SESSION['admin']) $admin = 2;


// Check if the user is submitting a comment
if ($loggedIn && isset($_POST['news_id']) && isset($_POST['comment'])) {
    $userId = $_SESSION['user_id'];
    $newsId = $_POST['news_id'];
    $comment = $_POST['comment'];

    // Establish a MySQL database connection
    $host = 'localhost';
    $dbName = 'test';
    $username = 'root';
    $password = 'root';

    // Create a new MySQLi instance
    $mysqli = new mysqli($host, $username, $password, $dbName);

    // Check the connection
    if ($mysqli->connect_error) {
        die("Database connection failed: " . $mysqli->connect_error);
    }

    // Insert the comment into the database
    $query = "INSERT INTO comments (user_id, news_id, comment) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('iis', $userId, $newsId, $comment);
    $stmt->execute();

    // Close the database connection
    $mysqli->close();
}

// Redirect the user back to the main page
header("Location: main.php");
exit();
?>
