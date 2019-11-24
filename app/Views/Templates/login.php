<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 11/04/2016
 * @Time    : 18:08
 * @File    : login.php
 * @Version : 1.0
 * @LastUpdate  : 11/04/2016 à 18:08
 */

?>
<!DOCTYPE>
<html>
<head>
    <title>Connexion - <?= App::env("SITE_NAME") ?></title>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="<?= App::env("SITE_URL") ?>public/vendors/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?= App::env("SITE_URL") ?>public/css/font.css" type="text/css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= App::env("SITE_URL") ?>public/css/loginTemplate.css" type="text/css" rel="stylesheet">
    <link href="<?= App::env("SITE_URL") ?>public/css/fakeLoader.css" type="text/css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Fenix' rel='stylesheet' type='text/css'>

    <script src="<?= App::env("SITE_URL") ?>public/js/versionJQuery.js" type="text/javascript"></script>
    <script src="<?= App::env("SITE_URL") ?>public/js/UserInterface.js" type="text/javascript"></script>
    <script src="<?= App::env("SITE_URL") ?>public/vendors/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <script src="<?= App::env("SITE_URL") ?>public/js/JQuery.js" type="text/javascript"></script>
    <script src="<?= App::env("SITE_URL") ?>public/js/fakeLoader.js" type="text/javascript"></script>
    <script>
        $.post('../../app/Ajax.php', {"action": "getLogoutImages", "department": "<?= $_COOKIE['department'] ?>"}, function (data) {
            if(data.logo === "none"){
                $('#img').remove();
                $('#text').toggle("drop", 1000);
            } else {
                $('#img').attr("src", "<?= App::env("SITE_URL") ?>"+data.logo);
            }
            $('.background').css({"background": "url('<?= App::env("SITE_URL") ?>"+data.background+"') no-repeat ", "background-size": "100%"});
        }, 'json');
        $(document).ready(function(){
            $(".loader").fakeLoader({
                timeToHide:1200,
                bgColor:"#7AA4C6",
                spinner:"spinner5"
            });
        });
        $(window).load(function(){
            $("#logo").show();
            $('hr').show().effect('slide', 'slow', function(){
                $("#img").show("blind", 2500, function(){
                    $('#text').toggle("drop", 1000);
                });
            });
        });

    </script>
</head>

<body>
<div class="loader"></div>
<div class="background"></div>

<div id="logo" style="display:none">
    <img id="img" src="" style="width:200px; height:200px;display:none;margin-left: 20%"/>
    <hr style="width:325px;display:none">
    <h4 id="text" style="display:none">Bienvenue sur le portail Garantie Jeune</h4>
</div>

    <div class="wrap">
        <div class="row">
            <div class="blur">
                <div style="margin-top:15px">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row-fluid user-row">
                                <h4>Connexion</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form role="form" class="form-signin" method="post" action="/login/index">
                                <fieldset>
                                    <label class="panel-login">
                                        <div class="login_result"></div>
                                    </label>
                                    <form method="post" action="$PORTAL_ACTION$">

                                        <input class="form-control" name="login" type="text" placeholder="Login">
                                        <input class="form-control" name="password" type="password" placeholder="Mot de passe">
                                        <input class="btn btn-lg btn-success btn-block" name="accept" type="submit" value="Connexion">
                                    </form>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
