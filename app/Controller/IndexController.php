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

use App;
use App\Controller;
use App\Table;

class IndexController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Index');
    }

    public function home()
    {
        $alerts = !empty($_SESSION) ? $this->Index->getAlerts() : null;
        $this->render("index.home", compact('alerts'));
    }
}