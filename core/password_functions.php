<?php
function pw_hash($pw){
  return password_hash($pw, PASSWORD_DEFAULT);
}
function pw_verify($pw){
  if (password_verify($pw, $hash)) {
    return true;
  } else {
    return false;
  }
}
?>
