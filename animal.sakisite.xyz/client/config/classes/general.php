<?php 
class General{

	public function logged_in () {
		return(isset($_SESSION['uId'])) ? true : false;
	}
    public function logged_in_admin () {
		return(isset($_SESSION['adminId'])) ? true : false;
	}
    public function logged_in_protect_admin() {
		if ($this->logged_in_admin() === true) {
			header('Location:'.APP_URL.APP_FOLDER.'/travler/index.php');
			exit();		
		}
	}
	public function logged_in_protect() {
		if ($this->logged_in() === true) {
			header('Location: home.php');
			exit();		
		}
	}
	 
	public function logged_out_protect() {
		if ($this->logged_in() === false) {
			header('Location: index.php');
			exit();
		}	
	}
	
	public function file_newpath($path, $filename){
		if ($pos = strrpos($filename, '.')) {
		   $name = substr($filename, 0, $pos);
		   $ext = substr($filename, $pos);
		} else {
		   $name = $filename;
		}
		
		$newpath = $path.'/'.$filename;
		$newname = $filename;
		$counter = 0;
		
		while (file_exists($newpath)) {
		   $newname = $name .'_'. $counter . $ext;
		   $newpath = $path.'/'.$newname;
		   $counter++;
		}
		
		return $newpath;
	}
}