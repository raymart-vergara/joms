<script type="text/javascript">
// Global Variables for Realtime Tables
var realtime_search_request;

$(function(){
    let role = '<?=$_SESSION['role']?>';
    if (role == 'user') {
        $('#accounts_bar').hide();
    }
    search_request();
    realtime_search_request = setInterval(search_request, 5000);

    sessionStorage.setItem('notif_new_joms_request', 0);
    load_notif_ame3_joms_request_page();
    realtime_load_notif_ame3_joms_request_page = setInterval(load_notif_ame3_joms_request_page, 5000);
    update_notif_new_joms_request();
});

const search_request =()=>{
	$('#spinner').css('display','block');
	$.ajax({
        url:'../../process/purchasing/request.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'fetch_requested_processed',
        },success:function(response){
          document.getElementById('list_of_uploaded_request').innerHTML = response;
          $('#spinner').fadeOut();
          let count = $('#list_of_uploaded_request_table tbody tr').length;
          $('#count_view').html(count);
        }
    });
}


</script>