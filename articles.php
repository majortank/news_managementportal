<?php 

require 'connect.php';

// set pagination variables
$results_per_page = 6;
$current_page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT) ?: 1;
$offset = ($current_page - 1) * $results_per_page;

// set filter variable
$filter = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING);

// build query based on filter
if ($filter) {
    $sql = "SELECT * FROM Articles WHERE category=? AND status=1 LIMIT ?, ?";
    $count_sql = "SELECT COUNT(*) AS count FROM Articles WHERE category=? AND status=1";
} else {
    $sql = "SELECT * FROM Articles WHERE status=1 LIMIT ?, ?";
    $count_sql = "SELECT COUNT(*) AS count FROM Articles WHERE status=1";
}

// create prepared statement for retrieving articles
$stmt = mysqli_prepare($conn, $sql);

// bind parameters to the prepared statement
if ($filter) {
    mysqli_stmt_bind_param($stmt, 'sii', $filter, $offset, $results_per_page);
} else {
    mysqli_stmt_bind_param($stmt, 'ii', $offset, $results_per_page);
}

// execute the prepared statement to retrieve articles
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// create prepared statement for retrieving count of articles in category
$count_stmt = mysqli_prepare($conn, $count_sql);

// bind parameters to the prepared statement
if ($filter) {
    mysqli_stmt_bind_param($count_stmt, 's', $filter);
}

// execute the prepared statement to retrieve count of articles in category
mysqli_stmt_execute($count_stmt);
$count_result = mysqli_stmt_get_result($count_stmt);
$count_row = mysqli_fetch_assoc($count_result);
$total_results = $count_row['count'];
$total_pages = ceil($total_results / $results_per_page);

// display filter buttons
$categories_sql = "SELECT category, COUNT(*) AS count FROM Articles GROUP BY category";
$categories_stmt = mysqli_prepare($conn, $categories_sql);
mysqli_stmt_execute($categories_stmt);
$categories_result = mysqli_stmt_get_result($categories_stmt);

echo "<div style=margin-top: 80px;'  class='btn-group'>";
echo "<a href='?page=1' class='btn btn-secondary'>All (" . $total_results . ")</a>";

// output filter buttons
while ($categories_row = mysqli_fetch_assoc($categories_result)) {
    echo "<a href='?page=1&category=" . $categories_row['category'] . "' class='btn btn-secondary'>" . $categories_row['category'] . " (" . $categories_row['count'] . ")</a>";
}
echo "</div>";

// output variable to browser console
if (!$result) {
    die('Error executing query: ' . mysqli_error($conn));
}

echo '<div class="card-deck row" style="margin-top: 50px;">';

if (!$result) {
    die('Error executing query: ' . mysqli_error($conn));
}

while ($row = mysqli_fetch_assoc($result)) {
    $stmt = mysqli_prepare($conn, "SELECT title, content, author, publish_date, article_id, source_url FROM articles WHERE article_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $row['article_id']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $title, $content, $author, $publish_date, $article_id, $source_url);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    echo '<div class="col-sm-6">';
    echo '<div class="card" style="margin-top: 5px;">';
    echo '<img height="250" width="300" src="' . $source_url . '" class="card-img-top" alt="">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $title . '</h5>';

         if (!preg_match('/<[^>]+>/', $content)) {
    // Add <p> tags around the content
    $content = '<p class="card-text">' . $content . '</p>';
    }
    $stripped_content = strip_tags($content);
    $excerpt = mb_substr($stripped_content, 0, 500);
    if(mb_strlen($stripped_content) > 100){
        $excerpt .= '...';
    }
    $sanitizedContent = htmlspecialchars_decode($excerpt);  
    echo '<p class="card-text">' . $sanitizedContent . '</p>';


    
    
  
    echo '<p class="card-text"><small class="text-muted">By ' . $author . ' | ' . $publish_date . '</small></p>';
    echo '<a href="article.php?id=' . $article_id . '" class="btn btn-primary">Read More</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '<script>console.log(' . json_encode($row) . ');</script>';
}

echo '</div>';

$total_pages = ceil($total_results / $results_per_page);

echo '<nav aria-label="Page navigation">';
echo '<ul class="pagination">';
for ($i = 1; $i <= $total_pages; $i++) {
    echo '<li class="page-item ' . ($i == $current_page ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '&category=' . $filter . '">' . $i . '</a></li>';
}
echo '</ul>';
echo '</nav>';

mysqli_close($conn);
