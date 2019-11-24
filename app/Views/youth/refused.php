<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 18/04/2016
 * @Time    : 11:17
 * @File    : refused.php
 * @Version : 1.0
 * @LastUpdate  : 18/04/2016 à 11:17
 */ ?>

<div class="alert alert-danger">
    <h2>Le dossier de <b><?= $youth->identity ?></b> viens d'être refusé par le validateur.</h2>

    <?php
    if($youth->validator_motif != ""): ?>
        <h3><i>Le validateur informe : <b><?= $youth->validator_motif ?></b></i></h3>
    <?php   endif;
    ?>

    Ce dossier est clos.
</div>
