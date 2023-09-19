<div class="modal fade bd-example-modal-lg" id="update_account" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content px-3">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">
          <b>Update Account</b>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mb-4">
          <div class="col-md-12">
            <input type="hidden" id="update_id" class="form-control" autocomplete="off">
            <label>Full Name</label>
            <input type="text" id="update_fullname" class="form-control" autocomplete="off">
          </div>
          <div class="col-md-6">
            <label>Username</label>
            <input type="text" id="update_username" class="form-control" autocomplete="off">
          </div>
          <div class="col-md-6">
            <label>Password:</label>
            <input type="password" id="update_password" class="form-control" autocomplete="off">
          </div>
          <div class="col-md-6">
            <label>Section:</label>
            <input type="text" id="update_section" class="form-control" autocomplete="off" disabled
              value="<?= htmlspecialchars($_SESSION['section']); ?>">
          </div>
          <div class="col-md-6">
            <label>User Type:</label>
            <select id="update_role" class="form-control">
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
                <a href="#" class="btn btn-danger" onclick="delete_account()">Delete</a>
              </span>
              <span class="pl-5">
                <a href="#" class="btn btn-primary" onclick="update_account()">Update</a>
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
<!-- <div class="modal fade bd-example-modal-xl" id="edit_account" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>Account Details</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-4">
                <input type="hidden" id="id_account" class="form-control">
                <span><b>Fullname:</b></span>
                <input type="text" id="fullname_update_account" class="form-control" style="height:45px; border: 1px solid black; font-size: 25px;" autocomplete="off">
            </div>
            <div class="col-4">
                 <span><b>Username:</b></span>
                 <input type="text" id="username_update_account" class="form-control" style="height:45px; border: 1px solid black; font-size: 25px;" autocomplete="off">
            </div>
            <div class="col-4">
                 <span><b>Password:</b></span>
                 <input type="password" id="password_update_account" class="form-control" style="height:45px; border: 1px solid black; font-size: 25px;" autocomplete="off">
            </div>
        </div> 
        <div class="row">
            
        </div>
        <hr>
        <div class="row">
          <div class="col-6">
            <div class="float-left">
              <a href="#" class="btn btn-danger" onclick="delete_account()">Delete Account Data</a>
            </div>
          </div>
          <div class="col-6">
            <div class="float-right">
              <a href="#" class="btn btn-primary" onclick="update_account()">Update Account Details</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->