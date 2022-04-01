<?php include('root.php') ?>

<ul class="navigation">
      <?php if (logged_in()) {
             echo '<li><a href="' . $root . 'login/logout.php">Logout</a></li>'; }
      else { echo '<li><a href="' . $root . 'login/login.php">Login</a></li>' ; } ?> 
      
      <?php echo '<li><a href="' . $root . 'index.php"> Home</a></li>' ?>
      <?php echo '<li><a href="' . $root . 'transformations/new.php">Add exercise</a></li>' ?>
      <?php echo '<li><a href="' . $root . 'transformations/index.php">Questions list</a></li>' ?>
</ul>