<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 31/03/2016
 * @Time    : 16:04
 * @File    : ArrayForm.php
 * @Version : 1.0
 * @LastUpdate  : 31/03/2016 à 16:04
 */

$t = [];

$t['mainForm']['options'] = array('css' => 'display:block');
$t['mainForm']['blocks']['part_1']['elements'][] = array(
    'type' => 'select',
    'label' => 'Civilité',
    'name' => 'civility',
    'required' => true,
    'options' => array(
        'values' => array(
            array('value' => '-', 'name' => "Choisissez la civilité", 'onSelect' => array('display' => '#divPourFR')),
            array('value' => 'MADAME', 'name' => "Madame", 'onSelect' => array('display' => '#divPourFR')),
            array('value' => 'MONSIEUR', 'name' => "Monsieur", 'onSelect' => array('display' => '#divPourUE'))
        )
    )
);
$t['mainForm']['blocks']['part_1']['elements'][] = array(
    'type' => 'text',
    'label' => 'Nom',
    'name' => 'lastName',
    'required' => true,
    'placeholder' => 'Nom du jeune',
    'css' => 'style="text-transform:uppercase"'
);
$t['mainForm']['blocks']['part_1']['elements'][] = array(
    'type' => 'text',
    'label' => 'Prénom',
    'name' => 'name',
    'required' => true,
    'placeholder' => 'Prénom du jeune',
);

$t['mainForm']['blocks']['part_1']['elements'][] = array(
    'type' => 'text',
    'label' => 'Date de naissance',
    'name' => 'birthday',
    'required' => true,
    'placeholder' => 'JJ/MM/AAAA',
    'class' => 'datepicker',
    'data_info' => 'date',
    'hr' => true,
);

$t['mainForm']['blocks']['part_1']['elements'][] = array(
    'type' => 'text',
    'label' => 'Nationalité',
    'name' => 'nationality',
    'required' => true,
    'placeholder' => 'Nationalité du jeune',
);

$t['mainForm']['blocks']['part_1']['elements'][] = array(
    'type' => 'text',
    'label' => 'Lieu de naissance',
    'name' => 'birthplace_town',
    'required' => false,
    'placeholder' => 'Ville où le jeune est né',
    'class' => 'birthplace',
);

$t['mainForm']['blocks']['part_1']['elements'][] = array(
    'type' => 'text',
    'label' => 'Code postal du lieu de naissance',
    'name' => 'birthplace_postal_code',
    'required' => false,
    'placeholder' => 'Code postal de la ville de naissance',
    'disabled' => true,
    'class' => 'birthplace_postal_code',
    'maxlength' => '5',
    'hr' => true,
);


/*$t['mainForm']['blocks']['part_1']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Nationalité',
    'name' => 'nationality',
    'required' => true,
    'buttons' => array(
        'values' => array(
            array('label' => 'FR' ,'value' => 'FR', 'name' => "FR", 'id' => "FR"),
            array('label' => 'UE', 'name' => "UE", 'id' => "UE"),
            array('label' => 'Hors-UE', 'name' => "Hors-UE", 'id' => "AUTRE")
        )
    )
);
$t['mainForm']['blocks']['part_1']['divs'][] = array(
    'class' => 'FR-birthplace',
    'css' => 'display:none;',
    'elements' => array(
        'inputs' => array(
            array('type' => 'text', 'label' => 'Lieu de naissance', 'name' => 'birthplace', 'placeholder' => 'Ville où le jeune est né', 'class' => 'birthplace'),
            array('type' => 'text', 'label' => 'Code postal du lieu de naissance', 'name' => 'birthplace_postal_code', 'placeholder' => 'Code postal de la ville de naissance', 'disabled' => true, 'class' => 'birthplace_postal_code')
        )
    )
);
$t['mainForm']['blocks']['part_1']['divs'][] = array(
    'class' => 'UE-birthplace',
    'css' => 'display:none;',
    'elements' => array(
        'inputs' => array(
            array('type' => 'text', 'label' => 'Pays', 'name' => 'UE-country', 'placeholder' => 'Pays de naissance (UE)', 'class' => 'UE-birthplace')
        )
    )
);
$t['mainForm']['blocks']['part_1']['divs'][] = array(
    'class' => 'AUTRE-birthplace',
    'css' => 'display:none;',
    'elements' => array(
        'inputs' => array(
            array('type' => 'text', 'label' => 'Pays', 'name' => 'Autre-country', 'placeholder' => 'Pays de naissance (Hors-UE)', 'class' => 'Autre-birthplace')
        )
    )
);
$t['mainForm']['blocks']['part_1']['divs'][] = array(
    'class' => 'otherBirthplaceInfo',
    'css' => 'display:none;',
    'hr' => true,
    'elements' => array(
        'inputs' => array(
            array('type' => 'text', 'label' => 'Date d\'arrivée en France', 'name' => 'arrived_in_france', 'placeholder' => 'JJ/MM/AAAA', 'class' => 'arrived_in_france'),
            array('type' => 'text', 'label' => 'Titre de séjour', 'name' => 'residence_permit', 'placeholder' => 'carte résident ou autre', 'class' => 'residence_permit'),
            array('type' => 'text', 'label' => 'Date d\'expiration du titre de résidence', 'name' => 'end_residence_permit', 'placeholder' => 'JJ/MM/AAAA', 'class' => 'end_residence_permit'),
        )
    )
);*/

