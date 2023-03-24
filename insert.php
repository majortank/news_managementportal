<?php
// Include the database connection file
require_once "connect.php";

// Define error variables
$titleErr = $authorErr = $contentErr = $categoryErr = $subcategoryErr = $publish_dateErr = $source_urlErr = "";

// Define variables and set to empty values
$title = $author = $content = $category = $subcategory = $publish_date = $source_url = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate title
    $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
    if (empty($title)) {
        $titleErr = "Title is required";
    }
    
    // Validate author
    $author = filter_input(INPUT_POST, "author", FILTER_SANITIZE_STRING);
    if (empty($author)) {
        $authorErr = "Author is required";
    }

    // Validate content
    $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_STRING);
    if (empty($content)) {
        $contentErr = "Content is required";
    }

    // Validate category
    $category = filter_input(INPUT_POST, "category", FILTER_SANITIZE_STRING);
    if (empty($category)) {
        $categoryErr = "Category is required";
    }

    // Validate subcategory
    $subcategory = filter_input(INPUT_POST, "subcategory", FILTER_SANITIZE_STRING);
    if (empty($subcategory)) {
        $subcategoryErr = "Subcategory is required";
    }

    // Validate publish date
    $publish_date = filter_input(INPUT_POST, "publish_date", FILTER_SANITIZE_STRING);
    if (empty($publish_date)) {
        $publish_dateErr = "Publish date is required";
    }

    // Validate source URL
    $source_url = filter_input(INPUT_POST, "source_url", FILTER_SANITIZE_URL);
    if (empty($source_url)) {
        $source_urlErr = "Source URL is required";
    }
    // Check if there are no errors, insert data into the database
    if (empty($titleErr) && empty($authorErr) && empty($contentErr) && empty($categoryErr) && empty($subcategoryErr) && empty($publish_dateErr) && empty($source_urlErr)) {
        $sql = "INSERT INTO Articles (title, author, content, category, subcategory, publish_date, source_url) VALUES ('$title', '$author', '$content', '$category', '$subcategory', '$publish_date', '$source_url')";

        if (mysqli_query($conn, $sql)) {
            header('Refresh: 0; URL=./articleSubmitted.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

// Function to sanitize input data
function test_input($data) {
    $data0 = trim($data);
    $data1 = stripslashes($data0);
    $data2 = htmlspecialchars($data1);
    return $data2;
}
?>
