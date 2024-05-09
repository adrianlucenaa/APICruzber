<?php 

namespace App\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use App\config\db;
use App\models\DBModel;
use App\models\ClientesModel;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class ClientesController {

    //Metodo que se trae todos los clientes
    public function getAll(Request $request, Response $response) {
        $token = $request->getAttribute('token');                       //Indicamos que el metodo , va a tener un atributo en la cabecera que va a ser el token
       
        $client = new \GuzzleHttp\Client(['verify' => false]);         

        ClientesModel::getAll($token);                                  //Llamada al ClientesModel , getall con parametro token

        die();
    }        
    //Metodo para insertar un cliente
    public function insert(Request $request, Response $response){
        $token = $request->getAttribute('token');
        $data = request->getParsedBody();                               //Igualamos la variable $data, a los datos que parseamos en el body
        
        $CC = $data['CodigoCliente'];                                   //Le pasamos los parametros que va tomar el metodo
        $nombre = $data['Nombre'];

        $client = new \GuzzleHttp\Client(['verify' => false]);

        if($data !== null && isset($data['Nombre'])){
            ClientesModel::insert($CC, $nombre,$token);                 //Si se ha encontrado el CodigoCliente y el nombre en el body actualizamos el nombre, sino devolvemos el error
        } else {

            $response->withStatus(400);

            $response = $response->withHeader('Content-Type', 'application/json');
            $response->getBody()->write(json_encode(['error' => 'El campo Nombre o CodigoCliente no se encontró en los datos recibidos']));
        }

        die();
    }

    //Metodo para eliminar un cliente
    public function delete (Request $request, Response $response) {
        
        $token = $request->getAttribute('token');
        $data = $request->getParsedBody();                                          //Parseamos el body que lleva el delete y lo guardamos en data
        $CC = isset($data['CodigoCliente']) ? $data['CodigoCliente'] : null;        //Guardamos el CodigoCliente en $data, sino guardamos null
        
        $client = new \GuzzleHttp\Client(['verify' => false]);

        if ($CC !== null ) {
            
            ClientesModel::delete($CC, $token);                                    //Lamamos a clientemodel y dentro llamos a delete
            
        } else {                                                                   //Si no se ha encontrado el CodigoCliente en el body devolvemos el error
            $response->getBody()->write(json_encode(['error' => 'El campo CodigoCliente no se encontró en los datos recibidos']));
            $response->withStatus(400);
            $response = $response->withHeader('Content-Type', 'application/json');           
        }

        die();
    }


    //Metodo para actualizar un cliente por codigo cliente le actulizemos el nombre
    public function update(Request $request, Response $response) {

        $token = $request->getAttribute('token');
        $data = $request->getParsedBody();                          //Parseamos el body que lleva el put y lo guardamos en data
        $CC   = $request->getAttribute('CC');
        $StCC = (string)$CC;                                        //Guardamos el CodigoCliente y nombre en $data

        $nombre = $data['Nombre'];
        
        $client = new \GuzzleHttp\Client(['verify' => false]);      //Verificación del certificado SSL se desactiva


        if($CC !== null && isset($nombre['Nombre'])){
            ClientesModel::update($CC, $nombre,$token);            //Si se ha encontrado el CodigoCliente en el body actualizamos el nombre, sino devolvemos el error
        } else {
            $response->withStatus(400);
            $response = $response->withHeader('Content-Type', 'application/json');
            $response->getBody()->write(json_encode(['error' => 'El campo Nombre o el CodigoCliente no se encontró en los datos recibidos']));
        }

        die();
    }  

    //Metodo get por CodigoCliente
    public function getCC (Request $request, Response $response){
        $token = $request->getAttribute('token');                  //Indicamos que el metodo , va a tener un atributo en la cabecera que va a ser el token

        $client = new \GuzzleHttp\Client(['verify' => false]);     //Verificación del certificado SSL se desactiva

        if($CC !== null ){
            ClientesModel::getCC($CC,$token);                      //Si se ha encontrado el CodigoCliente en el body actualizamos el nombre, sino devolvemos el error
        } else {
            $response->withStatus(400);
            $response = $response->withHeader('Content-Type', 'application/json');
            $response->getBody()->write(json_encode(['error' => 'El campo CodigoCliente no se encontró en los datos recibidos']));
        }

        die();
    } 
}
