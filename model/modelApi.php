<?php
class modelApi {

private $db;

public function __construct() {
    $this->db = new PDO('mysql:host=localhost;'.'dbname=db_zapatilla;charset=utf8', 'root', '');
}

public function getAll($order=null) {
    if(!empty($order)){
             if( $order == "desc"){
            $query = $this->db->prepare("SELECT * FROM zapatilla
             JOIN marca ON zapatilla.id_marca=marca.id_marca  ORDER BY Precio desc");
               }else if($order=="asc"){
                      $query = $this->db->prepare("SELECT * FROM zapatilla
                     INNER JOIN marca ON zapatilla.id_marca=marca.id_marca ORDER BY Precio asc" );
                } 
            }else{
     $query = $this->db->prepare("SELECT * FROM zapatilla
    INNER JOIN marca ON zapatilla.id_marca=marca.id_marca");
                  }
     $query->execute();
     $zapatillas = $query->fetchAll(PDO::FETCH_OBJ); 
     return $zapatillas;
                }

    public function get($id) {
      $query = $this->db->prepare("SELECT * FROM zapatilla WHERE id_= ?");
      $query->execute([$id]);
      $zapatilla = $query->fetch(PDO::FETCH_OBJ);
                    
      return $zapatilla;
                }
            

public function getZapatillaId ($id_zapatilla) {
    $query = $this->db->prepare("SELECT * FROM zapatilla INNER JOIN marca ON zapatilla.id_marca=marca.id_marca WHERE id_=?");
    $query->execute(array($id_zapatilla));
    return $query->fetch(PDO::FETCH_OBJ);
 
}


public function insertZapatilla($modelo, $precio, $stock, $id_marca) {
  
    $query = $this->db->prepare("INSERT INTO zapatilla (Modelo, 
         Precio, Stock, id_marca) VALUES(?, ?, ?, ?)");
        return $query->execute(array($modelo,$precio,$stock, $id_marca));
           


}
function getMarcas(){
    $query = $this->db->prepare ('SELECT * FROM marca');
    $query->execute();
    $mar = $query->fetchAll(PDO::FETCH_OBJ);
    return $mar;
}
      


function GetMarcaID($id){
    $sentencia = $this->db->prepare("SELECT * FROM marca WHERE id_marca=?");
    $sentencia->execute(array($id));
    return $sentencia->fetch(PDO::FETCH_OBJ);
}

public  function getZapatillasPorMarca($id){
    $sentencia = $this->db->prepare("SELECT * FROM zapatilla INNER JOIN marca ON zapatilla.id_marca=marca.id_marca WHERE 
    zapatilla.id_marca=?");
    $sentencia->execute(array($id));
    return $sentencia->fetchAll(PDO::FETCH_OBJ);

}

}