$t['mainForm']['blocks']['part_1']['elements'][] = array(
    'type' => 'text',
    'label' => 'Adresse e-mail',
    'name' => 'mail',
    'required' => false,
    'placeholder' => 'Adresse e-mail du jeune',
    'class' => 'verifMail'
);
$t['mainForm']['blocks']['part_1']['elements'][] = array(
    'type' => 'text',
    'label' => 'Numéro de téléphone (portable)',
    'name' => 'phone_number',
    'required' => false,
    'placeholder' => 'Numéro de téléphone portable du jeune',
    'class' => 'verifPhone',
    'maxlength' => '10',
);
$t['mainForm']['blocks']['part_1']['elements'][] = array(
    'type' => 'text',
    'label' => 'Numéro de téléphone (fixe)',
    'name' => 'fixe_number',
    'required' => false,
    'placeholder' => 'Numéro de téléphone (fixe) du jeune',
    'class' => 'verifFixe',
    'maxlength' => '10',
);


$t['mainForm']['blocks']['part_1']['elements'][] = array(
    'type' => 'textarea',
    'label' => 'Adresse',
    'name' => 'address',
    'placeholder' => 'Numéro et nom de rue',
    'required' => true,
);
$t['mainForm']['blocks']['part_1']['elements'][] = array(
    'type' => 'text',
    'label' => 'Code Postal',
    'name' => 'postal_code',
    'required' => true,
    'placeholder' => 'Code Postal',
    'class' => 'postal_code',
    'maxlength' => '5',
);
$t['mainForm']['blocks']['part_1']['elements'][] = array(
    'type' => 'select',
    'label' => 'Ville',
    'name' => 'town',
    'required' => true,
    'options' => array(
        'values' => array(
            array('value' => '-', 'name' => "Sélectionnez la ville"),
        )
    )
);

$t['mainForm']['blocks']['part_1']['elements'][] = array(
    'type' => 'text',
    'label' => 'N° de sécurité sociale',
    'name' => 'social_s_number',
    'required' => false,
    'placeholder' => 'Numéro de sécurité sociale',
    'maxlength' => '15',
);

$t['mainForm']['blocks']['part_1']['elements'][] = array(
    'type' => 'text',
    'label' => 'N° Pôle Emploi (si inscrit)',
    'name' => 'pole_e_number',
    'required' => false,
    'placeholder' => 'Numéro Pôle Emploi',
    'maxlength' => '8',
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Zone Prioritaire (QPV)',
    'name' => 'QPV',
    'required' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "QPV", 'id' => "qpv_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "QPV", 'id' => "qpv_no")
        )
    )
);


$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Zone Prioritaire (ZSP)',
    'name' => 'ZSP',
    'required' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "ZSP", 'id' => "zsp_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "ZSP", 'id' => "zsp_no")
        )
    )
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Zone Prioritaire (ZUS)',
    'name' => 'ZUS',
    'required' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "ZUS", 'id' => "zus_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "ZUS", 'id' => "zus_no")
        )
    )
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Zone Prioritaire (ZRR)',
    'name' => 'ZRR',
    'required' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "ZRR", 'id' => "zrr_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "ZRR", 'id' => "zrr_no")
        )
    )
);


