<?php
    

    namespace App\models;

    use GuzzleHttp\Client;
    use App\models\DBModel;
    
    class ClientesModel extends DBModel{        //heredamos de la clase DBModel para asi coger sus atributos y metodos

        static $tabla = 'Clientes';
        public static function getAll ($token){      //la funcion esta esta estatica para asi cuando la usemos noo tener que crear una nueva
            $url = 'https://localhost:8081/api/clientes/';

            $client = new \GuzzleHttp\Client(['verify' => false]);
            
            $resultados = self::select();      //guardo en la variable resultados, el select echo en dbmodel

            var_dump($resultados);             //para ver el resultado por pantalla
            
        }
       
        //Metodo para insertar un cliente
        public static function insert($CC, $nombre, $token){
            $url = 'https://localhost:8081/api/clientes/' . $CC . $nombre;              //Igualamos la variable url , con el enlace eal endpoint de mi api
        
            $client = new \GuzzleHttp\Client(['verify' => false]);
            try {
                $response = $client->request('POST', $url, [                            
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,                          //Formato del token de authorizacion
                        'Content-Type' => 'application/json',                           //le decimos que el contenido es json
                    ],
                    'json' => [                                                         //Le pasamos los datos que va tomar el json
                        $nombre => 'Nombre',
                        $CC => 'CodigoCliente',

                    ],
                ]);
        
                return $response->getBody()->getContents();
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                return $e->getMessage();
            }
        }
        
        
        // Método para eliminar un cliente en la API de C#
        public static function delete($CC, $token) {

            // URL de la API de C# donde se encuentra el endpoint para eliminar un cliente
            $url = 'https://localhost:8081/api/clientes/' . $CC;
                   
            // Configuración de la solicitud HTTP DELETE utilizando Guzzle HTTP Client
            $client = new \GuzzleHttp\Client(['verify' => false]);
        
            try {
                $response = $client->request('DELETE', $url, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token, //formato del token de autorización
                        'Content-Type' => 'application/json', //Indica que el contenido de la solicitud es JSON
                    ],
                ]);
        
                // Retornar la respuesta para manejarla en el controlador
                return $response->getBody()->getContents();
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                // Manejar errores de solicitud HTTP
                return $e->getMessage();
            }
        }
        
        //Metodo para actualizar un cliente
        public static function update($CC, $nombre,$token){
            $url = 'https://localhost:8081/api/clientes/' . $CC;                                //Igualamos la variable url , con el enlace eal endpoint de mi api

            $client = new \GuzzleHttp\Client(['verify' => false]);
            
            try {
                $response = $client->request('UPDATE', $url, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,                                  //formato del token de autorización
                        'Content-Type' => 'application/json',                                   //Indica que el contenido de la solicitud es JSON
                    ],
                    $params = [
                        'CodigoCliente' => $CC,                                                 //Parametros que va tener cliente en el metodo update
                        'Nombre' => $nombre
                    ],
                ]);
        
                                                                                                // Retornar la respuesta para manejarla en el controlador
                return $response->getBody()->getContents();
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                                                                                                // Manejar errores de solicitud HTTP
                return $e->getMessage();
            }
        }
        //Metodo para buscar un cliente por codigo cliente
        public static function getCC ($CC, $token){                                              //la funcion esta esta estatica para asi cuando la usemos noo tener que crear una nueva
            $url = 'https://localhost:8081/api/clientes/' . $CC;                                 //Igualamos la variable url , con el enlace el endpoint de mi api

            $client = new \GuzzleHttp\Client(['verify' => false]);           

            try {
                $response = $client->request('GETCC', $url, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,                                   //formato del token de autorización
                        'Content-Type' => 'application/json',
                    ],
                    $params = [
                        'CodigoCliente' => $CC,                                                  //Parametro que va tener cliente en el metodo get por CodigoCLiente
                    ],
                ]);
        
                return $response->getBody()->getContents();
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                return $e->getMessage();
            }
            
        }
    }