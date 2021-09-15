<?php
require('db_conn.php');
require('password_functions.php');

if(isset($_POST['email']) && isset($_POST['password'])){
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE);
  $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
  if(!$email){
    header('Location: http://localhost/salesnetwork/index.php?error=Email is required');
  } else if(!$password){
    header('Location: http://localhost/salesnetwork/index.php?error=Password is required');
  } else {
    $query = 'SELECT * FROM users_tbl WHERE email = :email';
    $stmt = $conn->prepare($query);
    $stmt->bindvalue(':email',$email);
    $stmt->execute();
    $stmt->closeCursor();
    if($stmt->rowCount() === 1){
      $user = $stmt->fetch();
      $user_id = $user['id'];
      $user_email = $user['email'];
      $user_status = $user['status'];
      $user_type = $user['user_type'];
      $user_verify = $user['email_verified'];
      $user_password = pw_hash($user['password']);
      if(pw_verify($password, $user_password)){
        if($user_status === 'active'){
          session_start();
          $_SESSION['user_id'] = $user_id;
          $_SESSION['user_email'] = $user_email;
          $_SESSION['user_type'] = $user_type;
          header('Location: http://localhost/salesnetwork/dashboard');
        }else {
          header('Location: http://localhost/salesnetwork/index.php?error=Your Account has not been activated');
        }
      } else {
        header('Location: http://localhost/salesnetwork/index.php?error=Incorrect email or password');
      }
    }else {
      header('Location: http://localhost/salesnetwork/index.php?error=Incorrect email or password');
    }
  }

}
 ?>