/** PARTIE 2 : Situation actuelle et parcours du jeune */
/*$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Inscris préalablement à la ML ?',
    'name' => 'was_registred_in_ML',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('value' => 'y', 'name' => "was_registred_in_ML", 'id' => "register_yes", "onclick" => "verifChecked2()"),
            array('value' => 'n', 'name' => "was_registred_in_ML", 'id' => "register_no", "onclick" => "verifChecked2()")
        )
    )
);*/

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'text',
    'label' => 'Inscris depuis le (si déjà inscris à la ml)',
    'name' => 'is_registred_ml',
    'required' => false,
    'placeholder' => 'Date de l\'inscription',
    'class' => 'register_ml_date',
    'data_info' => 'date',
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'select',
    'label' => 'Site de rattachement (si déjà inscris à la ml)',
    'name' => 'srgj',
    'onchange'=> 'addCounselor(this.value);',
    'required' => false,
    'options' => array(
        'values' => array(
            array('value' => '-', 'name' => "Choisissez un site"),
        )
    )
); // Name problem

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'select',
    'label' => 'Conseiller prescripteur (si déjà inscris à la ml)',
    'name' => 'cp',
    'onchange'=> 'addCounselorPhone(this.value);',
    'required' => false,
    'options' => array(
        'values' => array(
            array('value' => '-', 'name' => "Choisissez un conseiller prescripteur"),
        )
    )
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Étudiant ou en formation?',
    'name' => 'student_training',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "student_training", 'id' => "student_training_yes", "onclick" => "verifChecked2()"),
            array('label' => 'Non', 'value' => 'n', 'name' => "student_training", 'id' => "student_training_no")
        )
    )
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'En éducation?',
    'name' => 'youth_education',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "youth_education", 'id' => "youth_education_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "youth_education", 'id' => "youth_education_no")
        )
    )
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'En emploi?',
    'name' => 'youth_employment',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "youth_employment", 'id' => "youth_employment_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "youth_employment", 'id' => "youth_employment_no")
        )
    )
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Autorisé à travailler',
    'name' => 'allowed_to_work',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "allowed_to_work", 'id' => "allowed_to_work_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "allowed_to_work", 'id' => "allowed_to_work_no")
        )
    )
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'text',
    'label' => 'Dernière classe',
    'name' => 'last_classroom',
    'required' => false,
    'placeholder' => 'Dernière classe fréquentée',
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'text',
    'label' => 'Établissement de la dernière classe',
    'name' => 'last_classroom_establishment',
    'required' => false,
    'placeholder' => 'Établissement de la dernière classe',
);


$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'text',
    'label' => 'Année dernière classe',
    'name' => 'last_classroom_date',
    'data_info' => 'date',
    'required' => false,
    'placeholder' => 'Laissez vide si nul',

);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'text',
    'label' => 'Diplôme le plus élevé obtenu',
    'name' => 'greatest_qualification',
    'required' => false,
    'placeholder' => 'Diplôme le plus élevé du jeune',
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Le jeune dispose t-il d\'un compte bancaire?',
    'name' => 'bank_account',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "bank_account", 'id' => "bank_account_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "bank_account", 'id' => "bank_account_no")
        )
    )
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Sous main de justice?',
    'name' => 'justice',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "justice", 'id' => "justice_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "justice", 'id' => "justice_no")
        )
    )
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Reconnaissance TH',
    'name' => 'know_as_TH',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "know_as_TH", 'id' => "know_as_TH_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "know_as_TH", 'id' => "know_as_TH_no")
        )
    )
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Jeune connu du CD',
    'name' => 'know_by_CG',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "know_by_CG", 'id' => "know_by_CG_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "know_by_CG", 'id' => "know_by_CG_no")
        )
    )
);


