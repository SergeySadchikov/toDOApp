<?php
/**
 * Created by PhpStorm.
 * User: Сергий
 * Date: 10.11.2018
 * Time: 17:59
 */
namespace  app\controllers;
use app\core\Controller;
use app\core\View;

class AccountController extends Controller
{
    public $login;
    public $password;
    public $email;
    public $surname;

    public function loginAction()
    {
        $postData = file_get_contents('php://input', true);
        if ($postData) {
            $data = json_decode($postData, true);
            $this->email = $this->validate($data['email']);
            $this->password = $this->validate($data['password']);
            $user = $this->model->getUser(['email' => $this->email]);
            if ($user && password_verify($this->password, $user['password'])) {
                $_SESSION['authorize']['id'] = $user['id'];
                View::message('success', ['id' => $user['id'], 'login' => $user['login'], 'email' => $user['email']]);
            } else {
                View::message('error', 'Неверный логин и/или пароль');
            }
        } else {
            View::errorCode(404);
        }
    }

    public function registerAction()
    {
        $postData = file_get_contents('php://input', true);
        if ($postData) {
            $data = json_decode($postData, true);
            $this->login = $this->validate($data['name']);
            $this->surname = $this->validate($data['surname']);
            $this->email = $this->validate($data['email']);
            if ($data['password'] === $data['confirm']) {
                $this->password = password_hash($this->validate($data['password']), PASSWORD_DEFAULT);
            }
            if (!$this->model->getUser(['email' => $this->email])) {
               $token = $this->model->createToken();
                $params = [
                    'login' => $this->login,
                    'surname' => $this->surname,
                    'password' => $this->password,
                    'email' => $this->email,
                    'token' => $token,
                    'status' => false
                ];
                $id = $this->model->registerUser($params);
                //высылаем подтверждение
                mail($this->email, 'Register', 'Confirm:https://to-do/account/confirm/'.$token);
                $user = $this->model->getUserById(['id' => $id]);
                $_SESSION['authorize']['id'] = $user['id'];
                View::message('success', ['id' => $user['id'], 'login' => $user['login'], 'email' => $user['email']]);
            } else {
                View::message('error', 'Такой Пользователь уже существует');
            }
        } else {
            View::errorCode(404);
        }
    }
    public function confirmAction()
    {
        if (!$this->model->checkToken($this->route['token'])) {
            View::errorCode(404);
        }
        //$this->model->activate($this->route['token']);
        View::redirect('/');

    }
    public function logoutAction()
    {
        unset($_SESSION['authorize']['id']);
    }
    //Реализовать отдельные классы
    public function validate($string)
    {
        return trim(htmlspecialchars(stripslashes($string)));
    }
    public function usersAction()
    {
        $users = $this->model->getUsers();
        View::message('ok', $users);
    }
}

