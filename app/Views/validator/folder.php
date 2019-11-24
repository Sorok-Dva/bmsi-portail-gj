<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 05/04/2016
 * @Time    : 10:40
 * @File    : folder.php
 * @Version : 1.0
 * @LastUpdate  : 05/04/2016 à 10:40
 */

$today = new DateTime();
$birthday = new DateTime(date('m/d/Y', $youth->birthday));
$interval = $birthday->diff($today);

switch($youth->validation):
    case "P":
        $state = "en attente";
        break;
    case "V":
        $state = "validé";
        break;
    case "R":
        $state = "refusé";
        break;
endswitch;
?>
<script type="text/javascript"> var id = "<?= $youth->youth_id ?>"; var jeune = "<?= $youth->identity ?>"; var jeune_id = "<?= $youth->youth_id ?>"; var referant = "<?= $youth->ML_referring_in_charge ?>";

    $(document).ready(function(){
        $(".datepicker").datepicker({
            dateFormat: "dd/mm/yy",
            autoSize: true,
            changeYear: false,
            minDate: "-0d",
            maxDate: "+6m",
            dayNames: ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"],
            dayNamesMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
            dayNamesShort: ["Dim", "Mar", "Mer", "Jeu", "Ven", "Sam", "Lun"],
            monthNames: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"],
            monthNamesShort: ["Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jui", "Aou", "Sep", "Oct", "Nov", "Dec"]
        });
    });
    </script>
