<?php
/**
 * Created by PhpStorm.
 * User: Сергий
 * Date: 10.11.2018
 * Time: 18:18
 */

namespace app\core;
use app\core\View;


abstract class Controller
{
    public $route;
    public $view;
    public $model;
    public $acl;
    public $var = [];

    public function __construct($route)
    {

        $this->route = $route;
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }
    public function loadModel($name)
    {
        $modelName = 'app\models\\'.ucfirst($name);
        if (class_exists($modelName)) {
            return new $modelName;
        }
    }
    //Права досутпа
    public function checkAcl()
    {
        $fileName = 'app/acl/'.$this->route['controller'].'.php';
        if (file_exists($fileName)) {
            $this->acl = require $fileName;
            if ($this->isAcl('all')) {
                return true;
            }
            elseif (isset($_SESSION['authorize']['id']) && $this->isAcl('authorize')) {
                return true;
            }
            elseif (!isset($_SESSION['authorize']['id']) && $this->isAcl('guest')) {
                return true;
            }
            elseif (isset($_SESSION['admin']) && $this->isAcl('admin')) {
                return true;
            }
            return false;
        }
    }
    public function isAcl($key)
    {
     return in_array($this->route['action'], $this->acl[$key]);
    }

}