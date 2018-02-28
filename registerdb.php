<?php

class Database{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dname = "afyadb";
    
    public function connect(){
        try{
            $conn_str = "mysql:host=$this->host; dbname=$this->dname";
            $conn = new PDO($conn_str, $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch(PDOException $err){
            $exception = array("code"=>500, "status"=>$err->getMessage());
            die($exception);
        }
    }
}
