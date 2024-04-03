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
            
            $sql = "INSERT INTO " . static::$tabla . " (CodigoCliente, Nombre) VALUES (:CodigoCliente, :Nombre)";
            echo $sql;
            $params = [
                'CodigoCliente' => $codigoCliente,
                'Nombre' => $nombre
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