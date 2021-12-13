<?php
	include("header.php");
	include("sidebar.php");
?>
	<style>
		.deleteAttach{
			position: absolute;
			color: red;
			border: 1px solid;
			border-radius: 100%;
			height: 17px;
			width: 17px;
			text-align: center;
			line-height: 1px;
			right: 5px;
			cursor:pointer;
		}
		.attchFile{
			width: 50px;
			float: left;
			margin-right: 5px;
			height: 33px;
			margin-bottom: 5px;
		}
	</style>
	<link rel="stylesheet" href="dist/css/upload.css">
	<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Reply Messages
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Reply Messages</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Reply Messages</h3>
				  <div class="pull-right">
					<a class="btn btn-primary btn-sm pull-right" href="add_replymsgs.php">Add Reply Message</a>
					</div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>SERIAL</th>
								<th>MESSAGE</th>
								<th>INTERVAL</th>
								<th>MAIL SETTINGS</th>
								<th>HITS</th>
								<th>ATTACHMENT</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$replyMsg = $objAdmin->getReplyMsgs($uId);
							//print_r($settings);
							$i = 1;
						foreach($replyMsg as $msg)
						{	
							$attch = $objAdmin->getAttachemnts($msg['id']);
							//print_r($attch);
						?>
						<tr id="row_<?php echo $msg['id'];?>">
							<td>Serial-<?php echo $msg['serial'];?></td>
							<td><?php echo $msg['message_body'];?></td>
							<td><?php echo $msg['msg_interval'];?></td>
							<td><?php echo $msg['from_name'].'/'.$msg['from_email'];?></td>
							<td><?php echo $msg['hits'];?></td>
							<td>
								<div id="at_<?php echo $msg['id'];?>">
									<?php
										foreach($attch as $aImg)
										{
									?>
									<div style="float:left; position:relative;" id="a_<?php echo $aImg['id']; ?>">	
										<img src="<?php echo APP_URL.$aImg['file_name']; ?>" class="attchFile">
										<div class="deleteAttach" title="Delete" rel="<?php echo $aImg['id']; ?>"><i class="fa fa-times"></i></div>
									</div>
									<?php
										}
									?>
								</div>
								<div class="clearfix"></div>
								<div class="file-input-wrapper">
								  <button class="btn btn-primary btn-file-input" style="padding: 5px;cursor:pointer;">Attachment</button>
								  <input type="file" name="imgUpload" id="attch_<?php echo $msg['id'];?>" class="imgUpload" rel="<?php echo $msg['id'];?>" value="" multiple>      
								</div>
								<div class="clearfix"></div>
							</td>
							
							<td><a class="edit_ques" href="add_replymsgs.php?id=<?php echo $msg['id'];?>" rel="<?php echo $msg['id'];?>" title="Edit"><span class="label label-primary"><i class="fa fa-edit"></i></span></a>&nbsp;&nbsp;<a href="javascript:void(0)" action="0" rel="<?php echo $msg['id'];?>" title="Delete" class="delete"><span class="label label-danger"><i class="fa fa-remove"></i></span></a></td>
							
						</tr>
						<?php
							$i++;
						}
						?>
						</tbody>
					</table>
                </div>
              </div><!-- /.box -->

            </div><!--/.col (left) -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
       <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	  <script type="text/javascript">
		$(function() {
			$("#example1").dataTable();
			
			$(document).on('click',".delete",function() {
				var did = $(this).attr('rel');
				
				if(confirm("Do you really want to delete this?"))
				{
					$.ajax({
						type: "POST",
						url: "_ajax_user_actions.php",
						data: 'delId='+did+'&act_type=delete_replymsg',
						cache: false,
						beforeSend:function() {
							//$("#searchinput").css('background','url("images/lightbox-ico-loading.gif") no-repeat scroll right center rgba(0, 0, 0, 0)');
						},
						success: function(html)
						{
							if(html.status == '1')
							{
								sweetalert('Success!', html.msg, 'success');
								$("#row_"+did).fadeOut(300);
							}
							else
							{
								sweetalert('Oops!', html.msg, 'error');
							}
							
						}
					});
				}
			});
			
			$(document).on('click',".deleteAttach",function() {
				var did = $(this).attr('rel');
				
				if(confirm("Do you really want to delete this?"))
				{
					$.ajax({
						type: "POST",
						url: "_ajax_user_actions.php",
						data: 'delId='+did+'&act_type=delete_MsgAttachment',
						cache: false,
						beforeSend:function() {
							//$("#searchinput").css('background','url("images/lightbox-ico-loading.gif") no-repeat scroll right center rgba(0, 0, 0, 0)');
						},
						success: function(html)
						{
							if(html.status == '1')
							{
								sweetalert('Success!', html.msg, 'success');
								$("#a_"+did).fadeOut(300);
							}
							else
							{
								sweetalert('Oops!', html.msg, 'error');
							}
							
						}
					});
				}
			});
		});
		
	$('.imgUpload').change(function(){ 
		var id = $(this).attr('rel');
		var oMyForm = new FormData();
		var files = $("#attch_"+id).prop("files").length;
		
		for(var i=0; i<files; i++)
		{
			oMyForm.append("file", $("#attch_"+id).prop("files")[i]);
			$.ajax({
				url: "attachment.php?type=msgAttach&flag=replyMsg&mid="+id,
				data: oMyForm,
				processData: false,
				contentType: false,
				type: 'POST',
				beforeSend:function()
				{
				   //$("#upld_exl_btn").hide();
				   //$("#upld_loader").show();
				},
				success: function(response) {
					//alert(response);
					//var newImg = "images/users/job_seeker/profile/"+response;
					if(response.status == '1')
					{
						//$('#upldMsg').attr('src',response.txt);
						$('#at_'+id).append('<img src="'+response.txt+'" class="attchFile" />');
						//$('#showImg').attr('src',response.txt);
					}
					else
					{
						alert(response.txt);
					}
				},
				error: function() {
					alert("unable to create the record");
				}
			});
		}
	});	
	</script>	
      <?php
		include("footer.php");
	?>