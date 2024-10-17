<?php
require_once './app/model/distributor-model.php';
require_once './app/view/distributor-view.php';

class DistrubutorController{
    private $view;
    private $model;

    public function __construct($res)
    {
        $this->view = new DistrubutorView($res->user);
        $this->model = new DistributorModel();
    }


    public function showDistributors(){

        $distributors = $this->getDistributors();

        if(!$distributors){
            $this->view->showError("No existen distribuidores");
        }

        $this->view->listDistributors($distributors);
    }

    public function addDistributor(){
        if(!isset($_POST['name']) || !isset($_POST['company']) || (!isset($_POST['phone']) || !isset($_POST['img']))){
            $this->view->showError('Falta completar campos');
            return;
        }
        $nombre = $_POST['name'];
        $empresa = $_POST['company'];
        $telefono = $_POST['phone'];
        $img = $_POST['img'];
        $this->model->setDistributor($nombre,$telefono,$empresa,$img);
        header('Location:' . BASE_URL.'distributors/list');
    }

    public function showformDistributor($id=-1){
        if($id == -1){
            $destiny ='add';
            $distributor = null;
        }else {
            $distributor = $this->model->getDistributorByID($id);
            $destiny= BASE_URL . 'distributors/update/'.$distributor->id;
        }

        $this->view->showFormDistributor($destiny, $distributor);

    }

    public function updateDistributor($id){
        if(!isset($_POST['name']) || !isset($_POST['company']) || (!isset($_POST['phone'])||!isset($_POST['img']))){
            $this->view->showError('Falta completar campos');
            return;
        }
        $nombre = $_POST['name'];
        $empresa = $_POST['company'];
        $telefono = $_POST['phone'];
        $img = $_POST['img'];
        $this->model->updateDistributor($nombre,$telefono,$empresa,$img,$id);
        header('Location:' . BASE_URL.'distributors/list');
    }

    public function deleteDistributor($id){
        $this->model->deleteDistributor($id);
        header('Location:' . BASE_URL.'distributors/list');
    }

    public function getDistributors(){

        $distributors = $this->model->getDistributors();

        if(!$distributors){
            $this->view->showError("No existen distribuidores");
            return;
        }
        return $distributors;
    }
}