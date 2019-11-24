<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 13/04/2016
 * @Time    : 10:36
 * @File    : manage.php
 * @Version : 1.0
 * @LastUpdate  : 13/04/2016 à 10:36
 */
if (isset($id[3])) {
	$prefix = "../../..";
} else {
	$prefix = "../..";
}
?>
<script>
    var prefix = "<?=$prefix?>";
    function verifYouthPhone() {
        var phone = $('.verifPhone').val();

        if ($(".errorPhone").length === 0) {
            $('.verifPhone').parent('div').after('<div class="col-md-4 alert-danger errorPhone"></div>');
        }

        if ($('.verifPhone').val().length != 10) {
            $('.verifPhone').css({"border": "2px solid red", "color": "red"});
            $('.errorPhone').empty().append('Le numéro saisi n\'est pas au bon format. Le numéro doit comporter 10 nombres').show();
            phoneAvailable = false;
        } else {
            $('.verifPhone').css({"border": "2px solid green", "color": "black"});
            $('.errorPhone').empty().hide();
            phoneAvailable = true;
        }
    }

    function verifYouthMail() {
        var mail = $('.verifMail').val();
        var regMail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        if ($(".errorMail").length === 0) {
            $('.verifMail').parent('div').after('<div class="col-md-4 alert-danger errorMail"></div>');
        }

        if (!regMail.test(mail)) {
            $('.verifMail').css({"border": "2px solid red", "color": "red"});
            $('.errorMail').empty().append('L\'adresse e-mail saisie n\'est pas au bon format. Voici un exemple : adresse@domaine.fr').show();
            mailAvailable = false;
        } else {
            $('.verifMail').css({"border": "2px solid green", "color": "black"});
            $('.errorMail').empty().hide();
        }
    }
    $(document).ready(function(){

        $('input[data-info=date]').each(function(){
            var input = this;
            $.post('<?=App::env("SITE_URL")?>app/Ajax.php', {"action": "convertTime", "time": $(this).val()}, function (data) {
                $(input).val(data);
            }, 'json');
        });

        $(".verifPhone").keyup(function () {
            verifYouthPhone()
        });
        $(".verifMail").keyup(function () {
            verifYouthMail()
        });
    });

</script>
<script src="<?=App::env("SITE_URL")?>public/js/addYouth.js" type="text/javascript"></script>

<div class="container">
    <?php
if ($youth->validator_motif != ""): ?>
            <div class="alert alert-danger">
                Motif du validateur : <b><?=$youth->validator_motif?></b>
            </div>
<?php endif;?>

    <div class="alert alert-info">
        Vous modifiez les informations de <b><?=$youth->identity?></b>
    </div>

    <div class="row">
        <section>
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">

                        <li role="presentation" class="active">
                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Informations du jeune">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-user"></i>
                                </span>
                            </a>
                        </li>

                        <li role="presentation">
                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Situation et parcours du jeune">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-folder-open"></i>
                                </span>
                            </a>
                        </li>

                        <li role="presentation">
                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Sitatuation de précarité et autres">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-home"></i>
                                </span>
                            </a>
                        </li>

                        <li role="presentation">
                            <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Informations pour le dossier">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-info-sign"></i>
                                </span>
                            </a>
                        </li>

                        <li role="presentation">
                            <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Pièces jointes">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-paperclip"></i>
                                </span>
                            </a>
                        </li>

                        <li role="presentation">
                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Validation">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-ok"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>

                <form class="form-horizontal" method="post" action="/youth/manage/<?=$youth->youth_id?>" role="form" autocomplete="off">
                    <div class="tab-content">
                        <?php if (isset($errors)):
                            switch ($errors):
                            case "BAD_FORMAT_FILES":
                                $return = "Format de fichier non accepté. Les formats acceptés sont : png, jpg, jpeg, zip, pdf, doc et dox";
                                break;
                            endswitch;
                                ?>
	                        <div class="alert alert-danger">
	                            <h3>Une erreur est survenue lors de l'envoi de votre formulaire : <?=$return?>.</h3>
	                        </div>
	                        <?php endif;?>
                        <!-- IDENTITY -->
                        <div class="tab-pane active" role="tabpanel" id="step1">
                            <fieldset>
                                <legend>Identité et informations sur le jeune</legend>

                                <?=$form->formConstruct("part_1");?>
                            </fieldset>
                            <ul class="list-inline pull-right">
                                <input id="update" type="submit" class="btn btn-info" value="Valider" />
                                <li><button type="button" class="btn btn-primary next-step">Continuer</button></li>
                            </ul>
                        </div>

                        <!-- INFORMATIONS -->
                        <div class="tab-pane" role="tabpanel" id="step2">
                            <fieldset>
                                <legend>Situation actuelle et parcours du jeune</legend>
                                <?=$form->formConstruct("part_2");?>
                            </fieldset>

                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Précédent</button></li>
                                <li><button type="button" class="btn btn-primary next-step">Continuer</button></li>
                            </ul>
                        </div>

                        <!-- SITUATION -->
                        <div class="tab-pane" role="tabpanel" id="step3">
                            <fieldset>
                                <legend>Situation de précarité et autres.</legend>
                                <?=$form->formConstruct("part_3");?>
                            </fieldset>


                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Précédent</button></li>
                                <li><button type="button" class="btn btn-primary next-step">Continuer</button></li>
                            </ul>
                        </div>


                        <div class="tab-pane" role="tabpanel" id="step4">
                            <fieldset>
                                <legend>Information du dossier</legend>
                            </fieldset>

                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Précédent</button></li>
                                <li><button type="button" class="btn btn-primary next-step">Continuer</button></li>
                            </ul>
                        </div>

                        <div class="tab-pane" role="tabpanel" id="step5">
                            <h3>Pièces jointes</h3>
                            <div class="alert alert-info">
                                Type de fichier accepté : JPG, JPEG, PNG, DOC, DOCX, PDF, ZIP
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="CNI">Carte d'identité</label>
                                <div class="col-md-4">
                                    <input type="file" name="CNI" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="CarteV">Carte Vitale</label>
                                <div class="col-md-4">
                                    <input type="file" name="CarteV" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="cpam">Copie CPAM</label>
                                <div class="col-md-4">
                                    <input type="file" name="cpam" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="authorization">Autorisations représentant légal/tutelle/curatelle</label>
                                <div class="col-md-4">
                                    <input type="file" name="authorization" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="RIB">RIB</label>
                                <div class="col-md-4">
                                    <input type="file" name="RIB" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="just_domicile">Justificatif de domicile</label>
                                <div class="col-md-4">
                                    <input type="file" name="just_domicile" class="form-control">
                                </div>
                            </div>
                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Précédent</button></li>
                                <li><button type="button" class="btn btn-primary btn-info-full next-step">Continuer</button></li>
                            </ul>
                        </div>

                        <div class="tab-pane" role="tabpanel" id="complete">
                            <h3>Validation</h3>
                            <p>Vérifiez les données saisies, et si tout vous semble bon, vous pouvez valider le formulaire pour l'envoyer au validateur.</p>
                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="validate"></label>
                                <div class="col-md-4">
                                    <input id="update" type="submit" class="btn btn-info" value="Envoyer le dossier" />
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
