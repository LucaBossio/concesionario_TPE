<?php
class DistrubutorView{
    public $user = null;
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function listDistributors($distributors){
        require_once './templates/layout/header.phtml';
        require_once './templates/distributor-list.phtml';
        require_once './templates/layout/footer.phtml';
    }


    public function showFormDistributor($destiny, $distributor = null){
        require_once './templates/layout/header.phtml';
        require_once './templates/distributor-form.phtml';
        require_once './templates/layout/footer.phtml';
    }




    
}