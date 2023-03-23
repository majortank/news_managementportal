<?php
require 'connect.php';

// Get the article_id from the query string
$article_id = $_GET['id'];

// Fetch the article from the database
$sql = "SELECT * FROM Articles WHERE article_id = $article_id";
$result = $conn->query($sql);

// Check if the article was found
if ($result->num_rows == 0) {
  echo "Article not found";
  exit;
}

// Display the article
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $row['title']; ?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</head>
<body>
    <header>
        <?php        include './components/navbar.php';?>
    </header>
    <main style="margin-top: 75px;">
        <div class="container">
    <h1 class="mt-5"><?php echo $row['title']; ?></h1>
    <p class="lead">By <?php echo $row['author']; ?></p>
    <img src="<?php echo $row['source_url']; ?>" style="height: 200px; width:100%" class="img-fluid" alt="<?php echo $row['title']; ?>">
    <hr>
    <p class="text-muted">Published on <?php echo $row['publish_date']; ?></p>
    <div id="content">
        <?php
  $content = $row['content'];
  if (!preg_match('/<[^>]+>/', $content)) {
    // Add <p> tags around the content
    $content = '<p>' . $content . '</p>';
}
  $decoded_text = htmlspecialchars_decode($content);
echo $decoded_text;
  
//  echo $sanitizedContent;
?>
    </div>
    <p class="text-muted">Category: <?php echo $row['category']; ?> > <?php echo $row['subcategory']; ?></p>
  </div>
    </main>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.3/dist/esm/popper-base.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+J9QLnEOWS9tD75aUksdQRVgIhKpyw4" crossorigin="anonymous"></script>

</body>
</html>

