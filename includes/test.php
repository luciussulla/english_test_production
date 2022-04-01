<?php 
  require_once('../includes/initialize.php'); 

  class Test {
    public $id; 
    public $name;
    public $owner;
    public $exercises;


    function __construct($post_request) {
      variable_dump($post_request); 
      
    }

    function save() {

    }

  }

?>