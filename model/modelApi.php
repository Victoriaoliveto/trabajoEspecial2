<?php
class modelApi {

private $db;

public function __construct() {
    $this->db = new PDO('mysql:host=localhost;'.'dbname=db_zapatilla;charset=utf8', 'root', '');
}

public function getAll($order, $sort) {
    $sort =strtolower($sort);
  $query = $this->db->prepare("SELECT * FROM zapatilla ORDER BY $sort $order");
$query->execute();
return $query->fetchAll(PDO::FETCH_OBJ);
}
   


public function getZapatillaId ($id_zapatilla) {
    $query = $this->db->prepare("SELECT * FROM zapatilla WHERE id_= $id_zapatilla");
    $query->execute();
    return $query->fetch(PDO::FETCH_OBJ);
}

public function insertZapatilla($modelo, $precio, $stock, $id_marca, $descripcion, $imagen) {
    $query = $this->db->prepare("INSERT INTO zapatilla (modelo, precio, stock, id_marca, descripcion, imagen) 
    VALUES (?, ?, ?, ?, ?, ?)");
    $query->execute(array($modelo, $precio, $stock, $id_marca, $descripcion, $imagen));
    $query->fetch(PDO::FETCH_OBJ);
    return $this->db->lastInsertId();
}



function getMarcas(){
    $query = $this->db->prepare ('SELECT * FROM marca');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
}

public  function getZapatillasPorMarca($id){
    $sentencia = $this->db->prepare("SELECT * FROM zapatilla WHERE id_marca=$id");
    $sentencia->execute();
    return $sentencia->fetchAll(PDO::FETCH_OBJ);

}

}


