<?php
// To get your current working directory: getcwd() (documentation)
// To get the document root directory: $_SERVER['DOCUMENT_ROOT'] (documentation)
// To get the filename of the current script: $_SERVER['SCRIPT_FILENAME']
// echo $_SERVER['DOCUMENT_ROOT']; 

defined('DS')        ? null : define('DS',        DIRECTORY_SEPARATOR); 
defined('SITE_ROOT') ? null : define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS."one_test"); 
defined('LIB_PATH')  ? null : define('LIB_PATH',  SITE_ROOT.DS.'includes');
?>

<?php
  // require_once("./includes/config.php"); 
  // require_once("./includes/database.php");
  // require_once("./includes/database_object.php");
  require_once(LIB_PATH.DS."functions.php"); 
  require_once(LIB_PATH.DS."config.php"); 
  require_once(LIB_PATH.DS."database.php"); 
  require_once(LIB_PATH.DS."database_object.php");
  require_once(LIB_PATH.DS."question.php");  
  require_once(LIB_PATH.DS."transformation.php"); 
  require_once(LIB_PATH.DS."exercise.php");
  require_once(LIB_PATH.DS."test.php");  
  
?>