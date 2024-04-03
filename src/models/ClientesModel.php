<?php

    namespace App\models;

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


        public static function delete($CC){
            
            $params = [
                'CC' => $CC                                                 //Parametros que va tener cliente en el metodo delete
            ];
            $resultados = parent::delete($CC);                              //guardo en la variable resultados, el delete echo en dbmodel
            var_dump($resultados);
        }
    }