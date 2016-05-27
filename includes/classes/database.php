<?php 

class Database{
    
//    public $connection;
//    
//    function __construct(){
//        $this->open_db_connection();
//    }
//    
//    public function open_db_connection(){
//        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
//        if($this->connection->connect_errno){
//            die("database connection failed" . $this->connection->connect_error);
//        }
//    }
//    
//    public function query($sql){
//        $result = $this->connection->query($sql);
//        if(!$result){
//            die("Query failed");
//        }
//        
//        return $result;
//    }
//    
//    private function confirm_query($result){
//        if(!$result){
//            die("Query failed");
//        }
//    }
//    
//    public function escape_string($string){
//        $escaped_string = $this->connection->real_escape_string($this->connection, $string);
//        
//        return $escaped_string;
//    }
//    
//    public function the_insert_id(){
//        return $this->connection->insert_id;
//    }
//    
//}
//
//$database = new Database();
}
?>