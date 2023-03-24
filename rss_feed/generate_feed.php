<?php
// Step 1: Connect to the database
require_once '../connect.php';

// Step 2: Fetch the latest articles
$sql = "SELECT * FROM articles ORDER BY publish_date DESC LIMIT 10";
$result = mysqli_query($conn, $sql);

// Step 3: Generate the RSS feed
header("Content-Type: application/rss+xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<rss version="2.0">';
echo '<channel>';
echo '<title>News Management Portal</title>';
echo '<link>http://www.nmp.com</link>';
echo '<description>Latest news and updates from News Manament Portal</description>';

while ($row = mysqli_fetch_assoc($result)) {
    $title = htmlspecialchars($row['title']);
    $description = htmlspecialchars($row['content']);
    $category = htmlspecialchars($row['category']);
    $pubDate = date("D, d M Y H:i:s O", strtotime($row['publish_date']));
    $link = htmlspecialchars($row['source_url']);

    echo '<item>';
    echo '<title>' . $title . '</title>';
    echo '<link>' . $link . '</link>';
    echo '<description>' . $description . '</description>';
    echo '<category>' . $category . '</category>';
    echo '<pubDate>' . $pubDate . '</pubDate>';
    echo '</item>';
}

echo '</channel>';
echo '</rss>';

// Step 4: Close the database connection
mysqli_close($conn);
?>
