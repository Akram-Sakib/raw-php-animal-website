<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $admin_info['prof_pic']; ?>" class="img-circle" alt="User Image" style="height:45px; width:45px;">
            </div>
            <div class="pull-left info">
				<p><?php echo $admin_info['company_name']; ?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <!--<li class="header">MAIN NAVIGATION</li>-->
			<li class="treeview">
				<a href="#">
					<i class="fa fa-envelope" aria-hidden="true"></i>
					<span>Email Setting</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="incoming_mails.php"><i class="fa fa-angle-double-right"></i> Incoming Mail</a></li>
				   
					<li><a href="mail_setting.php"><i class="fa fa-angle-double-right"></i> Outgoing Mail</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-comments" aria-hidden="true"></i>
					<span>Message Setting</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="replymsgs.php"><i class="fa fa-angle-double-right"></i> Reply Message</a></li>
				   
					<li><a href="followupmessage.php"><i class="fa fa-angle-double-right"></i> Follow-up Message</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-users"></i>
					<span>Lead Management</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<!--<li><a href="add_lead.php"><i class="fa fa-angle-double-right"></i> Insert Leads</a></li>-->
				   
					<li><a href="manage_leads.php"><i class="fa fa-angle-double-right"></i> Manage Leads</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-cog"></i>
					<span>System Settings</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="black_list.php"><i class="fa fa-angle-double-right"></i> Blacklist Settings</a></li>
				   
					<li><a href="set_limit.php"><i class="fa fa-angle-double-right"></i> Limit Settings</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-database"></i>
					<span>Database & System</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="clear_leads.php"><i class="fa fa-angle-double-right"></i> Clean Leads</a></li>
				   
					<li><a href="reset_system.php"><i class="fa fa-angle-double-right"></i> Reset Systems</a></li>
				</ul>
			</li>
            
            <!--<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>-->
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>