$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Jeune connu du Pôle Emploi',
    'name' => 'know_by_PE',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "know_by_PE", 'id' => "know_by_PE_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "know_by_PE", 'id' => "know_by_PE_no")
        )
    )
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Jeune connu du PJJ',
    'name' => 'know_by_PJJ',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "know_by_PJJ", 'id' => "know_by_PJJ_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "know_by_PJJ", 'id' => "know_by_PJJ_no")
        )
    )
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Jeune connu du SPIP',
    'name' => 'know_by_SPIP',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "know_by_SPIP", 'id' => "know_by_SPIP_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "know_by_SPIP", 'id' => "know_by_SPIP_no")
        )
    )
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Jeune connu de l\'ASE',
    'name' => 'know_by_SPIP',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "know_by_ASE", 'id' => "know_by_ASE_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "know_by_ASE", 'id' => "know_by_ASE_no")
        )
    )
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Jeune connu de CIAS',
    'name' => 'know_by_CIAS',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "know_by_CIAS", 'id' => "know_by_CIAS_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "know_by_CIAS", 'id' => "know_by_CIAS_no")
        )
    )
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Jeune connu de la ML',
    'name' => 'know_by_ML',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "know_by_ML", 'id' => "know_by_ML_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "know_by_ML", 'id' => "know_by_ML_no")
        )
    )
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Jeune connu du CHRS',
    'name' => 'know_by_CHRS',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "know_by_CHRS", 'id' => "know_by_CHRS_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "know_by_CHRS", 'id' => "know_by_CHRS_no")
        )
    )
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Un suivi est-il en cours avec l\'une de ces structures',
    'name' => 'ongoing_with_the_knowed_structure',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "ongoing_with_the_knowed_structure", 'id' => "ongoing_with_the_knowed_structure_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "ongoing_with_the_knowed_structure", 'id' => "ongoing_with_the_knowed_structure_no")
        )
    )
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'select',
    'label' => 'Structure avec suivi en cours',
    'name' => 'which_structure_ongoing',
    'required' => false,
    'options' => array(
        'values' => array(
            array('value' => '-', 'name' => "Choisissez une structure"),
            array('value' => 'CD', 'name' => "Conseil Départemental"),
            array('value' => 'PE', 'name' => "Pôle Emploi"),
            array('value' => 'PJJ', 'name' => "PJJ"),
            array('value' => 'SPIP', 'name' => "SPIP"),
            array('value' => 'ASE', 'name' => "ASE"),
            array('value' => 'CIAS', 'name' => "CIAS"),
            array('value' => 'CHRS', 'name' => "CHRS"),
            array('value' => 'ML', 'name' => "Mission Locale")
        )
    )
);

$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Le jeune est-il actuellement accompagné?',
    'name' => 'is_accompanied',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "is_accompanied", 'id' => "is_accompanied_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "is_accompanied", 'id' => "is_accompanied_no")
        )
    )
);
/*verifier name*/
$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'text',
    'label' => 'Partenaire ayant orienté le jeune en GJ',
    'name' => 'partner',
    'required' => false,
    'placeholder' => 'Nom du partenaire',
);
/*verifier name*/
$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'select',
    'label' => 'Le jeune est-il accompagné à la date de la proposition GJ ?',
    'name' => 'ongoing_with_the_knowed_structure',
    'required' => false,
    'options' => array(
        'values' => array(
            array('value' => '-', 'name' => "Choisissez un accompagnateur"),
            array('value' => 'CG', 'name' => "ANI"),
            array('value' => 'PE', 'name' => "CIVIS"),
            array('value' => 'PJJ', 'name' => "PPAE"),
            array('value' => 'none', 'name' => "aucun"),
        )
    )
);

/*$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'text',
    'label' => 'Etablissement du diplôme le plus élevé obtenu',
    'name' => 'greatest_qualification_institution',
    'required' => false,
    'placeholder' => 'Etablissement où le jeune à obtenu son diplôme le plus élevé',
);
$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'text',
    'label' => 'Spécialité suivie',
    'name' => 'speciality',
    'required' => false,
    'placeholder' => 'Spécialité du diplôme le plus élevé',
);*/

/** Situation personelle */
/*$t['mainForm']['blocks']['part_2']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Le jeune est-il en couple ?',
    'name' => 'is_relationship',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "is_relationship", 'id' => "is_relationship_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "is_relationship", 'id' => "is_relationship_no")
        )
    )
);*/
$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'select',
    'label' => 'Situation familiale',
    'name' => 'life_situation',
    'required' => false,
    'hr' => false,
    'options' => array(
        'values' => array(
            array('value' => '-', 'name' => "Choisissez"),
            array('value' => 'married', 'name' => "Marié(e)"),
            array('value' => 'PACS', 'name' => "PACS"),
            array('value' => 'celib', 'name' => "Célibataire"),
            array('value' => 'other', 'name' => "Autre"),
        )
    )
);
/*verifier name*/
$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Vit au foyer de ses parents ?',
    'name' => '',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "", 'id' => "_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "", 'id' => "_no")
        )
    )
);
/*verifier name*/
$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Jeune cohabitant ou décohabitant ?',
    'name' => '',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Cohabitant', 'value' => '', 'name' => "", 'id' => ""),
            array('label' => 'Décohabitant', 'value' => '', 'name' => "", 'id' => "")
        )
    )
);

