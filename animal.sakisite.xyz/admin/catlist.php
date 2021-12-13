<?php require "inc/header.php"; ?>
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
                                        <h1>All Category</h1>
                                    </div>
                                    <div class="ml-auto d-flex align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <a href="index.php"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                   <a href="index.php"> Category Option</a>
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page"><a href="catlist.php">Catlist</a></li>
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
                                                <h4 class="card-title">Category List</h4>
                                                <div class="mt-4">
                                                <?php if (Session::get('userRole') == '1') { ?>
                                                <?php
                                                if (isset($_GET["delcatid"])) {
                                                    $delcatid = $_GET["delcatid"];
                                                    $delquery = "DELETE FROM tbl_category WHERE id = '$delcatid' ";
                                                    $deletecat = $db->delete($delquery);
                                                    if ($deletecat) {
                                                        $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>Category Deleted successfully.</div> ";
                                                        echo $msg;
                                                    }else {
                                                        $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Category not Deleted.</div> ";
                                                        echo $msg;
                                                        }
                                                    }
                                                ?>
                                                <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body" >
                                            <table class="table data display datatable" id="example">
                                                <thead class="thead-light table-primary">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Category Name</th>
                                                        <?php 
                                                        if (Session::get('userRole') == '1' || Session::get('userRole') == '2') { ?>
                                                        <th>Action</th>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT * FROM tbl_category ";
                                                    $category = $db->select($sql);
                                                    if ($category) {
                                                        $i = 0;
                                                    while ($result = $category->fetch_assoc()) {
                                                        $i++;
                                                        ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $result['name']; ?></td>
                                                        <?php if (Session::get('userRole') == '1' || Session::get('userRole') == '2') { ?>
                                                        <td><a href="editcat.php?editcatid=<?php echo $result['id']; ?>">Edit</a> <?php if ((Session::get('userRole') == '2') == false) { ?>|| <a href="?delcatid=<?php echo $result['id']; ?>" onclick="return confirm('Are you sure to Delete Data!'); ">Delete</a></td>
                                                        <?php } } ?>
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
            <!-- begin footer -->
           <?php require "inc/footer.php"; ?>
