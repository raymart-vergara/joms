<script type="text/javascript">
    $(document).ready(function () {
        load_accounts();
        
        sessionStorage.setItem('notif_new_joms_request', 0);
        load_notif_ame3();
        realtime_load_notif_ame3 = setInterval(load_notif_ame3, 5000);
    });

    const load_accounts = () => {
        $.ajax({
            url: '../../process/account/account_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'load_accounts'
            }, success: function (response) {
                $('#list_of_account').html(response);
                $('#spinner').fadeOut();
            }
        });
    }

    const add_account = () => {
        var add_fullname = document.getElementById('add_fullname').value;
        var add_username = document.getElementById('add_username').value;
        var add_password = document.getElementById('add_password').value;
        var add_section = document.getElementById('add_section').value;
        var add_role = document.getElementById('add_role').value;

        if (add_fullname == '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Input your Name !!!',
                text: 'Information',
                showConfirmButton: false,
                timer: 1000
            });
        } else if (add_username == '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Input Username!!!',
                text: 'Information',
                showConfirmButton: false,
                timer: 1000
            });
        } else if (add_password == '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Input password!!!',
                text: 'Information',
                showConfirmButton: false,
                timer: 1000
            });
        } else if (add_section == '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Input Section!!!',
                text: 'Information',
                showConfirmButton: false,
                timer: 1000
            });
        }
        else if (add_role == '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Input role!!!',
                text: 'Information',
                showConfirmButton: false,
                timer: 1000
            });
        } else {
            $.ajax({
                url: '../../process/account/account_p.php',
                type: 'POST',
                cache: false,
                data: {
                    method: 'add_account',
                    add_fullname: add_fullname,
                    add_username: add_username,
                    add_password: add_password,
                    add_section: add_section,
                    add_role: add_role
                }, success: function (response) {
                    if (response == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Succesfully added!!!',
                            text: 'Success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        $('#add_fullname').val('');
                        $('#add_username').val('');
                        $('#add_password').val('');
                        // $('#add_section').val('');
                        $('#add_role').val('');
                        $('#add_account').modal('hide');
                        load_accounts();
                        // setTimeout(function () {
                        //     location.reload();
                        // }, 100);
                    } else if (response == 'Already Exist') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Duplicate Data !!!',
                            text: 'Information',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                }
            })
        }
    };

    //clear the form when close the modal
    $("#add_account").on('hidden.bs.modal', e => {
        $('#add_fullname').val('');
        $('#add_username').val('');
        $('#add_password').val('');
        $('#add_role').val('');
    });

    //show details with params
    const get_acc_details = (param) => {
        var string = param.split('~!~');
        var id = string[0];
        var fullname = string[1];
        var username = string[2];
        var password = string[3];
        var section = string[4];
        var role = string[5];

        document.getElementById('update_id').value = id;
        document.getElementById('update_fullname').value = fullname;
        document.getElementById('update_username').value = username;
        document.getElementById('update_password').value = password;
        document.getElementById('update_section').value = section;
        document.getElementById('update_role').value = role;
    };

    // update javascript using ajax
    const update_account = () => {
        var update_id = document.getElementById('update_id').value;
        var update_fullname = document.getElementById('update_fullname').value;
        var update_username = document.getElementById('update_username').value;
        var update_password = document.getElementById('update_password').value;
        var update_section = document.getElementById('update_section').value;
        var update_role = document.getElementById('update_role').value;

        $.ajax({
            url: '../../process/account/account_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'update_account',
                update_id:update_id,
                update_fullname:update_fullname,
                update_username:update_username,
                update_password:update_password,
                update_section:update_section,
                update_role:update_role,
            }, success: function (response) {
                if (response == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Succesfully Recorded!!!',
                        text: 'Success',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    $('#update_fullname').val('');
                        $('#update_username').val('');
                        $('#update_password').val('');
                        // $('#add_section').val('');
                        $('#update_role').val('');
                        $('#update_account').modal('hide');
                        load_accounts();
                        // setTimeout(function () {
                        //     location.reload();
                        // }, 100);
                } else if (response == 'duplicate') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Duplicate Data !!!',
                        text: 'Information',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            }
        })
    };
    
    const delete_account = () => {
        var update_id = document.getElementById('update_id').value;
        $.ajax({
            url: '../../process/account/account_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'delete_exc',
                update_id:update_id
            }, success: function (response) {
                if (response == 'success') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Succesfully Deleted !!!',
                        text: 'Information',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    load_accounts();
                    $('#update_account').modal('hide');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error !!!',
                        text: 'Error',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            }
        });
    }

    const search_account = () => {
        var fullname = document.getElementById('fullname_search').value;
        $.ajax({
            url: '../../process/account/account_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'search_account',
                fullname:fullname
            }, success: function (response) {
                $('#list_of_account').html(response);
                $('#spinner').fadeOut();
            }
        })
    }
</script>