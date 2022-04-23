<?php
//  include('./root.php'); 
 require_once('../includes/initialize.php'); 
?> 

<?php
echo "<p>Hello</p>"; 

if(isset($_GET["id"])) {
  $id = $_GET["id"]; 
  echo "id is " . $id; 
  echo "**************"; 
  $obj = Transformation::find_obj_by_id($id); 

  dump_variable($obj); 
} else {
  echo "Id not found"; 
}

?>

<?php

?>