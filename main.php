<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
} else $uid = null;
$loggedIn = isset($_SESSION['user_id']);
if (!isset($_SESSION['admin'])) $_SESSION['admin'] = 1;


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

// Display the login/register section on the right
echo "<div style='float: right; margin: 20px;'>";
echo $_SESSION['admin'];

if ($_SESSION['admin'] == "2") {
    echo "<p>Admin logged in</p>";
    echo "<form action='logout.php' method='POST'>";
    echo "<input type='submit' value='Logout'>";
    echo "</form>";

} else if ($loggedIn) {
    echo "<p>User logged in</p>";
    echo "<form action='logout.php' method='POST'>";
    echo "<input type='submit' value='Logout'>";
    echo "</form>";
} else {
    echo "<h2>Login/Register</h2>";
    echo "<form action='login.php' method='POST'>";
    echo "<label for='username'>Username:</label>";
    echo "<input type='text' name='username' id='username'><br>";
    echo "<label for='password'>Password:</label>";
    echo "<input type='password' name='password' id='password'><br>";
    echo "<input type='submit' value='Login'>";
    echo "</form>";
    echo "<p>Don't have an account? <a href='register.php'>Register here</a></p>";
}
echo "</div>";

// Display the news articles on the left
echo "<div style='margin-right: 300px; padding: 20px;'>";

// Retrieve the news articles
$query = "SELECT id, content, category FROM news";
$newsResult = $mysqli->query($query);
//

while ($newsRow = $newsResult->fetch_assoc()) {
    $newsId = $newsRow['id'];
    $contents[] = $newsRow['content'];
    $category = $newsRow['category'];

}


//$e = "In PHP, what is meant by return \$this . return means what it always means: return a value from a function. \$this is the current object, usually the object through which the current member function was called.";

// for ($i = 0; $i < 5; $i++) $contents[$i] = $e;







for ($i = 0; $i < count($contents); $i++) {
    $newsId = $i + 1;
    echo "<div style='padding-bottom: 20px;'>";
    echo "<h2>News Article " . ($i + 1) . "</h2>";
    echo "<p>" . $contents[$i] . "</p>";

    // Retrieve comments for the news article
    $query = "SELECT comments.comment, users.username,comments.id, comments.user_id FROM comments JOIN users ON comments.user_id = users.id WHERE comments.news_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $newsId);
    $stmt->execute();
    $commentsResult = $stmt->get_result();


    while ($commentRow = $commentsResult->fetch_assoc()) {
        $comment = $commentRow['comment'];
        $username = $commentRow['username'];
        $cid = $commentRow['id'];
        $cuid = $commentRow['user_id'];


        echo "<p><strong>$username:</strong> $comment</p>  ";
        if ($_SESSION['admin'] == 2) {
            echo "
        <form action='delete.php' method='POST'>
            <input type='hidden' name='news_id' value='$newsId'>
            <input type='hidden' name='cid' value='$cid'>
            <input type='submit' value='Delete'>
        </form><br>";

        }
        if ($uid == $cuid){
            echo "
        <form action='delete.php' method='POST'>
            <input type='hidden' name='news_id' value='$newsId'>
            <input type='hidden' name='cid' value='$cid'>
             
            <input type='submit' value='Delete'>
        </form><br>";

            echo "
        <form action='modify.php' method='POST'>
            <input type='hidden' name='news_id' value='$newsId'>
            <input type='hidden' name='cid' value='$cid'>
             <textarea name='modify' placeholder='Modify your comment'></textarea><br>
            <input type='submit' value='Modify'>
        </form><br>";
        }
    }

    // Comment form

    if ($loggedIn) {
        echo "
        <form action='comment.php' method='POST'>
            <input type='hidden' name='news_id' value='$newsId'>
            <textarea name='comment' placeholder='Enter your comment'></textarea><br>
            <input type='submit' value='Submit'>
        </form><br>";
    } else {
        echo "<p>Please login to leave a comment</p>";
    }

    echo "</div>";
}

echo "</div>";

// Close the database connection
$mysqli->close();
?>
