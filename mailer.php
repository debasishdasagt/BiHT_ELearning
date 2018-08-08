<?php
error_reporting(E_ALL);
require("PHPMailer_5.2.4/class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP(); // set mailer to use SMTP
<<<<<<< HEAD
$mail->SMTPDebug  = 2;
=======
$mail->SMTPDebug  = 0;
>>>>>>> 9b45a4fdc2fd351655fac22e35cd7f306b673354
$mail->From = "admin@biht.in";
$mail->FromName = "BiHT Administrator";
$mail->Host = "server188.microhost.com"; // specif smtp server
$mail->SMTPSecure= "ssl"; // Used instead of TLS when only POP mail is selected
$mail->Port = 465; // Used instead of 587 when only POP mail is selected
$mail->SMTPAuth = true;
$mail->Username = "admin@biht.in"; // SMTP username
$mail->Password = "biht@2012"; // SMTP password
<<<<<<< HEAD
//$mail->AddAddress("debasishdas.agt@gmail.com","Debasish"); //replace myname and mypassword to yours
//$mail->AddReplyTo("debasishdas.trp@gmail.com", "Debasish the Admin");
=======
$mail->AddAddress("debasishdas.agt@gmail.com", "Debasish"); //replace myname and mypassword to yours
$mail->AddReplyTo("debasishdas.trp@gmail.com", "Debasish the Admin");
>>>>>>> 9b45a4fdc2fd351655fac22e35cd7f306b673354
$mail->WordWrap = 50; // set word wrap
//$mail->AddAttachment("c:\\temp\\js-bak.sql"); // add attachments
//$mail->AddAttachment("c:/temp/11-10-00.zip");

$mail->IsHTML(true); // set email format to HTML
<<<<<<< HEAD
//$mail->Subject = 'test';
//$mail->Body = 'test';
if(isset($_GET['mailadd']))
{
   $mail->AddAddress($_GET['mailadd'],$_GET['mailnam']); 
   $mail->Subject = $_GET['mailsub'];
   $mail->Body = $_GET['mailbdy'];
   if($mail->Send()) {echo "1";}
   else {echo "0";}
}
=======
$mail->Subject = 'test';
$mail->Body = 'test';

if($mail->Send()) {echo "Send mail successfully";}
else {echo "Send mail fail";}
>>>>>>> 9b45a4fdc2fd351655fac22e35cd7f306b673354
?>