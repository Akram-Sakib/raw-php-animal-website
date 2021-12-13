<?php
	include("header.php");
	include("sidebar.php");
	
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Clear Leads
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Clear Leads</li>
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
                  <h3 class="box-title">Clean Leads</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="cleanLeadFrm">
					<input type="hidden" name="act_type" value="clean_leads" />
                  <div class="box-body">
					<div class="row">
						<div class="form-group col-md-6">
						  <button type="submit" class="btn btn-primary">Clean</button>
						</div>
                    </div>
                  </div><!-- /.box-body -->
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
						  <p>Clean leads will be: Delete All Leads History</p>
						</div>
						
                    </div>
                    
                  </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div>
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	<script type="text/javascript">
	
	$("#cleanLeadFrm").validate({
		rules: {
			limit: "required"
		},
		submitHandler: function() { 
			if(confirm("Do you really want to clean all leads?"))
			{
				$.ajax({
					type: "POST",
					url: "_ajax_user_actions.php",
					data: $("#cleanLeadFrm").serialize(),
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
		}
	});
	
	
</script>
<?php
include("footer.php");
?>