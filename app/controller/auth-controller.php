<?php

require_once './app/view/auth-view.php';
require_once './app/model/auth-model.php';

class AuthController{
    private $view;
    private $model;

    public function __construct()
    {
        $this->view = new AuthView();
        $this->model = new AuthModel();
    }
    public function showLogin(){
        $this->view->showLogin();
    }


    public function login(){
        if((!isset($_POST['username']) || empty($_POST['username'])) || (!isset($_POST['password']) || empty($_POST['password']))){
            $this->view->showError('Usuario y/o contraseña invalidos');
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->model->getUser($username);
        if($user && password_verify($password, $user->contrasenia)){
            session_start();
            $_SESSION['user'] = $user->usuario;
            $_SESSION['id'] = $user->id;
            $_SESSION['rol'] = 'admin';

            header('Location:' . BASE_URL);
        }else{
            $this->view->showLogin('Datos incorrectos');
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL);
    }

}