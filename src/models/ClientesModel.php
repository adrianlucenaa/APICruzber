<?php
    

    namespace App\models;

    use GuzzleHttp\Client;
    use App\models\DBModel;
    
    class ClientesModel extends DBModel{        //heredamos de la clase DBModel para asi coger sus atributos y metodos

        static $tabla = 'Clientes';
        public static function getAll (){      //la funcion esta esta estatica para asi cuando la usemos noo tener que crear una nueva
            
            $resultados = self::select();      //guardo en la variable resultados, el select echo en dbmodel

            var_dump($resultados);             //para ver el resultado por pantalla
        }

        public static function insert($codigoCliente, $nombre){
            
            $params = [                                                   //Parametros que va tener cliente en el metodo insert
                'CodigoCliente' => $codigoCliente,
                'Nombre' => $nombre
            ];
            $resultados = parent::insert($codigoCliente, $nombre);         //guardo en la variable resultados, el insert echo en dbmodel
            var_dump($resultados);                                         //para ver el resultado por pantalla de la variable resultados
        }

        /*
        public static function delete($CC){
            $params = [
                'CodigoCliente' => $CC                                                 //Parametros que va tener cliente en el metodo delete
            ];
            $resultados = parent::delete($CC);                              //guardo en la variable resultados, el delete echo en dbmodel
            var_dump($resultados);
        }
        */
        
        // Método para eliminar un cliente en la API de C#
        public static function delete($CC, $token) {

            // URL de la API de C# donde se encuentra el endpoint para eliminar un cliente
            $url = 'https://localhost:8081/api/clientes/' . $CC;
        
            

            // Configuración de la solicitud HTTP DELETE utilizando Guzzle HTTP Client
            $client = new \GuzzleHttp\Client(['verify' => false]);
        
            try {
                $response = $client->request('DELETE', $url, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token, // Corregido el formato del token de autorización
                        'Content-Type' => 'application/json', // Indica que el contenido de la solicitud es JSON
                    ],
                ]);
        
                // Retornar la respuesta para manejarla en el controlador
                return $response->getBody()->getContents();
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                // Manejar errores de solicitud HTTP
                return $e->getMessage();
            }
        }
        
            
        public static function update($CC, $nombre){
            $params = [
                'CodigoCliente' => $CC,                                                 //Parametros que va tener cliente en el metodo update
                'Nombre' => $nombre
            ];
            $resultados = parent::update($CC, $nombre);                              //guardo en la variable resultados, el update echo en dbmodel
            var_dump($resultados);
        }
    }