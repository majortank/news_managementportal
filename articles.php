<?php 

require 'connect.php';


// set pagination variables
$results_per_page = 10;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $results_per_page;

// set filter variable
$filter = isset($_GET['category']) ? $_GET['category'] : '';

// build query based on filter
if ($filter) {
    $sql = "SELECT * FROM Articles WHERE category='$filter' AND status=1 LIMIT $offset, $results_per_page";
    $count_sql = "SELECT COUNT(*) AS count FROM Articles WHERE category='$filter' AND status=1";
} else {
    $sql = "SELECT * FROM Articles WHERE status=1 LIMIT $offset, $results_per_page";
    $count_sql = "SELECT COUNT(*) AS count FROM Articles WHERE status=1";
}


// execute query to retrieve articles
$result = mysqli_query($conn, $sql);

// execute query to retrieve count of articles in category
$count_result = mysqli_query($conn, $count_sql);
$count_row = mysqli_fetch_assoc($count_result);
$total_results = $count_row['count'];
$total_pages = ceil($total_results / $results_per_page);

// display filter buttons
$categories_sql = "SELECT category, COUNT(*) AS count FROM Articles GROUP BY category";
$categories_result = mysqli_query($conn, $categories_sql);
echo "<div style=margin-top: 80px;'  class='btn-group'>";
echo "<a href='?page=1' class='btn btn-secondary'>All (" . $total_results . ")</a>";
while ($categories_row = mysqli_fetch_assoc($categories_result)) {
    echo "<a href='?page=1&category=" . $categories_row['category'] . "' class='btn btn-secondary'>" . $categories_row['category'] . " (" . $categories_row['count'] . ")</a>";
}
echo "</div>";

// output variable to browser console




// display articles
echo '<div class="card-deck row" style="margin-top: 50px;">';
while ($row = mysqli_fetch_assoc($result)) {
echo '  <div class="col-sm-6">';
echo '    <div class="card" style="margin-top: 5px;">';
echo "      <img height='250' width='300' src='" . $row['source_url'] . "' class='card-img-top' alt=''>";
echo '      <div class="card-body">';
echo "      <h5 class='card-title'>" . $row['title'] . "</h5>";
echo "<p class='card-text'>" . substr($row['content'], 0, 100) . "...</p>";
echo "      <p class='card-text'><small class='text-muted'>By " .$row['author'] . " | " . $row['publish_date'] . "</small></p>";
echo "      <a href='article.php?id=" . $row['article_id'] . "' class='btn btn-primary'>Read More</a> ";
echo '      </div>';
echo '    </div>';
echo '  </div>';
echo "<script>console.log(".json_encode($row).");</script>";
}

echo '</div>';

$total_pages = ceil($total_results / $results_per_page);

// display pagination links
echo "<nav aria-label='Page navigation'>";
echo "<ul class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<li class='page-item " . ($i == $current_page ? 'active' : '') . "'><a class='page-link' href='?page=" . $i . "&category=" . $filter . "'>" . $i . "</a></li>";
}
echo "</ul>";
echo "</nav>";
// close database connection
mysqli_close($conn);
?>


