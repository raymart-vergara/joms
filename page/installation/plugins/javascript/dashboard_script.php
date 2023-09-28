<script type="text/javascript">

    //para mahide yung page ng Account settings kapag user ka
    $(function () {
        let role = '<?= $_SESSION['role'] ?>';
        if (role == 'user') {
            $('#accounts_bar').hide();
        }
        search_request();
        search_request2();
        setInterval(search_request2, 10000);
    });

    //Only for Display lang sya ng data ng without Installation Date not for searching. check the method name if same sa backend at malaman ang process.
    const search_request = () => {
        $.ajax({
            url: '../../process/installation/installation.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'fetch_request',
                has_installation_date: 0
            }, success: function (response) {
                document.getElementById('list_of_request').innerHTML = response;
                //Count ng request table
                let count = $('#list_of_request_table tbody tr').length;
                $('#count_view').html(count);
            }
        });
    }
    //Only for Display lang sya ng data ng with Installation Date not for searching. check the method name if same sa backend at malaman ang process.
    const search_request2 = () => {
        $.ajax({
            url: '../../process/installation/installation.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'fetch_request',
                has_installation_date: 1
            }, success: function (response) {
                document.getElementById('list_of_request2').innerHTML = response;
                let count = $('#list_of_request_table2 tbody tr').length;
                $('#count_view2').html(count);
            }
        });
    }

    // check all and uncheck
    const uncheck_all = () => {
        var select_all = document.getElementById('installation_check_all');
        select_all.checked = false;
        $('.singleCheck').each(function () {
            this.checked = false;
        });
        get_checked_length();
    }
    const select_all_func = () => {
        var select_all = document.getElementById('installation_check_all');
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
            document.getElementById("btnInstall").disabled = false;
        } else {
            //document.getElementById("btnInstall").setAttribute('disabled', true);
            document.getElementById("btnInstall").disabled = true;
        }
    }

    $("#install_modal").on('hidden.bs.modal', e => {
        $('#installation_date').val('');
    });

    const install = () => {

        var arr = [];
        $('input.singleCheck:checkbox:checked').each(function () {
            arr.push($(this).val());
        });

        var installation_date = document.getElementById('installation_date').value;
        var line_no = document.getElementById('line_no').value;

        if (installation_date == '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Select Date of Installation !',
                text: 'Information',
                showConfirmButton: false,
                timer: 1000
            });
        } else if (line_no == '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Insert Line Number !',
                text: 'Information',
                showConfirmButton: false,
                timer: 1000
            });
        }else {

            var numberOfChecked = arr.length;
            if (numberOfChecked > 0) {

                $.ajax({
                    url: '../../process/installation/installation.php',
                    type: 'POST',
                    cache: false,
                    data: {
                        method: 'install',
                        id: arr,
                        installation_date: installation_date,
                        line_no : line_no
                    }, success: function (response) {
                        console.log(response);
                        Swal.fire({
                            icon: 'success',
                            title: 'Installation Date Successfully Updated',
                            text: 'Success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        $('#installation_date').val('');
                        $('#line_no').val('');
                        search_request();
                        search_request2();
                        $('#install_modal').modal('hide');
                    }
                });
            }
            else {
                Swal.fire({
                    icon: 'info',
                    title: 'Please Select For Installation !!!',
                    text: 'Information',
                    showConfirmButton: false,
                    timer: 1000
                });
            }
        }

    }
</script>