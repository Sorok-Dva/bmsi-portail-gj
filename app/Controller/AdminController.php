<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 04/04/2016
 * @Time    : 10:00
 * @File    : AdminController.php
 * @Version : 1.0
 * @LastUpdate  : 04/04/2016 à 10:00
 */

namespace App\Controller;

use App\Table;
use App\Controller;
use \App;
use Core\HTML\BootstrapForm;
use Core\HTML\FormBuilder;

class AdminController extends AppController
{

    public function formBuilder(){

        $this->render('adm.formBuilder');
    }
}