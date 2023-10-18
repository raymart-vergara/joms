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
             <button type="button" class="btn btn-danger ml-1" id="btnCancel" data-toggle="modal" data-target="#cancel_request" disabled>
             Cancel Request</button>
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
                  <div class="col-sm-2 offset-sm-3">
                    <label>Section</label>
                    <select class="form-control" id="request_section_search" style="width: 100%;"
                      onchange="search_request()" required>
                      <option selected value="Please Select">Please Select</option>
                      <option value="mppd1">Mppd1 - Request</option>
                      <option value="ame1req">Ame1 - Request</option>
                      <option value="ame2req">Ame2 - Request</option>
                      <option value="ame3req">Ame3 - Request</option>
                      <option value="ame5req">Ame5 - Request</option>
                    </select>
                  </div>
                  <div class="col-sm-2 ">
                    <label>Status</label>
                    <select class="form-control" id="request_status_search" style="width: 100%;"
                      onchange="search_request()" required>
                      <option selected value="pending">Pending</option>
                      <option value="open">Open</option>
                      <option value="ame3">Closed - AME3</option>
                      <option value="ame2">Closed - AME2</option>
                      <option value="cancelled">Cancelled</option>
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
                            <th colspan="17" class="bg-secondary">Request</th>
                            <th colspan="15" class="bg-light">RFQ Process</th>
                            <th colspan="16" class="bg-secondary">PO Process</th>
                            <th colspan="3" class="bg-light">Installation</th>
                          </tr>
                          <tr>
                          <th>
                            <input type="checkbox" name="" id="cancel_check_all" onclick="select_all_func()">
                          </th>
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

                            <th>Date of Issuance of RFQ </th>
                            <th>RFQ No </th>
                            <th>Target Date of Reply Quotation </th>
                            <th>Uploaded By</th>
                            <th>Date of Reply Quotation </th>
                            <th>LEADTIME(based on quotation)</th>
                            <th>Quotation No </th>
                            <th>Unit Price JPY </th>
                            <th>Unit Price USD </th>
                            <th>Unit Price PHP </th>
                            <th>Total Amount </th>
                            <th>FSIB No. </th>
                            <th>FSIB Code </th>
                            <th>Date sent to Internal Signatories </th>
                            <th>Uploaded By</th>

                            <th>Target Approval date of quotation </th>
                            <th>Approval date of quotation </th>
                            <th>Target Date Submission to Purchasing </th>
                            <th>Actual Date of Submission to Purchasing </th>
                            <th>Target PO Date</th>
                            <th>PO Date </th>
                            <th>PO No. </th>
                            <th>Ordering Additional Details </th>
                            <th>Supplier </th>
                            <th>ETD </th>
                            <th>ETA </th>
                            <th>Actual Arrival date </th>
                            <th>Invoice No </th>
                            <th>Classification </th>
                            <th>Remarks </th>
                            <th>Uploaded By</th>

                            <th>Line Number</th>
                            <th>Installation Date</th>
                            <th>Uploaded By</th>
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