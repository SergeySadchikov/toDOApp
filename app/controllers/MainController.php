<?php
/**
 * Created by PhpStorm.
 * User: Сергий
 * Date: 10.11.2018
 * Time: 18:46
 */

namespace app\controllers;
use app\core\Controller;
use app\lib\Db;

class MainController extends Controller
{
    public $auth = false;

   public function indexAction()
    {
    //       $result  = $this->model->getTasks();
    //       $var = [
    //           'tasks' => $result
    //       ];
     if ($this->checkAcl()) {
         $this->auth = true;
    }
        $this->var += ['auth' => $this->auth];
        //debug($this->var);
        $this->view->render('To-Do', $this->var);
    }
}