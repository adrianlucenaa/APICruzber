<?php

namespace App\controllers;

class IndexController{

    public function index(Request $request, Response $response) {
        $response -> getBody()->write("Eh entrado al IndexController , desde mi controlador.");
        
        return $response;
    }
}