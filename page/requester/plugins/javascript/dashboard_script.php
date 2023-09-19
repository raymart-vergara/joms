<script type="text/javascript">
$(function(){
    let role = '<?=$_SESSION['role']?>';
    if (role == 'user') {
        $('#accounts_bar').hide();
    }
    document.getElementById('request_date_from_search').value = '<?=$server_date_only?>';
    document.getElementById('request_date_to_search').value = '<?=$server_date_only?>';
    search_request();
    setInterval(search_request, 10000);
});

const search_request =()=>{
    let request_status = document.getElementById('request_status_search').value;
    let request_date_from = document.getElementById('request_date_from_search').value;
    let request_date_to = document.getElementById('request_date_to_search').value;
	$('#spinner').css('display','block');
	$.ajax({
        url:'../../process/requester/request.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'fetch_request',
            request_status: request_status,
            request_date_from: request_date_from,
            request_date_to: request_date_to
        },success:function(response){
          document.getElementById('list_of_request').innerHTML = response;
          $('#spinner').fadeOut();
          let count = $('#list_of_request_table tbody tr').length;
          $('#count_view').html(count);
        }
    });
}
</script>