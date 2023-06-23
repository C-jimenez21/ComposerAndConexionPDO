<?php
    namespace App;
    class connect extends credentials{
        public $con;
        function __construct(private $dsn = "mysql", private $port =3306){
            parent::__construct(); //equivalente a Super en Js
            try {
                /**
                 * ? En este apartado se establece la conexion con la base de datos 
                 */
                $this->con=new \PDO( $this->dsn.":host=".$this->__get('host').";dbname=".$this->__get('dbname').";user=". $this->username.";password=".$this->__get('password').";port=". $this->port); //El "\" es para cosas que son 100% PHP apara que no las busque en el Composer    
                $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                print("Lograste entrar CV");
            } catch (\PDOException $e) {
                print_r($e->getMessage());
            }
        }
    }
?>

