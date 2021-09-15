lo<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//ALTER TABLE tablename AUTO_INCREMENT = 1
//ALTER TABLE `entrepreneur_tbl` AUTO_INCREMENT = 1;


$ea_flag = 'ent_id';
$ea_id = '1';
$name = 'test';
$surname = 'test';
$contact = '0810405434';
$email = 'brnhrmn@gmail.com';
$password = 'testpassword';

  require_once('db_conn.php');
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $qry = 'INSERT INTO users_tbl (name, surname, contact_num, email, password, ent_id, email_verified, user_type, status)';
  $qry .= ' VALUES (:name, :surname, :contact, :email, :password, :ea_id, 0, "entrepreneur", "inactive")';
  $stmt = $conn->prepare($qry);
  $stmt->bindValue(':name', $name);
  $stmt->bindValue(':surname', $surname);
  $stmt->bindValue(':contact', $contact);
  $stmt->bindValue(':email', $email);
  $stmt->bindValue(':password', $password);
  $stmt->bindValue(':ea_id', $ea_id);
  $last_id;

    if($stmt->execute()){
    echo 'true';
  }else {
    echo 'false';
    print_r($conn->errorInfo());
  }

  /*
  if ($stmt->execute()) {
   $last_id = $conn->lastInsertId();
   echo "New record created successfully. Last inserted ID is: " . $last_id;
  } else {
  $last_id = false;
  echo "poes";
  }
  $stmt->closeCursor();
  */
?>
