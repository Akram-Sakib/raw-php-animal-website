<aside class="app-navbar">
    <!-- begin sidebar-nav -->
    <div class="sidebar-nav scrollbar scroll_light">
        <ul class="metismenu " id="sidebarNav">
            <li class="nav-static-title">Personal</li>
            <li class="active">
                <a href="index.php" aria-expanded="false">
                    <i class="nav-icon ti ti-rocket"></i>
                    <span class="nav-title">Dashboards</span>
                </a>
            </li>
            <?php 
if (Session::get('userRole') == '1') { ?>
            <li><a href="inbox.php" aria-expanded="false"><i class="nav-icon ti ti-email"></i><span class="nav-title">Mail</span><?php
                $query = "SELECT * FROM tbl_contact WHERE status = '0' ORDER BY id desc";
				$inboxnumber = $db->select($query);
                if ($inboxnumber) {
                    $count = mysqli_num_rows($inboxnumber);
                    echo "<span class='nav-label label label-primary'>".$count."</span>";
                }?></a></li>
                <?php } ?>
            <li class="nav-static-title">Post Option</li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-layers"></i><span
                        class="nav-title">Post</span></a>
                <ul aria-expanded="false">
                
                    <li> <a href="addpost.php">Add Post</a> </li>
                    
                    <li> <a href="postlist.php">Post List</a> </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-bag"></i> <span class="nav-title">Category Option</span></a>
                <ul aria-expanded="false">
                <?php if (Session::get('userRole') == '1') { ?>
                    <li> <a href="addcat.php">Add Category</a> </li>
                <?php } ?>
                    <li> <a href="catlist.php">Category List</a> </li>
                </ul>
            </li>
            <li class="nav-static-title">Page Option</li>
            <?php if (Session::get('userRole') == '1') { ?>
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-calendar"></i><span class="nav-title">Page Option</span></a>
                <ul aria-expanded="false">
                    <li><a href='logotitle.php'>Logo and Title</a></li>
                    <li><a href='author.php'>Author Details</a></li>
                    <li><a href='copyright.php'>Copyright Text</a></li>
                    <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><span class="nav-title">About Page Option</span></a>
                    <ul aria-expanded="false">
                        <li><a href="addmember.php">Add Member</a></li>
                        <li><a href="memberlist.php">Team Member List</a></li>
                    </ul>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <?php if (Session::get('userRole') == '1' || Session::get('userRole') == '2') { ?>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-layers"></i><span class="nav-title">Pages</span></a>
                <ul aria-expanded="false">
                <?php if (Session::get('userRole') == '1') { ?>
                    <li><a href="addnewpage.php">Add New Page</a> </li>
                    <?php } ?>
                    <?php if (Session::get('userRole') == '1' || Session::get('userRole') == '2') { ?>
                    <?php 
                    $sql = "SELECT * FROM tbl_page ";
                    $page = $db->select($sql);
                    if ($page) {
                        while ($result = $page->fetch_assoc()) { ?>
                    <li><a href="page.php?pageid=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></li>
                    <?php } ?>
                    <?php } } ?>
                </ul>
            </li>
            <?php } ?>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon fa fa-sliders"></i><span class="nav-title">Slider Option</span> </a>
                <ul aria-expanded="false">
                <?php if (Session::get('userRole') == '1') { ?>
                    <li> <a href="addslider.php">Add Slider</a> </li>
                    <?php } ?>
                    <li> <a href="sliderlist.php">Slider List</a> </li>
                </ul>
            </li>
            <?php if (Session::get('userRole') == '1') { ?>
            <li class="nav-static-title">Widgets, Tables & Layouts</li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false"> <i class="nav-icon ti ti-layout-grid4-alt"></i> <span class="nav-title">Widgets</span> <!-- <span class="nav-label label label-success">New</span> --> </a>
                <ul aria-expanded="false">
                    <li> <a href="infotop.php">Info Top</a> </li>
                    <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><span class="nav-title">Footer Top</span></a>
                    <ul aria-expanded="false">
                        <li><a href="footer_column_1.php">Footer Top Colum 1</a></li>
                        <li><a href="footer_column_2.php">Footer Top Colum 2</a></li>
                        <li><a href="footer_column_3.php">Footer Top Colum 3</a></li>
                    </ul>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <li class="nav-static-title">Extra Components</li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-map-alt"></i><span class="nav-title">Maps</span></a>
                <ul aria-expanded="false">
                    <li> <a href="maps-vector.php">Vector Maps</a> </li>
                    <li> <a href="maps-mapael.php">Mapael Maps</a> </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- end sidebar-nav -->
</aside>