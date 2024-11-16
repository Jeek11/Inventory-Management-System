<?php
// Database configuration variables
$servername = "localhost";  // Typically 'localhost' if you're running MySQL locally
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password (empty for local default)
$dbname = "yandb";  // Name of your MySQL database

// Create a new MySQLi connection object
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    // If there's a connection error, display it and stop the script
    die("Connection failed: " . $conn->connect_error);
}

// If connection is successful, the $conn object is ready for use
?>
