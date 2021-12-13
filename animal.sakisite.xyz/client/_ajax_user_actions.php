<?php
require 'config/init.php';
extract($_POST);

if($act_type=='inc_mail_setting')
{
	$addSettings = $objAdmin->add_incMail_settings($_POST);
	if($addSettings)
	{
		$html['status'] ='1';
		$html['msg'] = '<div class="alert alert-success alert-dismissible">Information Saved Successfully.</div>';
	}
	else
	{
		$html['status'] ='0';
		$html['msg'] = "<div class='alert alert-danger' style='text-align:center;'>Something is went wrong.</div>";	
	}
	
	header('Content-Type: application/x-json; charset=utf-8');
	$result = json_encode($html);
	echo  $result;
}
if($act_type=='add_mail_setting')
{
	$addSettings = $objAdmin->add_mail_settings($_POST);
	if($addSettings)
	{
		$html['status'] ='1';
		$html['msg'] = '<div class="alert alert-success alert-dismissible">Information Saved Successfully.</div>';
	}
	else
	{
		$html['status'] ='0';
		$html['msg'] = "<div class='alert alert-danger' style='text-align:center;'>Something is went wrong.</div>";	
	}
	
	header('Content-Type: application/x-json; charset=utf-8');
	$result = json_encode($html);
	echo  $result;
}
if($act_type=='delete_incMail')
{
	$delSettings = $objAdmin->delete_incMail_settings($delId);
	if($delSettings)
	{
		$html['status'] ='1';
		$html['msg'] = '<div class="alert alert-success alert-dismissible">Setting Deleted Successfully.</div>';
	}
	else
	{
		$html['status'] ='0';
		$html['msg'] = "<div class='alert alert-danger' style='text-align:center;'>Something is went wrong.</div>";	
	}
	
	header('Content-Type: application/x-json; charset=utf-8');
	$result = json_encode($html);
	echo  $result;
}
if($act_type=='delete_setting')
{
	$delSettings = $objAdmin->delete_mail_settings($delId);
	if($delSettings)
	{
		$html['status'] ='1';
		$html['msg'] = '<div class="alert alert-success alert-dismissible">Setting Deleted Successfully.</div>';
	}
	else
	{
		$html['status'] ='0';
		$html['msg'] = "<div class='alert alert-danger' style='text-align:center;'>Something is went wrong.</div>";	
	}
	
	header('Content-Type: application/x-json; charset=utf-8');
	$result = json_encode($html);
	echo  $result;
}
if($act_type=='add_reply_msg')
{
	$addSettings = $objAdmin->add_replyMsg($_POST);
	if($addSettings)
	{
		$html['status'] ='1';
		$html['msg'] = '<div class="alert alert-success alert-dismissible">Information Saved Successfully.</div>';
	}
	else
	{
		$html['status'] ='0';
		$html['msg'] = "<div class='alert alert-danger' style='text-align:center;'>Something is went wrong.</div>";	
	}
	
	header('Content-Type: application/x-json; charset=utf-8');
	$result = json_encode($html);
	echo  $result;
}
if($act_type=='add_lead')
{
	$addSettings = $objAdmin->add_lead($_POST);
	if($addSettings)
	{
		$html['status'] ='1';
		$html['msg'] = '<div class="alert alert-success alert-dismissible">Information Saved Successfully.</div>';
	}
	else
	{
		$html['status'] ='0';
		$html['msg'] = "<div class='alert alert-danger' style='text-align:center;'>Something is went wrong.</div>";	
	}
	
	header('Content-Type: application/x-json; charset=utf-8');
	$result = json_encode($html);
	echo  $result;
}
if($act_type=='deleteLead')
{
	$delete = $objAdmin->delete_leads($delId);
	if($delete)
	{
		$html['status'] ='1';
		$html['msg'] = '<div class="alert alert-success alert-dismissible">Setting Deleted Successfully.</div>';
	}
	else
	{
		$html['status'] ='0';
		$html['msg'] = "<div class='alert alert-danger' style='text-align:center;'>Something is went wrong.</div>";	
	}
	
	header('Content-Type: application/x-json; charset=utf-8');
	$result = json_encode($html);
	echo  $result;
}
if($act_type=='delete_replymsg')
{
	$delete = $objAdmin->delete_replyMsgs($delId);
	if($delete)
	{
		$html['status'] ='1';
		$html['msg'] = '<div class="alert alert-success alert-dismissible">Setting Deleted Successfully.</div>';
	}
	else
	{
		$html['status'] ='0';
		$html['msg'] = "<div class='alert alert-danger' style='text-align:center;'>Something is went wrong.</div>";	
	}
	
	header('Content-Type: application/x-json; charset=utf-8');
	$result = json_encode($html);
	echo  $result;
}
if($act_type=='add_followup_msg')
{
	$addSettings = $objAdmin->add_followupMsg($_POST);
	if($addSettings)
	{
		$html['status'] ='1';
		$html['msg'] = '<div class="alert alert-success alert-dismissible">Information Saved Successfully.</div>';
	}
	else
	{
		$html['status'] ='0';
		$html['msg'] = "<div class='alert alert-danger' style='text-align:center;'>Something is went wrong.</div>";	
	}
	
	header('Content-Type: application/x-json; charset=utf-8');
	$result = json_encode($html);
	echo  $result;
}
if($act_type=='delete_followup')
{
	$delete = $objAdmin->delete_followupMsgs($delId);
	if($delete)
	{
		$html['status'] ='1';
		$html['msg'] = '<div class="alert alert-success alert-dismissible">Setting Deleted Successfully.</div>';
	}
	else
	{
		$html['status'] ='0';
		$html['msg'] = "<div class='alert alert-danger' style='text-align:center;'>Something is went wrong.</div>";	
	}
	
	header('Content-Type: application/x-json; charset=utf-8');
	$result = json_encode($html);
	echo  $result;
}
if($act_type=='blackWord_setting')
{
	$addSettings = $objAdmin->add_blackWord($_POST);
	if($addSettings)
	{
		$html['status'] ='1';
		$html['msg'] = '<div class="alert alert-success alert-dismissible">Information Saved Successfully.</div>';
	}
	else
	{
		$html['status'] ='0';
		$html['msg'] = "<div class='alert alert-danger' style='text-align:center;'>Something is went wrong.</div>";	
	}
	
	header('Content-Type: application/x-json; charset=utf-8');
	$result = json_encode($html);
	echo  $result;
}
if($act_type=='delete_blackWord')
{
	$delete = $objAdmin->delete_blackWord($delId);
	if($delete)
	{
		$html['status'] ='1';
		$html['msg'] = '<div class="alert alert-success alert-dismissible">Setting Deleted Successfully.</div>';
	}
	else
	{
		$html['status'] ='0';
		$html['msg'] = "<div class='alert alert-danger' style='text-align:center;'>Something is went wrong.</div>";	
	}
	
	header('Content-Type: application/x-json; charset=utf-8');
	$result = json_encode($html);
	echo  $result;
}
if($act_type=='send_limit')
{
	$upd = $objAdmin->update_sendLimit($limit);
	if($upd)
	{
		$html['status'] ='1';
		$html['msg'] = '<div class="alert alert-success alert-dismissible">Updated Successfully.</div>';
	}
	else
	{
		$html['status'] ='0';
		$html['msg'] = "<div class='alert alert-danger' style='text-align:center;'>Something is went wrong.</div>";	
	}
	
	header('Content-Type: application/x-json; charset=utf-8');
	$result = json_encode($html);
	echo  $result;
}
if($act_type=='clean_leads')
{
	$upd = $objAdmin->cleanLeads();
	if($upd)
	{
		$html['status'] ='1';
		$html['msg'] = '<div class="alert alert-success alert-dismissible">All Leads Deleted Successfully.</div>';
	}
	else
	{
		$html['status'] ='0';
		$html['msg'] = "<div class='alert alert-danger' style='text-align:center;'>Something is went wrong.</div>";	
	}
	
	header('Content-Type: application/x-json; charset=utf-8');
	$result = json_encode($html);
	echo  $result;
}
if($act_type=='reset_system')
{
	$upd = $objAdmin->resetSystem();
	if($upd)
	{
		$html['status'] ='1';
		$html['msg'] = '<div class="alert alert-success alert-dismissible">All Data Deleted Successfully.</div>';
	}
	else
	{
		$html['status'] ='0';
		$html['msg'] = "<div class='alert alert-danger' style='text-align:center;'>Something is went wrong.</div>";	
	}
	
	header('Content-Type: application/x-json; charset=utf-8');
	$result = json_encode($html);
	echo  $result;
}

