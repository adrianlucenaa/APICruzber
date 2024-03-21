<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

//Impotacion de Autoload
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/rutas/clientes.php';
require __DIR__ . '/../src/config/db.php';

 $app = AppFactory::create();
 /*$app->setBasePath('/PruebaAPI/public'); */

/*
 $app->get('/clientes', function (Request $request, Response $response) {
    $conn = new PDO("sqlsrv:server=localhost;database=Cruzber","logic","Sage2009+");
    $sql  = $conn->prepare("SELECT TOP 2 * FROM clientes");
    $sql->execute();
    $data = $sql->fetchAll(PDO::FETCH_ASSOC);
    $response->getBody()->write(json_encode($data));
    return $response;
});
*/

//Lanzamos la App
$app->run();