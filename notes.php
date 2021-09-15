<?php
$input = 'verify=true&id=1&email=this@this.com';
$result ='dmVyaWZ5PXRydWUmaWQ9MSZlbWFpbD10aGlzQHRoaXMuY29t';
$test = strtr(base64_encode($input), '+/=', '-_,');
echo $test;
$test = base64_decode(strtr($test, '-_,', '+/='));
echo '<br>'.$test;


 ?>
