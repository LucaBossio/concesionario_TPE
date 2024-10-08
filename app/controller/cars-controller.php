<?php

require_once './app/model/cars-model.php';
require_once './app/view/cars-view.php';

class CarsController{

    private $model;
    private $view;

    public function __construct($res)
    {
        $this->model = new CarsModel();
        $this->view = new CarsView($res->user);
    }



    public function showCars(){
        $cars = $this->model->getCars();

        if(!$cars){
            $this->view->showError("No existen vehiculos");
        }

        $this->view->showCars($cars);
    }

    public function showCar($searchedCar){
        $params = explode("-", $searchedCar);
        $brand = $params[0];
        $model = $params[1];
        $year = $params[2];
        $car = $this->model->getCar($brand, $model, $year);

        if(!$car){
            $this->view->showError("No existe el vehiculo");
        }

        $this->view->showCar($car);
    }

    public function showCarsDistributor($distributor_id){
        $cars = $this->model->getCarsEspesificados('id_distribuidor', $distributor_id);

        if(!$cars){
            $this->view->showError("No existen vehiculos");
        }
        $this->view->showCars($cars);
    }

    public function addCar(){
        if(!isset($_POST['brand']) || !isset($_POST['model']) || !isset($_POST['categories']) || !isset($_POST['year']) || !isset($_POST['doors']) || !isset($_POST['power']) || !isset($_POST['car-price'])){
            $this->view->showError('Falta completar campos');
            return;
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
        $car = $this->model->getCarByID($id);

        if(!$car){
            $this->view->showError('No existe el vehiculo con id $id');
        }
        $this->model->deleteCar($id);
        header('Location:' . BASE_URL);
    }

    public function editCar($id){
        $car = $this->model->getCarByID($id);

        if(!$car){
            $this->view->showError('No existe el vehiculo con id $id');
        }

        $this->view->showEditCar($car);
    }

    public function updateCar($id){
        if(!isset($_POST['brand']) || !isset($_POST['model']) || !isset($_POST['categories']) || !isset($_POST['year']) || !isset($_POST['doors']) || !isset($_POST['power']) || !isset($_POST['car-price'])){
            $this->view->showError('Falta completar campos');
            return;
        }

        $marca = $_POST['brand'];
        $modelo = $_POST['model'];
        $categoria = $_POST['categories'];
        $anio = $_POST['year'];
        $puertas = $_POST['doors'];
        $hp = $_POST['power'];
        $precio = $_POST['car-price'];

        $this->model->updateCar($marca,$modelo,$categoria,$anio,$puertas,$hp,$precio,$id);
        
        header('Location:' . BASE_URL);
    }
    
    public function showError($error){
        $this->view->showError($error);
    }
}