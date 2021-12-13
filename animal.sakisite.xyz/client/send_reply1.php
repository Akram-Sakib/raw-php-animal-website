<?php
	require 'config/init.php';
	
	
	$uId = $_SESSION['adminId'];
	//$incMailSetting = $objAdmin->getIncMailSettings($uId);
	//print_r($incMailSetting);
	
	$leadarraydesc = $objAdmin->leadsdesc();
	//print_r($leadarraydesc);
	//die;
	
	if($leadarraydesc == false){
		echo "<h1>No Leads Found</h1>";
	}else{
		 $mail="";
		 require_once 'third_party/PHPMailerAutoload.php';
		 $mail = new PHPMailer;
		 /*$smstpMail = new PHPMailer();
		 $this->load->helper('email'); */
		 

		foreach( $leadarraydesc  as $leadsarray){
			$leadid = $leadsarray['id'];
			$lead = trim($leadsarray['email']);
			echo "<br/><hr/>";
			$leadName = $leadsarray['name'];
			$time = $leadsarray['time'];
			$rebody = $leadsarray['message'];
			$messageid = $leadsarray['messageid'];
			echo $msgToEmail = $leadsarray['toemail'];
			$lastReplySentTime = $leadsarray['last_reply_sent_at'];
  
			echo "Serial : ".$serial = $leadsarray['serial'];
			echo "<br/>";
			
			//$lastReplySentTime;
			//die;
			$now 			=  time();
			$replydata = $objAdmin->replymessage($serial, $msgToEmail, $lastReplySentTime, $now);
			print_r($replydata);
			//die;
		   if($replydata){
							
				foreach($replydata as $replydatas){
					$replyid 		=  $replydatas['replyid'];
					$replysubject 	=  $replydatas['subject'];
					$message_body 	=  $replydatas['message_body'];
					$hits 			=  $replydatas['hits'];
					$interval 		=  $replydatas['msg_interval'];
					
					$fromname 		=  $replydatas['from_name'];
					$fromemail		=  $replydatas['from_email'];
					$replyto 		=  $replydatas['replyto_email'];
					
					$smtpusername 	=  $replydatas['smtp_user'];
					$smtppass 		=  $replydatas['smtp_pass'];
					$smtphost 		=  $replydatas['hostname'];
					$smtpport 		=  $replydatas['port'];
					$smtplimit 		=  $replydatas['sending_limit'];
					
				}
	
				$subject = $leadsarray['subject'];
					if($subject=='' || $subject==NULL){
					$subject = $replysubject ;
				}
				
				
					//echo '<br/>nnn::'.$leadName;

					$firstname = $lastname = '';	
					$namearray = explode(" ", trim($leadName));
					/* echo '<pre>';
					print_r($namearray);
					echo '</pre>'; */
					$firstname = $namearray[0]; 
					$lastname  = end($namearray);
					/* if($lastname == '')
					{
						$lastname = $firstname;
					} */
					
				  $message_body = firstnamereplace($message_body, $firstname);
				  $message_body = lastnamereplace($message_body, $lastname);
				  $message_body = emailreplace($message_body, $lead);
				  $message_body = todareplace($message_body);
				//  $message_body .= '<div class=""><br/>On '.date("l M d h:i:s"). ' UTC 2017, '.$firstname.' '.$lastname. '<' .$lead .'> <span dir="ltr">&lt;<a style="color: #15c;" target="_blank" href="mailto:'.$lead.'">'.$lead.'</a>&gt;</span> wrote:<br><br><div dir="ltr">'.$rebody.'</div>';
					
					//$leadtime 		=   $leadsarray['date'];
					$leadtime 		=   $lastReplySentTime;
					$now 			=  time();

					$settimes = $interval;
					$distance = ($now - $leadtime) / 60;
				
					settype($distance, "integer");
					settype($settimes, "integer");
					
					echo $distance.':::'.$settimes;
					//die;
					///If Interval Over	
					//if($distance > $settimes){
					if(1){
						
						// SMTP configuration
						//$mail->isSMTP();
						$mail->Host = $smtphost;
						$mail->SMTPAuth = true;
						$mail->Username = $smtpusername;
						$mail->Password = $smtppass;
						$mail->SMTPSecure = 'tls';
						$mail->Port = $smtpport;
						
						$mail->setFrom($fromemail, $fromname);
						
						$mail->addReplyTo($replyto, $fromname);
						
						$mail->addCustomHeader('In-Reply-To', $messageid);
						$mail->addCustomHeader('References', $messageid);
		
						//$mail->addAddress($lead);
						$mail->addAddress($lead);
						//var_dump($this->mail->validateAddress($lead));
						$mail->Subject = "Re: ".$subject;
						$mail->Body = $message_body;

						// Add a recipient
						//$mail->addAddress('john@gmail.com');

						// Add cc or bcc 
						//$mail->addBCC('bcc@example.com');

						// Email subject
						//$mail->Subject = 'Send Email via SMTP using PHPMailer';

						// Set email format to HTML
						$mail->isHTML(true);
						
						$attachment = $objAdmin->getattachmentreplymessage($replyid);
						//echo count($attachment);
						//print_r($attachment);
						if($attachment){
							foreach($attachment as $attfile){
								$filename = $attfile['file_name'];
								$fileType = $attfile['file_type'];
								$filepath= APP_ROOT.$filename;
								$mail->addAttachment($filepath, $fileType);
								//$mime -> addAttachment($filepath, 'image/jpeg');
							}
							
						}else{
							echo "Attachment Not Found";
						}

						// Email body content
						/* $mailContent = "<h1>Send HTML Email using SMTP in PHP</h1>
							<p>This is a test email has sent using SMTP mail server with PHPMailer.</p>"; */
						//$mail->Body = $mailContent;

						// Send email
						$mail->send();
						/* if(!$mail->send()){
							echo 'Message could not be sent.';
							echo 'Mailer Error: ' . $mail->ErrorInfo;
						}else{
							echo 'Message has been sent';
						} */
						echo 'Error:::'.$mail->ErrorInfo;
						//DIE; 
						if($mail->ErrorInfo!=""){
							//echo $this->mail->ErrorInfo;
							$objAdmin->delete_leads($leadid);
							//echo "DELETE FROM `emails` WHERE `email`='$lead'";
							//$this->db->query("DELETE FROM `emails` WHERE `id`='$leadid'");
							
							echo "Something Goes Wrong <br/>";	
						}else{
							//echo $this->mail->ErrorInfo;
							echo "<br/>";
								echo " Yes Mail sent:::".$lead;
								//echo "UPDATE `emails` SET `status`=1 WHERE `id`=$leadid";
								/* $this->db->query("UPDATE `emails` SET `status`=1 WHERE `id`=$leadid");
								$this->db->query("UPDATE `message` SET `hits`=`hits`+1 WHERE `id`=$replyid"); */
							$objAdmin->update_lead_sent_email($leadid, $replyid);			
						}
						$mail->ClearAllRecipients(); 
						$mail->clearAttachments();
						$mail->ClearReplyTos();
					}else{
						echo "Distance is ". $distance ." Lower than : ".$settimes;
					}
				
				}//if reply message null
			}

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
