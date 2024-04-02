<?php

    namespace App\models;

    use PDO;

    class DBModel{
        protected static $tabla = 'dual';//esto va a definir modelo por modelo a que tabla se le va a pedir cada consulta
        protected static function select(){
            $sql = "SELECT TOP 1 * FROM static::$tabla.";
            $resultados = self::select();  //guardo en la variable resultado la ejecucion de la consulta
            return self::execute($sql);
        }
        protected static function execute ($sql){
            
            $dbcnx = new PDO("sqlsrv:server=localhost;database=Cruzber", "logic", "Sage2009+");
            $dbcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            var_dump($dbcnx);
            $stm = $dbcnx->prepare($sql);
            $resultados = $stm->execute();


            $filas = [];
                while ($r = $stm->fetch(PDO::FETCH_ASSOC)) {
                    $filas [] = $r;
                }
            return $filas;
        }
        
    }