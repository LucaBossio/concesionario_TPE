<?php

require_once './app/model/cars-model.php';
require_once './app/view/cars-view.php';

class CarsController{

    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new CarsModel();
        $this->view = new CarsView();
    }

    public function showCars(){
        $cars = $this->model->getCars();

        if(!$cars){
            $this->view->showError("No existen vehiculos");
        }

        $this->view->showCars($cars);
    }

    public function showCar($id){
        $car = $this->model->getCar($id);

        if(!$car){
            $this->view->showError("No existe el vehiculo");
        }

        $this->view->showCar($car);
    }

    public function addCar(){
        if(!isset($_POST['brand'])){
            $this->view->showError('Falta completar campos');
        }

        $marca = $_POST['brand'];
        $modelo = $_POST['model'];
        $categoria = $_POST['categories'];
        $anio = $_POST['year'];
        $puertas = $_POST['doors'];
        $hp = $_POST['power'];
        $precio = $_POST['car-price'];

        $this->model->addCar($marca,$modelo,$categoria,$anio,$puertas,$hp,$precio);
        
        header('Location:' . BASE_URL);
    }

    public function deleteCar($id){
        $car = $this->model->getCar($id);

        if(!$car){
            $this->view->showError('No existe el vehiculo con id $id');
        }
        $this->model->deleteCar($id);
        header('Location:' . BASE_URL);
    }
    
    public function showError($error){
        $this->view->showError($error);
    }
}