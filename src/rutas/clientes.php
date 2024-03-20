<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../config/db.php';

 $app = AppFactory::create();

 //Metodo get que se traiga a todos los clientes
 $app->get('/clientes', function (Request $request, Response $response) {
    $Sql = "SELECT TOP * FROM Clientes";
    try{
        $db = new db();
        $db = $db->connectDB();
        $resultado = $db->query($Sql);
        if($resultado->rowCount() > 0){
            $clientes = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($clientes);
        }else{
            echo json_encode("No existen clientes en la base datos");
        }
    }catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

 $app->run();

