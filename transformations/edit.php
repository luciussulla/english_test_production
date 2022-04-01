<?php include('root.php') ?>
<?php require_once('../includes/initialize.php'); ?>
<?php include('helpers.php')?>
<?php include($root . 'layouts/header.php'); ?>
<?php 
  // confirmed_logged_in($root);
  $id = (int)$_GET["id"]; 
  $transformation = Transformation::find_transformation_by_id($id);
?>
<div class="checked_answers">

  <form class="form" action="update.php" method="post">
    <input type="hidden" name="id" value="<?php echo $transformation->id ?>"/>
    <p class="form-control">
      <label>Beginning of the sentnece</label>
      <input class="question_input" type="text" name="question_start" value="<?php echo $transformation->parts_of_sentence[0] ?>" placeholder="" />
    </p>
    <p class="form-control">
      <label>Ending of the sentnece (leave blank if you do not need it)</label>
      <input class="question_input" type="text" name="question_end"   value="<?php echo $transformation->parts_of_sentence[1] ?>" placeholder="" />
    </p>
    <p class="form-control">
      <label>Answer</label>
      <input class="question_input" type="text" name="answer" value="<?php echo $transformation->answer ?>" placeholder=""/>
    </p>
    <p>
      <input class="button form-button" type="submit" name="submit" value="Update question" />
    </p>
  </form>
  <br/>
  <a class="button link-button" href="../../index.php">Back</a>

</div>  
<script src="javascript.js"></script>
<?php include($root . 'layouts/footer.php'); ?>