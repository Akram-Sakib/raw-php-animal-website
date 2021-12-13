<?php
	include("header.php");
	include("sidebar.php");
	
	$id = $_GET['id'];
	if(isset($_GET['id']))
	{
		$incMails = $objAdmin->getIncMailSettingById($id);
	}
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Incoming Mail
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Incoming Mail</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Fill up Below Fields</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="inc_mail_frm">
					<input type="hidden" name="userId" value="<?php echo $uId; ?>" />
					<input type="hidden" name="act_type" value="inc_mail_setting" />
					<input type="hidden" name="editId" value="<?php echo $id; ?>" />
                  <div class="box-body">
					<div class="row">
						<div class="form-group col-md-6">
						  <label for="from_email">Incoming Mail</label>
						  <input type="email" class="form-control" id="inc_mail" name="inc_mail" placeholder="Incoming email" value="<?php echo $incMails['email']; ?>">
						</div>
						<div class="form-group col-md-6">
						  <label for="from_name">Mail Password</label>
						  <input type="text" class="form-control" name="mail_pass" id="mail_pass" placeholder="Mail Password" value="<?php echo $incMails['password']; ?>">
						</div>
						
						<div class="form-group col-md-6">
						  <label for="send_limit">Hostname</label>
						  <input type="text" class="form-control" name="host_name" id="host_name" placeholder="Hostname" value="<?php echo $incMails['host']; ?>">
						</div>
						<div class="form-group col-md-6">
						  <label for="send_limit">PORT</label>
						  <input type="number" class="form-control" name="port" id="port" placeholder="Port" value="<?php echo $incMails['port']; ?>">
						</div>
                    </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->

            </div>
			<div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Instructions</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                  <div class="box-body">
					<div class="row">
						<div class="form-group col-md-12">
						  <p>Incoming Mail is the IMAP/POP Mail from where Leads will be collected for further reply. Its called Mastermail also.</p>
						  <p>Try to Forward Gmail/yahoo/hotmail to the webmail. Its realiable to collect lead from webmail. If add gmail always try to add SSL PORT and host for Imap connection.</p>
						  <p>From gmail must need to set Imap enabled, Less secure apps enable, and do not set 2step verification.</p>
						  <p>There are no limit to receive leads from master mail.</p>
						  <p>Follow our youtube video to understand more clearly</p>
						</div>
						
                    </div>
                    
                  </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div>
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Mail Settings</h3>
				  
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>S.No.</th>
								<th>EMAIL</th>
								<!--<th>PASSWORD</th>-->
								<th>HOSTNAME</th>
								<th>PORT</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$settings = $objAdmin->getIncMailSettings($uId);
							//print_r($settings);
							$i = 1;
						foreach($settings as $setting)
						{	
						?>
						<tr id="row_<?php echo $setting['id'];?>">
							<td><?php echo $i;?></td>
							<td><?php echo $setting['email'];?></td>
							<!--<td><?php //echo $setting['password'];?></td>-->
							<td><?php echo $setting['host'];?></td>
							<td><?php echo $setting['port'];?></td>
							
							<td><a class="edit_ques" href="incoming_mails.php?id=<?php echo $setting['id'];?>" rel="<?php echo $setting['id'];?>" title="Edit"><span class="label label-primary"><i class="fa fa-edit"></i></span></a>&nbsp;&nbsp;<a href="javascript:void(0)" action="0" rel="<?php echo $setting['id'];?>" title="Delete" class="delSettings"><span class="label label-danger"><i class="fa fa-remove"></i></span></a></td>
							
						</tr>
						<?php
							$i++;
						}
						?>
						</tbody>
					</table>
                </div>
              </div><!-- /.box -->

            </div>
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	<script type="text/javascript">
	
	$("#inc_mail_frm").validate({
		rules: {
			password: "required",
			inc_mail: {
                required: true,
                email: true
            },
			port: "required",
			host_name: "required"
		},
		submitHandler: function() { 
			$.ajax({
				type: "POST",
				url: "_ajax_user_actions.php",
				data: $("#inc_mail_frm").serialize(),
				cache: false,
				beforeSend:function() {
					//$("#searchinput").css('background','url("images/lightbox-ico-loading.gif") no-repeat scroll right center rgba(0, 0, 0, 0)');
				},
				success: function(html)
				{
					if(html.status == '1')
					{
						sweetalert('Success!', html.msg, 'success');
					}
					else
					{
						sweetalert('Oops!', html.msg, 'error');
					}
				}
			}); 
		}
	});
	
	$(".delSettings").click(function() {
		var did = $(this).attr('rel');
		
		if(confirm("Do you really want to delete this?"))
		{
			$.ajax({
				type: "POST",
				url: "_ajax_user_actions.php",
				data: 'delId='+did+'&act_type=delete_incMail',
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
	
</script>
<?php
include("footer.php");
?>