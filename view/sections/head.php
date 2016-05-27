<?php
session_start();
include("../../controller/mainControllers/messageController.php");
?>
<head>
    <meta charset="utf-8">
    <title>WorldGames - Your Shop Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="bskit, bootstrap starter kit, bootstrap builder">
    <meta name="description" content="Your Favorite Shop of Games">
    <link rel="shortcut icon" href="../resources/images/favicon.png">
    <link href="../resources/css/bootstrap.min.css" rel="stylesheet">
    <link href="../resources/css/font-awesome.min.css" rel="stylesheet">
    <link href="../resources/css/style-library.css" rel="stylesheet">
    <link href="../resources/css/gallery.css" rel="stylesheet">
    <link href="../resources/css/jquery-ui.css" rel="stylesheet">
    <link href="../resources/css/jquery-ui.theme.css" rel="stylesheet">
    <link href="../resources/css/jquery-ui.structure.css" rel="stylesheet">
    <link href="../resources/css/header.css" rel="stylesheet">
    <link href="../resources/css/footer.css" rel="stylesheet">
    <link href="../resources/css/style.css" rel="stylesheet">
    <?php
    if (basename($_SERVER['PHP_SELF'])=="gameDetailsView.php") {
        echo '<link rel="stylesheet" href="../resources/css/gameDetails.css"/>';
    }
    ?>
</head>