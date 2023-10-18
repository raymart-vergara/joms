<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/set_rfq_pobar.php'; ?>
<!-- Main Sidebar Container -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><b>Set RFQ + PO</b></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Set RFQ + PO</li>
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
                      <div class="small-box bg-secondary">
                        <div class="inner">
                          <a href="#" data-toggle="modal" data-target="#export_rfq_po" style="color:white;">
                            <h5>Export Request Data + RFQ + PO</h5>
                            <br>
                            <br>
                        </div>
                        <div class="icon">
                          <i class="fas fa-download"></i>
                        </div>
                        </a>
                        <a href="#" data-toggle="modal" data-target="#export_rfq_po" class="small-box-footer">Proceed <i
                            class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="small-box bg-info">
                        <div class="inner">
                          <a href="#" data-toggle="modal" data-target="#import_rfq_po" style="color:white;">
                            <h5>Import Request Data + RFQ + PO</h5>
                            <br>
                            <br>
                        </div>
                        <div class="icon">
                          <i class="fas fa-upload"></i>
                        </div>
                        </a>
                        <a href="#" class="small-box-footer" data-toggle="modal" data-target="#import_rfq_po">Proceed <i
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
                  <h3 class="card-title">List of Request Data + RFQ + PO</h3>
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
                      <div class="container-fluid">
                        <div class="row mb-0">
                          <div class="col-12 d-flex justify-content-between">
                            <div class="col-3">
                              <div class="input-group">
                                <button type="button" class="btn btn-danger" id="btnCancel" data-toggle="modal"disabled
                                  data-target="#cancel_request" >
                                  Cancel Request</button>
                                <div class="input-group-prepend ml-3"> <label class="input-group-text"
                                    for="inputGroupSelect01">Status</label> </div>
                                <select class="custom-select text-center" onchange="filter_rfq_process()" required
                                  id="rfq_status_search">
                                  <option selected value="open_all">RFQ Process</option>
                                  <option value="open_initial">Initial RFQ</option>
                                  <option value="open_complete">Compelete RFQ</option>
                                  <option value="cancelled">Cancelled</option>
                                </select>
                              </div>
                            </div>
                            <div class=""> <b>
                                <div class="h3 text-center" id="count_view"> </div> <label
                                  class="text-center">Count</label>
                              </b> </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <div class="card-body table-responsive p-0" style="height: 500px;">
                            <table class="table table-head-fixed text-nowrap table-bordered table-hover"
                              id="list_of_uploaded_request_with_po_table">
                              <thead style="text-align:center;">
                                <tr>
                                  <th colspan="17" class="bg-secondary">Request</th>
                                  <th colspan="15" class="bg-light">RFQ Process</th>
                                  <th colspan="16" class="bg-secondary">PO Process</th>
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
                                  <th>Upload By</th>

                                  <th>Date of Issuance of RFQ </th>
                                  <th>RFQ No </th>
                                  <th>Target Date of Reply Quotation </th>
                                  <th>Upload By</th>

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
                                  <th>Upload By</th>

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
                                  <th>Upload By</th>
                                </tr>
                              </thead>
                              <tbody id="list_of_uploaded_request_with_po" style="text-align:center;"></tbody>
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
<?php include 'plugins/javascript/notification_script.php'; ?>
<?php include 'plugins/javascript/set_rfq_po_script.php'; ?>