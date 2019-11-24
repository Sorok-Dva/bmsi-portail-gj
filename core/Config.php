<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 07/11/2015
 * @Time    : 18:19
 * @File    : Config.php
 * @Version : 1.0
 */

namespace Core;

class Config
{


    /**
     * @var string À ne pas toucher. Merci, par respect pour l'auteur, de laisser cette information quelque part sur votre site (par défaut, dans le footer)
     */
    public static $author = "<small>Powered with LightPHPFramework created by Liightman</small>";
    private static $_instance;
    private $settings = [];

    public function __construct($file)
    {
        $this->settings = require($file);
    }

    /**
     * @param $file string fichier qui dont les tables doivent �tre instanci�s
     * @return Config
     */
    public static function getInstance($file)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Config($file);
        }

        return self::$_instance;
    }

    public function get($key)
    {
        if (!isset($this->settings[$key])) {
            return null;
        }

        return $this->settings[$key];
    }
}