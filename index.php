<?php
require 'app/lib/dev.php';
require 'app/autoloader.php';

use app\core\Router;

session_start();
$router = new Router();
$router->run();