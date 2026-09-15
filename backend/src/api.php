<?php
require_once __DIR__ . '/controllers.php';

$method = $_SERVER['REQUEST_METHOD'];

match ($method){
    'GET' => hendleGet(),
    'POST' => hendlePost(),
    'PUT' => hendlePut(),
    'PATCH' => hendlePach(),
    'DELETE' => hendleDelete(),
    'default' => hendleMethodAllowed(),
};  