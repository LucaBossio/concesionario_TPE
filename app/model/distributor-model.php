<?php
class DistributorModel{

    private $db;

    public function __construct(){
        $this->db= new PDO('mysql:host=localhost;dbname=concesionario;charset=utf8', 'root', '');
    }

    public function getDistributors(){
        $query = $this->db->prepare('SELECT * FROM `distribuidor`'); 
        $query->execute();
        $distributors = $query->fetchAll(PDO::FETCH_OBJ);
        return $distributors;
    }

    public function getDistributor($id){
        $query = $this->db->prepare('SELECT * FROM `distribuidor` WHERE id = ?'); 
        $query->execute($id);
        $distributors = $query->fetchAll(PDO::FETCH_OBJ);
        return $distributors;
    }


    public function setDistributor($nombre, $telefono, $empresa){
        $query=$this->db->prepare('INSERT INTO `distribuidor`(`nombre`, `telefono`, `empresa`) VALUES (?,?,?)');
        $query->execuet($nombre, $telefono, $empresa);
    }

    public function deleteDistributor(){
        $query = $this->db->prepare('DELETE FROM `distribuidor` WHERE id = ?'); 
        $query->execute($id);
    }

}