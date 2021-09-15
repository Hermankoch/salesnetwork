<?php
require '../assets/php_library/phpmailer/src/Exception.php';
require '../assets/php_library/phpmailer/src/PHPMailer.php';
require '../assets/php_library/phpmailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//Address array('email@domain.com', 'Name Surname')
function sendEmail($addressArr, $subject, $msg, $attach) {
  $mail = new PHPMailer(true);
  try {
      $mail->isSMTP();
      //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->Host       = 'mail.webarena.co.za';
      $mail->SMTPAuth   = true;
      //info@SalesNetwork.co.za (Google);
      $mail->Username   = 'herman@webarena.co.za';
      $mail->Password   = 'K@pteinSkuim!1992';
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $mail->Port       = 465;

      //Recipients
      $mail->setFrom('herman@webarena.co.za', 'SalesNetwork');
      $mail->addReplyTo('noreply@webarena.co.za', 'No Reply');
      foreach ($addressArr as $email => $name) {
        $mail->addAddress($email, $name);
      }
      if(!empty($attach) && $attach !== null && $attach !== ''){
        $mail->addAttachment($attach);
      }
      //Content
      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body    = $msg;
      //$mail->AltBody = strip_tags($msg);
      $mail->send();
      return 'Message has been sent successfully';
  } catch (Exception $e) {
      return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

 ?>
