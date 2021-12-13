<?php
	include("header.php");
	include("sidebar.php");
	
	$id = $_GET['id'];
	$sendingLimit = $objAdmin->getSendLimit();
	if(!$sendingLimit)
	{
		$sendingLimit = 1;
	}
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Set Limit
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Set Limit</li>
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
                <form role="form" id="sendLimitFrm">
					<input type="hidden" name="userId" value="<?php echo $uId; ?>" />
					<input type="hidden" name="act_type" value="send_limit" />
					<input type="hidden" name="editId" value="<?php echo $id; ?>" />
                  <div class="box-body">
					<div class="row">
						<div class="form-group col-md-6">
						  <label for="from_email">Set Limit</label>
						  <input type="text" class="form-control" id="limit" name="limit" placeholder="Limit" value="<?php echo $sendingLimit; ?>">
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
						  <p>Per Day Limit Set</p>
						</div>
						
                    </div>
                    
                  </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div>
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	<script type="text/javascript">
	
	$("#sendLimitFrm").validate({
		rules: {
			limit: "required"
		},
		submitHandler: function() { 
			$.ajax({
				type: "POST",
				url: "_ajax_user_actions.php",
				data: $("#sendLimitFrm").serialize(),
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