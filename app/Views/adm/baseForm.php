<?php if($part == 1) : ?>
    <div class="droppedField" id="CTRL-DIV-1001">
        <label class="control-label" for="civility">Civilité</label>
        <select id="rank" name="civility" class="ctrl-combobox">
            <option value="-">Choisissez la civilité</option>
            <option value="Mme">Madame</option>
            <option value="Mr">Monsieur</option>
        </select>
        <input type="hidden" class="hiddenObligatoire" value="false">
    </div>
    <div class="droppedField" id="CTRL-DIV-1002">
        <label class="control-label">Nom</label>
        <input type="text" placeholder="Nom de famille du jeune" name="lastName" class="ctrl-textbox">
        <input type="hidden" class="hiddenObligatoire">
    </div>
    <div class="droppedField" id="CTRL-DIV-1003">
        <label class="control-label">Prénom</label>
        <input type="text" placeholder="Prénom du jeune" name="name" class="ctrl-textbox">
        <input type="hidden" class="hiddenObligatoire">
    </div>
    <div class="droppedField" id="CTRL-DIV-1004">
        <label class="control-label">Date de naissance</label>
        <input type="text" placeholder="JJ/MM/AAAA" name="birthday" class="ctrl-textbox">
        <input type="hidden" class="hiddenObligatoire">
    </div>
    <div class="droppedField" id="CTRL-DIV-1005">
        <label class="control-label">Adresse e-mail</label>
        <input type="text" placeholder="Adresse e-mail du jeune" name="mail" class="ctrl-textbox">
        <input type="hidden" class="hiddenObligatoire">
    </div>
    <div class="droppedField" id="CTRL-DIV-1006">
        <label class="control-label">Numéro de téléphone</label>
        <input type="text" placeholder="Numéro de téléphone du jeune" name="phone" class="ctrl-textbox">
        <input type="hidden" class="hiddenObligatoire">
    </div>
    <div class="droppedField" id="CTRL-DIV-1007">
        <label class="control-label">Adresse</label>
        <input type="text" placeholder="Nom de famille du jeune" name="address" class="ctrl-textbox">
        <input type="hidden" class="hiddenObligatoire">
    </div>
    
<?php endif;

if($part == 2) : ?>
<div class="droppedField" id="CTRL-DIV-1101">
    <label class="control-label" for="civility">Civilité</label>
    <select id="rank" name="civility" class="ctrl-combobox">
        <option value="-">Choisissez la civilité</option>
        <option value="Mme">Madame</option>
        <option value="Mr">Monsieur</option>
    </select>
    <input type="hidden" class="hiddenObligatoire" value="false">
</div>
<?php endif; ?>