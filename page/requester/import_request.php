<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/import_requestbar.php'; ?>
<!-- Main Sidebar Container -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><b>Import Request Data</b></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Import Request Data</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title"></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="small-box bg-info">
                        <div class="inner">
                          <a href="" style="color:white;" data-toggle="modal" data-target="#import_request">
                            <h5>Import Data</h5>
                            <br>
                            <br>
                        </div>
                        <div class="icon">
                          <i class="fas fa-upload"></i>
                        </div>
                        </a>
                        <a href="#" class="small-box-footer" data-toggle="modal" data-target="#import_request">Proceed
                          <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="small-box bg-secondary">
                        <div class="inner">
                          <a href="../../template/template for request.csv" style="color:white;">
                            <h5>Download Template</h5>
                            <br>
                            <br>
                        </div>
                        <div class="icon">
                          <i class="fas fa-download"></i>
                        </div>
                        </a>
                        <a href="../../template/template for request.csv" class="small-box-footer">Proceed <i
                            class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- end row -->
          </div>
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">List of Request Data</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                      <i class="fas fa-expand"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                  <div class="card-body">
                    <div class="container-fluid">
                      <div class="row mb-0">
                        <div class="col-sm-1 text-center">
                          <b><span class="h3" id="count_view"></span></b><br>
                          <label>Count</label>
                        </div>
                        <!-- <div class="col offset-sm-9">
                        <a href="#" class="btn btn-secondary"> Export Request
                          Data </a>
                        </div> -->
                      </div>
                     
                      <div class="row">
                        <div class="col-12">
                          <div class="card-body table-responsive p-0" style="height: 500px;">
                            <table class="table table-head-fixed text-nowrap table-bordered table-hover"
                              id="list_of_uploaded_request_table">
                              <thead style="text-align:center;">
                                <tr>
                                  <th>#</th>
                                  <th>Status</th>
                                  <th>Car Maker</th>
                                  <th>Car Model</th>
                                  <th>Product </th>
                                  <th>Jig Name </th>
                                  <th>Drawing No </th>
                                  <th>Type </th>
                                  <th>Qty </th>
                                  <th>Purpose </th>
                                  <th>Kigyo Budget </th>
                                  <th>Date Requested </th>
                                  <th>Requested By </th>
                                  <th>Required Delivery Date </th>
                                  <th>Remarks (fill up if ECT jig is under new design, supplier) </th>
                                  <th>Uploaded By</th>
                                </tr>
                              </thead>
                              <tbody id="list_of_uploaded_request" style="text-align:center;"></tbody>
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
                        </div>
                      </div>
                    </div>
                    <!-- end container -->
                  </div>
                  <!-- /.card-body -->
                </form>
              </div>
            </div>
          </div>
        </div>
  </section>
</div>


<?php include 'plugins/footer.php'; ?>
<?php include 'plugins/javascript/import_request_script.php'; ?>