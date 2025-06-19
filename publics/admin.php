<?php

// đường dẫn có tham số controller và action
// nếu không có thì mặc định vào dashboard / index
$controllerName = $_GET['controller'] ?? 'admin';
$action = $_GET['action'] ?? 'index';

$controllerClass = $controllerName . 'Controller';
// echo "controller: $controllerClass";
require_once "../controllers/{$controllerClass}.php";
// require_once "./controllers/{$controllerClass}.php";
$controller = new $controllerClass();
$controller->$action();
?>