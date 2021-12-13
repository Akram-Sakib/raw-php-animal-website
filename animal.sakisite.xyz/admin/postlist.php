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
                                <h1>Add New Post</h1>
                            </div>
                            <div class="ml-auto d-flex align-items-center">
                                <nav>
                                    <ol class="breadcrumb p-0 m-b-0">
                                        <li class="breadcrumb-item">
                                            <a href="index.html"><i class="ti ti-home"></i></a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            Post
                                        </li>
                                        <li class="breadcrumb-item active text-primary" aria-current="page"><a href="postlist.php">Postlist</a></li>
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
                                                <th width="15%">Post Title</th>
                                                <th width="15%">Description</th>
                                                <th width="10%">Category</th>
                                                <th width="10%">Image</th>
                                                <th width="10%">Author</th>
                                                <th width="10%">Tags</th>
                                                <th width="10%">Date</th>
                                                <th width="15%">Action</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $sql = "SELECT tbl_post.*, tbl_category.name FROM tbl_post INNER JOIN tbl_category ON tbl_post.cat = tbl_category.id ORDER BY tbl_post.title DESC";
                                        $category = $db->select($sql);
                                        if ($category) {
                                            $i = 0;
                                        while ($result = $category->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['title']; ?></td>
                                                <td><?php echo $fm->textShorten($result['body'], 40); ?></td>
                                                <td><?php echo $result['name']; ?></td>
                                                <td><img src="uploads/<?php echo $result['image']; ?>" height="40px" width="60px"></td>
                                                <td><?php echo $result['author']; ?></td>
                                                <td><?php echo $result['tags']; ?></td>
                                                <td><?php echo $fm->date($result['date']); ?></td>
                                                <td><a href="viewpost.php?viewpostid=<?php echo $result['id']; ?>">View</a>
                                                <?php
                                                if (Session::get('userRole') == 1 || Session::get('userid') == $result['userid']) { ?>
                                                || <a href="editpost.php?editpostid=<?php echo $result['id']; ?>">Edit</a> || <a href="delpost.php?delpostid=<?php echo $result['id']; ?>" onclick="return confirm('Are you sure to Delete Data!'); ">Delete</a>
                                                <?php } ?></td>
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
