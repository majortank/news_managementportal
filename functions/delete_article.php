<?php

// database credentials
require_once '../connect.php';

// get the article ID from the query string
$article_id = $_GET['id'];

// delete the article from the database
$sql = "DELETE FROM articles WHERE article_id = $article_id";
mysqli_query($conn, $sql);

// redirect back to the articles page
header("Location: ../auth/dashboard.php");
exit();

?>
