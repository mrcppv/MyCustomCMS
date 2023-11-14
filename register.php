<?php
// Start the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect the user to the main page
    header("Location: main.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $userform = $_POST['username'] ;
    $passform = $_POST['password'] ;

    // Validate form data (perform necessary validation here)

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

    // Prepare and execute the query to insert the user
    $query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $userform, $passform);
    $stmt->execute();

    // Get the inserted user ID
    $userId = $stmt->insert_id;

    // Close the database connection
    $mysqli->close();

    // Start the session and store the user ID
    session_start();
    $_SESSION['user_id'] = $userId;

    // Redirect the user to the main page
    header("Location: main.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
<h2>Register</h2>
<form action="register.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required><br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br>
    <input type="submit" value="Register">
</form>
<p>Already have an account? <a href="main.php">Login here</a></p>
</body>
</html>
