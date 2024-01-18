<script type="text/javascript">
    $(function () {
        let role = '<?= $_SESSION['role'] ?>';
        if (role == 'user') {
            $('#accounts_bar').hide();
        }

        //search_request_with_rfq();
        filter_rfq_process();
        sessionStorage.setItem('notif_new_joms_request', 0);
        load_notif_ame3();
        realtime_load_notif_ame3 = setInterval(load_notif_ame3, 5000);

        import_initial_rfq_button();
        import_full_rfq_button();
        import_po_btn();

    });

    // const search_request_with_rfq = () => {
    //     $('#spinner').css('display', 'block');
    //     $.ajax({
    //         url: '../../process/purchasing/po.php',
    //         type: 'POST',
    //         cache: false,
    //         data: {
    //             method: 'fetch_request_with_po',
    //         }, success: function (response) {
    //             document.getElementById('list_of_uploaded_request_with_po').innerHTML = response;
    //             $('#spinner').fadeOut();
    //             let count = $('#list_of_uploaded_request_with_po_table tbody tr').length;
    //             $('#count_view').html(count);
                
    //         }
    //     });
    // }


    const import_initial_rfq_button = () => {
        $("#import_rfq_btn").click(function () {
            $('#import_rfq').modal('hide');
            Swal.fire({
                icon: 'info',
                title: 'Please Wait!!',
                text: '',
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false
            });
        });
    }

    const import_full_rfq_button = () => {
        $("#full_rfq_btn").click(function () {
            $('#full_rfq').modal('hide');
            Swal.fire({
                icon: 'info',
                title: 'Please Wait!!',
                text: '',
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false
            });
        });
    }

    const import_po_btn = () => {
        $("#po_btn").click(function () {
            $('#import_po').modal('hide');
            Swal.fire({
                icon: 'info',
                title: 'Please Wait!!',
                text: '',
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false
            });
        });
    }

    const filter_rfq_process = () => {
        var rfq_status_search = document.getElementById('rfq_status_search').value;
        $.ajax({
            url: '../../process/purchasing/rfq.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'filter_rfq_process',
                rfq_status_search: rfq_status_search
            }, success: function (response) {
                $('#list_of_uploaded_request_with_po').html(response);
                $('#spinner').fadeOut();
                let count = $('#list_of_uploaded_request_with_po_table tbody tr').length;
                $('#count_view').html(count);
                if (rfq_status_search == 'cancelled') {
                    document.getElementById("cancel_check_all").disabled = true;
                } else {
                    document.getElementById("cancel_check_all").disabled = false;
                }
            }
        })
    }

    // check all and uncheck
    const uncheck_all = () => {
        var select_all = document.getElementById('cancel_check_all');
        select_all.checked = false;
        $('.singleCheck').each(function () {
            this.checked = false;
        });
        get_checked_length();
    }
    const select_all_func = () => {
        var select_all = document.getElementById('cancel_check_all');
        if (select_all.checked == true) {
            console.log('check');
            $('.singleCheck').each(function () {
                this.checked = true;
            });
        } else {
            console.log('uncheck');
            $('.singleCheck').each(function () {
                this.checked = false;
            });
        }
        get_checked_length();
    }
    const get_checked_length = () => {
        var arr = [];
        document.querySelectorAll("input.singleCheck[type='checkbox']:checked").forEach((el, i) => {
            arr.push(el.value);
        });
        console.log(arr);
        var numberOfChecked = arr.length;
        document.getElementById("numcheck").innerHTML = numberOfChecked;
        console.log(numberOfChecked);
        if (numberOfChecked > 0) {
            //document.getElementById("btnInstall").removeAttribute('disabled');
            document.getElementById("btnCancel").disabled = false;
        } else {
            //document.getElementById("btnInstall").setAttribute('disabled', true);
            document.getElementById("btnCancel").disabled = true;
        }
    }

    $("#install_modal").on('hidden.bs.modal', e => {
        $('#installation_date').val('');
    });
    const cancel_req = () => {
        var arr = [];
        $('input.singleCheck:checkbox:checked').each(function () {
            arr.push($(this).val());
        });

        var cancel_date = document.getElementById('cancel_date').value;
        var cancel_reason = document.getElementById('cancel_reason').value;

        if (cancel_date == '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Select Date of Cancellation!!!',
                text: 'Information',
                showConfirmButton: false,
                timer: 1000
            });
        } else if (cancel_reason == '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Select Reason of Cancellation!!!',
                text: 'Information',
                showConfirmButton: false,
                timer: 1000
            });
        } else {

            var numberOfChecked = arr.length;
            if (numberOfChecked > 0) {
                $.ajax({
                    url: '../../process/requester/request.php',
                    type: 'POST',
                    cache: false,
                    data: {
                        method: 'cancellation',
                        id: arr,
                        cancel_date: cancel_date,
                        cancel_reason: cancel_reason
                    }, success: function (response) {
                        console.log(response);
                        Swal.fire({
                            icon: 'success',
                            title: 'Cancellation Success!!',
                            text: 'Success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        $('#cancel_request').modal('hide');
                        $('#cancel_date').val('');
                        $('#cancel_reason').val('');
                        // search_request_with_rfq();
                        filter_rfq_process();
                       
                    }
                });
            }
            else {
                Swal.fire({
                    icon: 'info',
                    title: 'Please Select For Cancellation !!!',
                    text: 'Information',
                    showConfirmButton: false,
                    timer: 1000
                });
            }
        }

    }

    const get_cancel_details = (param) => {
        var string = param.split('~!~');
        var request_id = string[0];
        var cancel_date = string[1];
        var cancel_reason = string[2];
        var cancel_by = string[3];
        var cancel_section = string[4];

        document.getElementById('id_cancel_request').value = request_id;
        document.getElementById('cancel_reason_details').value = cancel_reason;
        document.getElementById('cancel_by_details').value = cancel_by;
        document.getElementById('cancel_section_details').value = cancel_section;
        document.getElementById('cancel_date_details').value = cancel_date;

    }

</script>