<?php
	include("header.php");
	include("sidebar.php");
	
	$id = $_GET['id'];
	$mailSetting = $objAdmin->getMailSettingById($id);
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Mail Settings 
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Mail Settings</li>
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
                  <h3 class="box-title">Fill up Below Fields</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="email_setting_frm">
					<input type="hidden" name="userId" value="<?php echo $uId; ?>" />
					<input type="hidden" name="act_type" value="add_mail_setting" />
					<input type="hidden" name="editId" value="<?php echo $id; ?>" />
                  <div class="box-body">
					<div class="row">
						<div class="form-group col-md-6">
						  <label for="from_email">SMTP Username</label>
						  <input type="email" class="form-control" id="smtp_user" name="smtp_user" placeholder="SMTP Username" value="<?php echo $mailSetting['smtp_user']; ?>">
						</div>
						<div class="form-group col-md-6">
						  <label for="from_email">SMTP Password</label>
						  <input type="text" class="form-control" id="smtp_pass" name="smtp_pass" placeholder="SMTP Password" value="<?php echo $mailSetting['smtp_pass']; ?>">
						</div>
						<div class="form-group col-md-6">
						  <label for="from_email">From Email</label>
						  <input type="email" class="form-control" id="from_email" name="from_email" placeholder="From email" value="<?php echo $mailSetting['from_email']; ?>">
						</div>
						<div class="form-group col-md-6">
						  <label for="from_name">From Name</label>
						  <input type="text" class="form-control" name="from_name" id="from_name" placeholder="From Name" value="<?php echo $mailSetting['from_name']; ?>">
						</div>
						<div class="form-group col-md-6">
						  <label for="replyto_email">Reply to Email</label>
						  <input type="text" class="form-control" name="replyto_email" id="replyto_email" placeholder="Reply to email" value="<?php echo $mailSetting['replyto_email']; ?>">
						</div>
						
						<div class="form-group col-md-6">
						  <label for="send_limit">Sending Limit</label>
						  <input type="text" class="form-control" name="send_limit" id="send_limit" placeholder="Sending Limit" value="<?php echo $mailSetting['sending_limit']; ?>">
						</div>
						<div class="form-group col-md-6">
						  <label for="send_limit">Hostname</label>
						  <input type="text" class="form-control" name="host_name" id="host_name" placeholder="Host Name" value="<?php echo $mailSetting['hostname']; ?>">
						</div>
						<div class="form-group col-md-6">
						  <label for="send_limit">PORT</label>
						  <input type="number" class="form-control" name="port" id="port" placeholder="PORT" value="<?php echo $mailSetting['port']; ?>">
						</div>
                    </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->

            </div><!--/.col (left) -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	<script type="text/javascript">
	
	$("#email_setting_frm").validate({
		rules: {
			from_name: "required",
			smtp_user: "required",
			smtp_pass: "required",
			host_name: "required",
			port: "required",
			from_email: {
                required: true,
                email: true
            },
			replyto_email: {
                required: true,
                email: true
            },
			send_limit: "required"
		},
		messages: {
			from_email: "Please enter from email",
			from_name: "Please enter from name",
			replyto_email: "Please enter reply to email",
			send_limit: "Please enter sending limit"
		},
		submitHandler: function() { 
			
			$.ajax({
				type: "POST",
				url: "_ajax_user_actions.php",
				data: $("#email_setting_frm").serialize(),
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
	
</script>
<?php
include("footer.php");
?>