<script type="text/javascript" src="<?= App::env("SITE_URL") ?>public/js/validator.js"></script>
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Dossier <b class="state"><?= $state ?></b></h3>
    </div>
    <div class="panel-body" style="margin-left: 20%;">
        <div class="row">
            <div class=" col-md-9 col-lg-9 "  align="center">
                <table style="width: 200%;border: solid 1px #5544DD;" align="center" class="table table-user-information">
                    <thead>
                    <tr>
                        <th style="width: 100%; text-align: center; border: solid 1px #337722; background: #CCFFCC" colspan="4">Renseignements généraux sur <i><?= $youth->identity ?></i></th>
                    </tr>
                    </thead>
                    <tbody style="width:100%;border: solid 1px black">
                    <tr class="border_bottom">
                        <td style="width:50%" colspan="2"><?= $youth->civility ?> <?= $youth->identity ?></td>
                        <td style="width:25%;"><b>Né<?= $e ?> le</b></td>
                        <td style="width:25%;"><?=date('d/m/Y', $youth->birthday)?>. (<?= $interval->format('%y'); ?> ans)</td>
                    </tr>

                    <tr class="border_bottom">
                        <td style="width:25%"><b>Nationalité</b></td>
                        <td style="width:25%"><?= $youth->nationality ?></td>

                        <td style="width:25%"><b>Né<?= $e ?> à</b></td>
                        <td style="width:25%"><?= $youth->birthplace_town ?></td>
                    </tr>

                    <tr class="border_bottom">
                        <td style="width:25%"><b>Adresse</b></td>
                        <td colspan="3"><?= $youth->address ?></td>
                    </tr>

                    <tr class="border_bottom">
                        <td style="width:25%"><b>Téléphone (portable)</b></td>
                        <td style="width:25%"><?= $youth->phone_number ?></td>

                        <td style="width:25%"><b>Téléphone (fixe)</b></td>
                        <td style="width:25%"><?= $youth->fixe_number ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Adresse e-mail</b></td>
                        <td colspan="2"><?= $youth->mail ?></td>
                    </tr>
                    <tr>
                        <td style="width:25%">Conseiller prescripteur en charge :</td>
                        <td style="width:25%"><?= $youth->ML_referring_in_charge ?></td>

                        <td style="width:25%">N° de téléphone du conseiller</td>
                        <td style="width:25%"><?= $youth->phone_ML_referring_in_charge ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Site de rattachement :</td>
                        <td colspan="2"><?= $youth->attachment_antenna ?></td>
                    </tr>
                    </tbody>
                </table><br>

                <!-- Situation -->
                <table style="width: 200%;border: solid 1px #5544DD;" align="center" class="table">
                    <thead>
                    <tr>
                        <th style="width: 100%; text-align: center; border: solid 1px #337722; background: #CCFFCC" colspan="4">Situation actuelle et parcours</th>
                    </tr>
                    </thead>
                    <tbody style="width:100%;border: solid 1px black">
                    <tr class="border_bottom">
                        <td style="width:25%"><b>JAPD</b></td>
                        <td style="width:25%;"><?= $youth->JAPD ?></td>
                        <td style="width:25%;"><b>Recensé</b></td>
                        <td style="width:25%;"><?= $youth->identified ?></td>
                    </tr>

                    <tr class="border_bottom">
                        <td style="width:25%"><b>Etudiant ou en formation</b></td>
                        <td style="width:25%"><?= $youth->student_training ?></td>

                        <td style="width:25%"><b>En éducation</b></td>
                        <td style="width:25%"><?= $youth->youth_education ?></td>
                    </tr>

                    <tr class="border_bottom">
                        <td style="width:50%" colspan="2"><b>En emploi</b></td>
                        <td style="width:50%" colspan="2"><?= $youth->youth_employment ?></td>
                    </tr>

                    <tr class="border_bottom">
                        <td style="width:25%"><b>Dernière classe suivie</b></td>
                        <td style="width:25%"><?= $youth->last_classroom ?></td>

                        <td style="width:25%"><b>Date de la dernière classe suivie</b></td>
                        <td style="width:25%"><?= date('d/m/Y', $youth->last_classroom_date) ?></td>
                    </tr>

                    <tr class="border_bottom">
                        <td style="width:50%" colspan="2"><b>Établissement de la dernière classe</b></td>
                        <td style="width:50%" colspan="2"><?= $youth->last_classroom_establishment ?></td>
                    </tr>

                    <tr>
                        <td style="width:50%" colspan="2"><b>Meilleur diplome</b></td>
                        <td style="width:50%" colspan="2"><?= $youth->greatest_qualification ?></td>
                    </tr>
                    </tbody>
                </table><br>


                <!-- Situation précarité -->
                <table style="width: 200%;border: solid 1px #5544DD;" align="center" class="table">
                    <thead>
                    <tr>
                        <th style="width: 100%; text-align: center; border: solid 1px #337722; background: #CCFFCC" colspan="4">Analyse de la situation de précarité</th>
                    </tr>
                    </thead>
                    <tbody style="width:100%;border: solid 1px black">
                    <tr class="border_bottom">
                        <td style="width:25%"><b>Situation familial</b></td>
                        <td style="width:25%;"><?= $youth->life_situation ?></td>
                        <td style="width:25%;"><b>Nombres d'enfants à charge</b></td>
                        <td style="width:25%;"><?= $youth->dependent_children ?></td>
                    </tr>
                    </tbody>
                </table>

                <hr>
                <h2>Pièces jointes : </h2>
                <?php
                    if(!empty($youth->files_CNI)): ?>
                        <h4>Carte d'identité : <a href="<?= App::env("SITE_URL") . $youth->files_CNI ?>" download="Pièce_Jointe_CNI-<?= $youth->lastName ?>_<?= $youth->name ?>">Lien</a></h4>
                <?php    endif;
                    if(!empty($youth->files_carteV)): ?>
                        <h4>Carte vitale : <a href="<?= App::env("SITE_URL") . $youth->files_carteV ?>-<?= $youth->lastName ?>_<?= $youth->name ?>">Lien</a></h4>
                <?php    endif;
                    if(!empty($youth->files_authorization)): ?>
                        <h4>Autorisations représentant légal/tutelle/curatelle : <a href="<?= App::env("SITE_URL") . $youth->files_authorization ?>" download="Pièce_Jointe_Auth-<?= $youth->lastName ?>_<?= $youth->name ?>" target="_blank">Lien</a></h4>
                <?php    endif;
                    if(!empty($youth->files_RIB)): ?>
                        <h4>RIB : <a href="<?= App::env("SITE_URL") . $youth->files_RIB ?>" target="_blank">Lien</a></h4>
                <?php    endif;
                    if(!empty($youth->files_just_comicile)): ?>
                        <h4>Justificatif de domicile : <a href="<?= App::env("SITE_URL") . $youth->files_just_comicile ?>" target="_blank">Lien</a></h4>
                <?php    endif;
                    if(!empty($youth->files_CPAM)): ?>
                        <h4>CPAM : <a href="<?= App::env("SITE_URL") . $youth->files_CPAM ?>" target="_blank">Lien</a></h4>
                <?php    endif;?>
            </div>
        </div>
    </div>
    <div class="panel-footer" style="min-height:50px;">
        <span class="pull-left">
            <input type="text" class="motif" placeholder="Motif de votre choix"/>
            <input type="text" class="datepicker" placeholder="JJ/MM/YYYY" />
            <!--<select class="date">
                <option>Choisissez une date de commission</option>
            </select>-->
            <select class="lieu">
                <option>Choisissez un site de commission</option>
                <option value="Tarbes">Tarbes</option>
                <option value="Vic de Bigorre">Vic de Bigorre</option>
                <option value="Bagnères de Bigorre">Bagnères de Bigorre</option>
                <option value="Lannemezan">Lannemezan</option>
            </select>



        </span>
        <span class="pull-right">
            <a href="/pdf/generate/<?= $youth->i_milo_folder_id ?>" target="_blank" class="btn btn-sm btn-info" type="button"><i class="glyphicon glyphicon-print"></i></a>
            <a data-original-title="Valider ce dossier" data-toggle="tooltip" type="button" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-thumbs-up"></i></a>
            <a data-original-title="Mettre en attente" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-pause"></i></a>
            <a data-original-title="Refuser ce dossier" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-thumbs-down"></i></a>
        </span>
    </div>
</div>