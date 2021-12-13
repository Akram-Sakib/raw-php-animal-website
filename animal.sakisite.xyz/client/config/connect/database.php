<?php 
ob_start();

if($_SERVER['REMOTE_ADDR']=='127.0.0.1' || $_SERVER['REMOTE_ADDR']=='::1'){
			}
	else
	{
			ini_set('session.save_path',$_SERVER["DOCUMENT_ROOT"].'/shabaj/session');
	}

session_start();

	# ----------------------------------------------------------------------------------------------------
	# DEFINE APP FOLDER
	# ----------------------------------------------------------------------------------------------------
	
	
	if($_SERVER['REMOTE_ADDR']=='127.0.0.1' || $_SERVER['REMOTE_ADDR']=='::1')
	{
				$config = array(
			'host'		=> 'localhost',
			'username' 	=> 'sakisite_secukcrn_autoresp_user',
			'password' 	=> '?ykf~+aNf4Fn',
			'dbname' 	=> 'sakisite_secukcrn_autoresp'
		);
    }
	else
	{
		$config = array(
			'host'		=> 'localhost',
			'username' 	=> 'sakisite_secukcrn_autoresp_user',
			'password' 	=> '?ykf~+aNf4Fn',
			'dbname' 	=> 'sakisite_secukcrn_autoresp'
		);
	}

	# ----------------------------------------------------------------------------------------------------
	# Website NAME
	# ----------------------------------------------------------------------------------------------------
	
	define('APP_NAME', "Quizsolution.in");

	# ----------------------------------------------------------------------------------------------------
	# DEFINE APP FOLDER
	# ----------------------------------------------------------------------------------------------------
	
	if($_SERVER['REMOTE_ADDR']=='127.0.0.1' || $_SERVER['REMOTE_ADDR']=='::1')
	{
	   define('APP_FOLDER', "/auto_responder/demo/");
	}
	else
	{
	   define('APP_FOLDER', "/shabaj/");
	}
	
	# ----------------------------------------------------------------------------------------------------
	# DEFINE APP ROOT
	# ----------------------------------------------------------------------------------------------------

	define('APP_ROOT', $_SERVER["DOCUMENT_ROOT"].APP_FOLDER);

	# ----------------------------------------------------------------------------------------------------
	# DEFINE DEFAULT URL
	# ----------------------------------------------------------------------------------------------------
	//print_r($_SERVER);
	//echo $checkHttp = $_SERVER['REQUEST_SCHEME'].'://';
	if($_SERVER['HTTPS'] == 'on')
	{
		$checkHttp = 'https://';
	}
	else
	{
		$checkHttp = 'http://';
	}
	//echo $checkHttp;
	define('APP_URL', $checkHttp.$_SERVER["HTTP_HOST"].APP_FOLDER);

	
try{
    $db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['username'], $config['password']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
   echo 'Connection failed: ' . $e->getMessage();
}