if($act_type=='delete_MsgAttachment')
{
	$delete = $objAdmin->delete_attachment($delId);
	if($delete)
	{
		$html['status'] ='1';
		$html['msg'] = '<div class="alert alert-success alert-dismissible">Setting Deleted Successfully.</div>';
	}
	else
	{
		$html['status'] ='0';
		$html['msg'] = "<div class='alert alert-danger' style='text-align:center;'>Something is went wrong.</div>";	
	}
	
	header('Content-Type: application/x-json; charset=utf-8');
	$result = json_encode($html);
	echo  $result;
}

if($act_type=='gen_info')
{
	$addSettings = $objAdmin->upd_gen_info($_POST);
	if($addSettings)
	{
		$html['status'] ='1';
		$html['msg'] = '<div class="alert alert-success alert-dismissible">Information Saved Successfully.</div>';
	}
	else
	{
		$html['status'] ='0';
		$html['msg'] = "<div class='alert alert-danger' style='text-align:center;'>Something is went wrong.</div>";	
	}
	
	header('Content-Type: application/x-json; charset=utf-8');
	$result = json_encode($html);
	echo  $result;
}
if($act_type=='change_pass')
{
	$addSettings = $objAdmin->change_password($userId, $old_pass, $conf_pass);
	if($addSettings)
	{
		$html['status'] ='1';
		$html['msg'] = '<div class="alert alert-success alert-dismissible">Password Changed Successfully.</div>';
	}
	else
	{
		$html['status'] ='0';
		$html['msg'] = "<div class='alert alert-danger' style='text-align:center;'>Old password did not matched.</div>";	
	}
	
	header('Content-Type: application/x-json; charset=utf-8');
	$result = json_encode($html);
	echo  $result;
}
?>