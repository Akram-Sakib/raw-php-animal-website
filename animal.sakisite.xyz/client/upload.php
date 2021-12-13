<?php 
	ob_start();
if($_GET['type'] == 'image')
{
	if($_GET['flag'] == 'userImg')
	{
		$path ='uploads/';
		
		@mkdir($path, 0777, true);
		
		$valid_formats = array('jpeg','jpg','JPG','png','PNG','gif');
		if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['file']['name'];
			$size = $_FILES['file']['size'];
			
			if(strlen($name))
			{
				list($txt, $ext) = explode(".", $name);
				if(in_array($ext,$valid_formats))
				{
				   $extension=$ext;
					$uploadedfile = $_FILES['file']['tmp_name'];
					$verifyToken=$txt."_".time();
					$actual_file_name = $verifyToken.".".$ext;
					$filename =$path.$actual_file_name;
					$temp=$_FILES['file']['tmp_name'];
					
					if(move_uploaded_file($temp,$filename))
					{
						$msg['txt'] = $filename;
						$msg['status'] = 1;
					}
					else
					{
						$msg['txt'] = 'Image is not uploaded, please contact to server admin.';
						$msg['status'] = 0;
					}						
				}
				else
				{
					$msg['txt'] = 'Please upload correct file type, only jpeg, jpg, png are allowed.';
					$msg['status'] = 0;
				}		
			}	
			else
			{
				$msg['txt'] = 'Please select file..!';
				$msg['status'] = 0;
			}
			header('Content-Type: application/x-json; charset=utf-8');
			$result = json_encode($msg);
			echo  $result;
		}
	}
}
?>