<?php
return [
    // 定义test模块的自动生成
    'admin' => [
        '__dir__'    => ['controller', 'model', 'view'],
        'controller' => ['Add', 'Edit', 'List', 'Login'],
        'model'      => [],
        'view'       => ['index/index', 'add/add', 'edit/edit', 'list/list', 'login/login'],
    ],
];