<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 07/04/2016
 * @Time    : 08:41
 * @File    : reportBug.php
 * @Version : 1.0
 * @LastUpdate  : 07/04/2016 à 08:41
 */

if(!empty($_SESSION)):
?>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<div class="feedback left">
    <div class="tooltips">
        <div class="btn-group dropup">
            <button type="button" class="btn btn-primary dropdown-toggle btn-circle btn-lg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bug fa-2x" title="Rapporter un problème"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-right dropdown-menu-form">
                <li>
                    <div class="report">
                        <h2 class="text-center">Un problème?</h2>
                        <form class="doo" method="post" action="/bug/report">
                            <div class="col-sm-12">
                                <textarea required name="comment" class="form-control" placeholder="Merci de nous signaler le bug ou problème que vous avez rencontré , fournissez autant de détails que possible." style="resize:none"></textarea>
                                <input name="url" type="hidden" value="<?= $_SERVER['QUERY_STRING'] ?>"/>
                                <input name="screenshot" type="hidden" class="screen-uri">
                                <span class="screenshot pull-right"><i class="fa fa-camera cam" title="Prendre une capture d'écran"></i></span>
                            </div>
                            <div class="col-sm-12 clearfix">
                                <button class="btn btn-primary btn-block">Envoyer le rapport</button>
                            </div>
                        </form>
                    </div>
                    <div class="loading text-center hideme">
                        <h2>Veuillez patienter</h2>
                        <h2><i class="fa fa-refresh fa-spin"></i></h2>
                    </div>
                    <div class="reported text-center hideme">
                        <h2>Merci!</h2>
                        <p>Votre rapport a été reçu, <br>nous allons l'étudier dans les plus bref délais.</p>
                        <div class="col-sm-12 clearfix">
                            <button class="btn btn-success btn-block do-close">Fermer</button>
                        </div>
                    </div>
                    <div class="failed text-center hideme">
                        <h2>Oops!</h2>
                        <p>Il semblerait que votre rapport n'a pas été envoyé<br><br></p>
                        <div class="col-sm-12 clearfix">
                            <button class="btn btn-danger btn-block do-close">Fermer</button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<?php endif; ?>