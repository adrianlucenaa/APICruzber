<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use  App\controllers\ClientesController;

require __DIR__ . '/../config/db.php';


$app = AppFactory::create();
$app->setBasePath('/PruebaAPI/public');


$app->addBodyParsingMiddleware();

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Metodo get que se traiga a todos los clientes
$app->get('/clientes', ClientesController::class . ':getAll');
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


//Metodo para eliminar un cliente
$app-> delete('/clientes/delete/{CC}', function (Request $request, Response $response) {

    $CC = $request->getAttribute('CC');
    $StCC = (string)$CC;
    $sql = "DELETE FROM Clientes WHERE CodigoCliente = '$StCC'";

    try {
        //Conexión a la base de datos
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->prepare($sql);
        $resultado-> execute();

        if($resultado->rowCount() > 0) {
            $responseBody = json_encode("Se elimino el cliente correctamente");
            $response->getBody()->write($responseBody);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        } else {
            $responseBody = json_encode("No se elimino el cliente");
            $response->getBody()->write($responseBody);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }
    } catch(PDOException $e) {
        $errorResponse = json_encode(['error' => ['text' => $e->getMessage()]]);
        $response->getBody()->write($errorResponse);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});

//Metodo para actualizar a un cliente
$app->put('/clientes/update/{CC}', ClientesController::class . ':update'); 

/*
$app->put('/clientes/update/{CC}', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $CC   = $request->getAttribute('CC');
    $StCC = (string)$CC;

    $nombre = $data['Nombre'];

    echo "El nuevo nombre del cliente es: $nombre ";

    // Verificación de datos
    if ($data !== null && isset($data['Nombre'])) {
        $nombre = $data['Nombre'];

        // Resto del código de actualización de un cliente

        $sql = "UPDATE Clientes SET 
                Nombre = :nombre 
                WHERE CodigoCliente = '$StCC'";

        try {
            
            // Conexión a la base de datos
            $db = new db();
            $db = $db->connectDB();
            $resultado = $db->prepare($sql);

            // Igualo resultado a los datos
            $resultado->bindParam(':nombre', $nombre);
            
            $resultado->execute();

            $responseBody = json_encode("Se actualizó el cliente correctamente");
            $response->getBody()->write($responseBody);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        } catch (PDOException $e) {
            $errorResponse = json_encode(['error' => ['text' => $e->getMessage()]]);
            $response->getBody()->write($errorResponse);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }
    } else {
        $errorResponse = json_encode(['error' => 'El campo Nombre no se encontró en los datos recibidos']);
        $response->getBody()->write($errorResponse);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }
});
*/
$app->run();