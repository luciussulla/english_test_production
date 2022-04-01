<?php 

  class Animal {
    
    public function id() {
      echo "The id is: " . $this->id; 
    }
    
  }

  class Cat extends Animal {
    public $id = "100"; 

    // public function id() {
    //   echo $this->id; 
    // }
  }

  $cat = new Cat(); 
  $cat->id(); 


?>