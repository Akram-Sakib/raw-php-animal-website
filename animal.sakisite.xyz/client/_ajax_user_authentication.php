<?php
require 'config/init.php';

if($_GET['action']=='login')
{
  
    extract($_POST);
	$login = $objAdmin->login($username, $password);
	if ($login === false) {
		echo 0;
		$errors[] = 'Sorry, that username/password is invalid';
	}else {
	
		$_SESSION['adminId'] = $login;
		$_SESSION['admin_name'] = $username;
		
		echo 1;
		exit();
	}
}


if($_GET['action']=='changepassword')
{
     extract($_POST);
	 
	 $uId = $_SESSION['adminId'];
	 
	echo  $boolChangepass = $objAdmin->change_password($uId, $oldpass, $newpass);
	
}

if($_GET['action']=='forgot')
{
    if (isset($_POST['email']) === true && empty($_POST['email']) === false) {
		if ($objAdmin->email_exists($_POST['email']) === true){
			echo $boolForgot =$objAdmin->forgot_password($_POST['email']);
		} else {
			echo '<div class="error">Sorry, that email doesn\'t exist.</div>';
		}
	}
}

if($_GET['action']=='delete_user')
{
	$regUid = $_POST['userId'];
	$action = $_POST['action'];
	echo $objAdmin->delete_user($regUid, $action);
}	
if($_GET['action']=='approve_askQues')
{
	$qId = $_POST['qId'];
	$action = $_POST['action'];
	echo $objAdmin->approve_askQues($qId, $action);
}
?>