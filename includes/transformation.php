<?php

  class Transformation extends Question {
    protected static $table_name = "transformations";
     
    // attributes
    public $id; 
    public $question; 
    public $answer; 
    public $parts_of_sentence; 

    // find_all - inherited 
    public function new_transformation($request_params) {
      global $database; 
      $transformation    = new Transformation(); 
      $question_start    = trim($request_params["question_start"]); 
      $question_end      = trim($request_params["question_end"]); 

      $question = $question_start . "__" . $question_end; // "__" will serve as separator for two parts of the question.
      $answer   = trim($request_params["answer"]); 

      $transformation->question = $database->escape_value($question); 
      $transformation->answer   = $database->escape_value($answer);

      return $transformation; 
    }

    private static function parse_question_into_fragments($question) {
      $parts_of_transformation = preg_split("/__/", $question); 
      // $parts_of_transformation = array(); 
      // $part_1 = preg_split("/__/",$question)[0]; 
      // $part_2 = preg_split("/__/",$question)[1]; 
      // $parts_of_transformation[] = $part_1; 
      // $parts_of_transformation[] = $part_2; 
      return $parts_of_transformation; 
    }

    public static function find_transformation_by_id($id) {
      global $database; 
      $id = $database->escape_value($id); 

      $result = parent::find_by_id($id); 
      $transformation = new Transformation(); 
      $transformation->id       = $result['id']; 
      $transformation->question = $result['question']; 
      $transformation->answer   = $result['answer']; 
      $transformation->parts_of_sentence = self::parse_question_into_fragments($result['question']); 

      return $transformation; 
    }

    public function create(){   
      // this function is called on the instance returned by new_transformation function
      // that's why we can use the $this->question and answer syntax
      global $database;    
      $question = $this->question; 
      $answer   = $this->answer;   

      $sql =  "INSERT INTO ".static::$table_name." ("; 
      $sql .= "question, answer";
      $sql .= ") VALUES ("; 
      $sql .= "'{$question}', '{$answer}'"; 
      $sql .= ")"; 
      
      if($database->query($sql)) {
        $this->id = $database->insert_id(); 
        return true; 
      } else {
        return false; 
      }
    }  

    private function split_question($question_assoc) {
      // question extracted from db goes here
      // this is for outputting the question
      // split question uses the build_question function
      $question_from_db = $question_assoc["question"]; 
      $is_match = preg_match("/__/", $question_from_db); // quesion in db has __ where the user shuld privide his answer (blank space for user to insert answer)
      if ($is_match) {
        $array =  preg_split("/__/", $question_from_db);
        $question_with_input = build_question($array, $question_assoc["id"]); // the question is built and the input field is inserted instead of "__";
        return $question_with_input; 
      } else {
        // if no blank was inserted just the beginning of the question you get the question back
        // still need work here to return full question with input field
        return $question_from_db;  
      } 
    }
      
    private function build_question($array, $question_id) {
      $question_input = "<p>";
      $question_input .= $array[0]; 
      $question_input .= " <input type=\"text\" value=\"\" name=\"answer-{$question_id}\" /> "; 
      $question_input .= $array[1];
      $question_input .= "</p>";
      return $question_input; 
    }

    // update 
    public function update($_post) {
      global $database;
      $question_start = trim($_post["question_start"]); 
      $question_end   = trim($_post["question_end"]); 
      $answer         = trim($_post["answer"]); 

      $question_id    = $database->escape_value($_post["id"]); 
      $question_start = $database->escape_value($question_start); 
      $question_end   = $database->escape_value($question_end);  
      $question       = $question_start . "__" . $question_end; // "__" will serve as separator for two parts of the question.
      $answer         = $database->escape_value($answer);  

      $query  = "UPDATE transformations ";
      $query .= "SET question='{$question}', answer='{$answer}' ";
      $query .= "WHERE id={$question_id}"; 
      
      $result = $database->query($query);
      return ($database->affected_rows()>=0) ? $result : false; // If there are no changes in the update form the db will return 0, and -1 if there's an error
    } 

    // delete 
    public function delete() {
      global  $database; 
      $id   = $database->escape_value($this->id); 
      $sql  = "DELETE FROM ".self::$table_name; 
      $sql .= " WHERE id={$id}"; 
      $sql .= " LIMIT 1"; 
      $result = $database->query($sql); 
      return ($database->affected_rows==1) ? $result : false; 
    }

  }
?>