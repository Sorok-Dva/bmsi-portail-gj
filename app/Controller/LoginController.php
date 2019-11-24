<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 12/04/2016
 * @Time    : 08:12
 * @File    : LoginController.php
 * @Version : 1.0
 * @LastUpdate  : 12/04/2016 à 08:12
 */

namespace App\Controller;

use App\Table;
use App\Controller;
use Core\Auth\Auth;
use \App;

class LoginController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->template = "login";
        $this->loadModel('Staff');
    }


    /**
     * Connecte un utilisateur
     */
    public function index()
    {
        $this->forbiddenToMember();
        $errors = false;
        if (!empty($_POST)) {
            $auth = new Auth(App::getInstance()->getDb());
            if ($auth->login($_POST['login'], $_POST['password'])) {
                setcookie('department', $_SESSION['department'], time()+60*60*24*31*12, '/');
                $this->Log->log("Connexion depuis l'adresse IP {$_SERVER['REMOTE_ADDR']}.");
                if ($_SESSION['first_connexion'] == "0") {
                    header('Location:/users/updatepassword');
                } else {
                    header('Location:/');
                }

            } else {
                $errors = true;
            }
        }
        $this->render('login.index', compact('errors'));
    }

    /**
     * Function pour connecter un utilisateur sans passer par la page de connexion (connexion via la box)
     */
    public function loginInstant()
    {
        $this->forbiddenToMember();
        if (!empty($_POST)) {
            $auth = new Auth(App::getInstance()->getDb());
            if ($auth->login($_POST['login'], $_POST['password'])) {
                header('Location:/');

            } else {
                $errors = true;

                $this->render('users.login', compact('errors'));
            }
        }
    }


    /*************************************************************************************/
    /************************** GESTION DES POST EN AJAX *********************************/
    /*************************************************************************************/
    public function AJAX_login($pseudo, $password)
    {
        $this->forbiddenToMember();
        if (!empty($_POST)) {
            $auth = new Auth(App::getInstance()->getDb());
            if ($auth->login($pseudo, $password)) {
                $this->sendMessagetoCLI("Une session viens d'etre creer pour " . $_SESSION['pseudo'], 4);
                return true;
            } else {
                return false;
            }
        }
    }

}