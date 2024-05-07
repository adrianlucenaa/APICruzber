<?php 

namespace App\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use App\config\db;
use App\models\DBModel;
use App\models\ClientesModel;



class ClientesController {

    //Metodo que se trae todos los clientes
    public function getAll(Request $request, Response $response) {
       ClientesModel::getAll();

       die();
    }

    //Metodo para insertar un nuevo cliente
    public function insert(Request $request, Response $response) {
       //Pasamos el token por atributo
        $token = $request->getAttribute('token');
        $data = $request->getParsedBody();              //Parseamos el body que lleva el post y lo guardamos en data
        $CC = $data['CodigoCliente'];        //Guardamos el CodigoCliente y nombre en $data
        $nombre = $data['Nombre'];

        
        $client = new \GuzzleHttp\Client(['verify' => false]);
        
        //Llamada al  Metodo post para insertar un nuevo cliente
    
        $response = $client->request('POST', 'https://localhost:8081/api/clientes/nuevo', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token, // Corregido el formato del token de autorización
                'Content-Type' => 'application/json', // Indica que el contenido de la solicitud es JSON
            ]
        ]);
        
        //Si codigocliente y nombre no es nulo lo inserta
        if ($CC !== null && $nombre !== null ) {
            ClientesModel::insert($CC, $nombre);
        }else{
            $response->getBody()->write(json_encode(['error' => 'El campo CC o el nombre no se encontró en los datos recibidos']));
            $response->withStatus(400);
            $response = $response->withHeader('Content-Type', 'application/json');
        }

        die();
    }
    
    //Metodo para eliminar un cliente
    public function delete (Request $request, Response $response) {
        
        $token = $request->getAttribute('token');
        $data = $request->getParsedBody();              //Parseamos el body que lleva el delete y lo guardamos en data
        $CC = isset($data['CodigoCliente']) ? $data['CodigoCliente'] : null;  //Guardamos el CodigoCliente en $data, sino guardamos null
        
        $client = new \GuzzleHttp\Client(['verify' => false]);

        $response = $client->request('DELETE', 'https://localhost:8081/api/clientes/' . $CC, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token, // Corregido el formato del token de autorización
                'Content-Type' => 'application/json', // Indica que el contenido de la solicitud es JSON
            ]
        ]);

        if ($CC !== null ) {
            
            ClientesModel::delete($CC, $token);
            
        } else {                                          //Si no se ha encontrado el CodigoCliente en el body devolvemos el error
            $response->getBody()->write(json_encode(['error' => 'El campo CC no se encontró en los datos recibidos']));
            $response->withStatus(400);
            $response = $response->withHeader('Content-Type', 'application/json');
            

        }

        die();
    }


    //Metodo para actualizar un cliente por codigo cliente le actulizemos el nombre
    public function update(Request $request, Response $response) {

        $data = $request->getParsedBody();                  //Parseamos el body que lleva el put y lo guardamos en data
        $CC   = $request->getAttribute('CC');
        $StCC = (string)$CC;                                //Guardamos el CodigoCliente y nombre en $data

        $nombre = $data['Nombre'];
        

        if($data !== null && isset($data['Nombre'])){
            ClientesModel::update($CC, $nombre);            //Si se ha encontrado el CodigoCliente en el body actualizamos el nombre, sino devolvemos el error
        } else {

            $response->withStatus(400);

            $response = $response->withHeader('Content-Type', 'application/json');
            $response->getBody()->write(json_encode(['error' => 'El campo Nombre no se encontró en los datos recibidos']));
        }

        die();
    }
}
