<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 17/07/2015
 * @Time    : 18:38
 * @File    : result.php
 * @Version : 1.0
 */

if ($successRegister) :
    if (App::env("ENV") == "DEBUG")
        var_dump($_POST);
    ?>
    <script>
        $('#rank option[value="<?= $_POST['rank'] ?>"]').prop('selected', true);
    </script>
    <div class="alert alert-success">
        <h1>
            Compte créer avec succès
        </h1>
        <h3>Vous venez de créer un compte pour <b><?= strtoupper($_POST['lastName']) ?> <?= $_POST['name'] ?></b>
            sur <?= App::env("SITE_NAME") ?>, cet utilisateur va recevoir un mail avec toutes les informations de
            connexion nécessaires dedans.</h3>
        <h3>Voici un récapitulatif du compte de <b><?= strtoupper($_POST['lastName']) ?> <?= $_POST['name'] ?></b></h3>
        <form class="form-horizontal" autocomplete="off" disabled="">
            <fieldset>
                <!-- Form Name -->
                <legend></legend>
                <!-- Fname input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="fname">Nom de Famille</label>
                    <div class="col-md-4">
                        <input id="fname" type="text" placeholder="<?= strtoupper($_POST['lastName']) ?>"
                               class="form-control input-md" disabled>
                    </div>
                </div>
                <!-- Name input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="name">Prénom</label>
                    <div class="col-md-4">
                        <input id="name" type="text" placeholder="<?= $_POST['name'] ?>" class="form-control input-md"
                               disabled>
                    </div>
                </div>
                <!-- Login input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="login">Identifiant</label>
                    <div class="col-md-4">
                        <input id="login" type="text" placeholder="<?= $_POST['login'] ?>" class="form-control input-md"
                               disabled>
                    </div>
                </div>

                <!-- Email input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="mail">Adresse e-mail</label>
                    <div class="col-md-4">
                        <input id="mail" type="text" placeholder="<?= $_POST['mail'] ?>" class="form-control input-md"
                               disabled>
                    </div>
                </div>

                <!-- Phone input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="phone">Numéro de téléphone</label>
                    <div class="col-md-4">
                        <input id="phone" type="text" placeholder="<?= $_POST['phone'] ?>" class="form-control input-md"
                               disabled>
                    </div>
                </div>
                <!-- Structure Name input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="structure_name">Nom de structure</label>
                    <div class="col-md-4">
                        <input id="structure_name" type="text" placeholder="<?= $_POST['structure_name'] ?>"
                               class="form-control input-md" disabled>
                    </div>
                </div>
                <!-- Antenna Name input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="structure_name">Nom officiel de l'antenne</label>
                    <div class="col-md-4">
                        <input id="structure_name" type="text" placeholder="<?= $_POST['antenna_name'] ?>"
                               class="form-control input-md" disabled>
                    </div>
                </div>
                <!-- Structure Code input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="structure_code">Code de structure</label>
                    <div class="col-md-4">
                        <input id="structure_code" type="text" placeholder="<?= $_POST['structure_code'] ?>"
                               class="form-control input-md" disabled>
                    </div>
                </div>
                <!-- Rank Select-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="rank">Rôle</label>
                    <div class="col-md-4">
                        <select id="rank" class="form-control" disabled>
                            <option value="0">Prescripteur</option>
                            <option value="1">Validateur</option>
                            <option value="2">Membre Commission</option>
                            <option value="3">Président Commission</option>
                            <option value="4">Administrateur de structure</option>
                        </select>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
<?php endif;

if ($errorRegister) : ?>
    <div class="alert alert-danger">
        <h1>
            Une erreur s'est produite lors de l'enregistrement du nouvel utilisateur.
        </h1>
        <h3>Navré de ce désagrément rencontré... Veuillez retenter l'opération.</h3>
    </div>
<?php endif;

if ($success) : ?>

    <div class="alert alert-success">
        <h1>
            Vos informations ont correctement été actualisées.
        </h1>
    </div>


<?php endif;

if ($error) : ?>

    <div class="alert alert-danger">
        <h1>
            Une erreur s'est produite lors de l'actualisation de vos informations.
        </h1>
        <h3>Navré de ce désagrément rencontré... Veuillez retenter l'opération.</h3>
    </div>


<?php endif; ?>