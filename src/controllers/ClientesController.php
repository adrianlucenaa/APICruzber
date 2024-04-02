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
}
