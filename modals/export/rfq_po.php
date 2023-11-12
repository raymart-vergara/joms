<div class="modal fade" id="export_rfq_po" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><b>Export Request Data + RFQ + PO</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
          onclick="javascript:window.location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info text-center">
              <div class="inner">
                <h4>Export W/O RFQ <br> And PO</h4>
              </div>
              <div class="icon">
                <i class="fas fa-download fa-sm" type="button" onclick="location.replace('../../process/export/export_request_data.php')"></i>
              </div>
              <a class="small-box-footer" type="button" class="close" data-dismiss="modal"
                onclick="location.replace('../../process/export/export_request_data.php')">
                Export Pending <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>


          <div class="col-lg-3 col-6">

            <div class="small-box bg-danger text-center">
              <div class="inner">
                <!-- <h3>65</h3> -->
                <h4>Export With <br> Initial RFQ</h4>
              </div>
              <div class="icon">
                <i class="fas fa-download"type="button" onclick="location.replace('../../process/export/export_initial_rfq.php')"></i>
              </div>
              <a class="small-box-footer" type="button" class="close" data-dismiss="modal"
                onclick="location.replace('../../process/export/export_initial_rfq.php')">
                Export Open Status <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>


          <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
              <div class="inner">
                <!-- <h3>44</h3> -->
                <h4 class="text-center">
                  Export With Complete RFQ</h4>
              </div>
              <div class="icon">
                <i class="fas fa-download" type="button"  onclick="location.replace('../../process/export/export_request_data_process.php')"></i>
              </div>
              <a class="small-box-footer" type="button" class="btn btn-warning" class="close" data-dismiss="modal"
                onclick="location.replace('../../process/export/export_request_data_process.php')">
                Export Open Status <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
              <div class="inner">

                <h4 class="text-center">
                  Export With Complete RFQ + PO</h4>
              </div>
              <div class="icon" type="button"
                onclick="location.replace('../../process/export/export_request_data_po_open.php')">
                <i class="fas fa-download"></i>
              </div>
              <a class="small-box-footer" type="button" class="btn btn-success" class="close" data-dismiss="modal"
                onclick="location.replace('../../process/export/export_request_data_po_open.php')">
                Export Closed
                Status <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

        </div>
        <!-- <div class="row">
          <div class="col-sm-3">
   
            <div class="form-group">
              <label>Export W/O RFQ and PO </label>
              <button type="button" class="btn btn-info" class="close" data-dismiss="modal"
                onclick="location.replace('../../process/export/export_request_data.php')">Export Pending
                Status</button>
            </div>
          </div>
          <div class="col-sm-3">

            <div class="form-group">
              <label>Export With Initial RFQ</label>
              <button type="button" class="btn bg-orange" class="close" data-dismiss="modal"
                onclick="location.replace('../../process/export/export_initial_rfq.php')">Export Open Status</button>
            </div>
          </div>
          <div class="col-sm-3">
     
            <div class="form-group">
              <label>Export With Complete RFQ</label>
              <button type="button" class="btn btn-warning" class="close" data-dismiss="modal"
                onclick="location.replace('../../process/export/export_request_data_process.php')">Export Open
                Status</button>
            </div>
          </div>
          <div class="col-sm-3">
          
            <div class="form-group">
              <label>Export With Complete RFQ + PO </label>
              <button type="button" class="btn btn-success" class="close" data-dismiss="modal"
                onclick="location.replace('../../process/export/export_request_data_closed.php')">Export Closed
                Status</button>
            </div>
          </div>
        </div> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal"
          onclick="javascript:window.location.reload()">Close</button>
      </div>
    </div>
  </div>
</div>