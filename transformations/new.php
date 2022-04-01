<?php
 require_once('../includes/initialize.php'); 
 include('./root.php'); 
?> 
<?php include('../layouts/header.php'); ?>

<div class="checked_answers">

<div class="instructions">
    <p>Please enter questions as follows:</p>
    <p>e.g: A sentence like: "I am constantly losing my keys" should be entered as follows:</p>
    <p>Beginning: I am constantly (lose)
    <p>Ending: my keys</p>
    <p>Answer: losing</p>
    <p>It will be presented like so: "I am constantly (lose) ...... my keys"; 
</div>

<form class="form" action="./create.php" method="post">
  <p class="form-control">
    <label>Beginning of the sentnece</label>
    <input type="text" name="question_start" value="" placeholder="" />
  </p>
  <p class="form-control">
    <label>Ending of the sentnece (leave blank if you do not need it)</label>
    <input type="text" name="question_end" value="" placeholder="" />
  </p>
  <p class="form-control">
    <label>Answer</label>
    <input type="text" name="answer" value="" placeholder=""/>
  </p>
  <p>
    <input class="button form-button" type="submit" name="submit" value="Create question" />
  </p>
</form>
<br/>
<a class="button link-button" href="../index.php">Back</a>

</div><!-- checked answers -->
</div><!-- container --> 
<?php include('../layouts/footer.php') ?>