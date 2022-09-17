<?php
$hostname = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "timepass";

// Create connection
$conn = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname );

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>