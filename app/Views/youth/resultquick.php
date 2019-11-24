<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 11/04/2016
 * @Time    : 14:49
 * @File    : resultquick.php
 * @Version : 1.0
 * @LastUpdate  : 11/04/2016 à 14:49
 */

if($result): ?>
    <div class="alert alert-success">
        <h2>Le dossier a bien été exporté.</h2>
        <?php if($alert): ?>

        <p>Une alerte viens d'être créée pour vous, vous informant de la création de ce dossier et pour vous rappeller de le compléter. </p>
        <p>Si vous souhaitez compléter le dossier maintenant, cliquez <a href="/youth/manage/<?= $_POST['id_folder'] ?>/<?= $user_id ?>">ici</a> <!--(l'alerte génerée sera automatiquement supprimée)--></p>

        <?php endif; ?>
    </div>

<?php
endif;
?>