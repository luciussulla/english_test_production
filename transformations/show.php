<?php
 include('./root.php'); 
 require_once('../includes/initialize.php'); 
?> 
<?php include('../layouts/header.php');  ?>

<?php

if(isset($_GET["id"])) {
  $id = (int)$_GET["id"]; 
  $obj = Transformation::find_obj_by_id($id); 

  $html  = ""; 
  $html .= "<div class=\"checked_answers\" >"; 
  $html .= "<div class=\"show_question_answer\" >"; 
  $html .= "<p>Question: {$obj->question} </p>"; 
  $html .= "<p>Answer:   {$obj->answer}   </p>"; 
  $html .= "<a class=\"button link-button\" href=\"edit.php?id={$id}\"/>Edit</a>"; 
  $html .= "</div>";
  $html .= "</div>"; 
  echo $html;
 
} else {
  echo "Id not found"; 
}
?>

<?php include('../layouts/footer.php'); ?>