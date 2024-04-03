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
            echo "Entrando en el método insert de ClientesModel"; // Mensaje de depuración
            $params = [
                'CodigoCliente' => $codigoCliente,
                'Nombre' => $nombre
            ];
            $resultados = parent::insert($codigoCliente, $nombre);
            var_dump($resultados);
        }
    }