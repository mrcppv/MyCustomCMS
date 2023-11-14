<?php

// Start the session
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']);
if ($_SESSION['admin']) $admin = 2;

class Connection {
    public $host;
    public $dbName;
    public $username;
    public $password;

   public function __construct($host, $username, $password, $db){

       $this->host = $host;
       $this->dbName = $db;
       $this->username = $username;
       $this->password = $password;


}

    public function start(){

        // Create a new MySQLi instance
       $mysqli = new mysqli($this->host, $this->username, $this->password, $this->dbName);

        // Check the connection
        if ($mysqli->connect_error) {
            die("Database connection failed: " . $mysqli->connect_error);
        }

        return $mysqli;

    }

}

class Admin extends Connection{
    public $userId;
    public $newsId;
    public $comment;
    public $cid;

    public function __construct()
    {

        global $loggedIn;
        global $admin;


        if ($loggedIn && isset($_POST['news_id']) && $admin==2) {
            $this->userId = $_SESSION['user_id'];
            $this->newsId = $_POST['news_id'];
            $this->cid = $_POST['cid'];


        }



    }


    public function delete(){
        // Create a new Connection instance
        $connection = new Connection('localhost', 'root', 'root', 'test');
// Connect to the database
        $conn = $connection->start();

        // delete from the database
        $query = "DELETE FROM comments WHERE news_id = $this->newsId and id = $this->cid";
        $conn->query($query);
        $conn->close();

    }


}

class User extends Connection{
    public $userId;
    public $newsId;
    public $comment;
    public $cid;


        public function __construct()
    {

        global $loggedIn;
        global $admin;


        if ($loggedIn && isset($_POST['news_id']) && $admin==1) {
            $this->userId = $_SESSION['user_id'];
            $this->newsId = $_POST['news_id'];
            $this->cid = $_POST['cid'];


        } else {
            exit();
        }



    }


    public function delete(){
        // Create a new Connection instance
        $connection = new Connection('localhost', 'root', 'root', 'test');
        $conn = $connection->start();
// Connect to the database


        // delete from the database
        $query = "DELETE FROM comments WHERE user_id = $this->userId and news_id = $this->newsId and id = $this->cid";
        $conn->query($query);
        $conn->close();

    }



}

$admin = new Admin();
$admin->delete();

$user = new User();
$user->delete();


// Redirect the user back to the main page
header("Location: main.php");
exit();

