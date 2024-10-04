<?php

require_once './libs/config.php';

class CarsModel{
    protected $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=".MYSQL_HOST .";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
        //$this->deploy();
    }

    public function getCars(){
        $query = $this->db->prepare('SELECT * FROM vehiculos');
        $query->execute();

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

    /*private function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql =<<<END
            END;
            $this->db->query($sql);
        }
    }*/
}