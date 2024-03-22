<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../config/db.php';

$app = AppFactory::create();
$app->setBasePath('/PruebaAPI/public');

// Metodo get que se traiga a todos los clientes
/*
$app->get('/clientes', function (Request $request, Response $response) {
    $Sql = "SELECT TOP 1 * FROM Clientes";
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
*/

// Metodo post para insertar un nuevo cliente
$app->post('/clientes/nuevo', function (Request $request, Response $response) {

    $contentType = $request->getHeaderLine('Content-Type');
    $data =        $request->getParsedBody();   

    $codigoCliente = $data['CodigoCliente'];
    $nombre        = $data['Nombre'];

    $sql = "INSERT INTO Clientes (CodigoCliente, Nombre) 
                        VALUES (:codigocliente, :nombre)";
    try {
        //Conexión a la base de datos
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->prepare($sql);

        //Igualo resultado a los datos
        $resultado->bindParam(':codigocliente', $codigoCliente);
        $resultado->bindParam(':nombre', $nombre);
        $resultado->execute();

        $responseBody = json_encode("Se insertó el cliente correctamente");
        $response->getBody()->write($responseBody);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    } catch(PDOException $e) {
        $errorResponse = json_encode(['error' => ['text' => $e->getMessage()]]);
        $response->getBody()->write($errorResponse);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
    } 
});


$app->run();