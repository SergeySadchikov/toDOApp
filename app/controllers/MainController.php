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
        //Проверка доступа
        if(!$this->checkAcl()) {
            $this->view->path = '/account/login';;
        } else {
            $this->view->path = 'main/index';
        }
        $this->view->render('To-Do');
    }
}