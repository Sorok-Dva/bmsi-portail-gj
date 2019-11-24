<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 21/03/2016
 * @Time    : 17:50
 * @File    : index.php
 * @Version : 1.0
 */

session_start();
define('ROOT', dirname(__DIR__));

require ROOT . '/core/Debug/ref.php';
require ROOT . '/app/App.php';

App::load();

$app = App::getInstance();
$routing = App::Routing();

?>