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

    public static function instantiate($obj, $db_result) {
      foreach($db_result as $key=>$value) {$obj->$key = $value;}
      return $obj;
    }

    public static function find_obj_by_id($id) {
      $class_name = get_called_class(); 
      $obj = new $class_name; 
      $db_result = self::find_by_id($id);
      $instance = self::instantiate($obj, $db_result); 
      return $instance;
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
    
    public function save_sanitized($sanitized_attributes) {
      // we need to have - static::attributes 
      $keys   = array_keys($sanitized_attributes); 
      $values = array_values($sanitized_attributes); 

      $db_field_names = join(", ", static::$attributes);

      $query = "INSERT INTO " . static::$table_name;
      $query .= " ({$db_field_names}) VALUES ('"; 
      $query .= join("', '", $values);   
      $query .= "')"; 

      if ($this->query($query)) {
        return true; 
      } else {
        return false;
      }  
    }
    
  }
?>