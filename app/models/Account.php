<?php
namespace app\models;
use app\core\Model;


class Account extends Model
{
    public function getUser($email)
    {
        $params =['email' => $email];
        $result = $this->db->row('SELECT * FROM user WHERE email = :email', $params);
        if (!empty($result)) {
            return $result[0];
        } else {
            return false;
        }
    }
    public function registerUser($login, $surname, $password, $email, $token)
    {
        $params = [
            'login' => $login,
            'surname' => $surname,
            'password' => $password,
            'email' => $email,
            'token' => $token,
            'status' => false
        ];
        $this->db->query('INSERT INTO user(login, surname, password, email, token, status) VALUES (:login, :surname, :password, :email, :token, :status)', $params);
        return $this->db->lastInsertId();
    }
    public function getUsers()
    {
        return $this->db->row('SELECT id, login, surname FROM user');
    }
    public function getUserById($id)
    {
        $params = ['id' => $id];
        $result = $this->db->row('SELECT * FROM user WHERE id = :id', $params);
        return $result[0];
    }
    public function createToken()
    {
        $token = bin2hex(random_bytes(30));
        return $token;
    }
    public function checkToken($token)
    {
        $params = ['token' => $token];
        return $this->db->column('SELECT id FROM user WHERE token = :token', $params);
    }
    public function activate($token)
    {
        $params = ['token' => $token];
        $this->db->query('UPDATE user SET status = 1 WHERE token = :token', $params);
    }
}