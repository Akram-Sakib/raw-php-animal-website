<?php 
require 'config/connect/database.php';

//require APP_ROOT.'/core/classes/users.php';

require APP_ROOT.'config/classes/admin.php';
require APP_ROOT.'config/classes/general.php';
require APP_ROOT.'config/classes/bcrypt.php';

$objAdmin 		= new Admin($db);
//$users 		   = new Users($db);

$general 	= new General();
$bcrypt 	= new Bcrypt(12);

$errors = array();

if (($general->logged_in_admin() === true) || (@$_SESSION['adminId']!=""))  {
	$admin_id 	= $_SESSION['adminId'];
}
