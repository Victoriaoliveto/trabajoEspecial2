<?php
require_once './libs/Router.php';
require_once './controller/controllerApi.php';


$router = new Router();

$router->addRoute('zapatilla', 'GET', 'controllerApi', 'getZapatilla');
$router->addRoute('zapatilla/:ID', 'GET', 'controllerApi', 'getZapatillaId');
$router->addRoute('zapatilla', 'GET', 'controllerApi', 'homeFilter'); 
$router->addRoute('zapatilla', 'POST', 'controllerApi', 'insertZapatilla');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
