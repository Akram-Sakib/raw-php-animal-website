<?php
	include("header.php");
	include("sidebar.php");
	
	$id = $_GET['id'];
	$replyMsg = $objAdmin->getReplyMsgById($id);
	
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Reply Message
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Reply Message</li>
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
                <form role="form" id="replymsg_frm">
					<input type="hidden" name="userId" value="<?php echo $uId; ?>" />
					<input type="hidden" name="act_type" value="add_reply_msg" />
					<input type="hidden" name="editId" value="<?php echo $id; ?>" />
                  <div class="box-body">
					<div class="row">
						<div class="form-group col-md-6">
						  <label for="from_email">Serial</label>
						  <input type="number" class="form-control" id="serial" name="serial" placeholder="Serial" value="<?php echo $replyMsg['serial']; ?>">
						</div>
						<div class="form-group col-md-6">
						  <label for="from_name">Subject <small>(Optional for Reply/Mandatory for 1way Sending)</small></label>
						  <input type="text" class="form-control" name="subj" id="subj" placeholder="Subject" value="<?php echo $replyMsg['subject']; ?>">
						</div>
						<div class="form-group col-md-6">
						  <label for="replyto_email">Interval (Minutes)</label>
						  <input type="number" class="form-control" name="interval" id="interval" placeholder="Interval" value="<?php echo $replyMsg['msg_interval']; ?>">
						</div>
						
						<div class="form-group col-md-6">
						  <label for="send_limit">Mail Setting (Frommail/Replyto)</label>
						  <?php
							$settings = $objAdmin->getMailSettings($uId);
						  ?>
						  <select class="form-control" name="mail_setting" id="mail_setting">
							<option value="">Select</option>
							<?php
								foreach($settings as $setting)
								{
									$check = '';
									if($replyMsg['mail_setting_id'] == $setting['id'])
									{
										$check = 'selected';
									}
							?>
								<option value="<?php echo $setting['id'];?>" <?php echo $check; ?>><?php echo $setting['from_name'].'/'.$setting['from_email'].'/'.$setting['replyto_email'];?></option>
							<?php
								}
							?>
						  </select>
						</div>
						<div class="form-group col-md-12">
						  <label for="msg_content">Message Content</label>
						  <textarea class="form-control" name="msg_content" id="msg_content" placeholder=""><?php echo $replyMsg['message_body']; ?></textarea>
						  <label><small>First Name = #firstname# , Last Name = #lastname# , Lead Mail = #youremail# , Today (dayname) = #todayis#</small></label>
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
	  <!--<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>-->
	  <script src="<?php echo APP_URL; ?>plugins/ckeditor_4.4.5_full/ckeditor/ckeditor.js"></script>
	<script type="text/javascript">
	//CKEDITOR.replace('msg_content');
	var titleEditor = CKEDITOR.replace( 'msg_content', {
		width:'auto',
		height:200,
		startupFocus : false,
		customConfig: '<?php echo APP_URL; ?>plugins/ckeditor_4.4.5_full/ckeditor/ckeditor_customconfig/ckeditor_config.js'
	});

	$("#replymsg_frm").validate({
		rules: {
			serial: "required",
			subj: "required",
			interval: "required",
			mail_setting: "required",
			msg_content: "required"
		},
		submitHandler: function() { 
			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}
			$.ajax({
				type: "POST",
				url: "_ajax_user_actions.php",
				data: $("#replymsg_frm").serialize(),
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