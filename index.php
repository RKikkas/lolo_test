<?php
/**
 * Created by PhpStorm.
 * User: Roger-PC
 * Date: 29-Jan-19
 * Time: 13:13
 */
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lolo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require_once "includes/functions.php"; ?>
<div id="container">
    <div id="modal">
        <div id="modal-box">
            <span id="close">&times;</span>
            <h2 id="title"></h2>
            <div id="modal-content"></div>
        </div>
    </div>
    <?php getFeed("https://flipboard.com/@raimoseero/feed-nii8kd0sz.rss"); ?>
</div>
</html>
