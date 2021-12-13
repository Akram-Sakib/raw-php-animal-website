<?php  
class Admin{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	
	
	public function update_admin($col, $val, $uId){

		$query = $this->db->prepare("UPDATE `users` SET `$col` = ? WHERE `id` = ?");

		$query->bindValue(1, $val);
		$query->bindValue(2, $uId);
		
		try{
			$query->execute();
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}
	
	public function getUserInfo($id) {
     
		$query = $this->db->prepare("SELECT * FROM admin WHERE id = ?");
		$query->bindValue(1, $id);
	
		try{
			$query->execute();
			return $rows = $query->fetch();
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function upd_gen_info($data){
		extract($_POST);
		
		$date = date('Y-m-d H:i:s');
		$query = $this->db->prepare("UPDATE admin SET username = ?, email=?, company_name=?, acc_holder_name=?, designation=?, prof_pic=? WHERE id = ?");

		$query->bindValue(1, $user_name);
		$query->bindValue(2, $email);
		$query->bindValue(3, $comp_name);
		$query->bindValue(4, $per_name);
		$query->bindValue(5, $designation);
		$query->bindValue(6, $prof_pic);
		$query->bindValue(7, $userId);
		
		try{
			$query->execute();
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function change_password($uId, $oldpass, $newpass) {

		global $bcrypt;  // Again make get the bcrypt variable, which is defined in init.php, which is included in login.php where this function is called
          
		$query = $this->db->prepare("SELECT `password`, `id` FROM `admin` WHERE `id` = ?");
		$query->bindValue(1, $uId);
          
		try{
			$query->execute();
			$data 				= $query->fetch();
			$stored_password 	= $data['password']; // stored hashed password
			$id   				= $data['id']; // id of the user to be returned if the password is verified, below.
	
			if($bcrypt->verify($oldpass, $stored_password) === true){ // using the verify method to compare the password with the stored hashed password.
				/* Two create a Hash you do */
				$password_hash = $bcrypt->genHash($newpass);

				$query1 = $this->db->prepare("UPDATE `admin` SET `password` = ? WHERE `id` = ?");

				$query1->bindValue(1, $password_hash);
				$query1->bindValue(2, $uId);
				$query1->execute();
				return true;
			}else{
				return false;	
			}

		}catch(PDOException $e){
			die($e->getMessage());
		}
		
		
	}

	public function login($usrName, $usrPassword) {
	
		global $bcrypt;  // Again make get the bcrypt variable, which is defined in init.php, which is included in login.php where this function is called

		$query = $this->db->prepare("SELECT `password`, `id` FROM `admin` WHERE `username` = ?");
		$query->bindValue(1, $usrName);

		try{
			
			$query->execute();
			$data 				= $query->fetch();
			$stored_password 	= $data['password']; // stored hashed password
			$id   				= $data['id']; // id of the user to be returned if the password is verified, below.
		
			//echo $bcrypt->verify($usrPassword, $stored_password);
			if($bcrypt->verify($usrPassword, $stored_password) === true){ // using the verify method to compare the password with the stored hashed password.
				return $id;	// returning the user's id.
			}else{
				return false;	
			}

		}catch(PDOException $e){
			die($e->getMessage());
		}
	}

	
	public function recover($email, $generated_string) {

		if($generated_string == 0){
			return false;
		}else{
	
			$query = $this->db->prepare("SELECT COUNT(`id`) FROM `admin` WHERE `email` = ? AND `generated_string` = ?");

			$query->bindValue(1, $email);
			$query->bindValue(2, $generated_string);

			try{

				$query->execute();
				$rows = $query->fetchColumn();

				if($rows == 1){
					
					global $bcrypt;

					$username = $this->fetch_info('username', 'email', $email); // getting username for the use in the email.
					$user_id  = $this->fetch_info('id', 'email', $email);// We want to keep things standard and use the user's id for most of the operations. Therefore, we use id instead of email.
			
					$charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
					$generated_password = substr(str_shuffle($charset),0, 10);

					$this->change_password($user_id, $generated_password);

					$query = $this->db->prepare("UPDATE `admin` SET `generated_string` = 0 WHERE `id` = ?");

					$query->bindValue(1, $user_id);
	
					$query->execute();
					$headersnw = 'From: info@quizsolution.in';
					mail($email, 'Your password', "Hello " . $username . ",\n\nYour your new password is: " . $generated_password . "\n\nPlease change your password once you have logged in using this password.\n\n-quizsolution.in",$headersnw);

				}else{
					return false;
				}

			} catch(PDOException $e){
				die($e->getMessage());
			}
		}
	}

	public function confirm_recover($email){

		$username = $this->fetch_info('username', 'email', $email);// We want the 'id' WHERE 'email' = user's email ($email)

		$unique = uniqid('',true);
		$random = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0, 10);
		
		$generated_string = $unique . $random; // a random and unique string
         
		 
		$query = $this->db->prepare("UPDATE `admin` SET `generated_string` = ? WHERE `email` = ?");

		$query->bindValue(1, $generated_string);
		$query->bindValue(2, $email);

		try{
			
			$query->execute();
			$headersnw = 'From: info@quizsolution.in';
			mail($email, 'Recover Password', "Hello " . $username. ",\r\nPlease click the link below:\r\n\r\n ".APP_URL."admin/recover.php?email=" . $email . "&generated_string=" . $generated_string . "\r\n\r\n We will generate a new password for you and send it back to your email.\r\n\r\n-- quizsolution.in", $headersnw);	
			 return true;		
			
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function email_exists($email) {
     
		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `admin` WHERE `email`= ?");
		$query->bindValue(1, $email);
	
		try{

			$query->execute();
			$rows = $query->fetchColumn();
            
			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}

	public function fetch_info($what, $field, $value){

		$allowed = array('id', 'username','email'); // I have only added few, but you can add more. However do not add 'password' eventhough the parameters will only be given by you and not the user, in our system.
		if (!in_array($what, $allowed, true) || !in_array($field, $allowed, true)) {
		    throw new InvalidArgumentException;
		}else{
		
			$query = $this->db->prepare("SELECT $what FROM `admin` WHERE $field = ?");

			$query->bindValue(1, $value);

			try{

				$query->execute();
				
			} catch(PDOException $e){

				die($e->getMessage());
			}

			return $query->fetchColumn();
		}
	}
	
	public function add_incMail_settings($data){
		extract($_POST);
		
		$date = date('Y-m-d H:i:s');
		if($editId == '')
		{
			$query = $this->db->prepare("INSERT INTO imap_email(email, port, password, host)VALUES(?,?,?,?)");

			$query->bindValue(1, $inc_mail);
			$query->bindValue(2, $port);
			$query->bindValue(3, $mail_pass);
			$query->bindValue(4, $host_name);
		}
		else{
			$query = $this->db->prepare("UPDATE imap_email SET email = ?, port=?, password=?, host=? WHERE id = ?");

			$query->bindValue(1, $inc_mail);
			$query->bindValue(2, $port);
			$query->bindValue(3, $mail_pass);
			$query->bindValue(4, $host_name);
			$query->bindValue(5, $editId);
		}
		
		try{
			$query->execute();
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}
	
	public function getIncMailSettings($userId) {
		$query = $this->db->prepare("SELECT * FROM imap_email ORDER BY id DESC");
		
		try{
			$query->execute();
			return $rows = $query->fetchAll();
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	public function getIncMailSettingById($id) {
		$query = $this->db->prepare("SELECT * FROM imap_email WHERE id = ?");
		$query->bindValue(1, $id);
		try{
			$query->execute();
			return $rows = $query->fetch();
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function delete_incMail_settings($id) {
		$query = $this->db->prepare("DELETE FROM imap_email WHERE id = ? LIMIT 1");
		$query->bindValue(1, $id);
		try{
			$query->execute();
			return true;
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	public function add_mail_settings($data){
		extract($_POST);
		
		$date = date('Y-m-d H:i:s');
		if($editId == '')
		{
			$query = $this->db->prepare("INSERT INTO mail_settings(user_id, from_name, from_email, replyto_email, sending_limit, date_time, smtp_user, smtp_pass, hostname, port)VALUES(?,?,?,?,?,?,?,?,?,?)");

			$query->bindValue(1, $userId);
			$query->bindValue(2, $from_name);
			$query->bindValue(3, $from_email);
			$query->bindValue(4, $replyto_email);
			$query->bindValue(5, $send_limit);
			$query->bindValue(6, $date);
			$query->bindValue(7, $smtp_user);
			$query->bindValue(8, $smtp_pass);
			$query->bindValue(9, $host_name);
			$query->bindValue(10, $port);
		}
		else{
			$query = $this->db->prepare("UPDATE mail_settings SET from_name = ?, from_email=?, replyto_email=?, sending_limit=?, smtp_user=?, smtp_pass=?, hostname=?, port=? WHERE id = ?");

			$query->bindValue(1, $from_name);
			$query->bindValue(2, $from_email);
			$query->bindValue(3, $replyto_email);
			$query->bindValue(4, $send_limit);
			$query->bindValue(5, $smtp_user);
			$query->bindValue(6, $smtp_pass);
			$query->bindValue(7, $host_name);
			$query->bindValue(8, $port);
			$query->bindValue(9, $editId);
		}
		
		try{
			$query->execute();
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}
	
	public function getMailSettings($userId) {
		$query = $this->db->prepare("SELECT * FROM mail_settings WHERE user_id=? ORDER BY id DESC");
		$query->bindValue(1, $userId);
	
		try{
			$query->execute();
			return $rows = $query->fetchAll();
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	public function getMailSettingById($userId) {
		$query = $this->db->prepare("SELECT * FROM mail_settings WHERE id=?");
		$query->bindValue(1, $userId);
	
		try{
			$query->execute();
			return $rows = $query->fetch();
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function delete_mail_settings($delId) {
		$query = $this->db->prepare("DELETE FROM mail_settings WHERE id = ? LIMIT 1");
		$query->bindValue(1, $delId);
	
		try{
			$query->execute();
			return true;
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function add_replyMsg($data){
		extract($_POST);
		
		$date = date('Y-m-d H:i:s');
		if($editId == '')
		{
			//echo "INSERT INTO reply_messages(user_id, serial, subject, msg_interval, mail_setting_id, message_body, date_time)VALUES($userId,$serial,'$subj',$interval,'$mail_setting','$msg_content','$date')";
			
			$query = $this->db->prepare("INSERT INTO reply_messages(user_id, serial, subject, msg_interval, mail_setting_id, message_body, date_time)VALUES(?,?,?,?,?,?,?)");

			$query->bindValue(1, $userId);
			$query->bindValue(2, $serial);
			$query->bindValue(3, $subj);
			$query->bindValue(4, $interval);
			$query->bindValue(5, $mail_setting);
			$query->bindValue(6, $msg_content);
			$query->bindValue(7, $date);
		}
		else{
			$query = $this->db->prepare("UPDATE reply_messages SET serial = ?, subject=?, msg_interval=?, mail_setting_id=?, message_body=? WHERE id = ?");

			$query->bindValue(1, $serial);
			$query->bindValue(2, $subj);
			$query->bindValue(3, $interval);
			$query->bindValue(4, $mail_setting);
			$query->bindValue(5, $msg_content);
			$query->bindValue(6, $editId);
		}
		
		try{
			$query->execute();
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}
	
	public function getReplyMsgs($userId) {
		$query = $this->db->prepare("SELECT r.*, m.from_name, m.from_email FROM reply_messages r INNER JOIN mail_settings m ON r.mail_setting_id = m.id WHERE r.user_id = ? ORDER BY id DESC");
		$query->bindValue(1, $userId);
	
		try{
			$query->execute();
			return $rows = $query->fetchAll();
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	public function delete_replyMsgs($delId) {
		$query = $this->db->prepare("DELETE FROM reply_messages WHERE id = ? LIMIT 1");
		$query->bindValue(1, $delId);
	
		try{
			$query->execute();
			return true;
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	public function getReplyMsgById($id) {
		$query = $this->db->prepare("SELECT r.*, m.from_name, m.from_email FROM reply_messages r INNER JOIN mail_settings m ON r.mail_setting_id = m.id WHERE r.id = ?");
		$query->bindValue(1, $id);
	
		try{
			$query->execute();
			return $rows = $query->fetch();
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	public function add_followupMsg($data){
		extract($_POST);
		
		$date = date('Y-m-d H:i:s');
		if($editId == '')
		{
			$query = $this->db->prepare("INSERT INTO followup_messages(user_id, subject, message_body, msg_interval, fromname, fromemail, replyto, mail_setting_id)VALUES(?,?,?,?,?,?,?,?)");

			$query->bindValue(1, $userId);
			$query->bindValue(2, $subj);
			$query->bindValue(3, $msg_content);
			$query->bindValue(4, $interval);
			$query->bindValue(5, $from_name);
			$query->bindValue(6, $reply_to);
			$query->bindValue(7, $from_email);
			$query->bindValue(8, $mail_setting);
		}
		else{
			$query = $this->db->prepare("UPDATE followup_messages SET message_body = ?, subject=?, msg_interval=?, mail_setting_id=?, fromname=?, fromemail=?, replyto=? WHERE id = ?");

			$query->bindValue(1, $msg_content);
			$query->bindValue(2, $subj);
			$query->bindValue(3, $interval);
			$query->bindValue(4, $mail_setting);
			$query->bindValue(5, $from_name);
			$query->bindValue(6, $from_email);
			$query->bindValue(7, $reply_to);
			$query->bindValue(8, $editId);
		}
		
		try{
			$query->execute();
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}
	
	public function add_lead($data){
		extract($_POST);
		
		$date = time();
		if($editId == '')
		{
			$query = $this->db->prepare("INSERT INTO emails(email, time, serial)VALUES(?,?,?)");
			$query->bindValue(1, $leads);
			$query->bindValue(2, $date);
			$query->bindValue(3, 1);
			
			$inbox = $this->db->prepare("INSERT INTO inbox(email,time, serial)VALUES(?,?,?)");
			$inbox->bindValue(1, $leads);
			$inbox->bindValue(2, $date);
			$inbox->bindValue(3, 1);
		}
		
		try{
			$query->execute();
			$inbox->execute();
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}
	
	public function delete_leads($dId) {
		$query = $this->db->prepare("DELETE FROM emails WHERE id = ?");
		$query->bindValue(1, $dId);
		try{
			$query->execute();
			
			$inbox = $this->db->prepare("DELETE FROM inbox WHERE id = ?");
			$inbox->bindValue(1, $dId);
			$inbox->execute();
			
			return true;
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function getAllLeads($userId) {
		$query = $this->db->prepare("SELECT * FROM emails");
	
		try{
			$query->execute();
			return $rows = $query->fetchAll();
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function getFollowupMsgs($userId) {
		$query = $this->db->prepare("SELECT f.*, m.from_name, m.from_email FROM followup_messages f INNER JOIN mail_settings m ON f.mail_setting_id = m.id WHERE f.user_id = ? ORDER BY id DESC");
		$query->bindValue(1, $userId);
	
		try{
			$query->execute();
			return $rows = $query->fetchAll();
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	public function delete_followupMsgs($delId) {
		$query = $this->db->prepare("DELETE FROM followup_messages WHERE id = ? LIMIT 1");
		$query->bindValue(1, $delId);
	
		try{
			$query->execute();
			return true;
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function getFollowupMsgById($id) {
		$query = $this->db->prepare("SELECT f.*, m.from_name, m.from_email FROM followup_messages f INNER JOIN mail_settings m ON f.mail_setting_id = m.id WHERE f.id = ?");
		$query->bindValue(1, $id);
	
		try{
			$query->execute();
			return $rows = $query->fetch();
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function chk_black_list($prefix, $suffix) {
		$query = $this->db->prepare("SELECT count(*) ttl FROM `blacklist`  WHERE `matchword`='$prefix' || `matchword`='$suffix'");
		
		try{
			$query->execute();
			return $rows = $query->fetchColumn();
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	public function chk_remaining_emails($emails) {
		$query = $this->db->prepare("SELECT count(*) ttl FROM emails WHERE `status`=0 AND `email`='$emails'");
		
		try{
			$query->execute();
			return $rows = $query->fetchColumn();
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function getLeadQuery($emails) {
		$query = $this->db->prepare("SELECT serial FROM emails WHERE `email`='$emails'");
		
		try{
			$query->execute();
			return $rows = $query->fetchAll();
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function addLeadQuery($fromemail,$serial,$newfromname,$subject,$incomingbody,$replytoaddress,$date,$time,$message_id) {
		$query = $this->db->prepare("INSERT INTO emails SET email=?, serial=$serial+1, sequence =$serial+1, name= ?, subject=?, message = ?, toemail = ?, status=0, flag=0, date = ?, msgdate = ?, time = ?, messageid = ?");
		
		$query->bindValue(1, $fromemail);
		$query->bindValue(2, $newfromname);
		$query->bindValue(3, $subject);
		$query->bindValue(4, $incomingbody);
		$query->bindValue(5, $replytoaddress);
		$query->bindValue(6, $date);
		$query->bindValue(7, $date);
		$query->bindValue(8, $time);
		$query->bindValue(9, $message_id);
		
		try{
			$query->execute();
			return true;
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function updLeadQuery($fromemail,$serial,$newfromname,$subject,$incomingbody,$replytoaddress,$date,$time,$message_id) {
		$query = $this->db->prepare("UPDATE `emails`  SET `email`=?, `serial`=$serial+1,`sequence`=$serial+1,`name`=?,`subject`=?, `message`=?,`toemail`=?,`status`=0,`flag`=0, `date`=?,`msgdate`=?,`time`=?,`messageid`=? WHERE `email`=?");
		
		$query->bindValue(1, $fromemail);
		$query->bindValue(2, $newfromname);
		$query->bindValue(3, $subject);
		$query->bindValue(4, $incomingbody);
		$query->bindValue(5, $replytoaddress);
		$query->bindValue(6, $date);
		$query->bindValue(7, $date);
		$query->bindValue(8, $time);
		$query->bindValue(9, $message_id);
		$query->bindValue(10, $fromemail);
		
		try{
			$query->execute();
			return true;
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function addToInbox($fromemail,$serial,$newfromname,$subject,$replytoaddress,$date,$time)
	{
		$query = $this->db->prepare("INSERT INTO `inbox`  SET `email`=?, `serial`=$serial+1,`name`=?,`subject`=?, `message`='',`toemail`=?,`status`=0,`flag`=0, `date`=?,`msgdate`=?,`time`=?");
		
		$query->bindValue(1, $fromemail);
		$query->bindValue(2, $newfromname);
		$query->bindValue(3, $subject);
		$query->bindValue(4, $replytoaddress);
		$query->bindValue(5, $date);
		$query->bindValue(6, $date);
		$query->bindValue(7, $time);
		
		try{
			$query->execute();
			return true;
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function sendlimit(){
		$query = $this->db->prepare("SELECT `value` FROM settings  WHERE `option`='sendlimit'");
		
		try{
			$query->execute();
			return $rows = $query->fetchColumn();
		} catch (PDOException $e){
			die($e->getMessage());
		} 	
	}
	
	public function maximumserial(){
		$query = $this->db->prepare("SELECT  MAX(serial) as serial FROM `emails`");
		
		try{
			$query->execute();
			return $rows = $query->fetchColumn();
		} catch (PDOException $e){
			die($e->getMessage());
		} 
	}
	
	public function leadsdesc(){
		$limit = $this->sendlimit();
		$maximumserial = $this->maximumserial();
		
		$query = $this->db->prepare("SELECT * FROM emails WHERE `status`=0 AND `serial` <= $maximumserial ORDER BY `id` DESC LIMIT $limit");
		
		try{
			$query->execute();
			return $rows = $query->fetchAll();
		} catch (PDOException $e){
			die($e->getMessage());
		}  
	}
	
	public function replymessage($serial){
		//echo "SELECT reply_messages.*, reply_messages.id as replyid, mail_settings.* FROM reply_messages  LEFT JOIN mail_settings ON mail_settings.id = reply_messages.mail_setting_id WHERE reply_messages.hits = (SELECT MIN( hits ) FROM reply_messages WHERE  `serial` =$serial ) AND reply_messages.serial=$serial";
		$query = $this->db->prepare("SELECT reply_messages.*, reply_messages.id as replyid, mail_settings.* FROM reply_messages  LEFT JOIN mail_settings ON mail_settings.id = reply_messages.mail_setting_id WHERE reply_messages.hits = (SELECT MIN( hits ) FROM reply_messages WHERE  `serial` =$serial ) AND reply_messages.serial=$serial");
		
		try{
			$query->execute();
			return $rows = $query->fetchAll();
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function update_lead_sent_email($leadid, $replyid){
		$query = $this->db->prepare("UPDATE `emails` SET `status`=1 WHERE `id`=$leadid");
		$query2 = $this->db->prepare("UPDATE `reply_messages` SET `hits`=`hits`+1 WHERE `id`=$replyid");
		
		try{
			$query->execute();
			$query2->execute();
			return $rows = $query->fetchAll();
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function get_followup(){
		$query = $this->db->prepare("SELECT  `followup_messages`.id as followupid , `followup_messages`.* , mail_settings.smtp_user, mail_settings.smtp_pass, mail_settings.hostname, mail_settings.port FROM `followup_messages` LEFT JOIN `mail_settings` ON  `followup_messages`.mail_setting_id=`mail_settings`.id ORDER BY `followup_messages`.`msg_interval`");
		
		try{
			$query->execute();
			return $rows = $query->fetchAll();
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function leadsovertime($replyinterval, $followupid){
		$nowtime = time();
		$withinterval = $nowtime - $replyinterval;
		echo "<br/>";
		echo $nowtime.':::::'.$replyinterval.':::::'.$withinterval;	
		echo "<br/>";
		//echo "SELECT * FROM emails WHERE last_followup_sent_at <= $withinterval ORDER By `id` ASC LIMIT 20";
		echo "<br/>";
		$query = $this->db->prepare("SELECT * FROM emails WHERE last_followup_sent_at <= $withinterval ORDER By `id` ASC LIMIT 20");
		
		try{
			$query->execute();
			$rows = $query->fetchAll();
			//echo count($rows);
			if(count($rows))
			{
				return $rows;
			}
			else{
				return false;
			}
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	/* public function leadsovertime($replyinterval, $followupid){
		$nowtime = time();
		$withinterval = $nowtime - $replyinterval;
		echo "<br/>";
		echo $withinterval;	
		echo "<br/>";
		$query = $this->db->prepare("SELECT   `emails`.* FROM `emails`  WHERE `time` <= $withinterval AND   `followup` < $followupid ORDER By `id` ASC LIMIT 20");
		
		try{
			$query->execute();
			$rows = $query->fetchAll();
			//echo count($rows);
			if(count($rows))
			{
				return $rows;
			}
			else{
				return false;
			}
		} catch (PDOException $e){
			die($e->getMessage());
		}
	} */
	
	public function getattachmentreplymessage($messageid){
		
		$query = $this->db->prepare("SELECT `file_name` FROM `attachments` WHERE `messageid`=$messageid");
		
		try{
			$query->execute();
			$rows = $query->fetchAll();
			//echo count($rows);
			if(count($rows))
			{
				return $rows;
			}
			else{
				return false;
			}
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function update_followup_email($followupid, $leadid){
		$time = time();
		$query = $this->db->prepare("INSERT INTO followup_sent SET email_id=?, followup_id=?, time=?");
		
		$query->bindValue(1, $leadid);
		$query->bindValue(2, $followupid);
		$query->bindValue(3, $time);
		
		//$query = $this->db->prepare("UPDATE `emails` SET `followup`=$followupid WHERE `id`=$leadid");

		try{
			$query->execute();
			$last = $this->db->lastInsertId();
			if($last)
			{
				$query1 = $this->db->prepare("UPDATE emails SET followup_count = followup_count+1, last_followup_sent_at = $time WHERE id = $leadid");
				$query1->execute();
			}
			return true;
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
}
?>