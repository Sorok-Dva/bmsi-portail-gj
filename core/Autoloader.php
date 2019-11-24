<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 21/03/2016
 * @Time    : 09:02
 * @File    : Autoloader.php
 * @Version : 1.0
 * LastUpdate   :
 */

namespace Core;

/**
 * Class Autoloader -> Permet de charger de façon automatique les class appelées
 */
class Autoloader
{

    /**
     * @param $class string Récupère le nom de la class afin d'aller chercher le fichier correspondant
     */
    static function autoload($class)
    {
        if (strpos($class, __NAMESPACE__ . '\\') === 0) {
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
            if (file_exists(__DIR__ . '/' . $class . '.php')) {
                require __DIR__ . '/' . $class . '.php';
            } else {

            }
        }
    }

    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

}