<?php
// $controllerName = $_GET['controller'] ?? 'admin';
// $action = $_GET['action'] ?? 'index';
// $controllerClass = $controllerName . 'Controller';
// require_once "../controllers/{$controllerClass}.php";
// $controller = new $controllerClass();
// $controller->$action();

$controllerName = $_GET['controller'] ?? 'authentication';
$action = $_GET['action'] ?? 'login';

$controllerClass = $controllerName . 'Controller';
$controllerFile = "../controllers/{$controllerClass}.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    if (class_exists($controllerClass)) {
        $controller = new $controllerClass();

        if (method_exists($controller, $action)) {
            // Gọi hàm tương ứng
            $controller->$action();
        } else {
            echo "Không tìm thấy action: $action";
        }
    } else {
        echo "Không tìm thấy class: $controllerClass";
    }
} else {
    echo "Không tìm thấy file controller: $controllerFile";
}

?>