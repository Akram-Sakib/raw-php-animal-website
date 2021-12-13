<?php
	include("header.php");
	include("sidebar.php");
?>
	<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mail Settings 
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mail Settings</li>
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
                  <h3 class="box-title">Mail Settings</h3>
				  <div class="pull-right">
					<a class="btn btn-primary btn-sm pull-right" href="add_mail_setting.php">Add Mail Settings</a>
					</div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>S.No.</th>
								<th>SMTP User</th>
								<!--<th>Password</th>-->
								<th>Host Name</th>
								<th>PORT</th>
								<th>From Name</th>
								<th>From Email</th>
								<th>Reply to Email</th>
								<th>Sending Limit</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$settings = $objAdmin->getMailSettings($uId);
							//print_r($settings);
							$i = 1;
						foreach($settings as $setting)
						{	
						?>
						<tr id="row_<?php echo $setting['id'];?>">
							<td><?php echo $i;?></td>
							<td><?php echo $setting['smtp_user'];?></td>
							<!--<td><?php //echo $setting['smtp_pass'];?></td>-->
							<td><?php echo $setting['hostname'];?></td>
							<td><?php echo $setting['port'];?></td>
							<td><?php echo $setting['from_name'];?></td>
							<td><?php echo $setting['from_email'];?></td>
							<td><?php echo $setting['replyto_email'];?></td>
							<td><?php echo $setting['sending_limit'];?></td>
							
							<td><a class="edit_ques" href="add_mail_setting.php?id=<?php echo $setting['id'];?>" rel="<?php echo $setting['id'];?>" title="Edit"><span class="label label-primary"><i class="fa fa-edit"></i></span></a>&nbsp;&nbsp;<a href="javascript:void(0)" action="0" rel="<?php echo $setting['id'];?>" title="Delete" class="delSettings"><span class="label label-danger"><i class="fa fa-remove"></i></span></a></td>
							
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
			
			$(".delSettings").click(function() {
				var did = $(this).attr('rel');
				
				if(confirm("Do you really want to delete this?"))
				{
					$.ajax({
						type: "POST",
						url: "_ajax_user_actions.php",
						data: 'delId='+did+'&act_type=delete_setting',
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
		});
	</script>	
      <?php
		include("footer.php");
	?>