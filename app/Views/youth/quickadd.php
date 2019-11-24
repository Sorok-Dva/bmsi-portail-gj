<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 11/04/2016
 * @Time    : 13:35
 * @File    : quickadd.php
 * @Version : 1.0
 * @LastUpdate  : 11/04/2016 à 13:35
 */
?>
<div class="container">
    <div class="alert alert-info">
        <h3>Vous avez la possibilité de créer un dossier instantanément en important les informations du dossier en question depuis le <b><a href="https://portail.i-milo.fr" target="_blank">portail conseiller I-Milo</a></b>. <br><br>
            Depuis l'interface du <b><a href="https://portail.i-milo.fr" target="_blank">portail conseiller I-Milo</a></b>, exportez simplement le dossier d'<b>un</b> jeune en fichier <b>CSV</b> puis importez le grâce au formulaire ci-dessous.</h3>
    </div>

    <?php if($error):
        switch($error):
            case "size":
                $return = "Le fichier est trop volumineux, il ne doit pas dépasser 1MO";
                break;
            case "type":
                $return = "Le type du fichier n'est pas accepté, vous devez importer un fichier CSV";
                break;
            case "upload":
                $return = "Erreur inconnue, réessayez";
                break;
            case "ar_exist":
                $return = "Le dossier existe déjà";
                break;
            case "bad_file":
                $return = "Les données de votre fichier ne correspondent pas/sont corrompues ou incomplète";
                break;

        endswitch;
        ?>
        <div class="alert alert-danger">
            <h3>Une erreur est survenue lors de l'envoi de votre formulaire : <?= $return ?>.</h3>
        </div>
    <?php endif; ?>
    
    <div class="panel panel-default">
        <div class="panel-heading"><small>Importer un dossier depuis le <b><a href="https://portail.i-milo.fr" target="_blank">portail conseiller I-Milo</a></b></small></div>
        <div class="panel-body">
            <form action="/youth/quickadd" method="post" enctype="multipart/form-data" class="form-horizontal" role="form" autocomplete="off" >
                <div class="form-group">
                    <label class="col-md-4 control-label" for="csvfile">Choisissez un fichier (csv | max. 1 Mo)</label>
                    <div class="col-md-4">
                        <input type="file" name="csvfile" class="form-control"  required>
                    </div>
                </div>
                <div class="alert alert-info">
                    Pour récupérer le numéro de dossier d'un jeune, lorsque vous êtes sur la page pour exporter le dossier en CSV, récupérer simplement la suite de numéros dans l'adresse url après le "/dossier/". (C.F capture d'écran)<br><br>
                    <img src="<?= App::env("SITE_URL") ?>public/images/id_folder.png"/>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="id_folder">Numéro de Dossier</label>
                    <div class="col-md-4">
                        <input type="text" name="id_folder" id="id_folder" class="form-control" required />
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary pull-right" id="js-upload-submit" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Envoi et traitement des données en cours...">Valider</button>

            </form>
        </div>
    </div>
</div> <!-- /container -->