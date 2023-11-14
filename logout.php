<?php
// Start the session
session_start();

// Clear the session data
session_unset();
session_destroy();

// Redirect the user to the main page
header("Location: main.php");
exit();
?>
