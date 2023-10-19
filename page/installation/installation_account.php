<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/installation_account_bar.php'; ?>
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
                            <h1 class="">AME 2 Account Management</h1>
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
                            <div class="d-flex">
                                <div class="mr-auto">
                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#add_account">
                                        <i class="fas fa-plus"> </i> Add Account</a>
                                </div>
                                <div class="px-1">
                                    <input type="text" id="fullname_search" class="form-control" autocomplete="off"
                                        placeholder="Fullname">
                                </div>
                                <div class="px-1">
                                    <button class="btn btn-success" id="searchReqBtn" onclick="search_account()">Search
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
                                <!-- get the id for javascript functions para madisplay ang mga data -->
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