/** Mobilité*/
$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Permis B',
    'name' => 'B_permit',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "B_permit", 'id' => "B_permit_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "B_permit", 'id' => "B_permit_no")
        )
    )
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Moyen de locomotion',
    'name' => 'locomotion',
    'buttons' => array(
        'values' => array(
            array('label' => 'Motocycle', 'value' => 'motorbike', 'name' => "locomotion", 'id' => "motorbike"),
            array('label' => 'Véhicule personnel', 'value' => 'personnal_vehicle', 'name' => "locomotion", 'id' => "personnal_vehicle"),
            array('label' => 'Transports en commun', 'value' => 'public_transport', 'name' => "locomotion", 'id' => "public_transport")
        )
    )
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'text',
    'label' => 'Combien d\'enfants sont à la charge des parents ?',
    'name' => 'parents_dependant_children',
    'required' => false,
    'placeholder' => 'Nombre d\'enfants à charge des parents',
);


$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'text',
    'label' => 'Combien d\'enfants sont à la charge du jeune ?',
    'name' => 'dependant_children',
    'required' => false,
    'placeholder' => 'Nombre d\'enfants à charge du jeune',
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'select',
    'label' => 'Logement du jeune',
    'name' => 'lodging',
    'required' => false,
    'options' => array(
        'values' => array(
            array('value' => '-', 'name' => "Choisissez une situation de logement"),
            array('value' => 'Locataire', 'name' => "Locataire"),
            array('value' => 'Propriétaire', 'name' => "Propriétaire"),
            array('value' => 'Hebergé par sa famille (hors parents)', 'name' => "Hebergé par sa famille (hors parents)"),
            array('value' => 'Hébergé par ses amis', 'name' => "Hébergé par ses amis"),
            array('value' => 'En foyer', 'name' => "En foyer"),
            array('value' => 'CHRS', 'name' => "CHRS"),
            array('value' => 'autre', 'name' => "autre"),
        )
    )
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'text',
    'label' => 'Si autre',
    'name' => 'other_housing',
    'required' => false,
    'placeholder' => 'Préciser le logement',
);


