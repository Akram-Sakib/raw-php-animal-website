<?php
require 'config/init.php';

$leads = $objAdmin->getAllLeads('1');

$arrayCol = array('Leads Mail','From Name', 'Time', 'Serial', 'Status');

$columnHeader ='';
$columnHeader = "Leads Mail"."\t"."From Name"."\t"."Time"."\t"."Serial"."\t"."Status"."\t";
 
 
$value1='';
$setData='';
foreach($leads as $key=>$row)
{
	//echo '<br/>'.$key.'=>'.$row;
  $rowData = '';
  foreach($row as $key=>$value)
  {
	if($key == 'email' || $key == 'name' || $key == 'time' || $key == 'serial' || $key == 'status')
	{
		//echo $key.'<br>';
		if($key != '0')
		{
			if($key == 'time')
			{
				$value = date('d-m-Y H:i', $value);
				$value1 = '"' . $value . '"' . "\t";
			}
			else if($key == 'status')
			{
				$value = 'Waiting';
				if($value == '1')
				{
					$value = 'Sent';
				}
				$value1 = '"' . $value . '"' . "\t";
			}
			else
			{
				$value1 = '"' . $value . '"' . "\t";
			}
			$rowData .= $value1;
		}
	}
	//echo '<br/>'.$key.'=>'.$value;
  }
  $setData .= trim($rowData)."\n";
}
//die; 

if($_GET['t'] == 'csv' || $_GET['t'] == 'excel')
{
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=Leads.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	 
	echo ucwords($columnHeader)."\n".$setData."\n";
}
else if($_GET['t'] == 'txt')
{
	$myfile = fopen("leads.txt", "w") or die("Unable to open file!");
	$txt = ucwords($columnHeader)."\n".$setData."\n";
	fwrite($myfile, $txt);
	fclose($myfile);

	/* $handle = fopen("leads.txt", "w");
    fwrite($handle, "text1.....");
    fclose($handle); */

    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename('leads.txt'));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize('leads.txt'));
    readfile('leads.txt');
    exit;
}
die;
 
?>