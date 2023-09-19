<script type="text/javascript">
    $(function () {
        let role = '<?= $_SESSION['role'] ?>';
        if (role == 'user') {
            $('#accounts_bar').hide();
        };

        $("#upload_request_btn").click(function () {
            $('#import_request').modal('hide');
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

        search_request();
        setInterval(search_request, 10000);

    });



    const search_request = () => {
        $('#spinner').css('display', 'block');
        $.ajax({
            url: '../../process/requester/request.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'fetch_requested_processed',
            }, success: function (response) {
                document.getElementById('list_of_uploaded_request').innerHTML = response;
                $('#spinner').fadeOut();
                let count = $('#list_of_uploaded_request_table tbody tr').length;
                $('#count_view').html(count);
            }
        });
    }


</script>