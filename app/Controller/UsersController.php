<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 21/03/2016
 * @Time    : 11:16
 * @File    : UsersController.php
 * @Version : 1.0
 * @LastUpdate  :
 */

namespace App\Controller;

use App\Table;
use App\Controller;
use \App;
use Core\HTML\BootstrapForm;

class UsersController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Staff');
    }

    /**
     * @param $password string Encrypte de façon non récursive un mot de passe
     * @return string Le mot de passe enrypté
     */
    public static function cryptPass($password)
    {
        $encryptedPassword = crypt($password, '$2y$10$commissiongjmissionloc$');
        return $encryptedPassword;
    }

    /**
     * Génére un password pour les prescripteurs
     * @param $car
     * @return string
     */
    private function generatePass($car)
    {
        $string = "";
        $chaine = "abcdefghijklmnpqrstuvwxyABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        srand((double)microtime() * 1000000);
        for ($i = 0; $i < $car; $i++) {
            $string .= $chaine[rand() % strlen($chaine)];
        }
        return $string;
    }

    /**
     * Envoie un mail pour valider l'inscription
     * @param $pseudo string Pseudo (prenom + nom) du nouvel utilisateur
     * @param $mail string Mail du nouvel utilisateur
     * @param $activation string Clé d'activation
     */
    private function sendRegistrationMail($login, $password, $mail, $identity, $admin, $activation)
    {
        $message_mail = "
		<!doctype html>
			<html lang='fr'>
				<body>
					<p><strong>Bonjour {$identity}</strong>,
					<br />L'administrateur de votre structure, {$admin}, vous a créer un compte sur le portail Garantie Jeune.
					<br> Pour accéder à votre espace prescripteur, cliquez sur le bouton ci-dessous et utilisez ces informations pour vous connecter : 
					<br><br> Login : <b>{$login}</b>
					<br> Mot de passe : <b>{$password}</b>
					<br><br><b>Dès lors de votre inscription, vous devrez changer votre mot de passe. Ce dernier devra rester personnel et confidentiel.</b><br>
					<a href='" . $activation . "'>Me connecter</a>
					<p>Le lien ne fonctionne pas ? Essayez de coller ce lien dans votre navigateur : " . $activation . "</p>
				</body>
			</html>";

        $headers_mail = 'MIME-Version: 1.0' . "\r\n";
        $headers_mail .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers_mail .= 'From: "' . App::env("SITE_NAME") . '" <' . App::env("MASTER_EMAIL") . '>' . "\r\n";

        // Envoi du mail
        mail($mail, $admin . ' vous a créer un compte sur ' . App::env("SITE_NAME") . '', $message_mail, $headers_mail);
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
        if (empty($this->Staff->checkData($type, $data))) {
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
        if (empty($this->Staff->checkData($type, $data))) {
            return false;
        }
        return true;
    }

    /**
     * Enregistre un utilisateur après avoir effectuer une batterie de test
     * @return mixed
     */
    public function add()
    {
//        $this->AllowedTo(App::env("ALLOW_ADD_USER"));
        if (!empty($_POST)) {

            if (App::env("ENV") == "DEBUG")
                var_dump($_POST);

            if (
                $_POST['login'] AND $_POST['mail'] AND
                $_POST['name'] AND $_POST['lastName'] AND
                $_POST['phone'] AND
                $_POST['structure_name'] AND $_POST['antenna_name'] AND $_POST['structure_code'] AND $_POST['structure_department']
            ) {

                $login = $_POST['login'];
                $name = $_POST['name'];
                $lastName = $_POST['lastName'];
                $mail = $_POST['mail'];
                $rank = $_POST['rank'];
                $phone = $_POST['phone'];
                $structureCode = $_POST['structure_code'];
                $structureName = $_POST['structure_name'];
                $structureDp = $_POST['structure_department'];
                $antennaName = $_POST['antenna_name'];
                $password = $this->generatePass('8');
                $_POST['password'] = $password;

                $missingFields = false;
                $errorDuplicateIdentity = false;
                $errorDuplicateLogin = false;
                $errorDuplicateMail = false;
                $errorDuplicatePhone = false;


                switch ($rank):
                    case 0:
                        $rank = "Prescripteur";
                        break;
                    case 1:
                        $rank = "Validateur";
                        break;
                    case 2:
                        $rank = "Membre Commission";
                        break;
                    case 3:
                        $rank = "Président Commission";
                        break;
                    case 4:
                        $rank = "Administrateur de structure";
                        break;
                endswitch;

                if ($this->noDataDuplicate('identity', $name . " " . $lastName) == true) {
                    if ($this->noDataDuplicate('login', $login) == true) {
                        if ($this->noDataDuplicate('mail', $mail) == true) {
                            if ($this->noDataDuplicate('phone_number', $phone) == true) {

                                $timestamp = time();

                                $user_id = uniqid();
                                $result = $this->Staff->create([

                                    'user_id' => $user_id,
                                    'login' => ucfirst($login),
                                    'mail' => $mail,
                                    'phone_number' => $phone,
                                    'rank' => $rank,
                                    'added_by' => $_SESSION['identity'],

                                    'identity' => ucfirst($name) . " " . ucfirst($lastName),
                                    'name' => ucfirst($name),
                                    'familyName' => ucfirst($lastName),

                                    'antenna_name' => $antennaName,
                                    'structure_name' => $structureName,
                                    'structure_code' => $structureCode,
                                    'structure_department' => $structureDp,

                                    'password' => $this->cryptPass($password),

                                    'ip_registration' => $_SERVER['REMOTE_ADDR'],
                                    'join_date' => $timestamp,

                                ]);

                                $activation = App::env("SITE_URL");
                                if (App::env("ENV") == "PRODUCTION")
                                    $this->sendRegistrationMail($login, $password, $mail, ucfirst($name) . " " . ucfirst($lastName), $_SESSION['identity'], $activation);

                                return !empty($result) ? $this->result('successR') : $this->result('errorR');

                            } else {
                                // Doublon de login
                                $errorDuplicateLogin = true;
                            }
                        } else {
                            // Doublon de numéro de téléphone
                            $errorDuplicatePhone = true;
                        }
                    } else {
                        // Doublon d'adresse e-mail
                        $errorDuplicateMail = true;
                    }
                } else {
                    // Doublon d'identité
                    $errorDuplicateIdentity = true;
                }
            } else {
                $missingFields = true;
            }
        } else {
            $missingFields = false;
            $errorDuplicateIdentity = false;
            $errorDuplicateLogin = false;
            $errorDuplicateMail = false;
            $errorDuplicatePhone = false;
        }

        $form = new BootstrapForm($_POST);
        $this->render('users.register', compact('form', 'errorDuplicateMail', 'errorDuplicateLogin', 'errorDuplicateIdentity', 'errorDuplicatePhone', 'missingFields'));
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

        $this->render('users.result', compact('success', 'error', 'successRegister', 'errorRegister'));
        die();
    }

    public function updatePassword()
    {
        $this->forbiddenToVisitor();
        if (!empty($_SESSION)) {
            if (!empty($_POST)) {

                $missingFields = false;
                $errorOldPass = false;
                $errorNewPass = false;

                if ($_POST['oldPass'] AND $_POST['newPass'] AND $_POST['newPassConf']) {

                    $oldPass = $_POST['oldPass'];
                    $newPass = $_POST['newPass'];
                    $newConfPass = $_POST['newPassConf'];

                    if ($newPass == $newConfPass) {
                        if ($this->Staff->checkPassword($this->cryptPass($oldPass))) {
                            $result = $this->Staff->update($_SESSION['user_id'], "user_id",
                                [
                                    "password" => $this->cryptPass($newPass),
                                    "last_update_password" => time()
                                ]
                            );
                            $_SESSION['first_connexion'] = time();
                            $this->Log->log("Modification du mot de passe du compte.");
                            return !empty($result) ? $this->result('success') : $this->result('error');

                            //Envoie d'un mail pour le signaler;

                        } else {
                            $errorOldPass = true;
                        }
                    } else {
                        $errorNewPass = true;
                    }
                } else {
                    $missingFields = true;
                }
            } else {
                $missingFields = false;
                $errorOldPass = false;
                $errorNewPass = false;
            }

            $this->render("users.updatePassword", compact('missingFields', 'errorOldPass', 'errorNewPass'));
        }
    }

    /**
     * Deconnecte un utilisateur
     */
    public function logout()
    {
        $this->Log->log("Déconnexion depuis l'adresse IP {$_SERVER['REMOTE_ADDR']}.");
        session_unset();
        session_destroy();

        $this->forbiddenToVisitor(); //s'occupe de rediriger l'utilisateur déconnecter vers l'accueil
    }

    public function AJAX_register($pseudo, $password, $retypePassword, $mail, $sexe)
    {

    }
}