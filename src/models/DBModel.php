<?php

    namespace App\models;

    use PDO;

    class DBModel{
        protected static $tabla = 'dual';                        //esto va a definir modelo por modelo a que tabla se le va a pedir cada consulta
        
        public static function select(){
            $sql = "SELECT TOP 5 * FROM " . static::$tabla;     //query para hacer lo deseado con la base de datos
            echo $sql;    
            return self::execute($sql);
        }

        public static function insert($codigoCliente, $nombre){
            
            $sql = "INSERT INTO " . static::$tabla . " (CodigoCliente, Nombre) VALUES (:CodigoCliente, :Nombre)"; //query para hacer lo deseado con la base de datos
            echo $sql;
            $params = [                                   //Parametros que va tener cliente
                'CodigoCliente' => $codigoCliente,
                'Nombre' => $nombre
            ];
            return self::execute($sql, $params);  
        }
        /*
        public static function delete($CC){

            $sql = "DELETE FROM " . static::$tabla . " WHERE CodigoCliente = :CC"; //query para hacer lo deseado con la base de datos
            echo $sql;
            $params = [ 
                'CC' => $CC
            ];                                  //Parametros que va tener cliente
            return self::execute($sql, $params);
        }
        */

        public static function delete($CC){

            $sql = "DELETE FROM " . static::$tabla . " WHERE CodigoCliente = :CC"; //query para hacer lo deseado con la base de datos
            echo $sql;
            $params = [
                'CC' => $CC
            ];
           return self::execute($sql, $params);
        }
        protected static function execute ($sql, $params = []) {
            
            $dbcnx = new PDO("sqlsrv:server=localhost;database=Cruzber", "logic", "Sage2009+");     //Conexion por pdo
            $dbcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                        //para sacar los errores y las excepciones
            var_dump($dbcnx);                                                                       //var_dump para ver el resultado por pantalla
            $stm = $dbcnx->prepare($sql);                                                           //stmt = statement (consulta)
            $resultados = $stm->execute($params);


            $filas = [];                                                                            //array de filas
                while ($r = $stm->fetch(PDO::FETCH_ASSOC)) {                                        //while para recorrer las filas
                    $filas [] = $r;                                                                 //igualamos las filas a la variable r
                }
            return $filas;                                                                          //devolvemos las filass
        }
        
    }