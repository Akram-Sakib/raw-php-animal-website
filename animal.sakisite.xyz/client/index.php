<?php
	include("header.php");
	include("sidebar.php");
	
?>
	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $objAdmin->countTtlLeads(); ?></h3>
                  <p>TOTAL LEADS</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $objAdmin->total_sent(); ?></h3>
                  <p>TOTAL SENT</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $objAdmin->total_waiting(); ?></h3>
                  <p>TOTAL WAITING</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
              </div>
            </div><!-- ./col -->
            <!--<div class="col-lg-3 col-xs-6">
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $objAdmin->total_uniq(); ?></h3>
                  <p>TOTAL UNIQ</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                
              </div>
            </div>-->
			<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php 
						echo $ttlFollowup = $objAdmin->total_followup(); 
						
				  ?></h3>
                  <p>TOTAL FOLLOWUP</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                
              </div>
            </div>
          </div><!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7">
              <div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-comments-o"></i>
                  <h3 class="box-title">Latest Incoming Leads</h3>
				  
                </div>
                <div class="box-body" style="min-height: 335px;">
					<div class="item">
					   <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Lead Email</th>
								<th>Time</th>
								<th>SER#</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$leads = $objAdmin->getLatestLeads($uId);
							//print_r($settings);
							$i = 1;
						foreach($leads as $leadData)
						{	
						?>
						<tr id="row_<?php echo $leadData['id'];?>">
							<td><?php echo $leadData['email'];?></td>
							<td><?php echo date("d-M-Y H:i A",$leadData['time']);?></td>
							<td><?php echo $leadData['serial'];?></td>
							
						</tr>
						<?php
							$i++;
						}
						?>
						</tbody>
					</table>
					</div>
					
				</div>
                
              </div>
            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5">
				<div class="box box-success">
					<div class="box-header">
						<i class="fa fa-comments-o"></i>
						<h3 class="box-title">Reply by Sequence <small> Reply Activity</small></h3>
						<div class="box-tools pull-right" data-toggle="tooltip" title="Status">
							<div class="btn-group" data-toggle="btn-toggle" >
								<!--<button type="button" class="btn btn-default btn-sm"><i class="fa fa-expand" aria-hidden="true"></i></button>
								<button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh text-red"></i></button>
								<button type="button" class="btn btn-default btn-sm"><i class="fa fa-cog text-green"></i></button>-->
							</div>
						</div>
					</div>
					<div class="box-body">
						<!-- chat item -->
						<div class="item">
							<table class="table table-bordered table-striped">
								<?php
									$replyMsg = $objAdmin->getReplyMsgSequence($uId);
									//print_r($replyMsg);
									$hitsarr = Array();
									foreach($replyMsg as $msg1)
									{
										if($hitsarr[$msg1['serial']] != '')
										{
											$hitsarr[$msg1['serial']] = $hitsarr[$msg1['serial']]+$msg1['hits'];
										}
										else
										{
											$hitsarr[$msg1['serial']] = $msg1['hits'];
										}
									}
									ksort($hitsarr);
									//print_r($hitsarr);
									foreach($hitsarr as $key=>$value)
									{
										$txt = '1st Reply';
										if($key == 2)
										{
											$txt = '2nd Reply';
										}
										else if($key == 3)
										{
											$txt = '3rd Reply';
										}
										else if($key == 4)
										{
											$txt = '4th Reply';
										}
										else if($key == 5)
										{
											$txt = '5th Reply';
										}
										else if($key == 6)
										{
											$txt = '6th Reply';
										}
										else if($key == 7)
										{
											$txt = '7th Reply';
										}
										else if($key == 8)
										{
											$txt = '8th Reply';
										}
										else if($key == 9)
										{
											$txt = '9th Reply';
										}
										else if($key == 10)
										{
											$txt = '10th Reply';
										}
								?>
								<tr>
									<td><?php echo $txt; ?></td>
									<td><?php echo $value; ?></td>
								</tr>
								<?php
									}
								?>
								
							</table>
						</div>
					</div><!-- /.chat -->
					
				</div>
              
            </section><!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    <?php
		include("footer.php");
	?>  