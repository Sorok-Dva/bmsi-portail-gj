<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 11/04/2016
 * @Time    : 17:42
 * @File    : error.php
 * @Version : 1.0
 * @LastUpdate  : 11/04/2016 à 17:42
 */
?>
<!DOCTYPE>
<html>
<head>
    <title>Erreur ! <?= App::env("SITE_NAME") ?></title>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="<?= App::env("SITE_URL") ?>public/vendors/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?= App::env("SITE_URL") ?>public/css/font.css" type="text/css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= App::env("SITE_URL") ?>public/css/defaultTemplate.css" type="text/css" rel="stylesheet">
    <link href="<?= App::env("SITE_URL") ?>public/css/loader.css" type="text/css" rel="stylesheet">
    <link href="<?= App::env("SITE_URL") ?>public/css/errorStyle.css" rel="stylesheet" type="text/css" media="all"/>

    <link href='http://fonts.googleapis.com/css?family=Fenix' rel='stylesheet' type='text/css'>

    <script src="<?= App::env("SITE_URL") ?>public/js/versionJQuery.js" type="text/javascript"></script>
    <script src="<?= App::env("SITE_URL") ?>public/js/UserInterface.js" type="text/javascript"></script>
    <script src="<?= App::env("SITE_URL") ?>public/vendors/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <script src="<?= App::env("SITE_URL") ?>public/js/loader.js" type="text/javascript"></script>
    <script src="<?= App::env("SITE_URL") ?>public/js/JQuery.js" type="text/javascript"></script>
</head>

<body>
    <div class="wrap">
        <div class="main">
            <h3><?= App::env("SITE_NAME") ?> - Page d'erreur</h3>
            <?= $content ?>
            <br>
            <span><a href="<?= App::env("SITE_URL") ?>" class="btn btn-primary btn-lg">
                    <span class="glyphicon glyphicon-home"></span>
                    Retour à l'accueil </a>
            </span>
            <br><br>
        </div>
        <div class="footer">
            <?php require 'Modules/reportBug.php' ?>
            <p>&copy; <?= App::env("SITE_NAME") ?> 2016 | <span class="right"> Version : <?= App::env("VERSION") ?></span>
        </div>
    </div>
</body>
</html>