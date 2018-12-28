<?php
/**
 * Created by PhpStorm.
 * User: Сергий
 * Date: 10.11.2018
 * Time: 1:46
 */

namespace app\core;
use app\core\View;

class Router
{
    protected $routes = [];
    protected $params = [];

    function __construct()
    {
        $arr =  include 'app/config/routes.php';
        foreach ($arr as $key => $value) {
            $this->add($key, $value);
        }
    }

    public function add($route, $param)
    {
        $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $param;
    }

    public function match()
    {
        $url = trim($_SERVER['REQUEST_URI'],'/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url,$matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int) $match;
                        }
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run()
    {
        if ($this->match()) {
            $controllerName = 'app\controllers\\'.ucfirst($this->params['controller']).'Controller';
            if (class_exists($controllerName)) {
               $action = $this->params['action'].'Action';
               if (method_exists($controllerName, $action)) {
                   $controller =  new  $controllerName($this->params);
                   $controller->$action();
               } else {View::errorCode(404);}
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }
}