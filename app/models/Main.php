<?php
/**
 * Created by PhpStorm.
 * User: Сергий
 * Date: 11.11.2018
 * Time: 12:30
 */

namespace app\models;


use app\core\Model;


class Main extends Model
{
    public function getTasks()
    {
        return $this->db->row('SELECT author FROM tasks');
    }
}