<?php
require_once './libs/config.php';
require_once './libs/deploy.php';

class CarsModel{
    protected $db;

    public function __construct()
    {
        $deploy = new Deploy();
        $this->db = new PDO("mysql:host=".MYSQL_HOST .";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);

    }

    public function getCars($where=1){
        $query = $this->db->prepare('SELECT * FROM vehiculos WHERE ?');
        $query->execute([$where]);

        $cars = $query->fetchAll(PDO::FETCH_OBJ);
        return $cars;
    }

    public function getCarsEspesificados($field, $distributor_id){
        $query = $this->db->prepare("SELECT * FROM vehiculos WHERE $field = ?");
        $query->execute([$distributor_id]);
        $cars = $query->fetchAll(PDO::FETCH_OBJ);
        return $cars;
    }

    public function getCar($brand, $model, $year){
        $query = $this->db->prepare('SELECT * FROM vehiculos WHERE marca = ? && modelo = ? && año = ?');
        $query->execute([$brand, $model, $year]);

        $car = $query->fetch(PDO::FETCH_OBJ);
        return $car;
    }

    public function getCarByID($id){
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

    public function updateCar($marca,$modelo,$categoria,$anio,$puertas,$hp,$precio,$id){
        $query = $this->db->prepare("UPDATE vehiculos SET marca = ?, modelo = ?, precio = ?, año = ?, puertas = ?, hp = ?, categoria = ? WHERE id = ?");
        $query->execute([$marca,$modelo,$precio,$anio,$puertas,$hp,$categoria,$id]);
    }


}