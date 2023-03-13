<?php
    require 'connect.php';
    $limit = 10; // number of articles per page
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $limit;
    $category = isset($_GET['category']) ? $_GET['category'] : 'all';
    $where = ($category != 'all') ? "WHERE category = '$category'" : "";
    
    $result = $conn->query("SELECT * FROM Articles $where ORDER BY publish_date DESC LIMIT $offset, $limit");
    while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-4"><div class="card"><img class="card-img-top" src="' . $row["source_url"] . '" alt="' . $row["title"] . '"><div class="card-body"><h5 class="card-title">' . $row["title"] . '</h5><p class="card-text">' . $row["content"] . '</p><p class="card-text"><small class="text-muted">' . $row["author"] . '</small></p></div></div></div>';
    }