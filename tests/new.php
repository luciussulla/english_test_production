<?php
 require_once('../includes/initialize.php'); 
 include('./root.php'); 
?> 
<?php include('../layouts/header.php'); ?>

<div class="box">

<div class="instructions">
    <p>Please pick exercises for your test:</p>
</div>

<?php 
  // all exercises; 
  $all_exercises = Exercise::find_all_instances(); 
  // dump_variable($all_exercises); 
?>

<form class="form" action="./create.php" method="post">

  <?php 
   $exercises = ""; 
  //  foreach($all_exercises as $exercise) {
  //   $exercises .= "<div class=\"question_input\">"; 
  //   $exercises .= "<input type=\"checkbox\" id=\"" . $exercise["id"] . "\">"; 
  //   $exercises .= "<label for=\"". $exercise["id"]. "\">" . $exercise["type"]."</label>";
  //   $exercises .= "<ul>";

  //   foreach($exercise->questions as $key=>$value) {
  //     // $exercises .= "<li> {$question["question"]} </li>"; // iterate through that exercise and give me the exercise objects $exercise->questions; 
  //     print_r($key); 
  //     echo "<br/>"; 
  //     print_r($value); 
  //   }

  //   $exercises .= "</ul>"; 
  //   $exercises .= "</div>"; 
  //  }
   echo $exercises; 
  ?>

  <p>
    <input class="button form-button" type="submit" name="submit" value="Create question" />
  </p>

</form>
<br/>
<a class="button link-button" href="../index.php">Home</a>

</div><!-- box -->
</div><!-- container --> 
<?php include('../layouts/footer.php') ?>