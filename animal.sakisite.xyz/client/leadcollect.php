<?php
	require 'config/init.php';
	//die;
	$uId = $_SESSION['adminId'];
	$incMailSetting = $objAdmin->getIncMailSettings($uId);
	/* print_r($incMailSetting);*/
	
	$BlockWords = $objAdmin->getBlackKeywords();
	
	$wordArr = array();
	foreach($BlockWords as $bwords)
	{
		$wordArr[] = trim($bwords['matchword']);
	}
	//print_r($wordArr);
	//die;
	/*mail('singhanil221@gmail.com','cronecheck','test');
	die; */
	if(count($incMailSetting))
	{
		foreach($incMailSetting as $incSetting)
		{
			$email = $incSetting['email'];
			$password = $incSetting['password'];
			$port = $incSetting['port'];
			$host = $incSetting['host'];
			$campaignid = 0;
			
			if($port == '143')
			{
				$domainURL = end(explode('@', $email));
				$hostname = '{'.$domainURL.':'.$port.'/notls}INBOX';
			}
			else
			{
				$hostname = "{".$host.":".$port."/imap/ssl/novalidate-cert}"; //disable validation of cert
			}		
			//Check hostname end
			
			$inbox = imap_open($hostname,$email,$password) or die('Cannot connect to Mail Server: ' . imap_last_error());
			
			$emails = imap_search($inbox,'ALL');
			print_r($emails);
			
			if($emails) {
	  
			/* begin output var */
			$output = '';
			
			  /* put the newest emails on top */
			rsort($emails);
			
			  foreach($emails as $email_number) {
					/* get information specific to this email */
					$getheader = imap_headerinfo($inbox, $email_number);  //Get  Email Header
					$overview = imap_fetch_overview($inbox,$email_number,0); //Fetch Email Header
					@$message_id	=  $getheader->message_id;
					
					//$headers = imap_fetchheader($inbox, $email_number,FT_PREFETCHTEXT);
					
					$headers = explode("\n", imap_fetchheader($inbox, $email_number)); 
					$head = array(); 
					foreach($headers as $key => $header) {
						$data = explode(":", $header);
						if( count($data) == 2 && !isset($head[$data[0]]))
						{
							$head[trim($data[0])] = trim($data[1]);     
						}
					} 
					
					//print_r($head);
					echo $head['Delivered-To'];
					
					/* if (stripos($headers, 'delivered-to:') !==false
							&& ($dt = findHeaderEntry($headers,
								 'delivered-to', true))) {
						if (($delivered_to = Mail_Parse::parseAddressList($dt)))
							$tolist['delivered-to'] = $delivered_to;
					} */
					
					//pd($overview);
					//print_r($headers);
					//print_r($overview);
					echo '<br/><br/>';
					print_r($getheader);
					echo '<br/>'; 
					//die;
					if($head['Delivered-To'] == '')
					{
						$toArr = $getheader->to;
						$toEmailAddress = $toArr[0]->mailbox.'@'.$toArr[0]->host;
					}
					else
					{
						$toEmailAddress = $head['Delivered-To'];
					}
					
					/* output the email header information */
					$replytoaddress = $toEmailAddress; //$getheader->toaddress;
					@$subject		= $overview[0]->subject;
					@$subject		= str_replace("'"," ",$subject);
					@$subject		= str_replace("\""," ",$subject);
					$fromname 		= $overview[0]->from;
					$toaddress 		= $overview[0]->to;
					$namecut 		= strpos($fromname, "<");
					$newfromname 	= substr($fromname,0,$namecut);
					$newfromname 	= str_replace("'"," ",$newfromname);
					$date			= $overview[0]->udate;
					$fromemail 		= $getheader->from[0]->mailbox . "@" . $getheader->from[0]->host;
					
					$prefix = $getheader->from[0]->mailbox;
					$suffix = $getheader->from[0]->host;
					
					//$blacklist = $objAdmin->chk_black_list($prefix, $suffix);
					//$blacklist = $this->db->query("SELECT * FROM `blacklist`  WHERE `matchword`='$prefix' || `matchword`='$suffix'")->num_rows();
				
				
					$incomingbody = imap_body($inbox, $email_number);
					//$incomingbody = $this->security->xss_clean(imap_body($inbox, $email_number));
					$bbody = explode("--",$incomingbody);
					
					/* echo "<pre>";
					print_r($bbody);
					echo "<pre>"; */
					
					print_r($wordArr);	
					$addLead = 1;
					foreach($wordArr as $w)
					{
						if (strpos($w, $fromemail) !== false) {
							$addLead = 0;
						}
					}
					
					//if( $blacklist < 1  ){
					if($addLead){
						$time = time();

						//$leaduniqcheck = $this->db->query("SELECT * FROM emails WHERE `status`=0 AND `email`='$fromemail'")->num_rows();
						$leaduniqcheck = $objAdmin->chk_remaining_emails($fromemail);
						if($leaduniqcheck == 0 ){
							//$leadquery = $this->db->query("SELECT `serial` FROM emails WHERE `email`='$fromemail'");
							$leadquery = $objAdmin->getLeadQuery($fromemail);
							print_r($leadquery);
							if(count($leadquery) > 0 ){
								foreach($leadquery as $leaddata){
									$serial = $leaddata['serial'];
								}
							}else{
								$serial = 0;
							}	
							 
							if($serial == 0){
								$objAdmin->addLeadQuery($fromemail,$serial,$newfromname,$subject,$incomingbody,$replytoaddress,$date,$time,$message_id);
								
									echo "<br/>";
							}elseif($serial > 0){
									$objAdmin->updLeadQuery($fromemail,$serial,$newfromname,$subject,$incomingbody,$replytoaddress,$date,$time,$message_id);
									 
									//echo $this->db->last_query();
									echo "<br/>";
								}else{
									echo "Serial Problem";
								}
								
								$objAdmin->addToInbox($fromemail,$serial,$newfromname,$subject,$replytoaddress,$date,$time);
								
							}
							else{
								echo "<br/> = Already exist this Lead = <br/>";
							}
					}
					else
					{
						echo '<br/>Black listed:::'.$fromemail;
					}
					imap_delete($inbox, $email_number); 
					//header('Location:send_reply.php');
					
					//echo file_get_contents(APP_URL.'send_reply.php');
			  }//end of email foreach
			}else{
				//ECHO APP_URL.'send_reply.php';
				//echo file_get_contents(APP_URL.'send_reply.php'); 
				echo "No Incoming Mail found";
			}//end of email if 
			imap_expunge($inbox);
			imap_close($inbox);	
		}
	}
	else
	{
		echo "Please Add Imap Info";
	}
	echo file_get_contents(APP_URL.'send_reply.php');
	echo file_get_contents(APP_URL.'send_followup.php');
?>
