<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../config/db.php';

$app = AppFactory::create();
$app->setBasePath('/PruebaAPI/public');

// Metodo get que se traiga a todos los clientes
$app->get('/clientes', function (Request $request, Response $response) {
    $Sql = "SELECT TOP 5 * FROM Clientes";
    try {
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->query($Sql);
        if ($resultado->rowCount() == -1) {
            $clientes = $resultado->fetchAll(PDO::FETCH_OBJ);
            $response->getBody()->write((string)json_encode($clientes));
        } else {
            $response->getBody()->write((string)json_encode("Ha llegado al else"));
        }

    } catch (PDOException $e) {
        $response->getBody()->write((string)json_encode(['error' => $e->getMessage()]));
    }

    return $response->withHeader('Content-Type', 'application/json');
});
 /*
$app->get('/clientes', function (Request $request, Response $response) {
   
    $Sql = "SELECT TOP 1 * FROM Clientes";
    try {
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->query($Sql);
        if ($resultado->rowCount() > 0) {
            $clientes = $resultado->fetchAll(PDO::FETCH_OBJ);
            return $response->withJson($clientes);
        } else {
            return $response->withJson("No existen clientes en la base de datos");
        }
    } catch (PDOException $e) {
        return $response->withStatus(500)->withJson(['error' => $e->getMessage()]);
    }
    
});
*/
$app->run();