<?php
// Include the database connection file
require_once "connect.php";

// Define error variables
$titleErr = $authorErr = $contentErr = $categoryErr = $subcategoryErr = $publish_dateErr = $source_urlErr = "";

// Define variables and set to empty values
$title = $author = $content = $category = $subcategory = $publish_date = $source_url = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate title
    if (empty($_POST["title"])) {
        $titleErr = "Title is required";
    } else {
        $title = test_input($_POST["title"]);
    }

    // Validate author
    if (empty($_POST["author"])) {
        $authorErr = "Author is required";
    } else {
        $author = test_input($_POST["author"]);
    }

    // Validate content
    if (empty($_POST["content"])) {
        $contentErr = "Content is required";
    } else {
        $content = test_input($_POST["content"]);
    }

    // Validate category
    if (empty($_POST["category"])) {
        $categoryErr = "Category is required";
    } else {
        $category = test_input($_POST["category"]);
    }

    // Validate subcategory
    if (empty($_POST["subcategory"])) {
        $subcategoryErr = "Subcategory is required";
    } else {
        $subcategory = test_input($_POST["subcategory"]);
    }

    // Validate publish date
    if (empty($_POST["publish_date"])) {
        $publish_dateErr = "Publish date is required";
    } else {
        $publish_date = test_input($_POST["publish_date"]);
    }

    // Validate source URL
    if (empty($_POST["source_url"])) {
        $source_urlErr = "Source URL is required";
    } else {
        $source_url = test_input($_POST["source_url"]);
    }

    // Check if there are no errors, insert data into the database
    if (empty($titleErr) && empty($authorErr) && empty($contentErr) && empty($categoryErr) && empty($subcategoryErr) && empty($publish_dateErr) && empty($source_urlErr)) {
        $sql = "INSERT INTO Articles (title, author, content, category, subcategory, publish_date, source_url) VALUES ('$title', '$author', '$content', '$category', '$subcategory', '$publish_date', '$source_url')";

        if (mysqli_query($conn, $sql)) {
            echo'<div class="alert alert-success" role="alert">';
            echo '    <h4 class="alert-heading">Well done!</h4>';
            echo'    <p>Aww yeah, you successfully created an article</p>';
            echo'    <hr>';
            echo'    <p class="mb-0">Whenever you need to, be sure to be patient as it waiting tobe approved.</p>';
            echo'  </div>';
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
