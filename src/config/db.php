<?php
/*
    class db{

        private $dbHost = 'localhost'; 
        private $dbName = 'Cruzber';
        private $dbUser = 'logic';
        private $dbPass = 'Sage2009+';

        public function connectDB(){
        try {
            $dbConnecion = new PDO("sqlsrv:server=$this->dbHost;database=$this->dbName", $this->dbUser, $this->dbPass);

            echo ("Se conecta a la base de datos");
            
        }
        catch (PDOException $e) {
            echo ("No se conecta a la base de datos");
            }
        }
    }   
*/
    class db{

        private $dbHost = 'localhost'; 
        private $dbName = 'Cruzber';
        private $dbUser = 'logic';
        private $dbPass = 'Sage2009+';
        
        
        //coneccion
        public function connectDB(){
           // $dbConnecion = new PDO("sqlsrv:server=$this->dbHost;database=$this->dbName", $this->dbUser, $this->dbPass); 
            $dbConnecion = new PDO("sqlsrv:server=localhost;database=Cruzber", "logic", "Sage2009+");
            $dbConnecion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnecion;
        }
    }

    ?>