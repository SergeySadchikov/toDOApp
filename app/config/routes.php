<?php

return [
    '' => [
        'controller' => 'main',
        'action' => 'index'
    ],
    'account/login'=> [
        'controller' => 'account',
        'action' => 'login'
    ],
    'account/register' => [
        'controller' => 'account',
        'action' => 'register'
    ],
    'account/logout' => [
        'controller' => 'account',
        'action' => 'logout'
    ],
    'account/users' => [
        'controller' => 'account',
        'action' => 'users'
    ],
    'account/user' => [
        'controller' => 'account',
        'action' => 'user'
    ],
    'account/confirm/{token:\w+}' => [
        'controller' => 'account',
        'action' => 'confirm'
    ],
    'task/add' => [
        'controller' => 'task',
        'action' => 'add'
    ],
    'task/all/{page:\d+}' => [
        'controller' => 'task',
        'action' => 'all'
    ],
    'task/my/{page:\d+}' => [
        'controller' => 'task',
        'action' => 'my'
    ],
    'task/added/{page:\d+}' => [
        'controller' => 'task',
        'action' => 'added'
    ],
    'task/edit/{id:\d+}' => [
        'controller' => 'task',
        'action' => 'edit'
    ],
    'task/delete/{id:\d+}' => [
        'controller' => 'task',
        'action' => 'delete'
    ]
];