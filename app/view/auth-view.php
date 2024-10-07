<?php

class AuthView{
    private $user = null;

    public function showLogin($error = ''){
        require_once './templates/login-form.phtml';
    }

    public function showError($error){
        require_once './templates/error.phtml';
    }

}