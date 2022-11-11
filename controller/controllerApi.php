<?php
require_once './model/modelApi.php';
require_once './view/viewApi.php';

class ControllerApi {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new modelApi();
        $this->view = new viewApi();
        
        
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getZapatilla($params = null){

        if (!empty($params[':order'])){
            $order = $params [':order'];
        if ($order =="desc"){
         $zapatilla = $this->model->getAll($order);
        }else if($order =="asc"){
         $zapatilla = $this->model->getAll($order);

        }
     }else {
            $zapatilla = $this->model->getAll();
        }
        $this->view->response($zapatilla,200);
    
    }

    public function getZapatillaId($params = null) {
        
        $id_zapatilla = $params[':ID'];
        $zapatilla = $this->model->getZapatillaId($id_zapatilla);
   
        if ($zapatilla)
            $this->view->response($zapatilla);
        else 
            $this->view->response(" id=$id_zapatilla No existe", 404);
    }

   

 public function homeFilter($params = null){
       $id =  $params[':Nombre'];
  
    $marca=$this->model->GetMarcaID($id);
    $zapatillasPorMarca=$this->model->getZapatillasPorMarca($marca);
   // $marcaElegida=$this->model->getMarcas();
    if ($id)
    $this->view->response($zapatillasPorMarca,200);
    else 
    $this->view->response(" id=$id No existe", 400);
}

    public function insertZapatilla ($params = null) {
        
        $zapatilla = $this->getData();
        
        if (empty($zapatilla->Modelo) || empty($zapatilla->Precio) || empty($zapatilla->Stock)) {
            $this->view->response("Ingrese los datos", 400);
        } else {
            $id =  $this->model->insertZapatilla ($zapatilla->Modelo, $zapatilla->Precio, $zapatilla->Stock,$zapatilla-> Descripcion);
            $zapatilla = $this->model->get($id);
            $this->view->response($zapatilla, 201);
        }
    }

}
