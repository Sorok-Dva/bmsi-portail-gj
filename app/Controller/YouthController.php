<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 23/03/2016
 * @Time    : 10:33
 * @File    : YouthController.php
 * @Version : 1.0
 * @LastUpdate  : 24/03/2016 à 17:00
 */

namespace App\Controller;

use App\Table;
use App\Controller;
use \App;
use Core\HTML\BootstrapForm;
use Core\HTML\FormBuilder;
use Core\CSVParser\CSVParser;

class YouthController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Youth');
        $this->loadModel('Index');
    }

    /**
     * Function qui permet de vérifier s'il n'existe pas de doublon au niveau des pseudo/mails en base de donnée
     * @param $type string nom de la colonne
     * @param $data string donnée à vérifier
     * @return bool true|false Retourne true si y a pas de doublon, retourne false s'il y en a un
     * @internal param string $var Le contenue de la variable a vérifiée
     */
    private function noDataDuplicate($type, $data)
    {
        if (empty($this->Youth->checkData($type, $data))) {
            return true;
        }
        return false;
    }

    /**
     * Function qui permet de vérifier s'il n'existe pas de doublon au niveau des login/mails en base de donnée
     * @param $type string nom de la colonne
     * @param $data string donnée à vérifier
     * @return bool true|false Retourne true si y a pas de doublon, retourne false s'il y en a un
     * @internal param string $var Le contenue de la variable a vérifiée
     */
    private function checkData($type, $data)
    {
        if (empty($this->Youth->checkData($type, $data))) {
            return false;
        }
        return true;
    }


    public function test()
    {
        $json = $this->Youth->getForms();
        r($json);
//        var_dump($json);
        $form = new FormBuilder($_POST, $json[0]->form);

        $this->render('debugProfile.test', compact('form'));
    }

    /**
     * Enregistre un utilisateur après avoir effectuer une batterie de test
     * @return mixed
     */
    public function add()
    {
        $json = $this->Youth->getForms();
        $form = new FormBuilder($_POST, $json[0]->form);


        if (!empty($_POST)) {

            $errors = [];

            if (
                $_POST['civility'] AND $_POST['lastName'] AND $_POST['name']
                AND $_POST['address'] AND $_POST['postal_code'] AND $_POST['town'] AND $_POST['nationality']
                AND $_POST['birthday']
            ) {

                if($_POST['civility'] == "-")
                    array_push($errors, "ERROR_CIVILITY");
                if ($this->noDataDuplicate('identity', $_POST['name'] . " " . $_POST['lastName']) == false)
                    array_push($errors, "DUPLICATE_IDENTITY");
                /*
                if ($this->noDataDuplicate('mail', $_POST['mail']) == false)
                    array_push($errors, "DUPLICATE_MAIL");
                if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) == false)
                    array_push($errors, "EMAIL_BAD_FORMAT");
                if (strlen($_POST['phone']) != 10)
                    array_push($errors, "PHONE_BAD_FORMAT");
                if ($this->noDataDuplicate('phone_number', $_POST['phone']) == false)
                    array_push($errors, "DUPLICATE_PHONE");
                if ($_POST['know_by_PE'] == "y" AND empty($_POST['pole_e_number'] OR $_POST['pole_e_number'] == ""))
                    array_push($errors, "MISSING_PE_NUMBER");*/


                if (empty($errors)) {
                    $user_id = uniqid();

                    $result = $this->Youth->create([

                        'youth_id' => $user_id,

                        'civility' => $_POST['civility'],
                        'identity' => ucfirst($_POST['name']) . " " . strtoupper($_POST['lastName']),
                        'name' => ucfirst($_POST['name']),
                        'lastName' => strtoupper($_POST['lastName']),
                        'birthday' => strtotime(str_replace('/', '-', $_POST['birthday'])),
                        'birthplace_town' => $_POST['birthplace'],
                        'birthplace_postal_code' => $_POST['birthplace_postal_code'],

                        'nationality' => $_POST['nationality'],

                        'address' => $_POST['address'],
                        'postal_code' => $_POST['postal_code'],
                        'town' => $_POST['town'],
                        'mail' => $_POST['mail'],
                        'phone_number' => $_POST['phone_number'],
                        'fixe_number' => $_POST['phone_fixe'],
                        "pole_e_number" => $_POST['pole_e_number'],
                        "social_s_number" => $_POST['social_s_number'],

                        "attachment_antenna" => $_SESSION['antenna'],
                        "ml_referring_in_charge" => $_SESSION['identity'],

                        "creation_date" => time()
                    ]);
                    array_push($errors, "NONE");
                    $this->Log->log("Création d'un dossier manuel pour le jeune ".ucfirst($_POST['name']) . " " . strtoupper($_POST['lastName']) . ".", "Y");
                    $this->render('youth.result', compact('user_id', 'errors'));
                    die();

                }

            } else {
                array_push($errors, "MISSING_FIELDS");
            }

            $this->render('youth.add', compact('form', 'errors'));
        } else {
            $this->render('youth.add', compact('form'));
        }
    }

    public function quickAdd(){
        $file =  isset($_FILES['csvfile']) ? $_FILES['csvfile'] : false;

        if($file AND $_POST){

            if ($this->noDataDuplicate('i_milo_folder_id', $_POST['id_folder']) == true){
                $uploads_dir = ROOT.'/app/__tmp';
                $tmp_name =  time().'_'.rand(0,30);

                if ($_FILES['csvfile']["error"] == UPLOAD_ERR_OK) {
                    if($_FILES['csvfile']['type'] == "application/vnd.ms-excel"){
                        if($_FILES['csvfile']['size'] > 0 AND $_FILES['csvfile']['size'] < 1048576) {

                            $result = move_uploaded_file($_FILES['csvfile']['tmp_name'], "$uploads_dir/$tmp_name.csv");

                            if($result){
                                $parser = new CSVParser($tmp_name.'.csv', true);

                                while ($data = $parser->get(1)) {

                                    $user_id = uniqid();

                                    $identity = ucfirst($data[0]['PRENOM']) . " " . strtoupper($data[0]['NOM USAGE']);

                                    if(!empty($identity)) {
                                        $result = $this->Youth->create([

                                            'youth_id' => $user_id,
                                            'i_milo_folder_id' => $_POST['id_folder'],

                                            'civility' => strtoupper($data[0]['TITRE']),
                                            'identity' => $identity,
                                            'name' => ucfirst($data[0]['PRENOM']),
                                            'lastName' => strtoupper($data[0]['NOM USAGE']),
                                            'birthday' => strtotime(str_replace('/', '-', $data[0]['DATE NAISSANCE'])),
                                            'birthplace_town' => $data[0]['birthplace'],
                                            'birthplace_postal_code' => $data[0]['birthplace_postal_code'],

                                            'nationality' => $data[0]['NATIONALITE'],

                                            'address' => $data[0]['ADRESSE'],
                                            'mail' => $data[0]['EMAIL'],
                                            'fixe_number' => $data[0]['TELEPHONE 1'],
                                            'phone_number' => $data[0]['TELEPHONE 2'],
                                            'life_situation' => $data[0]['SITUATION FAMILIALE'],


                                            'JAPD' => $data[0]['JAPD'],
                                            'identified' => $data[0]['RECENSE'],

                                            'last_classroom_establishment' => $data[0]['CLASSE - ETABLISSEMENT'] != "" ? $data[0]['CLASSE - ETABLISSEMENT'] : "Non précisé",
                                            'last_classroom' => $data[0]['CLASSE - CLASSE'] != "" ? $data[0]['CLASSE - CLASSE'] : "Non précisé",
                                            'last_classroom_date' => strtotime(str_replace('/', '-', $data[0]['CLASSE - DATE'])),
                                            'dependent_children' => $data[0]['NOMBRE D\'ENFANTS'],

                                            "attachment_antenna" => $_SESSION['antenna'],
                                            "ml_referring_in_charge" => $_SESSION['identity'],


                                            "lodging" => $data[0]['HEBERGEMENT'],
                                            "lodging_problems" => $data[0]['PROBLEMATIQUE LOGEMENT'],
                                            "B_permit" => $data[0]['PERMIS'],
                                            "locomotion" => $data[0]['MOYEN DE LOCOMOTION'],

                                            "creation_date" => time(),

                                        ]);

                                        $alert_id = uniqid("_a-");
                                        $alert = $this->Index->create([
                                            'id' => $alert_id,
                                            'to' => $_SESSION['user_id'],
                                            'type' => "info",
                                            'title' => "Information : Création d'un dossier rapide",
                                            'alert' => "Vous avez récemment créer un dossier rapide (avec les informations d'<b>I-Milo</b>) pour le jeune <b>$identity</b>. <br> Veuillez compléter les informations de ce dossier en cliquant <a href='/youth/manage/{$_POST['id_folder']}/$user_id'>ici</a>."

                                        ]);
                                        $this->Log->log("Création d'un dossier avec un fichier CSV pour le jeune $identity.", "Y");
                                    } else {
                                        $error = "bad_file";
                                        $this->render('youth.quickadd', compact('error'));
                                        die();
                                    }


                                }

                                $id_folder = $_POST['id_folder'];
                                $this->render('youth.resultquick', compact('result', 'alert', 'user_id', 'id_folder', 'alert_id'));
                                die();
                            } else {
                                $parser = false;
                            }
                        } else {
                            $error = "size";
                        }
                    } else {
                        $error = "type";
                    }
                } else {
                    $error = "upload";
                }
            } else {
                $error = "ar_exist";
            }
        } else {
            $error = false;
        }

        $this->render('youth.quickadd', compact('error'));
    }

    public function manage(){
        $id = App::getActualRoute();

        if(!empty($id[2])) {
            $youth = $this->Youth->findFolder($id[2]);
            if(!empty($youth)){
                if (!isset($id[3]) OR  $id[3] != $youth->youth_id ) {
                    if ($youth->attachment_antenna != $_SESSION['antenna']) {
                        $this->Log->log("Tentative d'accès à un dossier qui n'est pas relié à la structure. (Dossier de $youth->identity).");
                        $this->Errors(
                            "usageError",
                            "Vous essayez d'accèder au dossier d'un jeune ne faisant pas parti de votre structure."
                        );
                    }
                }

                if($_FILES){
                    foreach($_FILES as $files){
                        if($files['error'] == 0){
                            $type = $files['type'];
                            if( !strstr($type, 'jpg') && !strstr($type, 'jpeg') && !strstr($type, 'png') && !strstr($type, 'tiff') && !strstr($type, 'pdf') && !strstr($type, 'zip') && !strstr($type, 'doc') && !strstr($type, 'docx') )
                            {
                                array_push($errors, "BAD_FORMAT_FILES");
                                $this->render('youth.manage', compact('youth', 'form', 'id', 'errors'));
                                die();
                            }
                        }
                    }

                    mkdir(ROOT."/app/__youth/".$youth->youth_id, 0705);

                    $i = 0;
                    foreach($_FILES as $files){
                        if($files['error'] == 0){
                            $type = $files['type'];

                            if( strstr($type, 'jpg') OR strstr($type, 'jpeg') OR strstr($type, 'png') OR strstr($type, 'tiff') OR strstr($type, 'pdf') OR strstr($type, 'zip') OR strstr($type, 'doc') OR strstr($type, 'docx') )
                            {
                                $files_id = uniqid("attachments_");
                                switch($i){
                                    case 0:
                                        $CNI_path = '/app/__youth/'.$youth->youth_id.'/' . $files_id . $files['name'];
                                        break;
                                    case 1:
                                        $carteV_path = '/app/__youth/'.$youth->youth_id.'/' . $files_id . $files['name'];
                                        break;
                                    case 2:
                                        $CPAM_path = '/app/__youth/'.$youth->youth_id.'/' . $files_id . $files['name'];
                                        break;
                                    case 3:
                                        $authorization_path = '/app/__youth/'.$youth->youth_id.'/' . $files_id . $files['name'];
                                        break;
                                    case 4:
                                        $RIB_path = '/app/__youth/'.$youth->youth_id.'/' . $files_id . $files['name'];
                                        break;
                                    case 5:
                                        $just_domicile_path = '/app/__youth/'.$youth->youth_id.'/' . $files_id . $files['name'];
                                        break;

                                }
                                move_uploaded_file($files['tmp_name'], ROOT . '/app/__youth/'.$youth->youth_id.'/' . $files_id . $files['name']);
                            }

                        }
                        $i++;
                    }
                }

                if($youth->validation == "P"){
                    if($_POST){
                        $result = $this->Youth->update($id[2], 'i_milo_folder_id OR youth_id',[

                            'civility' => $_POST['civility'],
                            'identity' => ucfirst($_POST['name']) . " " . strtoupper($_POST['lastName']),
                            'name' => ucfirst($_POST['name']),
                            'lastName' => strtoupper($_POST['lastName']),
                            'birthday' => strtotime(str_replace('/', '-', $_POST['birthday'])),
                            'birthplace_town' => $_POST['birthplace_town'],
                            'birthplace_postal_code' => $_POST['birthplace_postal_code'],

                            'nationality' => $_POST['nationality'],

                            'address' => $_POST['address'],
                            'postal_code' => $_POST['postal_code'],
                            'town' => $_POST['town'],
                            'mail' => $_POST['mail'],
                            'phone_number' => $_POST['phone_number'],
                            'fixe_number' => $_POST['fixe_number'],

                            "pole_e_number" => $_POST['pole_e_number'],
                            "social_s_number" => $_POST['social_s_number'],

                            'know_by_CG' => $_POST['know_by_CG'],
                            'know_by_PE' => $_POST['know_by_PE'],
                            'know_by_PJJ' => $_POST['know_by_PJJ'],
                            'know_by_SPIP' => $_POST['know_by_SPIP'],
                            'know_by_ASE' => $_POST['know_by_ASE'],
                            'know_by_CIAS' => $_POST['know_by_CIAS'],
                            'know_by_CHRS' => $_POST['know_by_CHRS'],
                            'know_by_ML' => $_POST['know_by_ML'],
                            'ongoing_with_the_knowed_structure' => $_POST['ongoing_with_the_knowed_structure'],

                            'life_situation' => $_POST['life_situation'],

                            'last_classroom_establishment' => $_POST['last_classroom_establishment'] != "" ? $_POST['last_classroom_establishment'] : "Non précisé",
                            'last_classroom' => $_POST['last_classroom'] != "" ? $_POST['last_classroom'] : "Non précisé",
                            'last_classroom_date' => strtotime(str_replace('/', '-', $_POST['last_classroom_date'])),
                            'dependent_children' => $_POST['dependant_children'],

                            "lodging" => $_POST['lodging'],
                            "B_permit" => $_POST['B_permit'],
                            "locomotion" =>$_POST['locomotion'],

                            "last_update" => time(),
                            "process" => "C",

                            "files_CNI" => $CNI_path,
                            "files_carteV" => $carteV_path,
                            "files_authorization" => $authorization_path,
                            "files_RIB" => $RIB_path,
                            "files_just_domicile" => $just_domicile_path,
                            "files_CPAM" => $CPAM_path,

                        ]);

                        if($result){
                            $this->Log->log("Modification du dossier du jeune $youth->identity.", "Y");
                            header('Location: '. App::env("SITE_URL") .'youth/manage/'.$id[2]);
                        }
                    }

                    $json = $this->Youth->getForms();
                    $form = new FormBuilder($youth, $json[0]->form);

                    $this->render('youth.manage', compact('youth', 'form', 'id'));
                } else if ($youth->validation == "R") {
                    $this->render('youth.refused', compact('youth', 'id'));
                } else if ($youth->validation == "V") {
                    $this->render('youth.accepted', compact('youth', 'id'));
                }

            } else {
                $this->Errors(
                    "usageError",
                    "L'url que vous avez entrer est incorrect. Aucun ID de dossier ne correspond au numéro du dossier indiqué dans l'url! <br><br>Si le prolème persiste, signalez-le à votre administrateur de structure"
                );
            }
        } else {
            $this->Errors(
                "usageError",
                "L'url que vous avez entrer est incorrect. Aucun ID de dossier n'est spécifier pour pouvoir y accéder!<br><br>Si le prolème persiste, signalez-le à votre administrateur de structure"
            );
        }
    }

    public function accepted(){
        $id = App::getActualRoute();

        if(!empty($id[2])) {
            $youth = $this->Youth->findFolder($id[2]);
            if(!empty($youth)){

                if ($youth->validation == "R") {
                    $this->Log->log("Consultation du dossier (refusé) de $youth->identity.");
                    $this->render('youth.refused', compact('youth', 'id'));
                } else if ($youth->validation == "V") {
                    $this->Log->log("Consultation du dossier (accepté) de $youth->identity.");
                    $this->render('youth.accepted', compact('youth', 'id'));
                } else {
                    header('Location: '. App::env("SITE_URL"));
                }

            } else {
                $this->Errors(
                    "usageError",
                    "L'url que vous avez entrer est incorrect. Aucun ID de dossier ne correspond au numéro du dossier indiqué dans l'url! <br><br>Si le prolème persiste, signalez-le à votre administrateur de structure"
                );
            }
        } else {
            $this->Errors(
                "usageError",
                "L'url que vous avez entrer est incorrect. Aucun ID de dossier n'est spécifier pour pouvoir y accéder!<br><br>Si le prolème persiste, signalez-le à votre administrateur de structure"
            );
        }
    }

    public function refused(){
        $id = App::getActualRoute();

        if(!empty($id[2])) {
            $youth = $this->Youth->findFolder($id[2]);
            if(!empty($youth)){
                if ($youth->validation == "R") {
                    $this->Log->log("Consultation du dossier (refusé) de $youth->identity.");
                    $this->render('youth.refused', compact('youth', 'id'));
                } else if ($youth->validation == "V") {
                    $this->Log->log("Consultation du dossier (accepté) de $youth->identity.");
                    $this->render('youth.accepted', compact('youth', 'id'));
                } else {
                    header('Location: '. App::env("SITE_URL"));
                }
            } else {
                $this->Errors(
                    "usageError",
                    "L'url que vous avez entrer est incorrect. Aucun ID de dossier ne correspond au numéro du dossier indiqué dans l'url! <br><br>Si le prolème persiste, signalez-le à votre administrateur de structure"
                );
            }
        } else {
            $this->Errors(
                "usageError",
                "L'url que vous avez entrer est incorrect. Aucun ID de dossier n'est spécifier pour pouvoir y accéder!<br><br>Si le prolème persiste, signalez-le à votre administrateur de structure"
            );
        }
    }
    public function myFolders(){
        $folders = $this->Youth->myFolders();
        $this->Log->log("Consultation des dossiers en charge.");
        $this->render('users.myfolders', compact('folders'));
    }
    
    public function result($info)
    {
        $successRegister = false;
        $errorRegister = false;
        $success = false;
        $error = false;

        switch ($info):
            case 'successR':
                $successRegister = true;
                break;
            case 'success':
                $success = true;
                break;
            case 'errorR':
                $errorRegister = true;
                break;
            case 'error':
                $error = true;
                break;
        endswitch;

        $this->render('youth.result', compact('success', 'error', 'successRegister', 'errorRegister'));
        die();
    }

}