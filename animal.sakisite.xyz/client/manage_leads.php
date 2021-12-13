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
            Manage Leads
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage Leads</li>
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
                  <h3 class="box-title">Manage Leads</h3>
				  <div class="pull-right">
					<!--<a class="btn btn-primary btn-sm pull-right" href="add_lead.php">Add New Lead</a>-->
					<div class="dropdown">
					  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
					  <span class="caret"></span></button>
					  <ul class="dropdown-menu">
						<li><a href="download_leads.php?t=csv">CSV</a></li>
						<li><a href="download_leads.php?t=excel">Excel</a></li>
						<li><a href="download_leads.php?t=txt">Text</a></li>
					  </ul>
					</div>
				</div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Lead Email</th>
								<th>From Name</th>
								<th>Time</th>
								<th>SER#</th>
								<th>STATUS</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$leads = $objAdmin->getAllLeads($uId);
							//print_r($settings);
							$i = 1;
						foreach($leads as $leadData)
						{	
						?>
						<tr id="row_<?php echo $leadData['id'];?>">
							<td><?php echo $leadData['email'];?></td>
							<td><?php echo $leadData['name'];?></td>
							<td><?php echo date("d-M-Y H:i A",$leadData['time']);?></td>
							<td><?php echo $leadData['serial'];?></td>
							<td>
								<?php 
									$status = $leadData['status']; 
									if($status){ echo "Sent";}else{ echo "Waiting";}
								?>
							</td>
							
							<td><a href="javascript:void(0)" action="0" rel="<?php echo $leadData['id'];?>" title="Delete" class="delete"><span class="label label-danger"><i class="fa fa-remove"></i></span></a></td>
							
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
			
			$(".delete").click(function() {
				var did = $(this).attr('rel');
				
				if(confirm("Do you really want to delete this?"))
				{
					$.ajax({
						type: "POST",
						url: "_ajax_user_actions.php",
						data: 'delId='+did+'&act_type=deleteLead',
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