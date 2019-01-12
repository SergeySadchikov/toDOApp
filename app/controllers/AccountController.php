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
            $user = $this->model->getUser($this->email);
            if ($user && password_verify($this->password, $user['password'])) {
                if ($user['status']) {
                    $_SESSION['authorize']['id'] = $user['id'];
                    View::message('success', ['id' => $user['id'], 'login' => $user['login'], 'email' => $user['email']]);
                } else {View::message('error', 'Необходимо подтверждение аккаунта');}
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
            if (!$this->model->getUser($this->email)) {
                $token = $this->model->createToken();
                $this->model->registerUser($this->login, $this->surname, $this->password, $this->email, $token);
                //высылаем подтверждение
                $message = '<a href="https://to-do/account/confirm/'.$token.'">Кликните по данной ссылке чтобы подвердить аккаунт To-Do App</a>';
                $headers = 'Content-type: text/html; charset = UTF-8' . "\r\n";
                mail($this->email, 'Register To-Do App', $message, $headers);
                View::message('success', 'Необходимо подтвердить аккаунт');
            } else {
                View::message('error', 'Такой Пользователь уже существует');
            }
        } else {
            View::errorCode(404);
        }
    }
    public function confirmAction()
    {
        if ($this->model->checkToken($this->route['token'])) {
            $id = $this->model->checkToken($this->route['token']);
            $_SESSION['authorize']['id'] = $id;
            $this->model->activate($this->route['token']);
            View::redirect('/');
        } else {
            View::errorCode(404);
        }
    }
    public function logoutAction()
    {
        unset($_SESSION['authorize']['id']);
        View::redirect('/');
    }
    public function validate($string)
    {
        return trim(htmlspecialchars(stripslashes($string)));
    }
    public function usersAction()
    {
        $users = $this->model->getUsers();
        View::message('ok', $users);
    }
    public function userAction()
    {
        if(!$this->checkAcl()) return;
        $user = $this->model->getUserById($_SESSION['authorize']['id']);
        $data = ['id' => $user['id'], 'email' => $user['email']];
        View::message('success', $data);
    }

}

