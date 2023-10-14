<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/requester_account_bar.php'; ?>
<!-- Main Sidebar Container -->
<section class="content">
    <div class="container-fluid">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header bg-white py-">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="">Account Management</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Account Management</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header py-4">
                            <!-- <div class="row">
                                    <div class="col-lg-4 sm-6">
                                    <a href="#" class="btn btn-info" data-toggle="modal"
                                            data-target="#new_account">Register
                                            Account</a>
                                    </div>
                                        
                                    <div class="col-lg-4 col-sm-6 float-right">
                                        <input type="text" id="full_name_search" class="form-control" autocomplete="off"
                                            placeholder="Fullname">
                                    </div>
                                    <div class="col-lg-2 col-sm-6 float-right">
                                    <button class="btn btn-primary" id="searchReqBtn" onclick="load_accounts()">Search
                                        <i class="fas fa-search"></i></button>
                                        </div>
                                </div> -->

                            <div class="d-flex">
                                <div class="mr-auto">
                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_account">
                                        <i class="fas fa-plus"> </i> Add Account</a>
                                </div>
                                <div class="px-1">
                                    <input type="text" id="fullname_search" class="form-control" autocomplete="off"
                                        placeholder="Fullname">
                                </div>
                                <div class="px-1">
                                    <button class="btn btn-primary" id="searchReqBtn" onclick="search_account()">Search
                                        <i class="fas fa-search"></i></button>
                                </div>
                            </div>

                        </div>

                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 500px;">
                            <table class="table table-head-fixed text-nowrap table-hover">
                                <thead style="text-align:center;">
                                    <th> # </th>
                                    <th> Username </th>
                                    <th> Full Name </th>
                                    <th> Section </th>
                                    <th> User Type </th>
                                </thead>
                                <tbody id="list_of_account" style="text-align:center;"></tbody>
                            </table>
                            <div class="row">
                                <div class="col-6"></div>
                                <div class="col-6">
                                    <div class="spinner" id="spinner" style="display:none;">
                                        <div class="loader float-sm-center"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
</section>

<?php
include 'plugins/footer.php'; ?>
<?php
include 'plugins/javascript/account_script.php';
?>
<?php
//  include 'plugins/javascript/notification_script.php';
?>
<?php
//  include 'plugins/javascript/closed_request_history_script.php';
?>