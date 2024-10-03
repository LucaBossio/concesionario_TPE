<?php

class CarsModel{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=concesionario;charset=utf8', 'root', '');
    }

    public function getCars(){
        $query = $this->db->prepare('SELECT * FROM vehiculos');
        $query->execute();

        $cars = $query->fetchAll(PDO::FETCH_OBJ);
        return $cars;
    }

    public function getCar($id){
        $query = $this->db->prepare('SELECT * FROM vehiculos WHERE id = ?');
        $query->execute([$id]);

        $car = $query->fetch(PDO::FETCH_OBJ);
        return $car;
    }

    public function addCar($marca,$modelo,$categoria,$anio,$puertas,$hp,$precio){
        $query = $this->db->prepare('INSERT INTO vehiculos( marca, modelo, año, puertas, hp, precio, id_distribuidor, categoria) VALUES (?,?,?,?,?,?,?,?)');
        $query->execute([$marca,$modelo,$anio,$puertas,$hp,$precio, 1 ,$categoria]);

        $id = $this->db->lastInsertId();
    
        return $id;

    }

    public function deleteCar($id){
        $query = $this->db->prepare('DELETE FROM vehiculos WHERE id = ?');
        $query->execute([$id]);


    }
}