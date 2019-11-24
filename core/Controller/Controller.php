<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 07/11/2015
 * @Time    : 18:59
 * @File    : Controller.php
 * @Version : 1.0
 */

namespace Core\Controller;

use App;
use Core\Auth\Auth;


class Controller
{

    protected $viewPath;
    protected $template;

    /**
     * @param $type string le type d'erreur
     * @param null $message sting Message pour spécifier une erreur
     */
    public function Errors($type, $message = null)
    {
        $this->template = "error";
        if(empty($this->viewPath))
            $this->viewPath = ROOT."/app/Views/";


        $this->render("errors." . $type, compact('message'));
        die();
    }

    /**
     * @param $view
     * @param array $variables
     */
    protected function render($view, $variables = [])
    {
        ob_start();
        extract($variables);
        require($this->viewPath . str_replace('.', '/', $view) . '.php');
        $content = ob_get_clean();
        require($this->viewPath . 'Templates/' . $this->template . '.php');
    }

    protected function renderPDF($view, $variables = []){
        extract($variables);
        require($this->viewPath . str_replace('.', '/', $view) . '.php');
        require($this->viewPath . 'Templates/' . $this->template . '.php');
    }

    public function forbiddenToVisitor()
    {
        $app = App::getInstance();
        $auth = new Auth($app->getDb());
        if (!$auth->isLogged()) {
            header('Location: / ');
        }
    }

    public function forbiddenToMember()
    {
        $app = App::getInstance();
        $auth = new Auth($app->getDb());
        if ($auth->isLogged()) {
            header('Location: / ');
        }
    }

    protected function forbiddenToWebBrowser(){
        if($_SERVER['REQUEST_METHOD'] == "GET"){
            header('Location: /');
            return "forbidden";
        }
    }

    /**
     * @param $rank string Rang de l'utilisateur
     */
    public function AllowedTo($rank)
    {
        $app = App::getInstance();
        $auth = new Auth($app->getDb());
        $user = $auth->userInfo();
        if ($user[0]->rank != $rank) {
            header('Location: / ');
        }
    }
}
