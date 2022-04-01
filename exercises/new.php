<?php
 require_once('../includes/initialize.php'); 
 include('./root.php'); 
?> 
<?php include('../layouts/header.php'); ?>
<?php 
  $all_transformations = Transformation::find_all(); 
  $exercise_types      = Exercise::$exercise_types; 
  // dump_variable($exercise_types); 
?>

<div class="box">
<div class="instructions">
    <p>Please pick the transformations for this exercise</p>
</div>

<form class="form" action="./create.php" method="post">
  <!-- this form should be a list of checkboxes with associated numbers of exercises 
  // list all exercises - preferably we only should list exercises of particular type like "transformasion" or "present simple" or "abcd" 
  // maybe even have subjects for particula exercises and list exercises for the subjects - subject could be read from the teacher's panel. 
  -->
  <?php 
  // here we output the transformations 
  // import the html from the index page of the previous app and adapt it to display checkbox form with the value of the exercises id
    $html=""; 
    $html .= "<select name=\"type\">";
    $html .= "<option value=\"\">--Please choose exercise type--</option>"; 
    foreach($exercise_types as $value) {
      $html .= "<option value=\"{$value}\">{$value}</option>"; 
    }
    $html .= "</select>"; 

    foreach($all_transformations as $key=>$value) {
      $html .= "<div class=\"question-item\">"; 
      $html .= "<input id=\"$key\" type=\"checkbox\" name=\"question_ids[]\" value=\"{$value["id"]}\" />"; 
      $html .= "<label for=\"{$key}\">{$value["question"]}</label>"; 
      $html .= "</div>"; 
    }
    echo $html; 
  ?>

  <p><input class="button form-button" type="submit" name="submit" value="Submit" /></p>
</form>
<br/>
<a class="button link-button" href="../index.php">Back</a>

</div><!-- box -->
</div><!-- container --> 
<?php include('../layouts/footer.php') ?>