<?php session_start();
// Redirect to sign-in page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ./auth/signin.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Article</title>
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
        <?php        include './components/navbar.php';?>
    </header>
    
    <main style="margin-top:70px; margin-bottom: 15px;">
        <div class="wrapper">
        <div class="container-fluid">
                 <h2>Submit an article</h2>
            <form action="insert.php" method="POST">
              <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" required>
              </div>
              <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" class="form-control" id="author" placeholder="Enter author" name="author" required>
              </div>
              <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control" rows="5" id="content" placeholder="Enter content" name="content" required></textarea>
              </div>
              <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" class="form-control" id="category" placeholder="Enter category" name="category" required>
              </div>
              <div class="form-group">
                <label for="subcategory">Subcategory:</label>
                <input type="text" class="form-control" id="subcategory" placeholder="Enter subcategory" name="subcategory" required>
              </div>
              <div class="form-group">
                <label for="publish_date">Publish Date:</label>
                <input type="date" class="form-control" id="publish_date" placeholder="Enter publish date" name="publish_date" required>
              </div>
              <div class="form-group">
                <label for="source_url">Source URL:</label>
                <input type="text" class="form-control" id="source_url" placeholder="Enter source URL" name="source_url" required>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </main>
    
    </div>
</body>
</html>
