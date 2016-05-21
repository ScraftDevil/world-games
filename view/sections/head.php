<?php
session_start();
?>
<head>
    <meta charset="utf-8">
    <title>WorldGames - Your Shop Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="bskit, bootstrap starter kit, bootstrap builder">
    <meta name="description" content="Your Favorite Shop of Games">
    <link rel="shortcut icon" href="images/favicon.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style-library.css" rel="stylesheet">
    <link href="css/gallery.css" rel="stylesheet">
    <link href="css/blog.css" rel="stylesheet">
    <link href="css/jquery-ui.css" rel="stylesheet">
    <link href="css/jquery-ui.theme.css" rel="stylesheet">
    <link href="css/jquery-ui.structure.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link href="css/footer.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <?php
    if (basename($_SERVER['PHP_SELF'])=="detailsProduct.php") {
        echo '<link rel="stylesheet" href="css/detailGame.css"/>';
    }
    ?>
</head>