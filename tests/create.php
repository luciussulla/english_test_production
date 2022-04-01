<?php
 require_once('../includes/initialize.php'); 
?> 

<?php
  // check of logged in ... redirect accordingly 
?>

<?php 
  if(isset($_POST["submit"])) { // for POST request 

    $test = new Test($_POST); 

    if($test && $test->save()) {
      // Transformation saved
      // If we reload page the form will be resubmitted - we do not want this... so...we rredirect instead
      redirect_to("./new.php");
    } else {
      // failed
      // $message = "There was an error that prevented comment from being saved"; 
      echo "Create page, you were not redirected. Something has gone wrong"; 
    }
  } 

  else { // For GET request
    echo "Get request where post expected"; 
  }
?>