<?php
/**
 * Created by PhpStorm.
 * User: Сергий
 * Date: 10.12.2018
 * Time: 13:50
 */

namespace app\controllers;


use app\core\Controller;
use app\core\View;
use app\models\Account;

class TaskController extends Controller
{
    private $userModel;
    public $task;

    public $description;

    public function __construct($route)
    {
        parent::__construct($route);
        $this->userModel = new Account();
    }
    public function addAction()
    {
        $postData = file_get_contents('php://input', true);
        $data = json_decode($postData, true);
        $this->description = htmlspecialchars($data['description']);
        if (!empty($data['userId'])) {
            $this->model->addTask(['description' => $this->description, 'is_done' => 'Ожидает', 'user_id' => $_SESSION['authorize']['id'], 'assigned_user_id' => $data['userId']]);
            View::message('success', $data);
        } else {
            $this->model->addTask(['description' => $this->description, 'is_done' => 'Ожидает', 'user_id' => $_SESSION['authorize']['id'], 'assigned_user_id' => $_SESSION['authorize']['id']]);
        }
        //$user =  $this->userModel->getUserById(['id' => $_SESSION['authorize']['id']]);

    }
    public function allAction()
    {
        $allTasks = $this->model->getAllTasks();
        View::message('success', $allTasks);
    }
    public function myAction()
    {
        $myTasks = $this->model->getMyTasks(['user_id' => $_SESSION['authorize']['id']]);
        View::message('success', $myTasks);
    }
    public function addedAction()
    {
        $addedTasks = $this->model->getAddedTasks(['author_id' => $_SESSION['authorize']['id']]);
        View::message('success', $addedTasks);
    }
    public function editAction()
    {
        $putData = file_get_contents('php://input', true);
        $data = json_decode($putData, true);
        $this->task = $this->model->getTask(['id' => $this->route['id']]);
        if (!empty($data['assigned_user_id'])) {
            $params = [
                'assigned_user_id' => $data['assigned_user_id'],
                'description' => $data['description'],
                'id' => $data['id']
            ];
            $this->isAuthor() ? $this->model->editTask($params) : View::errorCode(403);
        } else {
            $params = [
                'id' => $data['id'],
                'is_done' => $data['status']
            ];
            $this->isAssigned() ? $this->model->changeStatus($params) : View::errorCode(403);
        }
    }
    public function isAssigned()
    {
        if ($_SESSION['authorize']['id'] === $this->task['assigned_user_id']) {
            return true;
        }
        return false;
    }
    public function isAuthor()
    {
        if ($_SESSION['authorize']['id'] === $this->task['user_id']) {
            return true;
        }
        return false;
    }
    public function deleteAction()
    {
        $this->task = $this->model->getTask(['id' => $this->route['id']]);
        $this->isAuthor() ? $this->model->deleteTask(['id' => $this->route['id']]) : View::errorCode(403);
    }
}