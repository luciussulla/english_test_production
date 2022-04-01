<?php 

class Question extends DatabaseObject {

  public static function instantiate_question($record, $object) {
    foreach($record as $attribute=>$value) {
      if($object->has_attribute($attribute)) { // the question objects need to inherit the queston class
        $object->$attribute = $value; 
      }
    }
    return $object;
  }

  public function has_attribute($attribute) {
    $obj_vars = get_object_vars($this); 
    return array_key_exists($attribute, $obj_vars) ? true : false; 
  }

  public static function find_related_questions($exercise, $from_save_function=false) {
    global $database; 
    
    if(!$from_save_function) { // this function is used both when we save a new exercise and when we query it in the db and then instantiate it and associated questions objects
      $exercise_type = $exercise["type"]; 
      $exercise_id   = $exercise["id"]; 
      $question_ids  = $exercise["question_ids"];

    } else {
      $exercise_type = $exercise->type; 
      $exercise_id   = $exercise->id; 
      $question_ids  = $exercise->question_ids; 
    }

    // validate we have the db table name
    if(!$exercise_type) {
      echo "exercise type not provided in 'find_related_questions()'"; 
      die(); 
    }

    // extract questions from db
    $question_ids = json_decode($question_ids); 
    $question_ids_string = implode(",", $question_ids);

    $query  = "SELECT * FROM {$exercise_type}"; 
    $query .= " WHERE id IN ($question_ids_string)"; 
    $result = $database->query($query); 

    // iteratively instantiate question objs
    $questions_array = array();

    while($record = $database->fetch_assoc($result)) {
      if($exercise_type == "transformations") {
        $object = new Transformation(); 
      }
      else if ($exercise_type = "abcd") {
        // $object = new Abcd(); 
      }  
      $questions_array[] = self::instantiate_question($record, $object); 
    }
    return $questions_array; 
  }
}

?>