<?php
$servername = "localhost";
$username = "nmp_user";
$password = "";
$dbname = "news_management-portal";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";




