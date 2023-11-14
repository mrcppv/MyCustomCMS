<?php
// Start the session
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']);
if ($_SESSION['admin']) $admin = $_SESSION['admin'];

if ($loggedIn && $admin == 2) {
// MySQL database configuration
    $host = 'localhost';
    $username = 'root';
    $password = 'root';
    $database = 'test';

// Connect to MySQL database
    $connection = mysqli_connect($host, $username, $password, $database);

// Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

// Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get the news text and category from the form
        $newsText = $_POST['newsText'];
        $category = $_POST['category'];

        // Insert the news into the "news" table
        $sql = "INSERT INTO news (content, category) VALUES ('$newsText', '$category')";
        if (mysqli_query($connection, $sql)) {
            // Redirect the user back to the main page
            header("Location: main.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }
    }

// Close the database connection
    mysqli_close($connection);
} else { header("Location: main.php"); }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin News</title>
</head>
<body>
<form method="POST" action="adminnews.php">
    <textarea name="newsText" rows="4" cols="50"></textarea>
    <br>
    <select name="category">
        <option value="sport">Sport</option>
        <option value="worldwide">Worldwide</option>
        <option value="culture">Culture</option>
        <option value="daily">Daily</option>
        <option value="europe">Europe</option>
    </select>
    <br>
    <input type="submit" name="submit" value="Add News">
</form>
</body>
</html>
