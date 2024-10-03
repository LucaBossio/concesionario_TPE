<?php
    function sessionAuthMiddleware($res) {
        session_start();
        if(isset($_SESSION['user'])){
            $res->user = new stdClass();
            $res->user->usuario = $_SESSION['user'];
            return;
        }else{
            header('Location: ' . BASE_URL . 'log');
            die();

        }
    }
