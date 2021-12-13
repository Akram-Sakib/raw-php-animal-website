<?php
	include("header.php");
	include("sidebar.php");
	
	$id = $_GET['id'];
	if(isset($_GET['id']))
	{
		$bWord = $objAdmin->getBlackWordById($id);
	}
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Blacklist
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Blacklist</li>
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
                <form role="form" id="blackWordFrm">
					<input type="hidden" name="userId" value="<?php echo $uId; ?>" />
					<input type="hidden" name="act_type" value="blackWord_setting" />
					<input type="hidden" name="editId" value="<?php echo $id; ?>" />
                  <div class="box-body">
					<div class="row">
						<div class="form-group col-md-6">
						  <label for="from_email">Blackliste Matchword</label>
						  <input type="text" class="form-control" id="blacklist" name="blacklist" placeholder="Keyword" value="<?php echo $bWord['matchword']; ?>">
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
						  <p>Black list that type of word to which no email will be sent it may be after @ or before @.</p>
						</div>
						
                    </div>
                    
                  </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div>
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Matched Keywords</h3>
				  
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>MATCHWORD</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$keywords = $objAdmin->getBlackKeywords();
							//print_r($settings);
							$i = 1;
						foreach($keywords as $matchkeyword)
						{	
						?>
						<tr id="row_<?php echo $matchkeyword['id'];?>">
							<td><?php echo $matchkeyword['matchword'];?></td>
							
							<td><a class="edit_ques" href="black_list.php?id=<?php echo $matchkeyword['id'];?>" rel="<?php echo $setting['id'];?>" title="Edit"><span class="label label-primary"><i class="fa fa-edit"></i></span></a>&nbsp;&nbsp;<a href="javascript:void(0)" action="0" rel="<?php echo $matchkeyword['id'];?>" title="Delete" class="delSettings"><span class="label label-danger"><i class="fa fa-remove"></i></span></a></td>
							
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
	
	$("#blackWordFrm").validate({
		rules: {
			blacklist: "required"
		},
		submitHandler: function() { 
			$.ajax({
				type: "POST",
				url: "_ajax_user_actions.php",
				data: $("#blackWordFrm").serialize(),
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
				data: 'delId='+did+'&act_type=delete_blackWord',
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