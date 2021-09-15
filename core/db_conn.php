<?php
//$dsn = 'mysql:host=localhost;dbname=db';
$dsn = 'mysql:host=localhost;dbname=salesnetwork_db';
$username = 'root';
$password = '';
try {
  $conn = new PDO($dsn,$username, $password);
} catch (PDOException $e) {
  
}

 ?>
