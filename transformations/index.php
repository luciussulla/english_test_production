<?php 
  require_once('../includes/initialize.php');
  require('root.php');  
?>  
<?php include('../layouts/header.php');  ?>
<?php 
  $all_transformations = Transformation::find_all(); 
  // var_dump($all_transformations); 
  // foreach($all_transformations as $row): 
  //   print_r($row); 
  //   echo "<br/>"; 
  // endforeach; 
  $html = ""; 
  foreach($all_transformations as $question_assoc) {
      // print_r($question_assoc);
      // echo "<br/>"; 
      // echo "<p>". $question_assoc["id"] ."</p>"; 
      $html .= "<div class=\"question-edit\">";
      $html .= "<a href=\"edit.php?id={$question_assoc["id"]}\">  <i class=\"far fa-edit\">     </i></a>"; 
      $html .= "<a href=\"delete.php?id={$question_assoc["id"]}\"><i class=\"far fa-trash-alt\"></i></a>";
      $html .= $question_assoc["question"]; 
      
      $html .= "</div>"; 
  } 
  echo $html; 
?>

<?php include('../layouts/footer.php'); ?>