<?php

require_once './app/model/cars-model.php';
require_once './app/view/cars-view.php';
require_once './app/model/distributor-model.php';

class CarsController{

    private $model;
    private $view;

    public function __construct($res)
    {
        $this->model = new CarsModel();
        $this->view = new CarsView($res->user);
    }

    public function showCars($distributors){
        $cars = $this->model->getCars();

        if(!$cars){
            $this->view->showError("No existen vehiculos");
        }

        $this->view->showCars($cars,$distributors);
    }

    public function showCar($id, $distributors){
        $car = $this->model->getCarByID($id);

        if(!$car){
            $this->view->showError("No existe el vehiculo");
            return;
        }

        $this->view->showCar($car, $distributors);
    }

    public function showCarsDistributor($distributor_id,$distributors){
        $cars = $this->model->getCarsByDistributor('id_distribuidor', $distributor_id);

        if(!$cars){
            $this->view->showError("No existen vehiculos");
            return;
        }
        $this->view->showCars($cars,$distributors);
    }

    public function showCarForm($id = -1){
        if($id == -1){
            $destiny = 'add';
            $car = null;
        }
        else{
            $car = $this->model->getCarByID($id);
            $destiny = BASE_URL.'vehicles/update/'.$car->id;
        }
        $controllerDis = new DistributorModel();
        $distributors = $controllerDis->getDistributors();
        $this->view->showCarForm($car,$destiny,$distributors);
    }

    public function addCar(){
        if(!isset($_POST['brand']) || !isset($_POST['model']) || !isset($_POST['categories']) || !isset($_POST['year']) || !isset($_POST['doors']) || !isset($_POST['power']) || !isset($_POST['car-price']) || !isset($_POST['image'])){
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
        $idDis = $_POST['distributor'];
        $imagen = $_POST['image'];

        $this->model->addCar($marca,$modelo,$categoria,$anio,$puertas,$hp,$precio,$imagen,$idDis);
        
        header('Location:' . BASE_URL . 'vehicles/list');
    }

    public function deleteCar($id){
        $car = $this->model->getCarByID($id);

        if(!$car){
            $this->view->showError('No existe el vehiculo con id $id');
        }
        $this->model->deleteCar($id);
        header('Location:' . BASE_URL . 'vehicles/list');
    }

    public function updateCar($id){
        if(!isset($_POST['brand']) || !isset($_POST['model']) || !isset($_POST['categories']) || !isset($_POST['year']) || !isset($_POST['doors']) || !isset($_POST['power']) || !isset($_POST['car-price']) || !isset($_POST['image'])){
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
        $idDis = $_POST['distributor'];
        $imagen = $_POST['image'];

        $this->model->updateCar($marca,$modelo,$categoria,$anio,$puertas,$hp,$precio,$id,$idDis,$imagen);
        
        header('Location:' . BASE_URL . 'vehicles/list');
    }
    
    public function showError($error){
        $this->view->showError($error);
    }

    public function showHome(){
        $this->view->showHome();
    }
}