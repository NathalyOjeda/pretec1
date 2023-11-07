<?php

Class DB {
    //variables o atributos de la clase
    private $host;
    private $usuario;
    private $pass;
    private $base_de_datos;
    private $charset;
    private $port;
    
    public function __construct() {
//        $this->host = 'db_msi.cubeinside.com';
//        $this->base_de_datos = 'msi_ventas';
//        $this->usuario = 'msi_user_database';
//        $this->pass = 'K3rL%#DD9V34HpYE';
//        $this->charset = 'utf8mb4';  
//        $this->port = '52001';  
//        $this->host = '192.168.100.2';
        $this->host = 'localhost';
//        $this->base_de_datos = 'despensa_jireh';
        $this->base_de_datos = 'pretec';
        $this->usuario = 'root';
        $this->pass = '';
        $this->charset = 'utf8mb4';  
    }
    
    public function  conectar(){
       
        try{
////            
//            $connection = "mysql:host=" . $this->host .
//                    ";dbname=" . $this->base_de_datos . 
//                   ";port=".$this->port.";charset=" . $this->charset;
            $connection = "mysql:host=" . $this->host .
                    ";dbname=" . $this->base_de_datos . 
                    ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES=> false,
                PDO::ATTR_PERSISTENT => TRUE
            ];
           
            $pdo = new PDO($connection, $this->usuario, $this->pass,
                    $options);
//            echo "conectado";
            return $pdo;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }   
    }
    
}
