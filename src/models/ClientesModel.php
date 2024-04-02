<?php

    namespace App\models;

    use App\models\DBModel;

    class ClientesModel extends DBModel{ //heredamos de la clase DBModel para asi coger sus atributos y metodos

        static $tabla = 'Clientes';
        static function getAll (){  //la funcion esta esta estatica para asi cuando la usemos noo tener que crear una nueva
            $sql = "SELECT TOP 1 * FROM static::$tabla.";
            $resultados = self::select();  //guardo en la variable resultado la ejecucion de la consulta

            var_dump($resultados); //para ver el resultado por pantalla
        }
    }