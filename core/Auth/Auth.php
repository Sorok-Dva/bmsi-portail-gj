<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 21/03/2016
 * @Time    : 12:21
 * @File    : DBAuth.php
 * @Version : 1.0
 * LastUpdate   :
 */

namespace Core\Auth;

use App\Controller\UsersController;
use Core\Database\Database;

class Auth
{

    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getUserId()
    {
        if ($this->isLogged()) {
            return $_SESSION['id'];
        }
        return false;
    }

    public function userInfo()
    {
        if ($this->isLogged()) {
            return $this->db->prepare("SELECT * FROM users_staff WHERE user_id = ? ", [$_SESSION['user_id']], null);
        }
        return false;
    }

    /**
     * @param $username
     * @param $password
     * @ereturn boolean
     * @return bool
     */
    public function login($username, $password)
    {
        $user = $this->db->prepare("SELECT * FROM users_staff WHERE login = ? ", [$username], null, true);
        if ($user) {
            if ($user->password === UsersController::cryptPass($password)) {
                $ml = $this->db->prepare("SELECT * FROM ml_structures WHERE structure_name = ? ", [$user->structure_name], null, true);
                $_SESSION['id'] = $user->id;
                $_SESSION['user_id'] = $user->user_id;
                $_SESSION['login'] = $user->login;
                $_SESSION['identity'] = $user->identity;
                $_SESSION['rank'] = $user->rank;
                $_SESSION['antenna'] = $user->antenna_name;
                $_SESSION['department'] = $user->structure_department;
                $_SESSION['first_connexion'] = $user->last_update_password;
                $_SESSION['logo'] = \App::env("SITE_URL").$ml->logo;
                return true;
            }
        }
        return false;
    }

    public function isLogged()
    {
        return isset($_SESSION['user_id']);
    }
}