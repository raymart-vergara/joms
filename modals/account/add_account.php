<div class="modal fade bd-example-modal-lg" id="add_account" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
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
                    <div class="col-md-12">
                        <label>Full Name</label>
                        <input type="text" id="add_fullname" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-md-6">
                        <label>Username</label>
                        <input type="text" id="add_username" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-md-6">
                        <label>Password:</label>
                        <input type="password" id="add_password" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-md-6">
                        <label>Section:</label>
                        <input type="text" id="add_section" class="form-control" autocomplete="off" disabled
                            value="<?= htmlspecialchars($_SESSION['section']); ?>">
                    </div>
                    <div class="col-md-6">
                        <label>User Type:</label>
                        <select id="add_role" class="form-control">
                            <option value="">Select User Type</option>
                            <option value="admin">admin</option>
                            <option value="user">user</option>
                        </select>
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
                                <a href="#" class="btn btn-primary" onclick="add_account()">Register</a>
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

<!-- <div class="modal fade bd-example-modal-xl" id="add_account" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>Add Account</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-4">
                <span><b>Fullname:</b></span>
                <input type="text" id="fullname_add_account" class="form-control" style="height:45px; border: 1px solid black; font-size: 25px;" autocomplete="off">
            </div>
            <div class="col-4">
                 <span><b>Username:</b></span>
                 <input type="text" id="username_add_account" class="form-control" style="height:45px; border: 1px solid black; font-size: 25px;" autocomplete="off">
            </div>
            <div class="col-4">
                 <span><b>Password:</b></span>
                 <input type="password" id="password_add_account" class="form-control" style="height:45px; border: 1px solid black; font-size: 25px;" autocomplete="off">
            </div>
        </div> 
      </div>
      <div class="modal-footer">
        <div class="row">
            <div class="col-12">
                <div class="float-right">
                    <a href="#" class="btn btn-primary" onclick="save_account()">Register Account</a>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div> -->