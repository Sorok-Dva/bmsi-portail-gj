<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 18/04/2016
 * @Time    : 11:17
 * @File    : accepted.php
 * @Version : 1.0
 * @LastUpdate  : 18/04/2016 à 11:17
 */ ?>

<div class="alert alert-success">
    <h2>Le dossier de <b><?= $youth->identity ?></b> viens d'être validé et envoyé en pré-commission/commission.</h2>

    <?php
    if($youth->validator_motif != ""): ?>
        <h3><i>Le validateur informe : <b><?= $youth->validator_motif ?></b></i></h3>
    <?php   endif;
    ?>
    Vous pouvez suivre l'avancement du dossier sur cette page.
</div>
