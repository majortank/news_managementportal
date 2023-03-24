<?php
session_start();

// Redirect to sign-in page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}


// Redirect to home page if user is a regular user
if ($_SESSION['user_role'] === 'user') {
    header('Refresh: 0; URL=./notadmin.php'); // Refresh the page and redirect after 3 seconds
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>
    <header class="mb-4">
        <?php include '../components/navbar.php'; ?>
    </header>
        <main class="mt-5 container-fluid">
            <?php

            require_once '../connect.php';

// retrieve articles from the database
$sql = "SELECT * FROM articles";
$result = mysqli_query($conn, $sql);

// display articles in a table

echo '<table class="table table-striped">';
echo '<thead>';
echo '<tr>';
echo '<th>Title</th>';
echo '<th>Author</th>';
echo '<th>Category</th>';
echo '<th>Subcategory</th>';
echo '<th>Publish Date</th>';
echo '<th>Status</th>';
echo '<th>Actions</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

while ($row = mysqli_fetch_assoc($result)) {
  echo '<tr>';
  echo '<td>' . $row['title'] . '</td>';
  echo '<td>' . $row['author'] . '</td>';
  echo '<td>' . $row['category'] . '</td>';
  echo '<td>' . $row['subcategory'] . '</td>';
  echo '<td>' . $row['publish_date'] . '</td>';
  echo '<td>' . ($row['status'] == 1 ? "Approved" : "Not Approved") . '</td>';
  echo '<td>';
  if ($row['status'] == 0) {
    echo '<a href="../functions/approve_article.php?id=' . $row['article_id'] . '" class="btn btn-success btn-sm mr-2">Approve</a>';
  } else {
    echo '<a href="../functions/disapprove_article.php?id=' . $row['article_id'] . '" class="btn btn-warning btn-sm mr-2">Disapprove</a>';

  }
  echo '<a href="../functions/view_article.php?id=' . $row['article_id'] . '" class="btn btn-primary btn-sm mr-2">View</a>';
  echo '<a href="../functions/delete_article.php?id=' . $row['article_id'] . '" class="btn btn-danger btn-sm">Delete</a>';
  echo '</td>';
  echo '</tr>';
}


echo '</tbody>';
echo '</table>';




// close the database connection
mysqli_close($conn);

?>

        </main>
    
   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.3/dist/esm/popper-base.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+J9QLnEOWS9tD75aUksdQRVgIhKpyw4" crossorigin="anonymous"></script>
</body>
</html>


