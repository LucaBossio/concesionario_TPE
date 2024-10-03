<?php
require_once './libs/response.php';
require_once './app/controller/cars-controller.php';
require_once './app/controller/auth-controller.php';
require_once './app/middlewares/session-middleware.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response();

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}else{
    $action = 'home';
}

$params = explode("/", $action);

switch($params[0]){
    case 'home':
        
        $controller = new CarsController();
        $controller->showCars();
    break;
    case 'vehicle':
        $controller = new CarsController();
        $controller->showCar($params[1]);
    break;
    case 'add':
        sessionAuthMiddleware($res);
        $controller = new CarsController();
        $controller->addCar();
    break;
    case 'delete':
        sessionAuthMiddleware($res);
        $controller = new CarsController();
        $controller->deleteCar($params[1]);
    break;
    case 'log':
        $controller = new AuthController();
        $controller->showLogin();
    break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
    break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();

    default:
        $controller = new CarsController();
        $controller->showError('Error 404');
    break;
}