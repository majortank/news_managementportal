<?php
session_start();

// Redirect to dashboard if user is already logged in
//if (isset($_SESSION['user_id'])) {
//    header('Location: ./auth/dashboard.php');
//    exit();
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News Management Portal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <header>
        <?php include './components/navbar.php';?>
        <p><a href="signup.php">Sign up</a> or <a href="signin.php">log in</a> to get started.</p>
    </header>
    <main style="margin-top:70px">
        <div class="container" >
  <div class="row">
    <div class="col-md-3">
        <a href="rss_feed/generate_feed.php" class="btn btn-primary">Subscribe to RSS Feed</a>
    </div>
    <div class="col-md-9">
      <?php include 'articles.php'; ?>
      <div class="row">
        <div class="col-md-12">
          <nav aria-label="Page navigation">
            <ul class="pagination">
              <?php include 'pagination.php'; ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
    </main>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.3/dist/esm/popper-base.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+J9QLnEOWS9tD75aUksdQRVgIhKpyw4" crossorigin="anonymous"></script>
</body>
</html>
