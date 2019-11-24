<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 19/04/2016
 * @Time    : 08:57
 * @File    : index.php
 * @Version : 1.0
 * @LastUpdate  : 19/04/2016 à 08:57
 */

?>

<!-- Pick a theme, load the plugin & initialize plugin -->
<link href="<?= App::env("SITE_URL") ?>public/vendors/tablesorter/css/theme.default.css" rel="stylesheet">

<script src="<?= App::env("SITE_URL") ?>public/vendors/tablesorter/js/jquery.tablesorter.js"></script>
<script src="<?= App::env("SITE_URL") ?>public/vendors/tablesorter/js/jquery.tablesorter.widgets.js"></script>
<!-- Grouping widget -->
<script src="<?= App::env("SITE_URL") ?>public/vendors/tablesorter/js/parsers/parser-input-select.js"></script>
<script src="<?= App::env("SITE_URL") ?>public/vendors/tablesorter/js/widgets/widget-grouping.js"></script>

<script>
    $(function(){
        $('table').tablesorter({
            headers: {
                0: { sorter: "checkbox" }
            },
            widgets        : ['zebra', 'columns', 'output'],
            usNumberFormat : true,
            dateFormat : "ddmmyyyy",
            sortReset      : true,
            sortRestart    : true,
            checkboxClass  : 'checked',
            group_checkbox    : [ 'checked', 'unchecked' ]
        });


    });

    $(document).ready(function(){
        $('.download').click(function(){
            $('input[type=checkbox]').each(function(){
                if($(this).is(':checked')){
                    console.log($(this).parent('td').children('a').attr('href'));

                    $(this).parent('td').children('a').get(0).click();
                }
            });
        });
    });


</script>

<style>
    table.tablesorter tbody tr.odd.checked td {
        background: #8080c0;
        color: #fff;
    }
    table.tablesorter tbody tr.even.checked td {
        background: #a0a0e0;
        color: #fff;
    }
</style>
<button type="button" class="btn btn-success download">Télécharger les dossiers</button>
<table class="tablesorter">
    <thead>
    <tr>
        <th class="sorter-checkbox"></th>
        <th>Identité</th>
        <th class="sorter-shortDate dateFormat-ddmmyyyy">Date de commission</th>
        <th>Lieu de commission</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach($folders as $folder):
        $today = new DateTime();
        $birthday = new DateTime(date('m/d/Y', $folder->birthday));
        $interval = $birthday->diff($today);
        ?>
        <tr>
            <td><input type="checkbox" title="checkbox"><input type="text" value="<?= $folder->youth_id ?>" hidden /><a class="dl" href="<?= App::env("SITE_URL") ?>pdf/generate/<?= $folder->youth_id ?>" download="FileName" style="display:none">dl</a></td>
            <td><?= $folder->civility ?> <?= $folder->identity ?>, <?= date('d/m/Y', $folder->birthday)?>. (<?= $interval->format('%y'); ?> ans)</td>
            <td><?= date('d/m/Y', $folder->commission_date) ?></td>
            <td><?= $folder->commission_lieu ?></td>
        </tr>
        <?php
    endforeach;
    ?>
    </tbody>
</table>