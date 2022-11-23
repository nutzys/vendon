<?php

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $stmt;
    private $error;
    private $dbh;

    public function __construct()
    {
        //PDO Connection
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass);
        }catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    //Prepare stmt
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    //Bind value to named param
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_INT;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    //Execute stmt
    public function execute(){
        $this->stmt->execute();
    }

    //Return single row
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //Return all rows
    public function all(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //Return row count
    public function getRows(){
        return $this->stmt->rowCount();
    }
}