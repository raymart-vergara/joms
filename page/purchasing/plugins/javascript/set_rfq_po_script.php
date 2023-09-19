<script type="text/javascript">
    $(function () {
        let role = '<?= $_SESSION['role'] ?>';
        if (role == 'user') {
            $('#accounts_bar').hide();
        }

        search_request_with_rfq();
        filter_rfq_process();
        sessionStorage.setItem('notif_new_joms_request', 0);
        load_notif_ame3();
        realtime_load_notif_ame3 = setInterval(load_notif_ame3, 5000);

        import_initial_rfq_button();
        import_full_rfq_button();
        import_po_btn();

    });

    const search_request_with_rfq = () => {
        $('#spinner').css('display', 'block');
        $.ajax({
            url: '../../process/purchasing/po.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'fetch_request_with_po',
            }, success: function (response) {
                document.getElementById('list_of_uploaded_request_with_po').innerHTML = response;
                $('#spinner').fadeOut();
                let count = $('#list_of_uploaded_request_with_po_table tbody tr').length;
                $('#count_view').html(count);
            }
        });
    }


    const import_initial_rfq_button = () => {
        $("#import_rfq_btn").click(function () {
            $('#import_rfq').modal('hide');
            Swal.fire({
                            icon: 'info',
                            title: 'Please Wait!!',
                            text: '',
                            showConfirmButton: false,
                            allowOutsideClick:false,
                            allowEscapeKey:false,
                            allowEnterKey:false
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
                            allowOutsideClick:false,
                            allowEscapeKey:false,
                            allowEnterKey:false
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
                            allowOutsideClick:false,
                            allowEscapeKey:false,
                            allowEnterKey:false
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
            }
        })
    }
    

</script>