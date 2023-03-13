<?php
$links = [
    ['text' => 'Home', 'url' => '/'],
    ['text' => 'Dashboard', 'url' => '../auth/dashboard.php'],
    ['text' => 'Submit Article', 'url' => '../submit.php'],
    ['text' => 'Update Article', 'url' => '../update.php'],
];
$links_2 = [
    ['text' => 'Home', 'url' => '/'],
    ['text' => 'Dashboard', 'url' => '../auth/dashboard.php'],
];
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    $admin_links = [
        ['text' => 'Submit Article', 'url' => '../submit.php'],
        ['text' => 'Update Article', 'url' => '../update.php'],
    ];
    $links_2 = array_merge($links, $admin_links);
}

if (isset($_SESSION['user_id'])) {
    $user_links = [
        ['text' => 'Logout', 'url' => '../auth/logout.php'],
    ];
} else {
    $user_links = [
        ['text' => 'Login', 'url' => '../auth/signin.php'],
        ['text' => 'Register', 'url' => '../auth/signup.php'],
    ];
}

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="margin-bottom: 15px">
    <div class="container">
        <a class="navbar-brand" href="/">News Management Portal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <?php foreach ($links as $link) { ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $link['url']; ?>"><?php echo $link['text']; ?></a>
                    </li>
                <?php } ?>
                <?php foreach ($user_links as $link) { ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $link['url']; ?>"><?php echo $link['text']; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
