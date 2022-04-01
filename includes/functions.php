<?php 

  function dump_variable($user_input) {
    echo '<pre>';
    var_dump($user_input);  
    echo '</pre>'; 
  }

  function redirect_to($new_location='') {
    header('Location: '.$new_location); 
    exit;
  }
  
  function generate_salt($length) {
    $unique_random_string = md5(uniqid(mt_rand(), true)); 
    $base64_string = base64_encode($unique_random_string); 
    $modified_base64_string = str_replace('+', '.', $base64_string);
    $salt = substr($modified_base64_string, 0, $length); 
    echo "\n Salt is: {$salt} \n";
    return $salt;  
  } 

  function password_encrypt($password){ 
    $hash_format = "$2y$10$"; 
    $salt_length = 22; 
    $salt = generate_salt($salt_length);
    // $salt = "Salt22CharactersOrMore";  
    $format_and_salt = $hash_format . $salt; 
    $hash = crypt($password, $format_and_salt); 
    return $hash; 
  }
  
  function password_check($password, $existing_hash) {
    $hash = crypt($password, $existing_hash); 
    if($hash === $existing_hash) {
      return true; 
    } else {
      return false;
    }
  }

  function attempt_login($password, $email) {
    $user = find_user($email); 
    if($user) {
      // echo "\n Teacher's name is: {$user['first_name']}"; 
      $db_password = $user["password"]; 
      // echo "\n db password is: {$db_password}"; 
      // echo "\n user provided password is: {$password}"; 
      $hash_provided_password = password_encrypt($password); 
      // echo "\n encrypted user provided pass is: {$hash_provided_password}";
      if(password_check($password, $db_password)) {
        // echo "\n password correct"; 
        return $user; 
      } else {
        return false; 
      }
    } else {
      return false; 
    }
  }
  
  function logged_in()  {
    return isset($_SESSION["user_id"]); 
  }

  function confirmed_logged_in($root="") {
    // global $root; 
    if(!logged_in()) {
      redirect_to($root.'login/login.php'); 
    } 
  }

 ?>  