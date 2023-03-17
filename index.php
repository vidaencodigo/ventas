<?php

/** Zona Horaria */
date_default_timezone_set('US/Central');

$path_controller = "app/";

if (!isset($_REQUEST['controller'])) {

    require_once $path_controller . "controller/index_controller.php";
    $controller = new IndexController();
    $controller->index();
} else {

    $controller = $_REQUEST['controller'];
    $action = $_REQUEST['action'];
    $file = $path_controller . "controller/" . $controller . "_controller.php";
    if (is_file($file)) {
        // verifica si el archivo controlador existe
        require_once $file;

        try {
            // comprueba que la accion este registrada
            $controller = ucwords($controller) . 'Controller';
            $controller = new $controller;
            call_user_func(array($controller, $action));
        } catch (\Throwable $th) {
            require_once $path_controller . "controller/error_controller.php";
            $controller = new ErrorController();
            $controller->index();
        }
    } else {
        require_once $path_controller . "controller/error_controller.php";
        $controller = new ErrorController();
        $controller->index();
    }
}
