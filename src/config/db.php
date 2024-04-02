<?php
    class db{

        private $dbHost = 'localhost'; 
        private $dbName = 'Cruzber';
        private $dbUser = 'logic';
        private $dbPass = 'Sage2009+';
        
        
        //coneccion
        public function connectDB(){ 
            $dbConnecion = new PDO("sqlsrv:server=localhost;database=Cruzber", "logic", "Sage2009+");
            $dbConnecion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnecion;
        }

        
    }

    ?>