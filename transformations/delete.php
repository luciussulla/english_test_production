<?php require_once('../includes/initialize.php') ?>
<?php
  if(isset($_GET["id"])) {
    echo "id provided"; 
    // find the right transformation
    $id = $_GET["id"]; 
    $transformation = Transformation::find_transformation_by_id($id); 
    var_dump($transformation); 
    if($transformation) {
      $transformation->delete($id); 
      redirect_to('index.php'); 
    } else {
      echo "No transformation with that id was found"; 
      // redirect_to('index.php');
    }
  } else {
    var_dump($transformation); 
    echo "No id provided"; 
    // redirect_to('index.php'); 
  }
?>