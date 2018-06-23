<?php

class Database
{
    public $host = DB_HOST;
    public $user = DB_USER;
    public $pass = DB_PASS;
    public $dbname = DB_NAME;
    public $link;
    public $error;

    private static $_instance = null;
    private function __construct()
    {
        $this->link = new mysqli($this->host,$this->user, $this->pass,$this->dbname);
        if(!$this->link){
            $this->error = "Database error".$this->link->connect_error;
            return FALSE;
        }
    }
    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = new Database;
        }
        return self::$_instance;
    }
    private function __clone() {}
    // select - Read
    public function select($query){
        $result = $this->link->query($query) or die($this->link->error.__LINE__);
        if($result->num_rows > 0){
            return $result;
        }else{
            return FALSE;
        }
    }
    // insert
    public function insert($query){
        $insert = $this->link->query($query) or die($this->link->error.__LINE__);
        if($insert){
            return $insert;
        }else{
            return FALSE;
        }
    }
    // update
    public function update($query){
        $update = $this->link->query($query) or die($this->link->error.__LINE__);
        if($update){
            return $update;
        }else{
            return FALSE;
        }
    }
    // Delete
    public function delete($query){
        $delete = $this->link->query($query) or die($this->link->error.__LINE__);
        if($delete){
            return $delete;
        }else{
            return FALSE;
        }
    }
}

