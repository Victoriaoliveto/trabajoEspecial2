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

        $order = isset ($_GET['order'] )? $_GET['order'] : "DESC";    
        $sort = isset ($_GET['sort'] )? $_GET['sort'] :"id_";

        $zapatilla = $this->model->getAll($order, $sort);
        $this->view->response($zapatilla, 200);
    
    }

    public function getZapatillaId($params = null) {
        
        $id_zapatilla = $params[':ID'];
        $zapatilla = $this->model->getZapatillaId($id_zapatilla);
   
        if ($zapatilla != null)
            $this->view->response($zapatilla);
        else 
            $this->view->response(" id=$id_zapatilla No existe", 404);
    }

   

    function homeFilter($params = null){
       $id =  $params[':ID'];
  
    $zapatillasPorMarca=$this->model->getZapatillasPorMarca($id);
    if ($zapatillasPorMarca != null)
    $this->view->response($zapatillasPorMarca, 200);
    else 
    $this->view->response("id= $id No existe", 400);
}

    public function insertZapatilla($params = null) {
        
        $zapatilla = $this->getData();
        
        if (empty($zapatilla->modelo) || empty($zapatilla->precio) || empty($zapatilla->stock)
            || empty($zapatilla->id_marca) || empty($zapatilla->descripcion)) {

            $this->view->response("Ingrese los datos", 400);

        } else {
            $nuevaZapatilla = $this->model->insertZapatilla($zapatilla->modelo, $zapatilla->precio, $zapatilla->stock, $zapatilla->id_marca, 
            $zapatilla->descripcion, $zapatilla->imagen);
           $resul = $this->model-> getZapatillaId ($nuevaZapatilla);
            $this->view->response($resul, 201);
        }
    }

}
