<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 23/03/2016
 * @Time    : 10:37
 * @File    : add.php
 * @Version : 1.0
 * @LastUpdate  : 23/03/2016 à 10:37
 */
?>
<script>
    var prefix = '..';
</script>
<script src="<?= App::env("SITE_URL")?>public/js/addYouth.js" type="text/javascript"></script>
<script src="<?= App::env("SITE_URL")?>public/js/verifData.js" type="text/javascript"></script>

<div class="container">
    <div class="alert alert-info">
        Vous pouvez importer les informations du dossier d'un jeune grâce à un export de ce dernier depuis le portail conseiller. Pour créer un dossier grâce à cette méthode, cliquez <a href="/youth/quickadd">ici</a>.
    </div>
    <div class="row">
        <section>
            <div class="wizard">
                <form class="form-horizontal" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
                    <div class="tab-content">

                        <!-- IDENTITY -->
                        <div class="tab-pane active" role="tabpanel" id="step1">
                            <fieldset>
                                <legend>Identité et informations sur le jeune</legend>
                                <?php
                            if(isset($errors)):
                                foreach ($errors as $error):
                                    switch ($error):
                                        case "DUPLICATE_IDENTITY":
                                            $alert = "warning";
                                            $message = "Nous avons déjà trouvé un jeune avec la même identité dans la base de donnée. Veuillez vérifier que le jeune ne soit pas déjà inscris. Le cas échéant, cliquez sur le bouton suivant pour valider le formulaire.";
                                            break;
                                        case "DUPLICATE_MAIL":
                                            $alert = "danger";
                                            $message = "Un jeune déjà inscris possède la même adresse e-mail. Veuillez vérifier cette information.";
                                            break;
                                        case "DUPLICATE_PHONE":
                                            $alert = "danger";
                                            $message = "Un jeune déjà inscris possède le même numéro de téléphone. Veuillez vérifier cette information.";
                                            break;
                                        case "EMAIL_BAD_FORMAT":
                                            $alert = "danger";
                                            $message = "L'email saisi n'est pas dans un bon format. <br> Exemple valide : adresse@service.fr";
                                            break;
                                        case "PHONE_BAD_FORMAT":
                                            $alert = "danger";
                                            $message = "Le numéro de téléphone saisi n'est pas valide. Le numéro doit comporter 10 chiffres. <br>
                                    Exemple valide 0601020304 (ou autre indicateur téléphonique français)";
                                            break;
                                        case "MISSING_FIELDS":
                                            $alert = "danger";
                                            $message = "Il manque des données au formulaire, veuillez revérifier que vous avez bien tout saisis.";
                                            break;
                                        case "ERROR_CIVILITY":
                                            $alert = "danger";
                                            $message = "Vous n'avez pas choisi de civilité.";
                                            break;
                                    endswitch; ?>
                                    <div class="alert alert-<?= $alert ?>"><?= $message ?></div>
                                <?php endforeach; endif;?>
                                <?= $form->formConstruct("part_1"); ?>
                            </fieldset>
                            <ul class="list-inline pull-right">
                                <li><button id="validate" class="btn btn-info">Créer le dossier</button></li>
                            </ul>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>