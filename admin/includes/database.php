<?php
//ini_set("memory_limit","16M");
//require_once("config.php");
class Database{
    public $connection;

    function __construct() {
        $this->open_db_connection();
    }

    public function open_db_connection(){
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if($this->connection->error){
            die("Database Connection Failed Badly".$this->connection->error);
        }
    }

    public function query($sql){
        $result = $this->connection->query($sql);
        $this->confirm_query($result);
        return $result;
    }

    public function confirm_query($result){
        if(!$result){
            die("Query Failed");
        }
    }

    public function escape_string($string){
        
        $escape_string = $this->connection->real_escape_string($string);
        //ini_set("memory_limit","1024M");
        return $escape_string;
    }
    public function the_insert_id(){
        return mysqli_insert_id($this->connection);
    }
}//End Class Database

$database = new Database();
//$database->open_db_connection();


?>