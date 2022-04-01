<?php
  // this is the second layer db object
  // it extends the MySQLDatabase object 
  // it has the universal functions which can be inherited by particular classes
  require_once('database.php');

  class DatabaseObject extends MySQLDatabase {
    
    public static function find_all() {
      global $database; 
      $sql = "SELECT * FROM ".static::$table_name; 
      $result_array = static::find_by_sql($sql); 
      return $result_array; 
    }

    public static function find_by_id($id) {
      $sql = "SELECT * FROM ".static::$table_name." WHERE id={$id}"; 
      $result_array = static::find_by_sql($sql); 
      $result = !empty($result_array) ? array_shift($result_array) : false; 
      return $result; 
    }
    
    public static function find_by_sql($sql) {
      global $database; 
      $result_set = $database->query($sql);
      $result_array = array(); 
      while($row = $database->fetch_assoc($result_set)) {
        $result_array[] = $row; 
      }
      return $result_array; 
    }
    
  }
?>