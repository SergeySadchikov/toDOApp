<?php
/**
 * Created by PhpStorm.
 * User: Сергий
 * Date: 11.11.2018
 * Time: 12:25
 */

namespace app\core;

use app\lib\Db;
abstract class Model
{
    public $db;

    public function __construct()
    {
        $this->db = new Db;
    }
}