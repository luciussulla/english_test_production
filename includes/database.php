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

    public function affected_rows() {
      return mysqli_affected_rows($this->connection); 
    }

    public function insert_id() {
      return mysqli_insert_id($this->connection); 
    }
    // INSTANTIATION AND INSTANCE OBJECTS

    public function has_attribute($attribute) {
      $class = get_class($this);
      return in_array($attribute, $class::$attributes);
    } 

    public function sanitized_attributes($request_params) {
      global $database;
      $obj_attributes = array();
      foreach($request_params as $attr=>$value) {
        if($this->has_attribute($attr)) {
          $obj_attributes[$attr] = trim($database->escape_value($value)); 
        }
      }
      return $obj_attributes; 
    }

    public function create($request_params) {
      // we save in object instance an assoc array of legitimate attr ans their values;
      foreach($this->sanitized_attributes($request_params) as $attr => $prop) {
        $this->$attr = $prop;
      }
    }

    public function save() {
      // we need to have - static::attributes 
      // we need also array of value properties than can be joined into a string => array_keys
    }
    
  }

  $database = new MySQLDatabase(); 
?>