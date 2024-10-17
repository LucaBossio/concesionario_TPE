<?php

class CarsView{
    public $user = null;
    public function __construct($user)
    {
        $this->user = $user;
    }
    public function showCars($cars ,$distributors){
        $count = count($cars);
        require_once './templates/cars-list.phtml';
    }

    public function showError($error = null){
        require_once './templates/error.phtml';
    }

    public function showCar($car,$distributors){
        require_once './templates/vehicle.phtml';
    }

    public function showEditCar($car){
        require_once './templates/car-form.phtml';
    }

    public function showHome(){
        require_once './templates/home.phtml';
    }

    public function showCarForm($car,$destiny,$distributors){
        require_once './templates/car-form.phtml';
    }
}