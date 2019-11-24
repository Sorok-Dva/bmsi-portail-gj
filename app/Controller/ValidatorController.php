<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 04/04/2016
 * @Time    : 10:00
 * @File    : ValidatorController.php
 * @Version : 1.0
 * @LastUpdate  : 06/04/2016 à 09:05
 */

namespace App\Controller;

use App\Table;
use App\Controller;
use \App;
use Core\HTML\BootstrapForm;
use Core\HTML\FormBuilder;

class ValidatorController extends AppController
{

    public function __construct(){
        parent::__construct();
        $this->loadModel('Youth');
    }

    public function index(){
        $folders = $this->Youth->getFoldersProcessV();
        $this->Log->log("Consultation des dossiers en attente de validation.");

        $this->render('validator.index', compact('folders'));
    }

    public function folder(){
        $id = App::getActualRoute();

        if(!empty($id[2])){
            $youth = $this->Youth->find($id[2]);
            if($youth->attachment_antenna != $_SESSION['antenna']){
                $this->Log->log("Tentative d'accès à un dossier qui n'est pas relié à la structure pour la validation. (Dossier de $youth->identity).");
                $this->Errors(
                    "usageError",
                    "Vous essayez d'accèder au dossier d'un jeune de faisant pas parti de votre structure."
                );
            }
            if(!empty($youth)){
                $this->Log->log("Lecture du dossier du jeune $youth->identity pour validation.");
                $this->render('validator.folder', compact('youth'));
            } else {
                $this->Errors(
                    "usageError",
                    "L'url que vous avez entrer est incorrect. Aucun ID de dossier ne correspond au numéro du dossier indiqué dans l'url! Retournez sur la page \"Valider des dossiers\" depuis le menu puis rechoisissez le dossier. <br><br>Si le prolème persiste, signalez-le à votre administrateur de structure"
                );
            }
        } else {
            $this->Errors(
                "usageError",
                "L'url que vous avez entrer est incorrect. Aucun ID de dossier n'est spécifier pour pouvoir y accéder!Retournez sur la page \"Valider des dossiers\" depuis le menu puis rechoisissez le dossier. <br><br>Si le prolème persiste, signalez-le à votre administrateur de structure"
            );
        }
    }
}