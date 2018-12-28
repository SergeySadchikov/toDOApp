<?php
/**
 * Created by PhpStorm.
 * User: Сергий
 * Date: 10.12.2018
 * Time: 13:56
 */

namespace app\models;

use app\core\Model;

class Task extends Model
{
    public function addTask($params)
    {
        $this->db->query('INSERT INTO task (description, is_done, date_added, user_id, assigned_user_id) VALUES (:description, :is_done, CURRENT_TIMESTAMP, :user_id, :assigned_user_id)', $params);
    }
    public function getAllTasks()
    {
        return $this->db->row('SELECT t.id as task_id, t.description as description, u.id as author_id, u.login as author_name, u.surname as author_surname, au.id as assigned_user_id, au.login as assigned_user_name, au.surname as assigned_user_surname, t.is_done as is_done, t.date_added as date_added FROM task t INNER JOIN user u ON u.id=t.user_id INNER JOIN user au ON t.assigned_user_id=au.id');
    }
    public function getMyTasks($params)
    {
        return $this->db->row('SELECT t.id as task_id, t.description as description, u.id as author_id, u.login as author_name, u.surname as author_surname, au.id as assigned_user_id, au.login as assigned_user_name, au.surname as assigned_user_surname, t.is_done as is_done, t.date_added as date_added FROM task t INNER JOIN user u ON u.id=t.user_id INNER JOIN user au ON t.assigned_user_id=au.id WHERE au.id = :user_id', $params);
    }
    public function getAddedTasks($params)
    {
        return $this->db->row('SELECT t.id as task_id, t.description as description, u.id as author_id, u.login as author_name, u.surname as author_surname, au.id as assigned_user_id, au.login as assigned_user_name, au.surname as assigned_user_surname, t.is_done as is_done, t.date_added as date_added FROM task t INNER JOIN user u ON u.id=t.user_id INNER JOIN user au ON t.assigned_user_id=au.id WHERE u.id = :author_id', $params);
    }
    public function getTask($params)
    {
        $task = $this->db->row('SELECT * FROM task WHERE id = :id', $params);
        return $task[0];
    }
    public function editTask($params)
    {
        $this->db->query('UPDATE task SET assigned_user_id = :assigned_user_id, description = :description WHERE id =:id', $params);
    }
    public function changeStatus($params)
    {
        $this->db->query('UPDATE task SET is_done = :is_done WHERE id =:id', $params);
    }
    public function deleteTask($params)
    {
        $this->db->query('DELETE FROM task WHERE id = :id', $params);
    }

}