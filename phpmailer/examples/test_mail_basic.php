<?php
require '../class.phpmailer.php'; // path to the PHPMailer class
require '../class.smtp.php';
$mail = new PHPMailer();
$mail->IsSMTP();  // telling the class to use SMTP
$mail->SMTPDebug = 2;
$mail->Mailer = "smtp";
$mail->Host = "ssl://smtp.gmail.com";
$mail->Port = 587;
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = "mrcapella@gmail.com"; // SMTP username
$mail->Password = "984011970"; // SMTP password
//$Mail->Priority = 1;
$mail->AddAddress("mrcapellal@gmail.com","Name");
$mail->SetFrom("mrcapellal@gmail.com", "marco");
//$mail->AddReplyTo($visitor_email,$name);
$mail->Subject  = "This is a Test Message";
$mail->Body     = "teste";
$mail->WordWrap = 50;
if(!$mail->Send()) {
echo 'Message was not sent.';
echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
echo 'Message has been sent.';
}
?>