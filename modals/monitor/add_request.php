<div class="modal fade bd-example-modal-xl" id="add_request" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content px-3">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">
                    <b>Register Account</b>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                <div class="col-md-3">
                        <label>Status</label>
                        <select id="add_status" class="form-control">
                        <option value="">Select Status</option>
                            <option value="pending">pending</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Car Maker</label>
                        <input type="text" id="add_carmaker" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Product</label>
                        <input type="text" id="add_product" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Jig Name:</label>
                        <input type="text" id="add_jigname" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Drawing No:</label>
                        <input type="text" id="add_drawingno" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Type:</label>
                        <input type="text" id="add_type" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Quantity:</label>
                        <input type="number" id="add_qty" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Purpose:</label>
                        <input type="text" id="add_purpose" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Budget:</label>
                        <input type="number" id="add_budget" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Date Requested</label>
                        <input type="date" id="add_daterequested" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label> Requested By</label>
                        <input type="text" id="add_requestedby" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Required Delivery Date</label>
                        <input type="date" id="add_reqdelivdate" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Remarks</label>
                            <input type="text" id="add_remarks" class="form-control">
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <span class="pr-2">
                                <a href="#" class="btn btn-danger px-3" data-dismiss="modal"
                                    aria-label="Close">Cancel</a>
                            </span>
                            <span class="pl-5">
                                <a href="#" class="btn btn-primary" onclick="add_request()">Register</a>
                            </span>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>