<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/dashboardbar.php'; ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><b>Request List</b></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Request List</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-lg-12 col-md-12 col-sm-12">
          <!-- jquery validation -->
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title"></h3>
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
            <div class="card-body">
              <div class="container-fluid">
                <div class="row mb-4">
                  <div class="col-sm-1 text-center">
                    <b><span class="h3" id="count_view"></span></b><br>
                    <label>Count</label>
                  </div>
                  <div class="col-sm-2 offset-sm-5">
                    <label>Status</label>
                    <select class="form-control" id="request_status_search" style="width: 100%;"
                      onchange="search_request()" required>
                      <option selected value="pending">Pending</option>
                      <option value="open">Open</option>
                      <option value="ame3">Closed - AME3</option>
                      <option value="ame2">Closed - AME2</option>
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <label>Date From</label>
                    <input type="date" class="form-control" id="request_date_from_search" onchange="search_request()">
                  </div>
                  <div class="col-sm-2">
                    <label>Date To</label>
                    <input type="date" class="form-control" id="request_date_to_search" onchange="search_request()">
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="card-body table-responsive p-0" style="height: 500px;">
                      <table class="table table-head-fixed text-nowrap table-bordered table-hover"
                        id="list_of_request_table">
                        <thead style="text-align:center;">
                          <tr>
                            <th colspan="15" class="bg-secondary">Request</th>
                            <th colspan="12" class="bg-light">RFQ Process</th>
                            <th colspan="15" class="bg-secondary">PO Process</th>
                            <th colspan="1" class="bg-light">Installation</th>
                          </tr>
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
                            <th>Budget </th>
                            <th>Date Requested </th>
                            <th>Requested By </th>
                            <th>Required Delivery Date </th>
                            <th>Remarks (fill up if ECT jig is under new design, supplier) </th>

                            <th>Date of Issuance of RFQ </th>
                            <th>RFQ No </th>
                            <th>Target Date of Reply Quotation </th>
                            <th>Date of Reply Quotation </th>
                            <th>LEADTIME(based on quotation)</th>
                            <th>Quotation No </th>
                            <th>Unit Price JPY </th>
                            <th>Unit Price USD </th>
                            <th>Total Amount </th>

                            <th>FSIB No. </th>
                            <th>FSIB Code </th>
                            <th>Date sent to Internal Signatories </th>

                            <th>Target Approval date of quotation </th>
                            <th>Approval date of quotation </th>
                            <th>Target Date Submission to Purchasing </th>
                            <th>Actual Date of Submission to Purchasing </th>
                            <th>Target PO Date</th>
                            <th>PO Date </th>
                            <th>PO No. </th>
                            <th>Ordering Additional Details </th>
                            <!-- <th>Car Model for Formula </th> -->
                            <th>Supplier </th>
                            <!-- <th>Start of Usage </th> -->
                            <!-- <th>Required Delivery Date </th> -->
                            <th>ETD </th>
                            <th>ETA </th>
                            <th>Actual Arrival date </th>
                            <th>Invoice No </th>
                            <th>Classification </th>
                            <th>Remarks </th>
                            <th>Installation Date</th>
                          </tr>
                        </thead>
                        <tbody id="list_of_request" style="text-align:center;"></tbody>
                      </table>
                    </div>
                  </div>

                  <!-- end row -->
                </div>
                <!-- end container -->
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'plugins/footer.php'; ?>
<?php include 'plugins/javascript/dashboard_script.php'; ?>