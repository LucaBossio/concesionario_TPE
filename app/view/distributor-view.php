<?php
class DistrubutorView{
    public $user = null;
    
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function listDistributors($distributors){
        require_once './templates/distributor-list.phtml';
    }


    public function showFormDistributor($destiny, $distributor = null){
        require_once './templates/distributor-form.phtml';
    }

    public function showError($error){
        require_once './templates/error.phtml';
    }




    
}