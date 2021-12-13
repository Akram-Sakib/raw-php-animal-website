<?php require "inc/header.php";?>

    <!-- begin app-container -->
    <div class="app-container">
        <!-- begin app-nabar -->
        <?php require "inc/sidebar.php";?>
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
                                <h1>User List</h1>
                            </div>
                            <div class="ml-auto d-flex align-items-center">
                                <nav>
                                    <ol class="breadcrumb p-0 m-b-0">
                                        <li class="breadcrumb-item">
                                            <a href="index.php"><i class="ti ti-home"></i></a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="index.php">User</a>
                                        </li>
                                        <li class="breadcrumb-item active text-primary" aria-current="page"><a href="userlist.php">User List</a></li>
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
                                        <h4 class="card-title mb-3">User List</h4>
<?php if (Session::get('userRole') == '1') { ?>
<?php
if (isset($_GET["deluser"])) {
    $deluserid = $_GET["deluser"];
    $delquery = "DELETE FROM tbl_user WHERE id = '$deluserid' ";
    $deleteuser = $db->delete($delquery);
    if ($deleteuser) {
        $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>User Deleted successfully.</div> ";
        echo $msg;
    } else {
        $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>User not Deleted.</div> ";
        echo $msg;

    }
}
?>
<?php } ?>
                                        <div class="mt-4">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="my_table data display datatable" id="example">
                                        <thead class="thead-light bg-primary text-light">
                                            <tr>
                                                <th width="5%">No.</th>
                                                <th width="15%">Name</th>
                                                <th width="15%">Image</th>
                                                <th width="10%">Username</th>
                                                <th width="15%">Email</th>
                                                <th width="15%">Details</th>
                                                <th width="10%">Role</th>
                                                <th width="15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
$sql = "SELECT * FROM tbl_user  ";
$user = $db->select($sql);
if ($user) {
    $i = 0;
    while ($result = $user->fetch_assoc()) {
        $i++;
        ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['name']; ?></td>
                                                <td><img style="border-radius: 50%;" src="uploads/<?php 
                                                if ($result['image'] == NULL ) {
                                                    echo "avatar.jpg";
                                                }else {
                                                    echo $result['image'];

                                                }
                                                ?>" height="40px" width="40px"></td>
                                                <td><?php echo $result['username']; ?></td>
                                                <td><?php echo $result['email']; ?></td>
                                                <td><?php echo $fm->textShorten($result['details'], 30); ?></td>
                                                <td><?php 
                                                if ($result['role'] == '1') {
                                                    echo "Admin" ;
                                                }elseif ($result['role'] == '2') {
                                                    echo "Editor" ;
                                                }elseif ($result['role'] == '3') {
                                                    echo "Author" ;
                                                }
                                                ?></td>
                                                <td><a href="viewuser.php?viewuserid=<?php echo $result["id"]; ?>">View</a><?php if (Session::get('userRole') == '1') { ?> || <a href="?deluser=<?php echo $result['id']; ?>" onclick="return confirm('Are you sure to Delete this User!'); ">Delete</a> <?php } ?></td>
                                            </tr>
                                            <?php }}?>
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
    <!-- begin footer -->
    <?php require "inc/footer.php";?>
