<?php
	require 'config/init.php';
	
	/* require_once 'third_party/PHPMailerAutoload.php';
	$mail = new PHPMailer; */
	
	$uId = $_SESSION['adminId'];
	//$incMailSetting = $objAdmin->getIncMailSettings($uId);
	//print_r($incMailSetting);
	
	$followupmessage = $objAdmin->get_followup();
	$ttlFolloupBySmtp = $objAdmin->countFolloupBysmtp();
	//print_r($ttlFolloupBySmtp);
	//die;
	//print_r($followupmessage);
	//die;
	echo 'TTL Follup::'.count($followupmessage);
	if(count($followupmessage)){
		
		 $mail="";
		 require_once 'third_party/PHPMailerAutoload.php';
		 $mail = new PHPMailer;

		$i=0; 
		$senderemail = '';
		foreach($followupmessage as $followupmsgdata){
			/* print_r($followupmsgdata);
			die;  */
			$i++;
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
			$sendEmailFrom 	= $followupmsgdata['sendFromFollowEmail'];
			$smtpId 	= $followupmsgdata['smtpId'];
			
			echo '<br/>--------------------------------------------------------------------<br/>';
			echo 'FollowupId:::'.$followupid.'<br/><br/>';
			
			$replyinterval 	= $followupmsgdata['msg_interval'] * 60;  //interval in sec
			
			
			$leads = $objAdmin->leadsovertime($replyinterval, $followupid, $senderemail);
			//print_r($leads);
			//die;
			if($leads){
				$lead = '';
				foreach($leads as $leaddata){
					echo '<br/>'.$leadid 		= $leaddata['id'];
					echo '<br/>'.$lead 			= $leaddata['email'];
					$fromname 		= $leaddata['name'];
					$subject 		= $leaddata['subject'];
					$leadToEmail 		= $leaddata['toemail'];
					echo '<br/>count:::'.$followup_count 		= $leaddata['followup_count'];
					echo '<br/>ExistsId:::'.$followupIdExists = $leaddata['followup'];
					
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
					/* print_r($leaddata);
					print_r($ttlFolloupBySmtp);
					die; */
					//$mail="";
					
					echo '<br/>ttl FFF:::'.$ttlFollowupCount = $ttlFolloupBySmtp[$leadToEmail];
					/* echo '<br/><br/><br/>';
					die; */
					if($followup_count < $ttlFollowupCount)
					{
						if($followupIdExists != $followupid)
						{
							if($i>=$followup_count)
							{
								// SMTP configuration
								//$mail->isSMTP();
								$mail->Host = $smtphost;
								$mail->SMTPAuth = true;
								$mail->Username = $smtpusername;
								$mail->Password = $smtppassword;
								$mail->SMTPSecure = 'tls';
								$mail->Port = $smtpport;
								
								//echo '<br/><br/>SenderEmail::::'.$senderemail.'---'.$sendername.'<br/><br/>';
								
								$mail->setFrom($senderemail, $sendername);
								$mail->ClearReplyTos();
								$mail->addReplyTo($replyto, '');
								
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
									echo '<br/>sentId:::><b style="color:red;">'.$lead.'=>'.$followupid.'</b>';
									$objAdmin->update_followup_email($followupid, $leadid);
								}else{
									echo " SMTP PROBLEM <br/>";
									echo " Mailer Error: " . $mail->ErrorInfo;
								}
							}
						}
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