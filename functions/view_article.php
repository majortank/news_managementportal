<?php

require_once '../connect.php';


// get the article ID from the query string
$article_id = $_GET['id'];

// retrieve the article from the database

$sql = "SELECT * FROM articles WHERE article_id = $article_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// display the article
echo "<h1>" . $row['title'] . "</h1>";
echo "<p>Author: " . $row['author'] . "</p>";
echo "<p>Category: " . $row['category'] . "</p>";
echo "<p>Subcategory: " . $row['subcategory'] . "</p>";
echo "<p>Publish Date: " . $row['publish_date'] . "</p>";
echo "<p>" . $row['content'] . "</p>";

// close the database connection
mysqli_close($conn);

?>
