<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 21/03/2016
 * @Time    : 15:41
 * @File    : register.php
 * @Version : 1.0
 * @LastUpdate  : 22/03/2016 à 11:16
 */

if ($errorDuplicateMail): ?>
    <div class="alert alert-danger">Cette adresse e-mail est déjà utilisée.</div>
<?php endif;

if ($errorDuplicateLogin): ?>
    <div class="alert alert-danger">Ce login est déjà utilisé.</div>
<?php endif;

if ($missingFields): ?>
    <div class="alert alert-danger">Tout les champs n'ont pas été rempli.</div>
<?php endif;

if ($errorDuplicateIdentity): ?>
    <div class="alert alert-danger">Un utilisateur possède déjà cette indentité.</div>
<?php endif;

if ($errorDuplicatePhone): ?>
    <div class="alert alert-danger">Ce numéro de téléphone est déjà utilisé.</div>
<?php endif; ?>
<script type="text/javascript">
    function addCode(name) {
        $.post('<?= App::env("SITE_URL")?>app/Ajax.php', {"type": "all", "name": name}, function (data) {
            $('.structure_name').val("" + data.name + "");
            $('.structure_code').val("" + data.code + "");
            $('.structure_department').val("" + data.department + "");
        }, 'json');
    }

    $(document).ready(function () {

        $('.antenna_name').autocomplete({
            source: '<?= App::env("SITE_URL")?>app/Ajax.php?type=antenna_name',
            dataType: 'json'
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
            return $("<li></li>").data("item.autocomplete", item)
                .append("<span onclick='addCode(\"" + item.value + "\")'>" + item.value + "</span>")
                .appendTo(ul);
        };

    });
</script>

<form class="form-horizontal" method="post" autocomplete="off">
    <fieldset>
        <legend>Formulaire d'ajout</legend>

        <div class="alert alert-warning">Lors de l'ajout du nom de l'antenne, cliquez bien sur le texte sinon l'ajout
            automatique ne fonctionnera pas.
        </div>

        <!-- Name -->
        <?= $form->input('name', 'Prénom', ['placeholder' => 'Prénom', 'required' => 'Y']); ?>
        <!-- Last Name -->
        <?= $form->input('lastName', 'Nom', ['placeholder' => 'Nom de famille', 'required' => 'Y']); ?>
        <!-- Last Name -->
        <?= $form->input('login', 'Identifiant', ['placeholder' => 'Identifiant de connexion', 'class' => 'verifLogin', 'onkeyup' => 'registrationVerify("login")', 'required' => 'Y']); ?>
        <!-- E-mail -->
        <?= $form->input('mail', 'Adresse e-mail', ['placeholder' => 'Adresse e-mail', 'class' => 'verifMail', 'onkeypress' => 'registrationVerify("mail")', 'required' => 'Y']); ?>
        <!-- Phone Number -->
        <?= $form->input('phone', 'Numéro de téléphone', ['placeholder' => 'Numéro de téléphone', 'class' => 'verifPhone', 'onkeypress' => 'registrationVerify("phone")']); ?>
        <!-- Antenna Name -->
        <?= $form->input('antenna_name', 'Nom de l\'antenne', ['placeholder' => 'Nom de l\'antenne', 'class' => 'antenna_name', 'required' => 'Y']); ?>
        <!-- Structure Name -->
        <?= $form->input('structure_name', 'Nom de la structure', ['placeholder' => 'Nom de la structure', 'class' => 'structure_name', 'disabled' => 'Y']); ?>
        <!-- Structure Code -->
        <?= $form->input('structure_code', 'Code de la structure', ['placeholder' => 'Code de la structure', 'class' => 'structure_code', 'required' => 'Y', 'disabled' => 'Y']); ?>
        <!-- Structure Department -->
        <?= $form->input('structure_department', 'Structure départementale', ['placeholder' => 'Structure départementale', 'class' => 'structure_department', 'disabled' => 'Y']); ?>
        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="rank">Rôle</label>
            <div class="col-md-4">
                <select id="rank" name="rank" class="form-control">
                    <option value="0">Prescripteur</option>
                    <option value="1">Validateur</option>
                    <option value="2">Membre Commission</option>
                    <option value="3">Président Commission</option>
                    <option value="4">Administrateur de structure</option>
                </select>
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="validate"></label>
            <div class="col-md-4">
                <button id="validate" name="validate" class="btn btn-info">Valider</button>
            </div>
        </div>


    </fieldset>
</form>

