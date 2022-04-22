<?php
//  include('./root.php'); 
 require_once('../includes/initialize.php'); 
?> 

<?php
  // check of logged in ... redirect accordingly 
?>

<?php 
  if(isset($_POST["submit"])) { // for POST request 
    $transformation   = new Transformation();
    $sanitized_params = $transformation->new($_POST); 
    if($transformation->save_sanitized($sanitized_params)) {
      echo $transformation->id; 
      //redirect_to("./new.php");
      echo "Transformation saved"; 
    } else {
      echo "Transformation has not been saved"; 
    }
    dump_variable($transformation); 
  } else { // For GET request
    echo "Get request where post expected"; 
  }
?>