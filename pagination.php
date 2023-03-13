<?php
    require 'connect.php';
    
    $result = $conn->query("SELECT DISTINCT category FROM Articles");
    while ($row = $result->fetch_assoc()) {
            echo '<li class="list-group-item"><a href="?category=' . $row["category"] . '">' . $row["category"] . '</a></li>';
    }