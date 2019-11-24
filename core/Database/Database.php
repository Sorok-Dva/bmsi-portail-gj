<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 09/13/2016
 * @Time    : 09:13
 * @File    : Database.php
 * @Version : 1.0
 * @LastUpdate  :
 */

namespace Core\Database;

use \PDO;
use Core\Controller;

/**
 * Class Database Effectue une connexion au serveur mysql
 * @package App
 */
class Database
{
    //@var string Donnée $user de la base de donnée
    private $_dbuser;

    //@var string Donnée $name de la base de donnée
    private $_dbname;

    //@var string Donnée $host distant de la base de donnée
    private $_server;

    //@var string Donnée $password de la base de donnée
    private $_pass;

    //@var object Retourne sous forme d'objet
    private $pdo;

    public function __construct($_dbname = null, $_dbuser = null, $_server = null, $_pass = null)
    {
        $this->_dbname = $_dbname;
        $this->_dbuser = $_dbuser;
        $this->_server = $_server;
        $this->_pass = $_pass;
    }

    /**
     * @return object|PDO
     */
    private function getPDO()
    {
        if ($this->pdo === null) {
            $pdo = new PDO ('mysql:host=' . $this->_server . ';dbname=' . $this->_dbname, $this->_dbuser, $this->_pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    /**
     * @param $statement string Requête MySQL
     * @param $class_name string Nom de la classe
     * @param bool $count Si on veut récuperer le nombre de ligne du statement
     * @param bool $one Si on veut récuperer un seul résultat
     * @return array Retourne le résultat de la requête sous forme de tableau associatif
     */
    public function query($statement, $class_name = null, $count = false, $one = false)
    {
        try{
            $query = $this->getPDO()->query($statement);

            if (
                strpos($statement, 'UPDATE') === 0 ||
                strpos($statement, 'INSERT') === 0 ||
                strpos($statement, 'DELETE') === 0
            ) {
                return $query;
            }

            if (is_null($class_name)) {
                $query->setFetchMode(PDO::FETCH_OBJ);
            } else {
                $query->setFetchMode(PDO::FETCH_CLASS, $class_name);
            }
            if ($one) {
                $data = $query->fetch();
            } else {
                $data = $query->fetchAll();
                if ($count):
                    $data = $query->rowCount();
                endif;
            }
            return $data;
        } catch (\Exception $e){
            $controller = new Controller\Controller();
            $controller->Errors("backError", $e);
            return false;
        }
    }

    /**
     * @param $statement string Requête MySQL
     * @param $attributes
     * @param $class_name string Nom de la classe
     * @param bool|false $one Si on souhaite avoir un fetch (true) ou fetchAll (false)
     * @return array|mixed Retourne le résultat de la requête sous forme de tableau associatif
     */
    public function prepare($statement, $attributes, $class_name = null, $one = false)
    {
        try{
            $req = $this->getPDO()->prepare($statement);
            $res = $req->execute($attributes);

            if (
                strpos($statement, 'UPDATE') === 0 ||
                strpos($statement, 'INSERT') === 0 ||
                strpos($statement, 'DELETE') === 0
            ) {
                return $res;
            }
            if (is_null($class_name)) {
                $req->setFetchMode(PDO::FETCH_OBJ);
            } else {
                $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
            }
            if ($one) {
                $data = $req->fetch();
            } else {
                $data = $req->fetchAll();
            }

            return $data;
        } catch (\Exception $e){
            $controller = new Controller\Controller();
            $controller->Errors("backError", $e);
            return false;
        }
    }

    public function lastInsertId()
    {
        return $this->getPDO()->lastInsertId();
    }
}