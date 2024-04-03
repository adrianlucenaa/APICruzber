<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use  App\controllers\ClientesController;



$app = AppFactory::create();
$app->setBasePath('/PruebaAPI/public');


$app->addBodyParsingMiddleware();

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

//Llamada al  Metodo get que se traiga a todos los clientes
$app->get('/clientes', ClientesController::class . ':getAll'); //La ruta que va a tomar cuando llamemos a getAll

// Metodo post para insertar un nuevo cliente
$app ->post('/clientes/nuevo', ClientesController::class . ':post');

//Metodo para eliminar un cliente
$app->delete('/clientes/delete/{CC}', ClientesController::class . ':delete');

//Metodo para actualizar a un cliente
$app->put('/clientes/update/{CC}', ClientesController::class . ':update'); 

$app->run();