/** Situation financière */
$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Appartient à un foyer bénéficiaire du RSA ?',
    'name' => 'home_rsa_beneficiary',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "home_rsa_beneficiary", 'id' => "home_rsa_beneficiary_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "home_rsa_beneficiary", 'id' => "home_rsa_beneficiary_no")
        )
    )
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Est bénéficiaire du RSA ?',
    'name' => 'rsa_beneficiary',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "rsa_beneficiary", 'id' => "rsa_beneficiary_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "rsa_beneficiary", 'id' => "rsa_beneficiary_no")
        )
    )
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'text',
    'label' => 'Ressources nettes du jeune sur les 3 derniers mois',
    'name' => 'net_resources',
    'required' => false,
    'placeholder' => 'Ressources nettes',
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'text',
    'label' => 'Dont revenus d\'activité',
    'name' => 'net_resources_earned_income',
    'required' => false,
    'placeholder' => 'Revenus d\'activité',
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'text',
    'label' => 'Dont autres',
    'name' => 'net_resources_other',
    'required' => false,
    'placeholder' => 'Préciser la nature (AAH, ARE, ATA, ...)',
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Reçoit le soutien financier des parents, tiers ou du conjoint ?',
    'name' => 'financially_supported',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "financially_supported", 'id' => "financially_supported_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "financially_supported", 'id' => "financially_supported_no")
        )
    )
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Si oui, préciser si une pension alimentaire/aide est déclarée comme étant versée au jeune',
    'name' => 'child_support',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "child_support", 'id' => "child_support_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "child_support", 'id' => "child_support_no")
        )
    )
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'text',
    'label' => 'Montant de la pension alimentaire versée',
    'name' => 'child_support_amount',
    'required' => false,
    'placeholder' => 'Indiquez le montant de la pension alimentaire',
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Jeune en situation de rupture familiale ?',
    'name' => 'family_breakdown',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "family_breakdown", 'id' => "family_breakdown_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "family_breakdown", 'id' => "family_breakdown_no")
        )
    )
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Rattachement fiscal du jeune à ses parents ?',
    'name' => 'fiscal_attachment',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "fiscal_attachment", 'id' => "fiscal_attachment_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "fiscal_attachment", 'id' => "fiscal_attachment_no")
        )
    )
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Le jeune a-t-il présenté un justificatif de non rattachement fiscal à ses parents ?',
    'name' => 'no_fiscal_attachment_proof',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "no_fiscal_attachment_proof", 'id' => "no_fiscal_attachment_proof_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "no_fiscal_attachment_proof", 'id' => "no_fiscal_attachment_proof_no")
        )
    )
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'text',
    'label' => 'Revenu Fiscal de Référence des parents',
    'name' => 'parents_rfr',
    'required' => false,
    'placeholder' => 'Indiquez le montant du RFR des parents',
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'text',
    'label' => 'Montant total d\'imposition des parents',
    'name' => 'parents_tax_amount',
    'required' => false,
    'placeholder' => 'Indiquez le montant d\'imposition total des parents',
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'text',
    'label' => 'Revenu Fiscal de Référence du jeune (ou du couple)',
    'name' => 'rfr',
    'required' => false,
    'placeholder' => 'Indiquez le montant du RFR du jeune',
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'text',
    'label' => 'Montant total d\'imposition du jeune',
    'name' => 'tax_amount',
    'required' => false,
    'placeholder' => 'Indiquez le montant d\'imposition total du jeune',
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'text',
    'label' => 'Niveau de ressources déclaré du jeune année N-1 (moyenne mensuelle lissée sur l\'année)',
    'name' => 'resources_level_N-1',
    'required' => false,
    'placeholder' => 'Indiquez le niveau de ressources du jeune de l\'année dernière',
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Le jeune a-t-il bénéficié du FDAJ dans les 6 derniers mois',
    'name' => 'fdaj_last_6_months',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "fdaj_last_6_months", 'id' => "fdaj_last_6_months_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "fdaj_last_6_months", 'id' => "fdaj_last_6_months_no")
        )
    )
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'radio',
    'label' => 'Le jeune a-t-il bénéficié du FDAJ dans les 12 derniers mois',
    'name' => 'fdaj_last_12_months',
    'required' => false,
    'hr' => false,
    'buttons' => array(
        'values' => array(
            array('label' => 'Oui', 'value' => 'y', 'name' => "fdaj_last_12_months", 'id' => "fdaj_last_12_months_yes"),
            array('label' => 'Non', 'value' => 'n', 'name' => "fdaj_last_12_months", 'id' => "fdaj_last_12_months_no")
        )
    )
);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'text',
    'label' => 'Si oui, objet de l\'aide',
    'name' => 'last_fdaj_object',
    'required' => false,
    'placeholder' => 'Indiquez l\'objet du FDAJ perçu',
);

/** Exposé des motifs de la proposition d'entrée en GJ par la ML*/

/** TEXT AREA lol
$t['mainForm']['blocks']['part_2']['elements'][] = array(
'type' => 'text',
'label' => 'Quels éléments de la vulnérabilité du jeune ?',
'name' => 'vulnerability_presentation',
'required' => false,
'placeholder' => 'Exposé de la situation sociale',
);
$t['mainForm']['blocks']['part_2']['elements'][] = array(
'type' => 'text',
'label' => 'Quels éléments de la vulnérabilité du jeune ?',
'name' => 'vulnerability_rupture_risks',
'required' => false,
'placeholder' => 'Risques de rupture',
);


$t['mainForm']['blocks']['part_2']['elements'][] = array(
'type' => 'text',
'label' => 'En quoi la garantie jeunes est-elle indispensable au jeune ?',
'name' => 'motivation_elements',
'required' => false,
'placeholder' => 'Eléments de motivation du jeune pour le dispositif',
);
$t['mainForm']['blocks']['part_2']['elements'][] = array(
'type' => 'text',
'label' => 'En quoi la garantie jeunes est-elle indispensable au jeune ?',
'name' => 'employment_obstacles',
'required' => false,
'placeholder' => 'Freins à l\'emploi',
);
$t['mainForm']['blocks']['part_2']['elements'][] = array(
'type' => 'text',
'label' => 'En quoi la garantie jeunes est-elle indispensable au jeune ?',
'name' => 'gj_expectations',
'required' => false,
'placeholder' => 'Quels sont les attentes du dispositif GJ ?',
);
$t['mainForm']['blocks']['part_2']['elements'][] = array(
'type' => 'text',
'label' => 'En quoi la garantie jeunes est-elle indispensable au jeune ?',
'name' => 'counselors_opinion',
'required' => false,
'placeholder' => 'Avis des conseillers GJ',
);


$t['mainForm']['blocks']['part_2']['elements'][] = array(
'type' => 'text',
'label' => 'Exposé des motifs de la proposition d\'entrée en GJ par la ML',
'name' => 'profesional_project',
'required' => false,
'placeholder' => 'Projet professionnel',
);
$t['mainForm']['blocks']['part_2']['elements'][] = array(
'type' => 'text',
'label' => 'Exposé des motifs de la proposition d\'entrée en GJ par la ML',
'name' => 'remark',
'required' => false,
'placeholder' => 'Attenttion particulière, remarque',
);
 */



