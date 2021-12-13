<?php require "inc/header.php";?>
<?php 
if (Session::get('userRole') == '2' || Session::get('userRole') == '3') {
    echo "<script>window.location = 'index.php'</script>" ;
}
?>
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
                                <h1>Add New Post</h1>
                            </div>
                            <div class="ml-auto d-flex align-items-center">
                                <nav>
                                    <ol class="breadcrumb p-0 m-b-0">
                                        <li class="breadcrumb-item">
                                            <a href="index.php"><i class="ti ti-home"></i></a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="index.php">Page Option</a>
                                        </li>
                                        <li class="breadcrumb-item text-primary" aria-current="page"><a href="index.php">About page option</a></li>
                                        <li class="breadcrumb-item active text-primary" aria-current="page"><a href="memberlist.php">Team Member List</a></li>
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
                                        <h4 class="card-title">Post List</h4>
                                        <div class="mt-4">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="my_table data display datatable" id="example">
                                        <thead class="thead-light bg-primary text-light">
                                            <tr>
                                                <th width="5%">No.</th>
                                                <th width="20%">Image</th>
                                                <th width="10%">Name</th>
                                                <th width="15%">Subtitle</th>
                                                <th width="20%">Description</th>
                                                <th width="10%">Email</th>
                                                <th width="10%">Contact Link</th>
                                                <th width="15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
$sql = "SELECT * FROM tbl_team";
$team = $db->select($sql);
if ($team) {
    $i = 0;
    while ($result = $team->fetch_assoc()) {
        $i++;
        ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $i; ?></td>
                                                <td><img src="uploads/<?php echo $result['image']; ?>" height="40px" width="60px"></td>
                                                <td><?php echo $result['name'] ?></td>
                                                <td><?php echo $result['subtitle']; ?></td>
                                                <td><?php echo $fm->textShorten($result['body'],40); ?></td>
                                                <td><?php echo $result['email']; ?></td>
                                                <td><?php echo $result['contact']; ?></td>
                                                <td><a href="edit_team.php?edit_team_id=<?php echo $result['id']; ?>">Edit</a> || <a href="delmember.php?del_team_id=<?php echo $result['id']; ?>" onclick="return confirm('Are you sure to Delete Data!'); ">Delete</a></td>
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
