<?php
/**
 * Created by PhpStorm.
 * User: Сергий
 * Date: 10.11.2018
 * Time: 19:21
 */

namespace app\core;


class View
{
    //path -  путь к файлу
    public $path;
    public $layout = 'to-do.html';
    public $route;

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $this->route['controller'].'/'.$route['action'];
        //debug($this->path);

    }
    public function render($title, $vars = [])
    {
        extract($vars);
        if (file_exists('app/views/'.$this->path.'.php')) {
            ob_start();
            require 'app/views/'.$this->path.'.php';
            $content = ob_get_clean();
            require 'app/views/layouts/'.$this->layout.'.php';
        } else {
            echo 'View not fount';
        }
    }
    public static function errorCode($code)
    {
        http_response_code($code);
        $filePath = 'app/views/errors/'.$code.'.php';
        if (file_exists($filePath)) {
            require $filePath;
            exit;
        }
    }
    public static function redirect($url)
    {
        header('location: '.$url);
        exit;
    }

    //AJAX
    public static function message($status, $message)
    {
        header('Content-Type: application/json');
        exit(json_encode(['status' => $status, 'message' => $message]));
    }
    public function redirectLocation($url)
    {
        exit(json_encode(['url' => $url]));
    }
}

