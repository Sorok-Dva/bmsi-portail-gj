<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 13/04/2016
 * @Time    : 14:51
 * @File    : PdfController.php
 * @Version : 1.0
 * @LastUpdate  : 13/04/2016 à 14:51
 */

namespace App\Controller;

use \App;
use Core\HTML\FormBuilder;

class PdfController extends AppController
{
    public function __construct(){
        $this->template = "pdf";
        $this->loadModel('Youth');

        parent::__construct();
    }

    public function form(){
        $json = $this->Youth->getForms();
        $form = new FormBuilder($_POST, $json[0]->form);
        $this->render('pdf.form', compact('form'));
    }

    public function generate(){
        $id = App::getActualRoute();

        if(!empty($id[2])){
            $youth = $this->Youth->findFolder($id[2]);

            if(!empty($youth)){
                $this->render('pdf.generate', compact('youth'));
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