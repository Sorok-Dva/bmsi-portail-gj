<?php
//Exemple pour les input text :

$form->input('is_register_ml', 'Inscris depuis le', ['placeholder' => 'Date de l\'inscription ', 'class' => 'register_ml_date']);

//is_register_ml => name
//Inscris depuis le => label
//'placeholder' => 'Date de l\'inscription ' ==> placeholder
//'class' => 'register_ml_date' ==> placeholder

//Ce qui donne :

$t['mainForm']['blocks']['part_1']['elements'][] = array(
    'type' => 'text',
    'label' => 'Inscris depuis le',
    'name' => 'is_register_ml',
    'required' => false,
    'placeholder' => 'Date de l\'inscription',
    'class' => 'register_ml_date'
);

//Exemple pour les input select
?>
    <label class="col-md-4 control-label" for="rank">Site de rattachement</label>
    <div class="col-md-4">
        <select id="srgj" name="srgj" class="form-control"  onchange="addCounselor(this.value);">
            <option value="-">Choisissez un site</option>
            <option value="1">Premier site</option>
        </select>
    </div>
<?php

//Site de rattachement => label
//srgj => name
//'class' => 'register_ml_date' ==> placeholder
//<option value="-">Choisissez un site</option> => Options

//Ce qui donne :

$t['mainForm']['blocks']['part_1']['elements'][] = array(
    'type' => 'select',
    'label' => 'Site de rattachement',
    'name' => 'srgj',
    'required' => false,
    'options' => array(
        'values' => array(
            array('value' => '-', 'name' => "Choisissez un site"),
            array('value' => '1', 'name' => "Premier site"),
        )
    )
);

//exemple des radio
?>
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
<?php

//ce qui donne

$t['mainForm']['blocks']['part_1']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Nationalité',
    'name' => 'nationality',
    'required' => true,
    'hr' => true,
    'buttons' => array(
        'values' => array(
            array('value' => 'FR', 'name' => "FR", 'id' => "FR"),
            array('value' => 'UE', 'name' => "UE", 'id' => "UE"),
            array('value' => 'AUTRE', 'name' => "Hors-UE", 'id' => "AUTRE")
        )
    )
);
