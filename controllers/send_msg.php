<?php 
//$recieved=$_REQUEST['details'];
$recieved=split(":",$_REQUEST['details']); 

$ch = curl_init();
$user="gauravjadwani93@gmail.com:9044297421";
$receipientno=$recieved[0]; 
$senderID="TEST SMS"; 
$msgtxt="Thanks for registering on To-do ".$recieved[1]." regards:TEAM E-GURU"; 
curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&msgtxt=$msgtxt");
$buffer = curl_exec($ch);
if(empty ($buffer))
{ echo " buffer is empty "; }
else
{ echo $buffer; } 
curl_close($ch);
?>