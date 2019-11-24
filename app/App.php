<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 21/03/2016
 * @Time    : 15:01
 * @File    : App.php
 * @Version : 1.0
 * @LastUpdate  :
 */

use Core\Config;
use Core\Database\Database;
use Core\Table\Table;

//use Core\Server\Server;

/**
 * Class App Factory + singleton | Permet d'initialiser les instances dès qu'on en a besoin
 */
class App {

	public $menuActive = null;

	private $db_instance;
	private static $_instance;

	/**
	 * @param $key string Valeur de la configuration demandée
	 * @return string La valeur de la clé
	 */
	public static function env($key) {
		$config = Config::getInstance(ROOT . '/config/config.php');
		return $config->get($key);
	}

	/**
	 * Singletons
	 * @return static
	 */
	public static function getInstance() {
		if (is_null(static::$_instance)) {
			static::$_instance = new App();
		}
		return static::$_instance;
	}

	/**
	 * @return bool
	 */
	public static function Routing() {
		$error = new \App\Controller\AppController();

		if (!empty($_SESSION) AND ($_SESSION['first_connexion'] == "0")) {
			empty($_SERVER['QUERY_STRING']) ? $page = '/users/updatePassword' : $page = $_SERVER['QUERY_STRING'];
		} elseif (!empty($_SESSION) AND ($_SESSION['first_connexion'] != "0")) {
			empty($_SERVER['QUERY_STRING']) ? $page = '/index/home' : $page = $_SERVER['QUERY_STRING'];
		}

		if(empty($_SESSION)) {
			$page = '/login/index';
		}

		$page = explode('/', substr($page, 1));

		if (isset($page[0]) AND isset($page[1])) {
			$action = $page[1];

			$controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller';

			if (class_exists($controller)) {
				if (method_exists($controller, $action)) {
					$controller = new $controller();
					return $controller->$action();
				} else {
					if (App::env("ENV") == "DEBUG") {
						return trigger_error("Impossible de charger la méthode : $action", E_USER_NOTICE);
					}

					if (App::env("ENV") == "PRODUCTION") {
						$error->Errors("undefinedMethods");
					}

				}
			} else {

				if (App::env("ENV") == "DEBUG") {
					return trigger_error("Impossible de charger la classe : $controller", E_USER_NOTICE);
				}

				if (App::env("ENV") == "PRODUCTION") {
					$error->Errors("undefinedClasses");
				}

			}
		} else {
			$error->Errors(
				"usageError",
				"L'url que vous avez entrer est incorrect."
			);
		}
	}

	public static function getActualRoute() {
		return explode('/', substr($_SERVER['QUERY_STRING'], 1));
	}

	public static function load() {
		require ROOT . '/app/Autoloader.php';
		App\Autoloader::register();
		require ROOT . '/core/Autoloader.php';
		Core\Autoloader::register();

	}

	/**
	 * @param $name string Nom de la table
	 * @return stdClass
	 */
	public function getTable($name) {
		$class_name = '\\App\\Table\\' . ucfirst($name) . 'Table';
		return new $class_name($this->getDb());
	}

	/**
	 * @return Database
	 */
	public function getDb() {

		if (is_null($this->db_instance)) {
			$this->db_instance = new Database(self::env("DB_DATABASE"), self::env("DB_USERNAME"), self::env("DB_HOST"), self::env("DB_PASSWORD"));
		}
		return $this->db_instance;
	}

}