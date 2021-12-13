<?php
require_once 'third_party/PHPMailerAutoload.php';
$mail = new PHPMailer;

$lead = $_GET['email'];

$mail->isSMTP();
$mail->SMTPDebug = 1;
$mail->Host = 'premium28.web-hosting.com';
$mail->SMTPAuth = true;
$mail->Username = 'khan@securemail.ltd';
$mail->Password = 'Soo12345';
$mail->SMTPSecure = 'ssl';
$mail->Port = '465'; 

$mail->setFrom('khan@securemail.ltd', 'Khan');

$mail->addReplyTo('khan@securemail.ltd', 'Khan');

//$mail->addCustomHeader('In-Reply-To', $messageid);
//$mail->addCustomHeader('References', $messageid);

$mail->addAddress($lead);
//var_dump($this->mail->validateAddress($lead));
$subject = 'Test email';
$mail->Subject = "Re: ".$subject;

$message_body = 'Test Email Body';
$mail->Body = $message_body;

$mail->isHTML(true); 

$mail->send();

if($mail->ErrorInfo!=""){
	echo $mail->ErrorInfo;	
}else{
	echo 'Mail Sent';
}
?>