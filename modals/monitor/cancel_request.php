<div class="modal fade" id="cancel_request" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <h5 class="modal-title" id="exampleModalLabel"> Confirm Cancellation for Selected Requests</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mt-2">
                <div class="row">
                    <div class="col-md-12">
                        <label>Reasons:</label>
                        <input type="text" id="cancel_reason" class="form-control">
                    </div>
                    <div class="col-md-6 mt-2 float-right">
                        <label>Canellation Date: </label>
                        <input type="date" id="cancel_date" class="form-control">
                    </div>
                    <div class="col-11 text-center mt-2 d-flex justify-content-end">
                        <span class="p">Number of Checked:</span>
                        <span class="h5" id="numcheck"></span>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
          <div class="col-sm-12">
            <label>Number of Checked:</label>
            <span id="numcheck"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <span>Installation Date </span>
          </div>
          <div class="col-sm-5">
          <input type="date" id="installation_date" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 mt-4">
            <span>Confirm Installation Date for Selected Requests</span>
          </div>
        </div>
      </div> -->
            <div class="modal-footer mb-1 pb-1">
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                <a href="#" class="btn btn-danger" onclick="install()">Confirmn </a>
            </div>
        </div>
    </div>
</div>
</div>