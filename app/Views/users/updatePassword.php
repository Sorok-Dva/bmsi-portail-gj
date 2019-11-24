<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 22/03/2016
 * @Time    : 10:51
 * @File    : updatePassword.php
 * @Version : 1.0
 * @LastUpdate  : 22/03/2016 à 11:00
 */

if ($errorOldPass): ?>
    <div class="alert alert-danger">Le mot de passe actuel que vous avez renseigné est incorrect.</div>
<?php endif;

if ($errorNewPass): ?>
    <div class="alert alert-danger">La confirmation de votre mot de passe ne correspond pas.</div>
<?php endif;

if ($missingFields): ?>
    <div class="alert alert-danger">Tout les champs n'ont pas été rempli.</div>
<?php endif; ?>

<form class="form-horizontal" method="post" autocomplete="off" disabled="">
    <fieldset>
        <!-- OldPass Input -->
        <legend>Mettez à jour votre mot de passe.</legend>

        <div class="form-group">
            <label class="col-md-4 control-label" for="oldPass">Mot de passe actuel</label>
            <div class="col-md-4">
                <input id="oldPass" name="oldPass" type="password" placeholder="Votre mot de passe actuel"
                       class="form-control input-md">
            </div>
        </div>

        <!-- NewPass input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="newPass">Nouveau mot de passe</label>
            <div class="col-md-4">
                <input id="newPass" name="newPass" type="password" placeholder="Votre nouveau mot de passe"
                       class="form-control input-md">
            </div>
        </div>
        <!-- NewConfPass input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="newPassConf">Confirmation</label>
            <div class="col-md-4">
                <input id="newPassConf" name="newPassConf" type="password"
                       placeholder="Confirmez votre nouveau mot de passe" class="form-control input-md">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="validate"></label>
            <div class="col-md-4">
                <button id="validate" name="validate" class="btn btn-info">Valider</button>
            </div>
        </div>

    </fieldset>
</form>
