<?php
	include("header.php");
	include("sidebar.php");
	
	$id = $_GET['id'];
	$followupMsg = $objAdmin->getFollowupMsgById($id);
	//print_r($followupMsg);
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Follow Up Message
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Follow Up Message</li>
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
                <form role="form" id="followup_frm">
					<input type="hidden" name="userId" value="<?php echo $uId; ?>" />
					<input type="hidden" name="act_type" value="add_followup_msg" />
					<input type="hidden" name="editId" value="<?php echo $id; ?>" />
                  <div class="box-body">
					<div class="row">
						<div class="form-group col-md-6">
						  <label for="replyto_email">Interval (Minutes)</label>
						  <input type="number" class="form-control" name="interval" id="interval" placeholder="Interval" value="<?php echo $followupMsg['msg_interval']; ?>">
						</div>
						<div class="form-group col-md-6">
						  <label for="">Subject <small>(Mandatory)</small></label>
						  <input type="text" class="form-control" name="subj" id="subj" placeholder="Subject" value="<?php echo $followupMsg['subject']; ?>">
						</div>
						<div class="form-group col-md-6">
						  <label for="">From Name</label>
						  <input type="text" class="form-control" id="from_name" name="from_name" placeholder="" value="<?php echo $followupMsg['fromname']; ?>">
						</div>
						<div class="form-group col-md-6">
						  <label for="">Reply To</label>
						  <input type="email" class="form-control" id="reply_to" name="reply_to" placeholder="" value="<?php echo $followupMsg['replyto']; ?>">
						</div>
						<div class="form-group col-md-6">
						  <label for="">From Email</label>
						  <input type="email" class="form-control" id="from_email" name="from_email" placeholder="" value="<?php echo $followupMsg['fromemail']; ?>">
						</div>
						<div class="form-group col-md-6">
						  <label for="send_limit">Mail Setting (From mail/Reply to)</label>
						  <?php
							$settings = $objAdmin->getMailSettings($uId);
						  ?>
						  <select class="form-control" name="mail_setting" id="mail_setting">
							<option value="">Select</option>
							<?php
								foreach($settings as $setting)
								{
									$check = '';
									if($followupMsg['mail_setting_id'] == $setting['id'])
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
						  <textarea class="form-control" name="msg_content" id="msg_content" placeholder=""><?php echo $followupMsg['message_body']; ?></textarea>
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

	  <script src="<?php echo APP_URL; ?>plugins/ckeditor_4.4.5_full/ckeditor/ckeditor.js"></script>
	<script type="text/javascript">
	//CKEDITOR.replace('msg_content');
	var titleEditor = CKEDITOR.replace( 'msg_content', {
		width:'auto',
		height:200,
		startupFocus : false,
		customConfig: '<?php echo APP_URL; ?>plugins/ckeditor_4.4.5_full/ckeditor/ckeditor_customconfig/ckeditor_config.js'
	});
	
	$("#followup_frm").validate({
		rules: {
			from_name: "required",
			subj: "required",
			interval: "required",
			mail_setting: "required",
			from_name: "required",
			reply_to: {
                required: true,
                email: true
            },
			from_email: {
                required: true,
                email: true
            },
			msg_content: "required"
		},
		submitHandler: function() { 
			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}
			$.ajax({
				type: "POST",
				url: "_ajax_user_actions.php",
				data: $("#followup_frm").serialize(),
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