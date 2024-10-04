<?php

class CarsView{
    public $user = null;
    public function __construct($user)
    {
        $this->user = $user;
    }
    public function showCars($cars){
        $count = count($cars);
        require_once './templates/add-car-form.phtml';
        require_once './templates/cars-list.phtml';
    }

    public function showError($error = null){
        require_once './templates/error.phtml';
    }

    public function showCar($car){
        require_once './templates/vehicle.phtml';
    }

    public function showEditCar($car){
        require_once './templates/edit-car-form.phtml';
    }
}