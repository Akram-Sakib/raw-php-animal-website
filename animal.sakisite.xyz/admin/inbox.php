<?php require "inc/header.php"; ?>
<?php 
if (Session::get('userRole') == '2' || Session::get('userRole') == '3') {
    echo "<script>window.location = 'index.php'</script>" ;
}
?>
            <!-- end app-header -->
            <!-- begin app-container -->
            <div class="app-container">
                <!-- begin app-nabar -->
                <?php require "inc/sidebar.php"; ?>
                <!-- end app-navbar -->
                <!-- begin app-main -->
                <div class="app-main" id="main">
                    <!-- begin container-fluid -->
                    <div class="container-fluid">
                        <!-- begin row -->
                        <div class="row">
                            <div class="col-md-12 m-b-30">
                                <!-- begin page title -->
                                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                                    <div class="page-title mb-2 mb-sm-0">
                                        <h1>Mail</h1>
                                    </div>
                                    <div class="ml-auto d-flex align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <a href="index.php"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item text-primary active">
                                                <a href="inbox.php">Mail</a></li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                <!-- end page title -->
                            </div>
                        </div>
                        <!-- end row -->
                        <!-- begin row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title mb-3">Inbox</h4>
                        <?php if (Session::get('userRole') == '1') { ?>
                                            <?php
					if (isset($_GET['seenid']) && isset($_GET['seenid'])) {
						$seenid = $_GET['seenid'];
						$query = "UPDATE tbl_contact SET status = '1' WHERE id = '$seenid'";
						$updated_row = $db->update($query);
						if ($updated_row) {
                            $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>Message sent in the Seen Box</div> ";
                            echo $msg;
						}else {
                            $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Something went Wrong.</div> ";
                            echo $msg;

						}
					}
					?>
                    <?php } ?>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <table class="my_table data display datatable" id="example">
                                            <thead class="thead-light bg-primary text-light">
                                                <tr>
                                                    <th width = "5%">No.</th>
                                                    <th width = "15%">First Name</th>
                                                    <th width = "15%">Last Name</th>
                                                    <th width = "15%">Email</th>
                                                    <th width = "15%">Message</th>
                                                    <th width = "15%">Date</th>
                                                    <th width = "20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $query = "SELECT * FROM tbl_contact WHERE status = '0' ORDER BY id desc";
                                            $inbox = $db->select($query);
                                            if ($inbox) {
                                                $i = 0;
                                                while ($result = $inbox->fetch_assoc()) { 
                                                    $i++;
                                                    ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $result['firstname']; ?></td>
                                                    <td><?php echo $result['lastname']; ?></td>
                                                    <td><?php echo $result['email']; ?></td>
                                                    <td><?php echo $fm->textShorten($result['body'], 30); ?></td>
                                                    <td><?php echo $fm->date($result['date']); ?></td>
                                                    <td><a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> || <a href="replymsg.php?replyid=<?php echo $result['id']; ?>">Reply</a> || <a onclick="return confirm('Are you sure to Move the Message!')" href="?seenid=<?php echo $result['id']; ?>">Seen</a></td>
                                                </tr>
                                                <?php } } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title mb-3">Seen Box</h4>
                                            <?php if (Session::get('userRole') == '1') { ?>

                                            <?php
					if (isset($_GET['unseenid'])) {
						$unseenid = $_GET['unseenid'];
						$query = "UPDATE tbl_contact SET status = '0' WHERE id = '$unseenid'";
						$updated_row = $db->update($query);
						if ($updated_row) {
                            $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>Message sent in the Inbox</div> ";
                            echo $msg;
						}else {
                            $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Something went Wrong.</div> ";
                            echo $msg;

						}
					}
					?>
                    
                    <?php } ?>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                
                                        <table class="my_table data display datatable" id="example">
                                            <thead class="thead-light bg-primary text-light">
                                                <tr>
                                                    <th width = "5%">No.</th>
                                                    <th width = "15%">First Name</th>
                                                    <th width = "15%">Last Name</th>
                                                    <th width = "15%">Email</th>
                                                    <th width = "15%">Message</th>
                                                    <th width = "15%">Date</th>
                                                    <th width = "20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $query = "SELECT * FROM tbl_contact WHERE status = '1' ORDER BY id desc";
                                            $inbox = $db->select($query);
                                            if ($inbox) {
                                                $i = 0;
                                                while ($result = $inbox->fetch_assoc()) { 
                                                    $i++;
                                                    ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $result['firstname']; ?></td>
                                                    <td><?php echo $result['lastname']; ?></td>
                                                    <td><?php echo $result['email']; ?></td>
                                                    <td><?php echo $fm->textShorten($result['body'], 30); ?></td>
                                                    <td><?php echo $fm->date($result['date']); ?></td>
                                                    <td><a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> || <a href="?unseenid=<?php echo $result['id']; ?>" onclick="return confirm('Are you sure to Move the Message!')" >Unseen</a> || <a onclick="return confirm('Are you sure to Delete !')" href="delmsg.php?delmsgid=<?php echo $result['id']; ?>">Delete</a></td>
                                                </tr>
                                                <?php } } ?>
                                            </tbody>
                                        </table>
                                
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container-fluid -->
            </div>
            <!-- end app-main -->
        </div>
        <!-- end app-container -->
        <?php require "inc/footer.php"; ?>