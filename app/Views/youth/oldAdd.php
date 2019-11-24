<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 23/03/2016
 * @Time    : 10:37
 * @File    : add.php
 * @Version : 1.0
 * @LastUpdate  : 23/03/2016 à 10:37
 */
?>
<script src="<?= App::env("SITE_URL")?>public/js/addYouth.js" type="text/javascript"></script>
<script src="<?= App::env("SITE_URL")?>public/js/verifData.js" type="text/javascript"></script>

<div class="container">
    <div class="row">
        <section>
            <div class="wizard">

                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">

                        <li role="presentation" class="active">
                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Informations du jeune">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-user"></i>
                                </span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Situation et parcours du jeune">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-folder-open"></i>
                                </span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Sitatuation de précarité et autres">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-home"></i>
                                </span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Informations pour le dossier">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-info-sign"></i>
                                </span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Step 5">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-picture"></i>
                                </span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Validation">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-ok"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>

                <form class="form-horizontal" method="post" role="form" autocomplete="off" target="_blank">
                    <div class="tab-content">

                        <!-- IDENTITY -->
                        <div class="tab-pane active" role="tabpanel" id="step1">
                            <fieldset>

                                <!-- Form Name -->
                                <legend>Indentité et informations sur le jeune</legend>
                                <!-- Select Civilité -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="civility">Civilité</label>
                                    <div class="col-md-4">
                                        <select id="rank" name="civility" class="form-control">
                                            <option value="-">Choisissez la civilité</option>
                                            <option value="Mme">Madame</option>
                                            <option value="Mr">Monsieur</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Last Name -->
                                <?= $form->input('lastName', 'Nom', ['placeholder' => 'Nom de famille du jeune', "class" => "verifDataLName", 'required' => 'Y']); ?>
                                <!-- Name -->
                                <?= $form->input('name', 'Prénom', ['placeholder' => 'Prénom du jeune',  "class" => "verifDataName", 'required' => 'Y']); ?>
                                <!-- Birthday -->
                                <?= $form->input('birthday', 'Date de naissance', ['placeholder' => 'JJ/MM/AAAA', 'class'=>'datepicker', 'required' => 'Y']); ?>
                                <hr>
                                <!-- Nationality -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="nationality">Nationalité</label>
                                    <div class="btn-group col-md-4" data-toggle="buttons">
                                        <label class="btn btn-primary" onclick="verifChecked()">
                                            <input type="radio" name="nationality" id="FR" value="FR" autocomplete="off"> FR
                                        </label>
                                        <label class="btn btn-primary" onclick="verifChecked()">
                                            <input type="radio" name="nationality" id="UE" value="UE" autocomplete="off"> UE
                                        </label>
                                        <label class="btn btn-primary" onclick="verifChecked()" >
                                            <input type="radio" name="nationality" id="AUTRE" value="AUTRE" autocomplete="off"> Hors-UE
                                        </label>
                                    </div>
                                </div>
                                <div id="FR-birthplace" style="display:none">
                                    <!-- Birthplace -->
                                    <?= $form->input('birthplace', 'Lieu de naissance', ['placeholder' => 'Ville où le jeune est né', 'class' => 'birthplace']); ?>
                                    <!-- Birthplace Postal Colde -->
                                    <?= $form->input('birthplace_postal_code', 'Code postal du lieu de naissance', ['placeholder' => 'Code postal de la ville de naissance', 'disabled' => 'Y', 'class' => 'birthplace_postal_code']); ?>
                                </div>
                                <div id="UE-birthplace" style="display:none">
                                    <!-- Birthplace -->
                                    <?= $form->input('UE-country', 'Pays', ['placeholder' => 'Pays de naissance (UE)', 'class' => 'UE-birthplace']); ?>
                                </div>
                                <div id="AUTRE-birthplace" style="display:none">
                                    <!-- Birthplace -->
                                    <?= $form->input('Autre-country', 'Pays', ['placeholder' => 'Pays de naissance (Hors-UE)', 'class' => 'Autre-birthplace']); ?>
                                </div>
                                <div id="otherBirthplaceInfo" style="display:none">
                                    <!-- arrived_in_france -->
                                    <?= $form->input('arrived_in_france', 'Date d\'arrivée en France', ['placeholder' => 'JJ/MM/AAA', 'class' => 'arrived_in_france']); ?>
                                    <!-- residence_permit -->
                                    <?= $form->input('residence_permit', 'Titre de séjour', ['placeholder' => 'carte résident ou autre', 'class' => 'residence_permit']); ?>
                                    <!-- end_residence_permit -->
                                    <?= $form->input('end_residence_permit', 'Date d\'expiration du titre de résidence', ['placeholder' => 'JJ/MM/AAA', 'class' => 'end_residence_permit']); ?>
                                </div>

                                <hr>
                                <!-- E-mail -->
                                <?= $form->input('mail', 'Adresse e-mail', ['placeholder' => 'Adresse e-mail du jeune', 'class' => 'verifMail', 'required' => 'Y']); ?>
                                <!-- Phone Number -->
                                <?= $form->input('phone', 'Numéro de téléphone', ['placeholder' => 'Numéro de téléphone du jeune', 'class' => 'verifPhone']); ?>
                                <!-- address -->
                                <?= $form->input('address', 'Adresse', ['type' => 'textarea', 'placeholder' => 'Numéro et nom de rue']); ?>
                                <!-- Postal Code -->
                                <?= $form->input('postal_code', 'Code Postal', ['placeholder' => 'Code Postale', 'class' => 'postal_code']); ?>
                                <!-- Select Town -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="town">Ville</label>
                                    <div class="col-md-4">
                                        <select id="town" name="town" class="form-control">
                                            <option value="-">Sélectionnez la ville</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-primary next-step">Continuer</button></li>
                            </ul>
                        </div>

                        <!-- INFORMATIONS -->
                        <div class="tab-pane" role="tabpanel" id="step2">

                            <legend>Situation actuelle et parcours du jeune</legend>

                            <!-- ML_Register -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="register_ml">Inscris préalablement à la ML?</label>
                                <div class="btn-group col-md-4" data-toggle="buttons">
                                    <label class="btn btn-primary" onclick="verifChecked2()">
                                        <input type="radio" name="was_registred_in_ML" value="y" id="register_yes" autocomplete="off"> Oui
                                    </label>
                                    <label class="btn btn-primary" onclick="verifChecked2()">
                                        <input type="radio" name="was_registred_in_ML" value="n" id="register_no" autocomplete="off"> Non
                                    </label>
                                </div>
                            </div>
                            <div id="Is_register_ML" style="display:none">
                                <!-- is_register_ml -->
                                <?= $form->input('is_register_ml', 'Inscris depuis le', ['placeholder' => 'Date de l\'inscription ', 'class' => 'register_ml_date']); ?>
                                <!-- Select Antenna -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="rank">Site de rattachement</label>
                                    <div class="col-md-4">
                                        <select id="srgj" name="srgj" class="form-control"  onchange="addCounselor(this.value);">
                                            <option value="-">Choisissez un site</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Select Counselor -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="rank">Conseiller prescritpeur</label>
                                    <div class="col-md-4">
                                        <select id="cp" name="cp" class="form-control" onchange="addCounselorPhone(this.value);">
                                            <option value="-">Choisissez un conseiller prescripteur</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Phone Counselor -->
                                <?= $form->input('phone_ML_referring_in_charge', 'Contact', ['placeholder' => 'Numéro de téléphone du conseiller', 'class' => 'phone_ML_referring_in_charge', 'disabled'=> 'y']); ?>
                            </div>

                            <hr>
                            <!-- student_training -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="student_training">Étudiant ou en formation?</label>
                                <div class="btn-group col-md-4" data-toggle="buttons">
                                    <label class="btn btn-primary" onclick="verifPublic()">
                                        <input type="radio" name="student_training" id="student_training_yes" value="y" autocomplete="off"> Oui
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="student_training" id="student_training_no" value="n" autocomplete="off"> Non
                                    </label>
                                </div>
                            </div>
                            <!-- youth_education -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="youth_education">En éducation?</label>
                                <div class="btn-group col-md-4" data-toggle="buttons">
                                    <label class="btn btn-primary" >
                                        <input type="radio" name="youth_education" id="youth_education_yes" value="y" autocomplete="off"> Oui
                                    </label>
                                    <label class="btn btn-primary" >
                                        <input type="radio" name="youth_education" id="youth_education_no" value="n" autocomplete="off"> Non
                                    </label>
                                </div>
                            </div>
                            <!-- youth_employment -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="youth_employment">En emploi?</label>
                                <div class="btn-group col-md-4" data-toggle="buttons">
                                    <label class="btn btn-primary" onclick="verifChecked2()">
                                        <input type="radio" name="youth_employment" id="youth_employment_yes" value="y" autocomplete="off"> Oui
                                    </label>
                                    <label class="btn btn-primary" onclick="verifChecked2()">
                                        <input type="radio" name="youth_employment" id="youth_employment_no" value="n" autocomplete="off"> Non
                                    </label>
                                </div>
                            </div>
                            <div id="allowed_to_work" style="display:none">
                                <!-- allowed_to_work -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="youth_employment">Autorisé à travailler</label>
                                    <div class="btn-group col-md-4" data-toggle="buttons">
                                        <label class="btn btn-primary" >
                                            <input type="radio" name="allowed_to_work" id="allowed_to_work_yes" value="y" autocomplete="off"> Oui
                                        </label>
                                        <label class="btn btn-primary" >
                                            <input type="radio" name="allowed_to_work" id="allowed_to_work_no" value="n" autocomplete="off"> Non
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- last_classroom -->
                            <?= $form->input('last_classroom', 'Dernière classe', ['placeholder' => 'Dernière classe fréquentée']); ?>
                            <!-- last_classroom_date -->
                            <?= $form->input('last_classroom_date', 'Année dernière classe', ['placeholder' => 'Laissez vide si nul']); ?>
                            <!-- greatest_qualification -->
                            <?= $form->input('greatest_qualification', 'Diplôme le plus élevé obtenu', ['placeholder' => 'Diplôme le plus élevé du jeune']); ?>

                            <hr>
                            <!--  -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="">Le jeune dispose t-il d'un compte bancaire?</label>
                                <div class="btn-group col-md-4" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        <input type="radio" name="" value="y" autocomplete="off"> Oui
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="" value="n" autocomplete="off"> Non
                                    </label>
                                </div>
                            </div>
                            <!--  -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="">Sous main de justice?</label>
                                <div class="btn-group col-md-4" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        <input type="radio" name="" value="y" autocomplete="off"> Oui
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="" value="n" autocomplete="off"> Non
                                    </label>
                                </div>
                            </div>
                            <!--  -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="">Reconnaissance TH</label>
                                <div class="btn-group col-md-4" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        <input type="radio" name="" value="y" autocomplete="off"> Oui
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="" value="n" autocomplete="off"> Non
                                    </label>
                                </div>
                            </div>

                            <hr>
                            <!-- KNOWED BY :CG -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="know_by_CG">Jeune connu du CG</label>
                                <div class="btn-group col-md-4" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        <input type="radio" name="know_by_CG" value="y" autocomplete="off"> Oui
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="know_by_CG" value="n" autocomplete="off"> Non
                                    </label>
                                </div>
                            </div>
                            <!-- PE -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="know_by_PE">Jeune connu du Pôle Emploi</label>
                                <div class="btn-group col-md-4" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        <input type="radio" name="know_by_PE" value="n" autocomplete="off"> Oui
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="know_by_PE" value="n" autocomplete="off"> Non
                                    </label>
                                </div>
                            </div>
                            <!-- PJJ -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="know_by_PJJ">Jeune connu PJJ</label>
                                <div class="btn-group col-md-4" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        <input type="radio" name="know_by_PJJ" value="y" autocomplete="off"> Oui
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="know_by_PJJ" value="n" autocomplete="off"> Non
                                    </label>
                                </div>
                            </div>
                            <!-- SPIP -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="know_by_SPIP">Jeune connu SPIP</label>
                                <div class="btn-group col-md-4" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        <input type="radio" name="know_by_SPIP" value="y" autocomplete="off"> Oui
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="know_by_SPIP" value="n" autocomplete="off"> Non
                                    </label>
                                </div>
                            </div>
                            <!-- ASE -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="know_by_ASE">Jeune connu de l'ASE</label>
                                <div class="btn-group col-md-4" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        <input type="radio" name="know_by_ASE" value="y" autocomplete="off"> Oui
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="know_by_ASE" value="n" autocomplete="off"> Non
                                    </label>
                                </div>
                            </div>
                            <!-- CIAS -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="know_by_CIAS">Jeune connu CIAS</label>
                                <div class="btn-group col-md-4" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        <input type="radio" name="know_by_CIAS" value="y" autocomplete="off"> Oui
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="know_by_CIAS" value="n" autocomplete="off"> Non
                                    </label>
                                </div>
                            </div>
                            <!-- ML -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="know_by_ML">Jeune connu de la ML</label>
                                <div class="btn-group col-md-4" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        <input type="radio" name="know_by_ML" value="y" autocomplete="off"> Oui
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="know_by_ML" value="n" autocomplete="off"> Non
                                    </label>
                                </div>
                            </div>
                            <!-- CHRS -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="know_by_CHRS">Jeune connu CHRS</label>
                                <div class="btn-group col-md-4" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        <input type="radio" name="know_by_CHRS" value="y" autocomplete="off"> Oui
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="know_by_CHRS" value="n" autocomplete="off"> Non
                                    </label>
                                </div>
                            </div>
                            <!-- ongoing_with_the_knowed_structure -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="ongoing_with_the_knowed_structure">Un suivi est est-il en cours avec l'une de ces structures</label>
                                <div class="btn-group col-md-4" data-toggle="buttons">
                                    <label class="btn btn-primary" onclick="verifChecked2()">
                                        <input type="radio" name="ongoing_with_the_knowed_structure" value="y" id="ongoing_with_the_knowed_structure_yes" autocomplete="off"> Oui
                                    </label>
                                    <label class="btn btn-primary" onclick="verifChecked2()">
                                        <input type="radio" name="ongoing_with_the_knowed_structure" value="n" autocomplete="off"> Non
                                    </label>
                                </div>
                            </div>
                            <div id="ongoing_with_the_knowed_structure" style="display:none">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="which_structure_ongoing">Structure avec suivi en cours</label>
                                    <div class="col-md-4">
                                        <select id="which_structure_ongoing" name="which_structure_ongoing" class="form-control">
                                            <option value="-">Choisissez une structure</option>
                                            <option value="CG">Conseil Général</option>
                                            <option value="PE">Pôle Emploi</option>
                                            <option value="PJJ">PJJ</option>
                                            <option value="SPIP">SPIP</option>
                                            <option value="ASE">ASE</option>
                                            <option value="CIAS">CIAS</option>
                                            <option value="CHRS">CHRS</option>
                                            <option value="ML">Mission Locale</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- KNOWED BY :CG -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="is_accompanied">Le jeune est-il actuellement accompagné?</label>
                                <div class="btn-group col-md-4" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        <input type="radio" name="is_accompanied" value="is_accompanied_y" autocomplete="off"> Oui
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="is_accompanied" value="is_accompanied_n" autocomplete="off"> Non
                                    </label>
                                </div>
                            </div>

                            <div id="accompanied" style="display:none">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="which_structure_ongoing">Accompagnements en cours</label>
                                    <div class="col-md-4">

                                    </div>
                                </div>
                            </div>


                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Précédent</button></li>
                                <li><button type="button" class="btn btn-primary next-step">Continuer</button></li>
                            </ul>
                        </div>

                        <!-- SITUATION -->
                        <div class="tab-pane" role="tabpanel" id="step3">
                            <!-- Form Name -->
                            <legend>Situation de précarité et autres.</legend>


                            <!-- life_situation -->
                            <div class="form-group">
                                <div class="alert alert-info">
                                    Cohabitant : chez ses parents, sous tutelle ou bénéficiant d'un soutient familial<br>
                                    Décohabitant : chez un tiers avec un lien de dépendance, SDF, hébérgé à l'hôtel ou autre logement précaire<br>
                                    Vie en couple : Marié, PACS, union libre
                                </div>
                                <label class="col-md-4 control-label" for="life_situation">Situation</label>
                                <div class="btn-group col-md-5" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        <input type="radio" name="life_situation" autocomplete="off"> Cohabitant
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="life_situation" autocomplete="off"> Décohabitant
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="life_situation" autocomplete="off"> Célibataire
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="life_situation" autocomplete="off"> Vie en couple
                                    </label>
                                </div>
                            </div>

                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Précédent</button></li>
                                <li><button type="button" class="btn btn-primary next-step">Continuer</button></li>
                            </ul>
                        </div>


                        <div class="tab-pane" role="tabpanel" id="step4">
                            <!-- Form Name -->
                            <legend>Information du dossier</legend>



                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Précédent</button></li>
                                <li><button type="button" class="btn btn-primary next-step">Continuer</button></li>
                            </ul>
                        </div>

                        <div class="tab-pane" role="tabpanel" id="step5">
                            <h3>Step 3</h3>
                            <p>This is step 3</p>
                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Précédent</button></li>
                                <li><button type="button" class="btn btn-default next-step">Skip</button></li>
                                <li><button type="button" class="btn btn-primary btn-info-full next-step">Continuer</button></li>
                            </ul>
                        </div>

                        <div class="tab-pane" role="tabpanel" id="complete">
                            <h3>Complete</h3>
                            <p>You have successfully completed all steps.</p>
                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="validate"></label>
                                <div class="col-md-4">
                                    <button id="validate" class="btn btn-info">Valider</button>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>