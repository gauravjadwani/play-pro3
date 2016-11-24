<?php
//$recieved=split(":","gaurav.jadwani@hotmail.com:gaurav");
//$recieved=split(":",$_REQUEST['details']); 
ini_set('max_execution_time', 0);

require_once('../phpmailer/PHPMailerAutoload.php');
define('GUSER', 'demo.email.sender2016@gmail.com'); // GMail username
define('GPWD', 'dowhatyoulove'); // GMail password

function smtpmailer($to, $from, $from_name, $subject, $body) { 
 //$msg= "Thanks for registering on To-do ".$recieved[1]." regards:TEAM E-GURU";

// use wordwrap() if lines are longer than 70 characters
 //$msg = wordwrap($msg,70);

try{
// send email
 global $error;
  $mail = new PHPMailer();
//  $mail->SMTPDebug = 2;
  // $mail->Mailer = 'smtp';  // create a new object
  //print_r($mail);
  $mail->IsSMTP(); // enable SMTP
    // debugging: 1 = errors and messages, 2 = messages only
  $mail->Debugoutput = 'html';
  $mail->SMTPAuth = true;  // authentication enabled
  $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 465;
  $mail->Username = GUSER;  
  $mail->Password = GPWD;           
  $mail->SetFrom($from, $from_name);
  $mail->Subject = $subject;
  $mail->Body = $body;
  $mail->AddAddress($to);
  //echo "********************************************************************************";
  //print_r($mail);
  //echo "********************************************************************************";
  //print_r($mail->Send());
  //exit;
  if(!$mail->Send()) {
    $error = 'Mail error: '.$mail->ErrorInfo; 
    return false;
  } else {
    $error = 'Message sent!';
    return true;
  }
}
catch(Exception $e){
 // print_r($e);
}
}

smtpmailer($email,'demo.email.sender2016@gmail.com', 'Team E-guru ', 'WARM-WELCOME', "Thanks for registering on To-do ".$name." \nRegards: TEAM E-GURU\n");
if(isset($error)){
  //print_r($error);
}

?>