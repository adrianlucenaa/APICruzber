<?php 


namespace App\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;



class ClientesController {

    public function getAll(Request $request, Response $response) {
        $response -> getBody()->write("Eh entado al ModelCliente , desde mi controlador.");
        return $response;
    }
 /*
    public function getAll(Request $request, Response $response) {
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

    }
    */
} 


    
