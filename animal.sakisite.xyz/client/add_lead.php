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
            Inset Lead
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Inset Lead</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                
                <form role="form" id="lead_frm">
					<input type="hidden" name="userId" value="<?php echo $uId; ?>" />
					<input type="hidden" name="act_type" value="add_lead" />
					<input type="hidden" name="editId" value="<?php echo $id; ?>" />
                  <div class="box-body">
					<div class="row">
						
						<div class="form-group col-md-12">
						  <label for="msg_content">Add Content</label>
						  <input type="text" class="form-control" name="leads" id="leads" value="" />
						  <!--<textarea class="form-control" name="leads" id="leads" placeholder=""><?php echo $replyMsg['message_body']; ?></textarea>
						  <label><small>First Name = #firstname# , Last Name = #lastname# , Lead Mail = #youremail# , Today (dayname) = #todayis#</small></label>-->
						</div>
                    </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
					<button type="submit" class="btn btn-primary">Save Lead</button>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="manage_leads.php" class="btn btn-default">Go To Manage Leads</a>
                    
                  </div>
                </form>
              </div><!-- /.box -->

            </div><!--/.col (left) -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
	<script type="text/javascript">
	//CKEDITOR.replace('msg_content');
	$("#lead_frm").validate({
		rules: {
			leads: {
                required: true,
                email: true
            }
		},
		submitHandler: function() { 
			
			$.ajax({
				type: "POST",
				url: "_ajax_user_actions.php",
				data: $("#lead_frm").serialize(),
				cache: false,
				beforeSend:function() {
					//$("#searchinput").css('background','url("images/lightbox-ico-loading.gif") no-repeat scroll right center rgba(0, 0, 0, 0)');
				},
				success: function(html)
				{
					if(html.status == '1')
					{
						$("#leads").val('');
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