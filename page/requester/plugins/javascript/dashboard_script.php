<script type="text/javascript">
	$(function () {
		let role = '<?= $_SESSION['role'] ?>';
		if (role == 'user') {
			$('#accounts_bar').hide();
		}

		if (status == 'open') {
			let status = document.getElementById("btnCancel").disabled
		}
		document.getElementById('request_date_from_search').value = '<?= $server_date_only ?>';
		document.getElementById('request_date_to_search').value = '<?= $server_date_only ?>';
		search_request();
		//setInterval(search_request, 10000);
	});

	const search_request = () => {
		let request_status = document.getElementById('request_status_search').value;
		let request_date_from = document.getElementById('request_date_from_search').value;
		let request_date_to = document.getElementById('request_date_to_search').value;
		let request_section = document.getElementById('request_section_search').value;

		$('#spinner').css('display', 'block');
		$.ajax({
			url: '../../process/requester/request.php',
			type: 'POST',
			cache: false,
			data: {
				method: 'fetch_request',
				request_status: request_status,
				request_date_from: request_date_from,
				request_date_to: request_date_to,
				request_section: request_section
			}, success: function (response) {
				document.getElementById('list_of_request').innerHTML = response;
				$('#spinner').fadeOut();
				let count = $('#list_of_request_table tbody tr').length;
				$('#count_view').html(count);
				if (request_status == 'open') {
					document.getElementById("cancel_check_all").disabled = true;
				} else if (request_status == 'cancelled') {
					document.getElementById("cancel_check_all").disabled = true;
				} else if (request_status == 'ame3') {
					document.getElementById("cancel_check_all").disabled = true;
				} else if (request_status == 'ame2') {
					document.getElementById("cancel_check_all").disabled = true;
				} else {
					document.getElementById("cancel_check_all").disabled = false;
				}
			}
		});
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
							title: 'Installation Date Successfully Updated',
							text: 'Success',
							showConfirmButton: false,
							timer: 1000
						});
						$('#cancel_date').val('');
						$('#cancel_reason').val('');
						search_request();
						$('#cancel_request').modal('hide');
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

</script>