/**				POUR LA COMMISSION 				*/

/*$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'text',
    'label' => 'Date de l\'entretien avec le jeune',
    'name' => 'interview_date',
    'required' => false,
    'placeholder' => 'JJ/MM/AAAA',
    'class' => 'datepicker',
    'data_info' => 'date',/** classe date à vérifier

);

$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'select',
    'label' => 'Avis pré-commission',
    'name' => 'pre_commission_opinion',
    'required' => false,
    'options' => array(
        'values' => array(
            array('value' => '-', 'name' => "Choisissez un avis"),
            array('value' => 'Favorable', 'name' => "Favorable"),
            array('value' => 'Favorable dérogatoire', 'name' => "Favorable dérogatoire"),
            array('value' => 'Défavorable', 'name' => "Défavorable"),
            array('value' => 'Reporté', 'name' => "Reporté"),
        )
    )
);
$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'select',
    'label' => 'Décision de la commission d\'attribution et de suivi',
    'name' => 'attribution_commission_opinion',
    'required' => false,
    'options' => array(
        'values' => array(
            array('value' => '-', 'name' => "Choisissez un avis"),
            array('value' => 'Favorable', 'name' => "Favorable"),
            array('value' => 'Favorable dérogatoire', 'name' => "Favorable dérogatoire"),
            array('value' => 'Défavorable', 'name' => "Défavorable"),
            array('value' => 'Reporté', 'name' => "Reporté"),
        )
    )
);
$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'text',
    'label' => 'Si favorable, pour une durée de combien de mois ?',
    'name' => 'months_period',
    'required' => false,
    'placeholder' => 'Indiquez la durée en nombre de mois',
);
$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'text',
    'label' => 'à compter du',
    'name' => 'start_of_months_period',
    'required' => false,
    'placeholder' => 'Indiquez la date de début de la période',
    'class' => 'datepicker' ,
    'data_info' => 'date',/** classe date à vérifier
); */

/** liste des pièces justificatives */
/**
Pièces d'identité en cours de validité
Autorisation du repésentant légal pour les mineurs ou pour les jeunes majeurs sous tutelle ou curatelle
Pour les ressortissants hors UE ou hors EEE, copie de la carte de séjour et de l'autorisation de travail en cours de validité
ressortissants hors france, documents attestant de cinq ans de présence sur le territoire français
Copie de l'attestation de la couverture sociale (= CPAM ?) mentionnant l'adresse du centre
Copie de la carte vitale
Attestation sur l'honneur des ressources déclarées (ou declarées des 3 derniers mois) (et NEET)
Relevé d'identité bancaire d'un compte au nom du jeune (livret A accepté)
Justificatif de domicile ou document attestant la déco-habitation (accueil CCAS, attestation association suivant le jeune...)

Attestation de bénéficiaire du RSA
dernier avis d'imposition ou de non imposition du jeune, de ses parents ou de son conjoint marié ou pacsé
avis d'engagement de détachement fiscal
tout élément justifiant de la situation précaire du jeune : attestation non imposition/surendettement/chômage...
 */
$t['mainForm']['blocks']['part_3']['elements'][] = array(
    'type' => 'text',
    'label' => 'Montant estimé de l\'allocation',
    'name' => 'allowance_estimated_amount',
    'required' => false,
    'placeholder' => 'Indiquez une estimation',
);


$dataEncoded = json_encode($t);

echo $dataEncoded;