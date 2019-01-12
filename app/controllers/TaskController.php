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
use app\core\Pagination;

class TaskController extends Controller
{
    public $pagination;
    public $task;
    public $description;
    public $taskId;
    public $status;


    public function addAction()
    {
        $postData = file_get_contents('php://input', true);
        $data = json_decode($postData, true);
        $this->description = htmlspecialchars($data['description']);
        if (!empty($data['userId'])) {
            $this->model->addTask($this->description, 'Ожидает', $_SESSION['authorize']['id'], $data['userId']);
            View::message('success', $data);
        } else {
            $this->model->addTask($this->description, 'Ожидает', $_SESSION['authorize']['id'], $_SESSION['authorize']['id']);
        }
    }
    public function allAction()
    {
        $this->pagination = new Pagination($this->route, $this->model->getCount());
        $allTasks = $this->model->getTasks($this->pagination->offset, $this->pagination->limit);
        View::message('success', $allTasks, $this->pagination->pageCount);
    }
    public function myAction()
    {
        $this->pagination = new Pagination($this->route, $this->model->getCount(false, $_SESSION['authorize']['id']));
        $myTasks = $this->model->getTasks($this->pagination->offset, $this->pagination->limit, false, $_SESSION['authorize']['id']);
        View::message('success', $myTasks, $this->pagination->pageCount);
    }
    public function addedAction()
    {
        $this->pagination = new Pagination($this->route, $this->model->getCount($_SESSION['authorize']['id']));
        $addedTasks = $this->model->getTasks($this->pagination->offset, $this->pagination->limit, $_SESSION['authorize']['id']);
        View::message('success', $addedTasks, $this->pagination->pageCount);
    }
    public function editAction()
    {
        $putData = file_get_contents('php://input', true);
        $data = json_decode($putData, true);
        $this->taskId = $this->route['id'];
        $this->task = $this->model->getTask($this->taskId);
        if (!empty($data['assigned_user_id'])) {
            $this->description = trim(htmlspecialchars($data['description']));
            $this->isAuthor() ? $this->model->editTask($this->taskId, $data['assigned_user_id'], $this->description) : View::errorCode(403);
            $this->pagination = new Pagination($this->route, $this->model->getCount($_SESSION['authorize']['id']));
            View::message('success', 'Задание успешно отредактировано', $this->pagination->pageCount);
        } else {
            $this->status = trim(htmlspecialchars($data['status']));
            $this->isAssigned() ? $this->model->changeStatus($this->taskId, $this->status) : View::errorCode(403);
            $this->pagination = new Pagination($this->route, $this->model->getCount(false, $_SESSION['authorize']['id']));
            View::message('success', 'Статус изменён', $this->pagination->pageCount);
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
        $this->taskId = $this->route['id'];
        $this->task = $this->model->getTask($this->taskId);
        $this->isAuthor() ? $this->model->deleteTask($this->taskId) : View::errorCode(403);
        $this->pagination = new Pagination($this->route, $this->model->getCount($_SESSION['authorize']['id']));
        View::message('success', 'Задание успешно удалено', $this->pagination->pageCount);
    }
}