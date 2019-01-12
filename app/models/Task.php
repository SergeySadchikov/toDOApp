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
    public function addTask($description, $status, $authorId, $assignedUserId)
    {
        $params = [
            'description' => $description,
            'is_done' => $status,
            'user_id' => $authorId,
            'assigned_user_id' => $assignedUserId
        ];
        $this->db->query('INSERT INTO task (description, is_done, date_added, user_id, assigned_user_id) VALUES (:description, :is_done, CURRENT_TIMESTAMP, :user_id, :assigned_user_id)', $params);
    }
    public function getTask($id)
    {
        $params = ['id' => $id];
        $task = $this->db->row('SELECT * FROM task WHERE id = :id', $params);
        return $task[0];
    }
    public function editTask($id, $assigned_user_id = false, $description = false, $status = false)
    {
        $params = [
            'assigned_user_id' => $assigned_user_id,
            'description' => $description,
            'id' => $id
        ];
        $this->db->query('UPDATE task SET assigned_user_id = :assigned_user_id, description = :description WHERE id =:id', $params);
    }
    public function changeStatus($id, $status)
    {
        $params = [
            'id' => $id,
            'is_done' => $status
        ];
        $this->db->query('UPDATE task SET is_done = :is_done WHERE id =:id', $params);
    }
    public function deleteTask($id)
    {
        $params = ['id' => $id];
        $this->db->query('DELETE FROM task WHERE id = :id', $params);
    }
    public function getCount($author = false, $assigned = false)
    {
        $sql = 'SELECT count(id) FROM task';
        $params = [];
        if ($author) {
            $params += ['author_id' => $author];
            $sql .= ' WHERE user_id = :author_id';
        }
        if ($assigned) {
            $params += ['user_id' => $assigned];
            $sql .= ' WHERE assigned_user_id = :user_id';
        }
        return $this->db->column($sql, $params);
    }
    public function getTasks($offset, $limit, $author = false, $assigned = false)
    {
        $params = [
            'offset' => $offset,
            'limit' => $limit
        ];
        $condition = '';
        if ($author) {
            $params += ['author_id' => $author];
            $condition = 'SELECT * FROM task WHERE user_id = :author_id ORDER BY id DESC LIMIT :offset, :limit';
        } elseif ($assigned) {
            $params += ['user_id' => $assigned];
            $condition = 'SELECT * FROM task  WHERE assigned_user_id = :user_id  ORDER BY id DESC LIMIT :offset, :limit';
        } else {
            $condition = 'SELECT * FROM task ORDER BY id DESC LIMIT :offset, :limit';
        }
        $sql = 'SELECT t.id as task_id, t.description as description, u.id as author_id, u.login as author_name, u.surname as author_surname, au.id as assigned_user_id, au.login as assigned_user_name, au.surname as assigned_user_surname, t.is_done as is_done, t.date_added as date_added 
            FROM ('.$condition.') t 
                INNER JOIN user u ON u.id=t.user_id 
                INNER JOIN user au ON t.assigned_user_id=au.id';
        return $this->db->row($sql, $params);
    }

}