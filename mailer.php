<?php
error_reporting(E_ALL);
require("PHPMailer_5.2.4/class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP(); // set mailer to use SMTP

$mail->SMTPDebug  = 0;
$mail->From = "admin@biht.in";
$mail->FromName = "BiHT Administrator";
$mail->Host = "server188.microhost.com"; // specif smtp server
$mail->SMTPSecure= "ssl"; // Used instead of TLS when only POP mail is selected
$mail->Port = 465; // Used instead of 587 when only POP mail is selected
$mail->SMTPAuth = true;
$mail->Username = "admin@biht.in"; // SMTP username
$mail->Password = "biht@2012"; // SMTP password

//$mail->AddAddress("debasishdas.agt@gmail.com","Debasish"); //replace myname and mypassword to yours
//$mail->AddReplyTo("debasishdas.trp@gmail.com", "Debasish the Admin");

$mail->WordWrap = 50; // set word wrap
//$mail->AddAttachment("c:\\temp\\js-bak.sql"); // add attachments
//$mail->AddAttachment("c:/temp/11-10-00.zip");

$mail->IsHTML(true); // set email format to HTML
if(isset($_GET['mailadd']))
{
   $mail->AddAddress($_GET['mailadd'],$_GET['mailnam']);
   $mail->AddReplyTo($_GET['mailadd'],$_GET['mailnam']);
   $mail->Subject = $_GET['mailsub'];
   $mail->Body = $_GET['mailbdy'];
   if($mail->Send()) {echo "1";}
   else {echo "0";}
}
?>