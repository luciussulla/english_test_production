<?php include('root.php') ?>
<?php require_once('../includes/initialize.php') ?>

<?php 
  if(isset($_POST['submit'])) {
    echo "update form was submitted<br/>"; 

    // if(isset($_POST['question'])) {
    //   $question = escape_string($_POST['question']); 
    // } else {
    //   $question = ""; 
    // } 

    // if(isset($_POST['answer'])) {
    //   $answer = escape_string($_POST['answer']); 
    // } else {
    //   $answer = "";
    // } 
    
    // $question_start = escape_string($_POST["question_start"]); 
    // $question_end   = escape_string($_POST["question_end"]); 
    // $question_id    = $_POST["id"]; 
    // $question       = $question_start . "__" . $question_end; // "__" will serve as separator for two parts of the question.
    // $answer         = escape_string($_POST["answer"]);  

    // $query  = "UPDATE transformations ";
    // $query .= "SET question='{$question}', answer='{$answer}' ";
    // $query .= "WHERE id={$question_id}"; 

    // $result = mysqli_query($connection, $query); 

    $transformation = Transformation::find_transformation_by_id($_POST["id"]); 
    // var_dump($transformation); 
    $result = $transformation->update($_POST); 
    
    if($result) {
      echo "<p>Success</p>"; 
      // print_r($result); 
      // var_dump($result); 
      redirect_to('index.php'); 
    } else { 
      echo "<p>Fail</p>"; 
      // print_r($result); 
      // echo "<br/>"; 
      // var_dump($result); 
      die("Database query failed " . mysqli_error($database->connection)); 
    }

  } else {
    // probably a get request
    echo "not a post request"; 
    // redirect_to("edit.php"); 
  }
?>