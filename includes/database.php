<?php
  // This class gives the possibility to do a query 
  // as well as the option to get the mysqli_fetch_assoc to get the result 
  // at the end of the file the instance od db is returned..
  // instances can acces $connection object

  require_once('config.php'); 

  class MySQLDatabase {
    public $connection; 

    public function __construct() {
      $this->open_connection(); 
    }
    
    public function open_connection() {
      $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME); 
      if(!$this->connection) {
        // die("Database connection failed: ".mysqli_connect_error()
        die("Database connection failed: " . 
          mysqli_connect_error() . " (" .
          mysqli_connect_errno() . ")"
        ); 
      // ); 
      } else {
        echo "Db connection established"; 
      }
    }
    
    public function close_connection() {
      if(isset($this->connection)) {
        mysqli_close($this->connection); 
        unset($this->connection); 
      }
    }

    public function query($query) {
      $result = mysqli_query($this->connection, $query); 
      if(!$result) {
        die("Query failed ". mysqli_error($this->connection)); 
      }
      return $result; 
    }

    public function fetch_array($result) {
      return mysqli_fetch_array($result); 
    }

    public function fetch_assoc($result) {
      return mysqli_fetch_assoc($result); 
    }

    public function escape_value($string) {
      return mysqli_real_escape_string($this->connection, $string); 
    } 
    
    public function escape_and_trim($request_params, $object_instance) {
      variable_dump($request_params); 
      // get the class variables 
      // make sure the param values correspond with the attributes if so.. trim them and escape the values 
      // return a cleaned params_object
      
    }



    public function affected_rows() {
      return mysqli_affected_rows($this->connection); 
    }

    public function insert_id() {
      return mysqli_insert_id($this->connection); 
    }
  }

  $database = new MySQLDatabase(); 
?>