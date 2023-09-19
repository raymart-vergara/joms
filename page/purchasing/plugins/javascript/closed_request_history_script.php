<script type="text/javascript">
$(function(){
    let role = '<?=$_SESSION['role']?>';
    if (role == 'user') {
        $('#accounts_bar').hide();
    }
    sessionStorage.setItem('notif_new_joms_request', 0);
    load_notif_ame3();
    realtime_load_notif_ame3 = setInterval(load_notif_ame3, 5000);
});

const search_request_with_rfq =()=>{
	$('#spinner').css('display','block');
	$.ajax({
        url:'../../process/purchasing/po.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'fetch_request_with_po',
        },success:function(response){
        	console.log(response);
          document.getElementById('list_of_uploaded_request_with_po').innerHTML = response;
           $('#spinner').fadeOut();
        }
    });
}

const get_closed_request_history = () => {
    var history_date_from = document.getElementById("history_date_from").value.trim();
    var history_date_to = document.getElementById("history_date_to").value.trim();
    if (history_date_from == '' || history_date_to == '') {
        Swal.fire({
            icon: 'info',
            title: 'Closed Request History',
            text: 'Fill out all date fields',
            showConfirmButton: false,
            timer : 1000
        });
    } else {
        $.ajax({
            url: '../../process/purchasing/po.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'get_closed_request_history',
                history_date_from: history_date_from,
                history_date_to: history_date_to
            }, 
            beforeSend: (jqXHR, settings) => {
                $('#spinner').css('display','block');
                jqXHR.url = settings.url;
                jqXHR.type = settings.type;
            }, 
            success: response => {
                document.getElementById('list_of_uploaded_request_with_po').innerHTML = response;
                $('#spinner').fadeOut();
                let count = $('#list_of_uploaded_request_with_po_table tbody tr').length;
                $('#count_view').html(count);
            }
        })
        .fail((jqXHR, textStatus, errorThrown) => {
          console.log(jqXHR);
          console.log(`System Error!!! Call IT Personnel Immediately!!! They will fix it right away. Error: url: ${jqXHR.url}, method: ${jqXHR.type} ( HTTP ${jqXHR.status} - ${jqXHR.statusText} )`);
        });
    }
}

const export_closed_request_history = () => {
    var history_date_from = document.getElementById("history_date_from").value.trim();
    var history_date_to = document.getElementById("history_date_to").value.trim();
    if (history_date_from != '' || history_date_to != '') {
        window.open('../../process/export/export_closed_request_history.php?history_date_from='+history_date_from+'&history_date_to='+history_date_to,'_blank');
    } else {
        Swal.fire({
            icon: 'info',
            title: 'Closed Request History',
            text: 'Fill out all date fields',
            showConfirmButton: false,
            timer : 1000
        });
    }
}

</script>