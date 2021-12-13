<?php
	require 'config/init.php';
	
	/* require_once 'third_party/PHPMailerAutoload.php';
	$mail = new PHPMailer; */
	
	$uId = $_SESSION['adminId'];
	$incMailSetting = $objAdmin->getIncMailSettings($uId);
	//print_r($incMailSetting);
	
	$followupmessage = $objAdmin->get_followup();
	//print_r($followupmessage);
	//die;
	
	if(count($followupmessage)){
		
		 $mail="";
		 require_once 'third_party/PHPMailerAutoload.php';
		 $mail = new PHPMailer;

		foreach($followupmessage as $followupmsgdata){
			$followupid 	= $followupmsgdata['followupid'];
			$message_body 	= $followupmsgdata['message_body'];
			$smtphost 	= $followupmsgdata['hostname'];
			$smtpport 	= $followupmsgdata['port'];
			$smtpusername 	= $followupmsgdata['smtp_user'];
			$smtppassword 	= $followupmsgdata['smtp_pass'];
			$senderemail 	= $followupmsgdata['fromemail'];
			$sendername 	= $followupmsgdata['fromname'];
			$replyto 	= $followupmsgdata['replyto'];
			$followupsubject 	= $followupmsgdata['subject'];
			
			
			$replyinterval 	= $followupmsgdata['msg_interval'] * 60;  //interval in sec
			
			$leads = $objAdmin->leadsovertime($replyinterval, $followupid);
			//print_r($leads);
			
			if($leads){
				$lead = '';
				foreach($leads as $leaddata){
					$leadid 		= $leaddata['id'];
					echo '<br/>'.$lead 			= $leaddata['email'];
					$fromname 		= $leaddata['name'];
					$subject 		= $leaddata['subject'];
					
					if($subject=='' || $subject==NULL){
						$subject = $followupsubject;
					}
					
					$todayis = date('l');	
					$todate	= date("M-d-Y");	
					$namearray = explode(" ", $fromname);
					
					$firstname = $namearray[0]; 
					$lastname  = $namearray[1]; 
					
					$message_body = firstnamereplace($message_body,$firstname );
					$message_body = lastnamereplace($message_body,$lastname );
					$message_body = emailreplace($message_body,$lead);
					$message_body = todareplace($message_body);
					
					//$mail="";
					
					// SMTP configuration
					//$mail->isSMTP();
					$mail->Host = $smtphost;
					$mail->SMTPAuth = true;
					$mail->Username = $smtpusername;
					$mail->Password = $smtppassword;
					$mail->SMTPSecure = 'tls';
					$mail->Port = $smtpport;
					
					$mail->setFrom($senderemail, $sendername);
					$mail->addReplyTo($replyto, 'GreenTech');
					
					//$mail->addCustomHeader('In-Reply-To',$messageid);
					//$mail->addCustomHeader('References',$messageid);
	
					$mail->addAddress($lead);
					//var_dump($this->mail->validateAddress($lead));
					$mail->Subject = "Re: ".$subject;
					$mail->Body = $message_body;

					// Set email format to HTML
					$mail->isHTML(true);
					
					
					$attachment = $objAdmin->getattachmentreplymessage($followupid);
					//echo count($attachment);
					if($attachment){
						foreach($attachment as $attfile){
							$filename = $attfile->file_name;
							$filepath= "uploads/".$filename;
							$mail->addAttachment($filepath, $filename);
						}
						
					}else{
						echo "Attachment Not Found";
					}
					
					//if($mail->send()){
					if($mail->send()){
						echo " MAIL SENT ";
						///Lead Status
						//$this->db->query("UPDATE `emails` SET `followup`=$followupid WHERE `id`=$leadid");
						$objAdmin->update_followup_email($followupid, $leadid);
					}else{
						echo " SMTP PROBLEM <br/>";
						echo " Mailer Error: " . $mail->ErrorInfo;
					}
					$mail->ClearAllRecipients(); 
					$mail->clearAttachments();
				}
			}
			else{
				echo "No leads found for Followup";
			}
			
	}//foreach closing
}
else{
	echo "No Followup Exist";
}

function firstnamereplace($content, $replaceby){
	return $bodytag = str_replace("#firstname#",$replaceby,$content);
}

function lastnamereplace($content, $replaceby){
	return $bodytag = str_replace("#lastname#",$replaceby,$content);
}

function emailreplace($content, $replaceby){
	return $bodytag = str_replace("#youremail#",$replaceby,$content);
}

function todareplace($content){
	$today = date('l');
	return $bodytag = str_replace("#todayis#",$today,$content);
}

function unsubreplace($content, $replaceby){
	return $bodytag = str_replace("{unsubscribe}",$replaceby,$content);
}
	
?>
