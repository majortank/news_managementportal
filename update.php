<?php session_start();

// Redirect to sign-in page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/signin.php');
    exit();
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Article Editor</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/rxyn6wmdmdgti4121cht97ol9sfzh3vrprt10lpygd8hmk8j/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'advlist autolink lists link',
    toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent'
  });
</script>
</head>
<body>
    <header>
        <?php        include './components/navbar.php';?>
    </header>
    <main style="margin-top:70px">
        <div class="container mt-4">
		<h2>Select an article to edit:</h2>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="form-group">
				<label for="article-select">Article:</label>
				<select class="form-control" id="article-select" name="article_id">
					<option value="">Select an article</option>
					<?php
						// Connect to database using PDO
						$dbhost = 'nmpserve.mysql.database.azure.com';
						$dbname = 'nmpdb';
						$dbuser = 'nmp_user@nmpserve';
						$dbpass = 'Tan123C++';
						$db = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);

						// Fetch article list
						$stmt = $db->prepare("SELECT article_id, title FROM Articles");
						$stmt->execute();
						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							echo '<option value="' . $row['article_id'] . '">' . $row['title'] . '</option>';
						}
					?>
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Edit Article</button>
		</form>

		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["article_id"])) {
				// Fetch selected article
				$stmt = $db->prepare("SELECT * FROM Articles WHERE article_id = ?");
				$stmt->execute([$_POST["article_id"]]);
				$article = $stmt->fetch(PDO::FETCH_ASSOC);
		?>
				<h2>Edit article:</h2>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<input type="hidden" name="article_id" value="<?php echo $article['article_id']; ?>">
					<div class="form-group">
						<label for="title">Title:</label>
						<input type="text" class="form-control" id="title" name="title" value="<?php echo $article['title']; ?>">
					</div>
					<div class="form-group">
						<label for="author">Author:</label>
						<input type="text" class="form-control" id="author" name="author" value="<?php echo $article['author']; ?>">
					</div>
					<div class="form-group">
						<label for="content">Content:</label>
						<textarea class="form-control" id="content" name="content"><?php echo $article['content']; ?></textarea>
                                                
					</div>
					<div class="form-group">
						<label for="category">Category:</label>
						<input type="text" class="form-control" id="category" name="category" value="<?php echo $article['category']; ?>">
					</div>
					<div class="form-group">
						<label for="subcategory">Subcategory:</label>
						<input type="text" class="form-control" id="subcategory" name="subcategory" value="<?php echo $article['subcategory']; ?>">
				
				</div>
				<div class="form-group">
					<label for="publish-date">Publish Date:</label>
					<input type="date" class="form-control" id="publish-date" name="publish_date" value="<?php echo $article['publish_date']; ?>">
				</div>
				<div class="form-group">
					<label for="source-url">Source URL:</label>
					<input type="text" class="form-control" id="source-url" name="source_url" value="<?php echo $article['source_url']; ?>">
				</div>
				<button type="submit" class="btn btn-primary">Update Article</button>
			</form>
	<?php
        
            
            }

		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["title"]) && isset($_POST["author"]) && isset($_POST["content"]) && isset($_POST["category"]) && isset($_POST["subcategory"]) && isset($_POST["publish_date"]) && isset($_POST["source_url"])) {
			// Update article
			$stmt = $db->prepare("UPDATE Articles SET title = ?, author = ?, content = ?, category = ?, subcategory = ?, publish_date = ?, source_url = ? WHERE article_id = ?");
			$stmt->execute([$_POST["title"], $_POST["author"], $_POST["content"], $_POST["category"], $_POST["subcategory"], $_POST["publish_date"], $_POST["source_url"], $_POST["article_id"]]);
                        ob_start();
			// Refresh page
//			header("Location: " . $_SERVER["PHP_SELF"]);
                        ob_end_flush();
		}
	?>
    </main>
</body>