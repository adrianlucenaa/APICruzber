<?php       

    namespace App\interfaces;

    use Psr\Http\Message\ResponseInterface as Response;

    interface InterfaceCliente{

        public static function getAll(Request $request, Response $response);

        public static function insert(Request $request, Response $response);

        public static function delete(Request $request, Response $response);

        public static function update(Request $request, Response $response);

    }      