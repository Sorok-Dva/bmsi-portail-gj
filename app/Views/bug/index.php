<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 07/04/2016
 * @Time    : 10:09
 * @File    : index.php
 * @Version : 1.0
 * @LastUpdate  : 07/04/2016 à 10:09
 */
?>
<div class="container">
<div class="row">
    <section class="content">
        <h1>Liste des problèmes remontés par les utilisateurs</h1>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger btn-filter" data-target="opened">En attente</button>
                            <button type="button" class="btn btn-success btn-filter" data-target="closed">Fermés</button>
                            <button type="button" class="btn btn-default btn-filter" data-target="all">Tous</button>
                        </div>
                    </div>
                    <div class="table-container">
                        <table class="table table-filter">
                            <tbody>
                            <?php foreach($bugs as $bug):

                                switch($bug->status):
                                    case "O":
                                        $validation = "opened";
                                        $state = "Ouvert";
                                        break;
                                    case "C":
                                        $validation = "closed";
                                        $state = "Fermé";
                                        break;
                                endswitch; ?>
                                <tr data-status="<?= $validation ?>" data-id="<?= $bug->id ?>">
                                    <td>
                                        <div class="media">
                                            <div class="media-header">
                                                <span class="media-meta pull-right">Le <?= date("d/m/Y", $bug->date) ?></span>
                                                <h4 class="title">
                                                    Problème #<?= $bug->id ?> (remonté par <?= $bug->identity ?>)
                                                    <span class="pull-right bugstatus <?= $validation ?>">(Problème <?= $state ?>)</span>
                                                </h4>
                                            </div>
                                            <div class="media-body" style="display:none;">
                                                <hr style="border: 3px dotted black">
                                                <p><?= $bug->report ?></p>

                                                <?php if($bug->screen != ""): ?><br>
                                                    <h4>Pièce jointe : <a href="<?= App::env("SITE_URL"); ?>app/__bugs_ss/<?= $bug->screen ?>" target="_blank">Cliquez ici pour voir la pièce jointe</a></h4>
                                                <?php endif;
                                                if($bug->url != ""): ?><br>
                                                    <h4><a href="<?= $bug->url ?>" target="_blank">Lien</a></h4>
                                                <?php endif;
                                                if($bug->status == "O"): ?>
                                                    <button class="btn btn-success" data-id="<?= $bug->id ?>"><span class="glyphicon glyphicon-eye-open "></span> Résolu</button>
                                                <?php endif;
                                                if($bug->status == "C"): ?>
                                                    <button class="btn btn-danger" data-id="<?= $bug->id ?>"><span class="glyphicon glyphicon-eye-close "></span> Non résolu</button>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
</div>


<script>
    $(document).ready(function () {

        $('.star').on('click', function () {
            $(this).toggleClass('star-checked');
        });

        $('.ckbox label').on('click', function () {
            $(this).parents('tr').toggleClass('selected');
        });

        $('.btn-filter').on('click', function () {
            var $target = $(this).data('target');
            if ($target != 'all') {
                $('.table tr').css('display', 'none');
                $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
            } else {
                $('.table tr').css('display', 'none').fadeIn('slow');
            }
        });

        $('.media-header').click(function(){
            if($(this).next('.media-body').is(':visible')) {
                $(this).next('.media-body').fadeOut(500);
            } else {
                $(this).next('.media-body').fadeIn(500);
            }

        });

        $('.media-body').find('button').click(function(){
            var status = $(this).text();
            var update ="";
            var newStatus ="";
            var newBugStatus ="";
            var id = $(this).attr('data-id');

            $(this).remove();
            
            switch (status) {
                case " Résolu":
                    update = "C";
                    newStatus = "closed";
                    newBugStatus = "(Problème Fermé)";

                    break;
                case " Non résolu":
                    update = "O";
                    newStatus = "opened";
                    newBugStatus = "(Problème Ouvert)";
                    break;
            }

            $.post('../../app/Ajax.php', {"action": "updateBug", "update": update, "id": id}, function (data) {
                $('[data-id="'+id+'"').attr('data-status', newStatus);
                $('[data-id="'+id+'"').find('.bugstatus').attr('class', newStatus+" pull-right ").empty().append(newBugStatus);

            }, 'json');
        })

    });
</script>



