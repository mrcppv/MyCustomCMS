<?php
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

// Retrieve the submitted username and password from the form

$userform = $_POST['username'];
$passform = $_POST['password'];

// Query the database to check if the user exists
$query = "SELECT id, username, password, admin FROM users WHERE username = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('s', $userform);
$stmt->execute();
$result = $stmt->get_result();

// Verify the password
if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $id = $row['id'];
    $hashedPassword = $row['password'];
    $admin = $row['admin'];

    if ($passform == $hashedPassword) {
        // Start a session and store the user's ID
        session_start();
        $_SESSION['user_id'] = $id;
        $_SESSION['admin'] = $admin;
        // Redirect the user to the main page

         header("Location: main.php");
        exit();
    }
}

echo "Invalid username or password.";

$stmt->close();
$mysqli->close();
?>
