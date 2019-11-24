<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 21/03/2016
 * @Time    : 09:01
 * @File    : default.php
 * @Version : 1.0
 * LastUpdate   :
 */
?>
<!DOCTYPE>
<html>
<head>
    <title><?= App::env("SITE_NAME") ?></title>

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
    <link href="<?= App::env("SITE_URL") ?>public/css/introjs.css" type="text/css" rel="stylesheet">
    <link href="<?= App::env("SITE_URL") ?>public/css/introjs-nassim.css" type="text/css" rel="stylesheet">
    <link href="<?= App::env("SITE_URL") ?>public/css/notification.css" type="text/css" rel="stylesheet">

    <link id="design" href="<?= App::env("SITE_URL") ?>public/css/UserInterface.css" rel="stylesheet" type="text/css"/>

    <script src="<?= App::env("SITE_URL") ?>public/js/versionJQuery.js" type="text/javascript"></script>
    <script src="<?= App::env("SITE_URL") ?>public/js/UserInterface.js" type="text/javascript"></script>
    <script src="<?= App::env("SITE_URL") ?>public/vendors/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <script src="<?= App::env("SITE_URL") ?>public/js/notification.js" type="text/javascript"></script>
    <script src="<?= App::env("SITE_URL") ?>public/js/infobulle.js" type="text/javascript"></script>
    <script src="<?= App::env("SITE_URL") ?>public/js/loader.js" type="text/javascript"></script>
    <script src="<?= App::env("SITE_URL") ?>public/js/JQuery.js" type="text/javascript"></script>
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><?= App::env("SITE_NAME") ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <?php require 'Modules/navbar.php'; ?>
        </div><!--/.navbar-collapse -->
    </div>
</nav>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron" style="margin-top:45px">
    <div class="container">
        <?php if(!empty($_SESSION)){ echo '<a href="/"><img src="'.$_SESSION['logo'].'" alt="logo département" style="height:125px;width:125px; float:left;"/></a>'; } ?>
        <h2 style="line-height: 2.1; margin-left: 150px;">Bienvenue sur le portail Garantie Jeune (<?= App::env("ENV") ?>)</h2>
    </div>
</div>

<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <?= $content; ?>
        <hr>

        <footer>
            <?php require 'Modules/reportBug.php' ?>
            <p>&copy; <?= App::env("SITE_NAME") ?> 2016 <span class="right">Version : <?= App::env("VERSION") ?></span>
            </p>
        </footer>
    </div> <!-- /container -->
    
</body>
</html>