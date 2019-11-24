<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 07/04/2016
 * @Time    : 08:46
 * @File    : BugController.php
 * @Version : 1.0
 * @LastUpdate  : 07/04/2016 à 08:46
 */
namespace App\Controller;

use App;
use App\Controller;
use App\Table;

class BugController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Bug');

    }

    private function base64_to_jpg($string, $file) {
        $fp = fopen('../app/__bugs_ss/'.$file, "wb");
        $data = explode(',', $string);
        fwrite($fp, base64_decode($data[1]));
        fclose($fp);
        return $file;
    }

    public function report()
    {
        if($this->forbiddenToWebBrowser() != "forbidden"){
            $comment = isset($_REQUEST['comment']) ? $_REQUEST['comment'] : '';
            $screenshot =  isset($_REQUEST['screenshot']) ? $_REQUEST['screenshot'] : false;
            
            if($screenshot) $screenshot = $this->base64_to_jpg($screenshot, time().'_'.rand(0,30).'.jpg');

            $create = $this->Bug->create([
                "report" => $comment,
                "screen" => $screenshot,
                "url" => $_REQUEST['url'],
                "identity" => $_SESSION['identity'],
                "date" => time()
            ]);
            $this->Log->log("Utiliation de l'outil de signalement de problème (signalé depuis l'adresse <a href=\"{$_REQUEST['url']}\" target=\"_blank\">{$_REQUEST['url']}</a>.");

            echo json_encode(array('result' => 'success'));
        }
    }

    public function index(){
        $bugs = $this->Bug->getBugs();

        $this->render("bug.index", compact('bugs'));
    }

    public function update(){
        if($this->forbiddenToWebBrowser() != "forbidden") {
            if ($_POST) {

            }
        }
    }
}

