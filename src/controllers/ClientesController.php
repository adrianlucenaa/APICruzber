<?php 

namespace App\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use App\config\db;
use App\models\DBModel;
use App\models\ClientesModel;


class ClientesController {
    //Logica del metodo GetAll
    public function getAll(Request $request, Response $response) {
       ClientesModel::getAll();

       die();
    }

    public function post(Request $request, Response $response) {
       
        $data = $request->getParsedBody();
        $codigoCliente = $data['CodigoCliente'];
        $nombre = $data['Nombre'];

        ClientesModel::insert($codigoCliente, $nombre);

        die();
    }
   
    public function delete (Request $request, Response $response) {
        
        $data = $request->getParsedBody();
        $CC = isset($data['CodigoCliente']) ? $data['CodigoCliente'] : null;

        if ($CC !== null) {
            ClientesModel::delete($CC);
        } else {
            $response->withStatus(400);

            $response = $response->withHeader('Content-Type', 'application/json');
            $response->getBody()->write(json_encode(['error' => 'El campo CC no se encontró en los datos recibidos']));

        }

        die();
    }

}
