<?php
require_once('email_function.php');
require_once('db_conn.php');
require_once('db_user_functions.php');
require_once('email_function.php');
require_once('password_functions.php');

if(isset($_POST['submit'])){
  $errorArr = array();
  $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
  $surname = filter_input(INPUT_POST, 'surname', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
  $contact = filter_input(INPUT_POST, 'contact', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE);
  $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
  $passwordVerify = filter_input(INPUT_POST, 'password-verify', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
  $province = filter_input(INPUT_POST, 'province', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
  $city = filter_input(INPUT_POST, 'city', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
  $companyName = filter_input(INPUT_POST, 'company-name', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
  $reg = filter_input(INPUT_POST, 'registered', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
  $web = filter_input(INPUT_POST, 'website', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
  $weblink;
  if(isset($_POST['websitelink'])){
    $weblink = filter_input(INPUT_POST, 'website', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
  } else {
    $weblink = 'No';
  }

  $social = filter_input(INPUT_POST, 'social', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
  $ps = filter_input(INPUT_POST, 'ps', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
  $description = filter_input(INPUT_POST, 'description', FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);

  if($passwordVerify !== $password){
    $errorArr['password'] = 'Passwords do not match';
  }
  $password = pw_hash($password);

  if(isset($_FILES["fileToUpload"])){
    $file = $_FILES["fileToUpload"]["tmp_name"];
    $target_file = basename($_FILES["fileToUpload"]["name"]);
    //"application/zip", "application/x-zip", "application/x-zip-compressed"
    $arrayZips = array("application/pdf", "application/msword",
    "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    "application/vnd.oasis.opendocument.text");

    $arrayExtensions = array("odt", "docx", "dotx", "pdf","dot", "doc");
    $original_extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $type = $finfo->file($file);

    if (in_array($type, $arrayZips) && in_array($original_extension, $arrayExtensions)){
      //file is correct
    }else {
      $errorArr['filetype'] = 'File is not PDF or Word';
    }
    if ($_FILES["fileToUpload"]["size"] > 2100000) {
      $errorArr['filesize'] = 'File too large';
    }
  }else {
    $errorArr['file'] = 'No file uploaded';
  }
  if(!empty($errorArr)){
    $url = "?";
    foreach ($errorArr as $key => $value) {
      $url .= $key ."=". $value ."&";
    }
    if(strrpos($url,"&") == strlen($url)-1){
      $url = substr($url, 0, strlen($url)-1);
    }
    header('Location: http://localhost/salesnetwork/entrepreneur.php'.$url."#signup");
  }else {
    //No errors
    $ent = addEnt($companyName, $weblink, $social, $ps);
    if($ent !== false){
      $ea_flag = 'ent_id';
      $ea_id = $ent;
      $user = addUser($name, $surname, $contact, $email, $password, $ea_flag, $ea_id);
      if($user !== false){
        $target_dir = '../uploads/documents/ent_id/'.$user.'/';
        $target_file = $target_dir . $target_file;

        if(file_exists($target_dir)){
          move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        }else {
          mkdir($target_dir);
          move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        }
        //customer
        $addressArr[$email] = $name.' '.$surname;
        $subject = 'SalesNetwork Registration';
        $msg = '<p>Dear, '.$name .' '.$surname.'</p><p>Your application has been recieved and we will contact you with further instructions</p>';
        $msg .= '<p>Please verify your email by clicking on this link: <a href="#">Verify Email</a></p>';
        $sent = sendEmail($addressArr, $subject, $msg, '');
        //representitives@sn
        $addressArr[$email] = $name.' '.$surname;
        $subject = 'New Entrepreneur Registration';
        $msg = '<p>A new entrepreneur has registered on the site.</p>';
        $msg .= '<p>Fullname: '.$name.' '.$surname.'</p>';
        $msg .= '<p>Contact: '.$contact.'</p>';
        $msg .= '<p>Email: '.$email.'</p>';
        $msg .= '<p>Products/Services: '.$ps.'</p>';
        $msg .= '<p>Company name: '.$companyName.'</p>';
        $msg .= '<p>Province: '.$province.'</p>';
        $msg .= '<p>City: '.$city.'</p>';
        $msg .= '<p>Website: '.$weblink.'</p>';
        $msg .= '<p>Social Media: '.$social.'</p>';
        $msg .= '<p>Please view the attached company certificate</p>';
        $attach = $target_file;
        $sent2 = sendEmail($addressArr, $subject, $msg, $attach);
        header('Location: http://localhost/salesnetwork/register.php');
      }else {
        //insert failed
        header('Location: http://localhost/salesnetwork/entrepreneur.php?error=User');
      }
    }else {
      //insert failed
      header('Location: http://localhost/salesnetwork/entrepreneur.php?error=ENT');
    }

  }
}



?>
