<?php
function addEnt($companyName, $web, $social, $ps){
  global $conn;
  $qry = 'INSERT INTO entrepreneur_tbl (company_name, website_link, social_link, type_ps)';
  $qry .= ' VALUES (:company, :website_link, :social_link, :ps)';
  $stmt = $conn->prepare($qry);
  $stmt->bindValue(':company', $companyName);
  $stmt->bindValue(':website_link', $web);
  $stmt->bindValue(':social_link', $social);
  $stmt->bindValue(':ps', $ps);
  $last_id;
  $stmt->execute();
  if ($stmt->execute()) {
    $last_id = $conn->lastInsertId();
  } else {
    $last_id = false;
  }
  $stmt->closeCursor();
  return $last_id;
}

function addUser($name, $surname, $contact, $email, $password, $ea_flag, $ea_id){
  global $conn;
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
  if ($stmt->execute()) {
    $last_id = $conn->lastInsertId();
  } else {
    $last_id = false;
  }
  $stmt->closeCursor();
  return $last_id;
}
 ?>
