<?php

// database credentials
require_once '../connect.php';
// get the article ID from the query string
$article_id = $_GET['id'];

// update the status of the article to "approved"
$sql = "UPDATE articles SET status = 0 WHERE article_id = $article_id";
mysqli_query($conn, $sql);

// redirect back to the articles page
header("Location: ../auth/dashboard.php");
exit();

?>
