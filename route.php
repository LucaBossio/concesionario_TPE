<?php
require_once './libs/response.php';
require_once './app/controller/cars-controller.php';
require_once './app/controller/auth-controller.php';
require_once './app/controller/distributor-controller.php';
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
        $controller->showHome();
    break;
    case 'vehicles':
        if($params[1]){
            switch($params[1]){
                case 'list':
                    sessionAuthMiddleware($res, $protectedRoutes);
                    $controller = new CarsController($res);
                    $controllerDis = new DistrubutorController($res);
                    $controller->showCars($controllerDis->getDistributors());
                    $controller->showCarForm();
                break;
                case 'vehicle':
                    if($params[2]){
                        sessionAuthMiddleware($res, $protectedRoutes);
                        $controller = new CarsController($res);
                        $controllerDis = new DistrubutorController($res);
                        $controller->showCar($params[2],$controllerDis->getDistributors());
                    }
                    else{
                        $controller = new CarsController($res);
                        $controller->showError('Id invalida');
                    }
                break;
                case 'add':
                    sessionAuthMiddleware($res, $protectedRoutes);
                    $controller = new CarsController($res);
                    $controller->addCar();
                break;
                case 'delete':
                    if($params[2]){
                        sessionAuthMiddleware($res, $protectedRoutes);
                        $controller = new CarsController($res);
                        $controller->deleteCar($params[2]);
                    }
                    else{
                        $controller = new CarsController($res);
                        $controller->showError('Id invalida');
                    }
                break;
                case 'edit':
                    if($params[2]){
                        sessionAuthMiddleware($res, $protectedRoutes);
                        $controller = new CarsController($res);
                        $controller->showCarForm($params[2]);
                    }
                    else{
                        $controller = new CarsController($res);
                        $controller->showError('Id invalida');
                    }
                break;
                case 'update':
                    if($params[2]){
                        sessionAuthMiddleware($res, $protectedRoutes);
                        $controller = new CarsController($res);
                        $controller->updateCar($params[2]);
                    }
                    else{
                        $controller = new CarsController($res);
                        $controller->showError('Id invalida');
                    }
                break;
                default:
                    sessionAuthMiddleware($res, $protectedRoutes);
                    $controller = new CarsController($res);
                    $controller->showError('Error 404');
                break;
            }
        }
        else{
            header('Location:' . BASE_URL . 'vehicles/list');
        }
    break;
    
    case 'distributors':
        if($params[1]){
            switch($params[1]){
                case 'list':
                    sessionAuthMiddleware($res, $protectedRoutes);
                    $controller = new DistrubutorController($res);
                    $controller->showDistributors();
                    $controller->showformDistributor();
                break;
                case'vehicles':
                    if($params[2]){
                        $controller = new CarsController($res);
                        $controllerDis = new DistrubutorController($res);
                        $controller->showCarsDistributor($params[2],$controllerDis->getDistributors());
                    }
                    else{
                        $controller = new CarsController($res);
                        $controller->showError('Id invalida');
                    }
                break;
                case'add':
                    sessionAuthMiddleware($res, $protectedRoutes);
                    $controller = new DistrubutorController($res);
                    $controller->addDistributor();
                break;
                case 'edit':
                    if($params[2]){
                        sessionAuthMiddleware($res, $protectedRoutes);
                        $controller = new DistrubutorController($res);
                        $controller->showformDistributor($params[2]);
                    }
                    else{
                        $controller = new CarsController($res);
                        $controller->showError('Id invalida');
                    }
                break;
                case 'update':
                    if($params[2]){
                        sessionAuthMiddleware($res, $protectedRoutes);
                        $controller = new DistrubutorController($res);
                        $controller->updateDistributor($params[2]);
                    }
                    else{
                        $controller = new CarsController($res);
                        $controller->showError('Id invalida');
                    }
                break;
                case 'delete':
                    if($params[2]){
                        sessionAuthMiddleware($res, $protectedRoutes);
                        $controller = new DistrubutorController($res);
                        $controller->deleteDistributor($params[2]);
                    }
                    else{
                        $controller = new CarsController($res);
                        $controller->showError('Id invalida');
                    }
                break;
                default:
                    sessionAuthMiddleware($res, $protectedRoutes);
                    $controller = new CarsController($res);
                    $controller->showError('Error 404');
                break;
            }
        }
        else{
            header('Location:' . BASE_URL . 'distributors/list');
        }
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
        sessionAuthMiddleware($res, $protectedRoutes);
        $controller = new CarsController($res);
        $controller->showError('Error 404');
    break;
}