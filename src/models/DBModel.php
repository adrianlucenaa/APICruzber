<?php

    namespace App\models;

    use PDO;

    class DBModel{
        protected static $tabla = 'dual';                        //esto va a definir modelo por modelo a que tabla se le va a pedir cada consulta
        
        public static function select(){
            $sql = "SELECT TOP 5 * FROM " . static::$tabla;     //query para hacer lo deseado con la base de datos
            return self::execute($sql);
        }

        public static function insert($codigoCliente, $nombre){
            
            $sql = "INSERT INTO " . static::$tabla . " (CodigoCliente, Nombre) VALUES (:CodigoCliente, :Nombre)"; //query para hacer lo deseado con la base de datos
            $params = [                                        //Parametros que va tener cliente
                'CodigoCliente' => $codigoCliente,
                'Nombre' => $nombre
            ];
            return self::execute($sql, $params);  
        }
        

        public static function delete($CC){

            $sql = "DELETE FROM " . static::$tabla . " WHERE CodigoCliente = :CodigoCliente"; //query para hacer lo deseado con la base de datos
            $params = [
                'CodigoCliente' => $CC                        //Parametros que va tener cliente
            ];
           return self::execute($sql, $params);               //Devuelvo la salida que me da el execute
        }

        public static function update($CC, $nombre){

            $sql = "UPDATE " . static::$tabla . " SET Nombre = :Nombre WHERE CodigoCliente = :CodigoCliente"; //query para hacer lo deseado con la base de datos
            $params = [
                'CodigoCliente' => $CC,                       //Parametros que va tener cliente
                'Nombre' => $nombre
            ];
            
            return self::execute($sql, $params);              //Devuelvo la salida que me da el execute
        }
        protected static function execute ($sql, $params = []) {
            
            $dbcnx = new PDO("sqlsrv:server=localhost;database=Cruzber", "logic", "Sage2009+");     //Conexion por pdo
            $dbcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                        //para sacar los errores y las excepciones                                                                      //var_dump para ver el resultado por pantalla
            $stm = $dbcnx->prepare($sql);                                                           //stmt = statement (consulta)
            $resultados = $stm->execute($params);

            if (stripos($sql, 'UPDATE') !== false || stripos($sql, 'INSERT') !== false) {   //validacion para saber si es una actualización o inserción
                return $result; // Si es una actualización o inserción, devolver el resultado de la ejecución directamente
            }

            $filas = [];                                                                            //array de filas
                while ($r = $stm->fetch(PDO::FETCH_ASSOC)) {                                        //while para recorrer las filas
                    $filas [] = $r;                                                                 //igualamos las filas a la variable r
                }
            return $filas;                                                                          //devolvemos las filass
        }
        
    }