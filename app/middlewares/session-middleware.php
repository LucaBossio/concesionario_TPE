<?php
    function sessionAuthMiddleware($res) {
        session_start();
        if(isset($_SESSION['id'])){
            $res->user = new stdClass();
            $res->user->id = $_SESSION['id'];
            $res->user->usuario = $_SESSION['user'];
            $res->user->rol = $_SESSION['rol'];
            return;
        }else if($res->user->rol == 'none'){
            
        }
        else{
            header('Location: ' . BASE_URL . 'log');
            die();

        }
    }
