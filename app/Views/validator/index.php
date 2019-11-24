<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 05/04/2016
 * @Time    : 09:41
 * @File    : index.php
 * @Version : 1.0
 * @LastUpdate  : 05/04/2016 à 09:41
 */
?>
<div class="container">
    <div class="row">
        <section class="content">
            <h1>Vue globale des dossiers</h1>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-right">
                            <div class="btn-group">
<!--                                <button type="button" class="btn btn-success btn-filter" data-target="validated">Validé</button>-->
                                <button type="button" class="btn btn-warning btn-filter" data-target="pending">En attente</button>
                                <button type="button" class="btn btn-danger btn-filter" data-target="refused">Refusé</button>
                                <button type="button" class="btn btn-default btn-filter" data-target="all">Tous</button>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="table table-filter">
                                <tbody>

                                <?php foreach($folders as $folder):

                                    $today = new DateTime();
                                    /**
                                     * Corrigé la génération de la date (en to fr)
                                     */
                                    $birthday = new DateTime(date('m/d/Y', $folder->birthday));
                                    $interval = $birthday->diff($today);

                                    switch($folder->validation):
                                        case "P":
                                            $validation = "pending";
                                            $state = "en attente";
                                            break;
                                        case "V":
                                            $validation = "validated";
                                            $state = "validé";
                                            break;
                                        case "R":
                                            $validation = "refused";
                                            $state = "refusé";
                                            break;
                                    endswitch;?>
                                    <tr data-status="<?= $validation ?>">
                                        <td>
                                            <div class="media">
                                                <a href="#" class="pull-left">
                                                    <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                </a>
                                                <div class="media-body">
                                                    <span class="media-meta pull-right">5 Mars 2016</span>
                                                    <h4 class="title">
                                                        <a href="/validator/folder/<?= $folder->youth_id ?>"><?= $folder->civility ?> <?= $folder->identity ?></a>
                                                        <span class="pull-right <?= $validation ?>">(Dossier <?= $state ?>)</span>
                                                    </h4>
                                                    <p class="summary">Né(e) à <?= $folder->birthplace_town ?> le <?= date('d/m/Y', $folder->birthday)?>. (<?= $interval->format('%y'); ?> ans)</p>
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

        $('.btn-filter').on('click', function () {
            var $target = $(this).data('target');
            if ($target != 'all') {
                $('.table tr').css('display', 'none');
                $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
            } else {
                $('.table tr').css('display', 'none').fadeIn('slow');
            }
        });

        $('button[data-target=pending').trigger('click');
    });
</script>