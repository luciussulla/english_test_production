<?php 
class Exercise extends DatabaseObject {
  
  public $id; 
  public $type; 
  public $question_ids; 
  public $questions; // these could be transformations, abcd exercises and other...  
  public static $table_name = "exercises"; 
  public static $exercise_types = array("transformations", "abcd");

  function __construct($user_input) {
    $this->parse_user_input($user_input); 
  }

  // INSTANTIATION SECTION *********** 
  private static function instantiate_exercise($exercise) {
    $exercise_instance = new Exercise($exercise); 
    $exercise_instance->id = $exercise["id"]; 
    
    // equip the exercise instance in an array of question instances
    $related_question_instances = Question::find_related_questions($exercise, false); 
    // $exercise_instance->questions = $related_question_instances; 
    return $exercise_instance;  
  }

  public static function find_all_instances() {
    // it is already implemented in the DB Object, we will 
    $all_exercises = parent::find_all(); 
    // we add the functionality of making instances of questions to the $questions instance variable 
    // extract question_ids from every exercise
    $exercises_array;  
    foreach($all_exercises as $exercise) {
      $exercises_array[] = self::instantiate_exercise($exercise);
    }
    return $exercises_array;  
  }

  // END INSTANTIATION SECTION *********** 
  private function parse_user_input($user_input) {
    $this->type = $user_input["type"]; 
    //$this->question_ids = implode(",", $user_input["question_ids"]); // this should be joined and put as string into the query
    $this->question_ids = json_encode($user_input["question_ids"]); 
  }   

  public function save() {
    global $database;
    $query = ""; 
    $query .= "INSERT INTO exercises ("; 
    $query .= "question_ids, type"; 
    $query .= ") VALUES (";
    $query .= "'{$this->question_ids}', '{$this->type}'"; 
    $query .= ")";  
    
    // echo $query; 
    $result = $database->query($query); 
    if($result) {
      $this->id = $database->insert_id(); 
      // BY THIS POINT THE OBJECT HASS ALL THE ATTRIBUTES EXCEPT QUESTIONS SO WE CAN ADD THEM: 
      // dump_variable($this); 
      $related_question_instances = Question::find_related_questions($this, true); 
      // echo "from teh exercise class"; 
      // dump_variable($related_question_instances); 
      $this->questions = $related_question_instances;  // makes sure your exercise has a $questions variable equipped with all associated questions; 
      return true; 
    } else {
      return false; 
    }
  }

  // private function instantiate_questions() {
  //   global $database; 
    
  //   $question_ids = json_decode($this->question_ids); 
  //   $question_ids_string = implode(",", $question_ids); 

  //   $query  = ""; 
  //   $query .= "SELECT * FROM ".$this->type;  
  //   $query .= " WHERE id IN (".$question_ids_string.")"; 
  //   echo $query; 

  //   $result = $database->query($query); 

  //   // iterate through all exercises and 
  //     // instantiate iteratively questions 
  //   // save the array of exercise instances as instance variable $questions
  // }
  
  // private function questions() {
  //   global $database; 

  //   // we select the questions for this exercise and store them in instance variable
  //   $question_ids = json_decode($this->question_ids); 
  //   $question_ids_string = implode(",", $question_ids); 

  //   $query  = ""; 
  //   $query .= "SELECT * FROM ".$this->type;  
  //   $query .= " WHERE id IN (".$question_ids_string.")"; 
  //   echo $query; 

  //   $result = $database->query($query); 

  //   // save the questions as instance variable; 
  //   // HERE WE NEED TO HAVE AN INSTANTIATION:
  //   while($row = $database->fetch_assoc($result)) {
  //     $this->questions[] = $row; 
  //   }
  // }

}
?>