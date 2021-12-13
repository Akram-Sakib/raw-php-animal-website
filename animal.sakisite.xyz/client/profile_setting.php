<?php
	include("header.php");
	include("sidebar.php");
	
	//$admin_info = $objAdmin->getUserInfo($uId);
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Profile Settings
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Profile Settings</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
			<div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <!--<li><a href="#general" data-toggle="tab">General Info</a></li>-->
                  <li class="active"><a href="#changPass" data-toggle="tab">Change Password</a></li>
                  
                </ul>
                <div class="tab-content">
                  <!--<div class="tab-pane" id="general">
						<form role="form" id="genInfoFrm">
							<input type="hidden" name="userId" value="<?php echo $uId; ?>" />
							<input type="hidden" name="act_type" value="gen_info" />
						  <div class="box-body">
							<div class="row">
								<div class="form-group col-md-6">
								  <label for="replyto_email">Login User Name</label>
								  <input type="text" class="form-control" name="user_name" id="user_name" placeholder="" value="<?php echo $admin_info['username']; ?>">
								</div>
								<div class="form-group col-md-6">
								  <label for="replyto_email">Email</label>
								  <input type="email" class="form-control" name="email" id="email" placeholder="" value="<?php echo $admin_info['email']; ?>">
								</div>
								<div class="form-group col-md-6">
								  <label for="replyto_email">Company Name</label>
								  <input type="text" class="form-control" name="comp_name" id="comp_name" placeholder="" value="<?php echo $admin_info['company_name']; ?>">
								</div>
								<div class="form-group col-md-6">
								  <label for="">Contact Person</small></label>
								  <input type="text" class="form-control" name="per_name" id="per_name" placeholder="" value="<?php echo $admin_info['acc_holder_name']; ?>">
								</div>
								<div class="form-group col-md-6">
								  <label for="">Designation</label>
								  <input type="text" class="form-control" id="designation" name="designation" placeholder="" value="<?php echo $admin_info['designation']; ?>">
								</div>
								
								<div class="form-group col-md-12">
								  <label for="msg_content">Profile Pic</label>
								  <div>
									<div class="file-input-wrapper">
									  <button class="btn btn-info btn-file-input" style="padding: 5px;cursor:pointer;">Upload image</button>
									  <input type="file" name="imgUpload" id="imgUpload" value="" style="position: absolute;top: 24px;opacity: 0;width: 93px;padding: 6px; pointer:cursor;">      
									</div>
									<div id="uploadedImages">
										<input type="hidden" name="" value="<?php echo $admin_info['prof_pic']; ?>" />
										<img src="<?php echo $admin_info['prof_pic']; ?>" style="height:70px; float:left; margin-right:5px;" />
									</div>
									</div>
								</div>
							</div>
							
						  </div>

						  <div class="box-footer">
							<button type="submit" class="btn btn-primary">Submit</button>
						  </div>
						</form>
                  </div>-->
                  <div class="tab-pane active" id="changPass">
						<form role="form" id="chgPassFrm">
							<input type="hidden" name="userId" value="<?php echo $uId; ?>" />
							<input type="hidden" name="act_type" value="change_pass" />
						  <div class="box-body">
							<div class="row">
								<div class="form-group col-md-6">
								  <label for="replyto_email">Old Password</label>
								  <input type="password" class="form-control" name="old_pass" id="old_pass" placeholder="" value="">
								</div>
								<div class="clearfix"></div>
								<div class="form-group col-md-6">
								  <label for="replyto_email">New Password</label>
								  <input type="password" class="form-control" name="new_pass" id="new_pass" placeholder="" value="">
								</div><div class="clearfix"></div>
								<div class="form-group col-md-6">
								  <label for="replyto_email">Confirm Password</label>
								  <input type="password" class="form-control" name="conf_pass" id="conf_pass" placeholder="" value="">
								</div>
								
							</div>
							
						  </div>

						  <div class="box-footer">
							<button type="submit" class="btn btn-primary">Change Password</button>
						  </div>
						</form>
                  </div><!-- /.tab-pane -->
                  
                </div>
              </div>
            </div>
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
	<script type="text/javascript">
	$('#imgUpload').change(function(){ 
		var oMyForm = new FormData();
		var files = $("#imgUpload").prop("files").length;
		
		for(var i=0; i<files; i++)
		{
			oMyForm.append("file", $("#imgUpload").prop("files")[i]);
			$.ajax({
				url: "upload.php?type=image&flag=userImg",
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
						$('#uploadedImages').html('<input type="hidden" name="prof_pic" value="'+response.txt+'"><img src="'+response.txt+'" style="height:70px; float:left; margin-right:5px;" />');
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
	
	$("#genInfoFrm").validate({
		rules: {
			user_name: "required",
			comp_name: "required",
			per_name: "required",
			designation: "required",
			email: {
                required: true,
                email: true
            }
		},
		submitHandler: function() { 
			
			$.ajax({
				type: "POST",
				url: "_ajax_user_actions.php",
				data: $("#genInfoFrm").serialize(),
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
	
	$("#chgPassFrm").validate({
		rules: {
			old_pass: {
                required: true,
                minlength: 6
            },
			new_pass: {
                required: true,
                minlength: 6
            },
			conf_pass: {
                required: true,
                equalTo: '#new_pass'
            }
		},
		submitHandler: function() { 
			
			$.ajax({
				type: "POST",
				url: "_ajax_user_actions.php",
				data: $("#chgPassFrm").serialize(),
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