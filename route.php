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

$protectedRoutes = ['add', 'delete','update','edit'];

$params = explode("/", $action);
switch($params[0]){
    case 'home':
        sessionAuthMiddleware($res, $protectedRoutes);
        $controller = new CarsController($res);
        $controller->showCars();
    break;
    case 'vehicle':
        sessionAuthMiddleware($res, $protectedRoutes);
        $controller = new CarsController($res);
        $controller->showCar($params[1]);
    break;
    case 'add':
        sessionAuthMiddleware($res, $protectedRoutes);
        $controller = new CarsController($res);
        $controller->addCar();
    break;
    case 'delete':
        sessionAuthMiddleware($res, $protectedRoutes);
        $controller = new CarsController($res);
        $controller->deleteCar($params[1]);
    break;
    case 'edit':
        sessionAuthMiddleware($res, $protectedRoutes);
        $controller = new CarsController($res);
        $controller->editCar($params[1]);
    break;
    case 'update':
        sessionAuthMiddleware($res, $protectedRoutes);
        $controller = new CarsController($res);
        $controller->updateCar($params[1]);
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
    break;
    default:
        $controller = new CarsController($res);
        $controller->showError('Error 404');
    break;
}