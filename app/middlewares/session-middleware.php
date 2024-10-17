<?php
    function sessionAuthMiddleware($res, $protectedRoutes = []) {
        session_start();
        if(isset($_SESSION['id'])){
            $res->user = new stdClass();
            $res->user->id = $_SESSION['id'];
            $res->user->usuario = $_SESSION['user'];
            $res->user->rol = $_SESSION['rol'];
            return;
        }
        
        $currentAction = !empty($_GET['action']) ? explode("/", $_GET['action'])[1] : 'home';
    
        if (in_array($currentAction, $protectedRoutes) && $res->user->rol == 'none') {
            // Si la ruta es protegida y no hay sesión, redirigimos al login
            header('Location: ' . BASE_URL . 'log');
            die();
        }
        
    }
