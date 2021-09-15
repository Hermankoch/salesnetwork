<?php
if(isset($_POST['submit'])){
  $file = $_FILES["fileToUpload"]["tmp_name"];
  $target_file = basename($_FILES["fileToUpload"]["name"]);
  //"application/zip", "application/x-zip", "application/x-zip-compressed"
  $arrayZips = array("application/pdf", "application/msword",
  "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
  "application/vnd.oasis.opendocument.text");

  $arrayExtensions = array(".odt", ".docx", ".dotx", ".pdf",".dot", ".doc");
  $original_extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $finfo = new finfo(FILEINFO_MIME);
  $type = $finfo->file($file);
  $errorArr = array();
  if (in_array($type, $arrayZips) && in_array($original_extension, $arrayExtensions)){
    //file is correct
  }else {
    $errorArr['filetype'] = 'File is not PDF or Word';
  }
  if ($_FILES["fileToUpload"]["size"] > 2100000) {
    $errorArr['filesize'] = 'File to large';
  }

  if(!empty($errorArr)){
    $url = "?";
    foreach ($errorArr as $key => $value) {
      $url .= $key ."=". $value);
    }
    header('Location: http://localhost/salesnetwork/entrepreneur.php'.$url.' is required');
  }
}
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
 </head>
 <body>
   <form class="" action="" method="post" enctype="multipart/form-data">
       <input type="file" name="fileToUpload" id="fileToUpload">
       <button type="submit" name="submit" value="submit">Submit</button>
   </form>
 </body>
 </html>
