<?php require "inc/header.php"; ?>
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
                            
                            <div class="col-xl-12 col-md-12 border-t col-12">
                                <div class="page-account-form">
                                    <div class="form-titel border-bottom p-3">
                                        <h5 class="mb-0 py-2">Your External Link</h5>
                                    </div>
                                    <div class="p-4">
                                        <form>
                                            <div class="form-group">
                                                <label for="fb">Facebook URL:</label>
                                                <input type="text" class="form-control" id="fb" value="https://www.facebook.com/">
                                            </div>
                                            <div class="form-group">
                                                <label for="tr">Twitter URL:</label>
                                                <input type="text" class="form-control" id="tr" value="https://twitter.com/">
                                            </div>
                            
                                            <div class="form-group">
                                                <label for="br">Blogger URL:</label>
                                                <input type="text" class="form-control" id="br" value="https://www.blogger.com/">
                                            </div>
                            
                                            <div class="form-group">
                                                <label for="go">Google+ URL:</label>
                                                <input type="text" class="form-control" id="go" value="https://plus.google.com/discover">
                                            </div>
                            
                                            <div class="form-group">
                                                <label for="li">LinkedIn URL:</label>
                                                <input type="text" class="form-control" id="li" value="https://in.linkedin.com/">
                                            </div>
                            
                                            <div class="form-group">
                                                <label for="we">Website URL:</label>
                                                <input type="text" class="form-control" id="we" value="https://yourwebsite.com/">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save & Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end container-fluid -->
                </div>
                <!-- end app-main -->
            </div>
            <!-- end app-container -->
<?php require "inc/footer.php"; ?>
