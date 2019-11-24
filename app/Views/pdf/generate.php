<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 13/04/2016
 * @Time    : 15:27
 * @File    : generate.php
 * @Version : 1.0
 * @LastUpdate  : 13/04/2016 à 15:27
 */

require ROOT.'/core/html2pdf/vendor/autoload.php';
ob_start();

$today = new DateTime();
$birthday = new DateTime(date('m/d/Y',  $youth->birthday));
$interval = $birthday->diff($today);

switch($youth->civility):
    case "MADAME":
        $e = "e";
        break;
    case "MONSIEUR":
        $e = "";
        break;
    default:
        $e = "(e)";

endswitch;
?>
<style type="text/css">
    tr.border_bottom td {
        border-bottom:1px solid black;
    }
    table.table, td, tr {
/*        border-left: solid 1px black;
        border-right: solid 1px black;*/
        padding: 8px 5px;
    }
    .right {
        text-align:right;
        width:10%;
    }
    .left {
        text-align:left;
        width:10%;
    }
    .center {
        text-align:center;
    }
</style>
    <page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
        <page_header>
            <table style="width: 100%;height:100px">
                <tr>
                    <td style="text-align: left;    width: 33%"><img src="<?= ROOT ?>/public/images/pdf/LogoM.png"  style=""/></td>
                    <td style="text-align: center;    width: 34%">Dossier de <?= $youth->civility ?> <b><?= $youth->identity ?></b></td>
                    <td style="text-align: right;    width: 33%">Imprimé le <?php echo date('d/m/Y'); ?></td>
                </tr>
            </table>
        </page_header>
        <page_footer>
            <table style="width: 100%; border: solid 1px black;">
                <tr>
                    <td style="text-align: left;    width: 50%">Page :</td>
                    <td style="text-align: right;    width: 50%">[[page_cu]]/[[page_nb]]</td>
                </tr>
            </table>
        </page_footer>

        <div style="margin-top:80px">
            <!-- IDENTITY -->
            <table style="width: 100%;border: solid 1px #5544DD;" align="center" class="table">
                <thead>
                    <tr>
                        <th style="width: 100%; text-align: center; border: solid 1px #337722; background: #CCFFCC" colspan="4">Renseignements généraux sur <i><?= $youth->identity ?></i></th>
                    </tr>
                </thead>
                <tbody style="width:100%;border: solid 1px black">
                    <tr class="border_bottom">
                        <td style="width:50%" colspan="2"><?= $youth->civility ?> <?= $youth->identity ?></td>
                        <td style="width:25%;"><b>Né<?= $e ?> le</b></td>
                        <td style="width:25%;"><?= date('d/m/Y', $youth->birthday)?>. (<?= $interval->format('%y'); ?> ans)</td>
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

                </tbody>
            </table><br>

            <!-- Situation -->
            <table style="width: 100%;border: solid 1px #5544DD;" align="center" class="table">
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
            <table style="width: 100%;border: solid 1px #5544DD;" align="center" class="table">
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
        </div>

    </page>
<?php

$pdf = ob_get_clean();

try{
    $html2pdf = new HTML2PDF("P", "A4", "fr");
//    $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont("Arial");
    $html2pdf->writeHTML($pdf);
    $html2pdf->Output(date("d-m-y", $youth->commission_date)."_{$youth->commission_lieu}_GJ_".strtoupper($youth->lastName)."_{$youth->name}.pdf");
}catch(HTML2PDF_exception $e){
    die($e);
}

?>