<?php
session_start();
include '../conn.php';

$method = $_POST['method'];

if ($method == 'fetch_requested_processed') {
	$request_status = $_POST['request_status'];
	$c = 0;
	$query = "SELECT joms_request.request_id, joms_request.status, joms_request.carmaker, joms_request.carmodel, joms_request.product, joms_request.jigname, joms_request.drawing_no, joms_request.type,
	joms_request.qty, joms_request.purpose, joms_request.budget, joms_request.date_requested, joms_request.requested_by , joms_request.required_delivery_date, joms_request.remarks, joms_request.uploaded_by,
	joms_rfq_process.date_of_issuance_rfq, joms_rfq_process.rfq_no, joms_rfq_process.target_date_reply_quotation, joms_rfq_process.item_code, joms_rfq_process.date_reply_quotation , joms_rfq_process.leadtime, joms_rfq_process.quotation_no,
	joms_rfq_process.unit_price_jpy, joms_rfq_process.unit_price_usd, joms_rfq_process.unit_price_usd,  joms_rfq_process.total_amount, joms_rfq_process.fsib_no, joms_rfq_process.fsib_code, joms_rfq_process.date_sent_to_internal_signatories,joms_rfq_process.target_approval_date_of_quotation,
	joms_rfq_process.i_uploaded_by, joms_rfq_process.c_uploaded_by
	FROM joms_request
	LEFT JOIN joms_rfq_process ON joms_rfq_process.request_id = joms_request.request_id WHERE joms_request.status = 'open'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {

			$c++;
			echo '<tr>';
			echo '<td>';
			$disable_row = '';
			if ($request_status == 'cancelled') {
				$disable_row = 'disabled';
				$cursor = 'cursor:pointer';
				$class_mods = 'modal-trigger" data-toggle="modal" data-target="#cancel_info_modal';
			}
			echo '<input type="checkbox" class="singleCheck bg-secondary" value="' . $j['request_id'] . '" onclick="get_checked_length()" ' . $disable_row . '>';
			echo '</td>';
			echo '<td>' . $c . '</td>';
			echo '<td style = " '.$color. $cursor. '"  class="'.$class_mods.'" onclick="get_cancel_details(&quot;' . $j['request_id'] . '~!~' . $j['cancel_date'] . '~!~' . $j['cancel_reason'] . '~!~' . $j['cancel_by'] .'~!~' . $j['cancel_section'] .'&quot;)">' . $j['status'] . '</td>';
			echo '<td>' . $j['carmaker'] . '</td>';
			echo '<td>' . $j['carmodel'] . '</td>';
			echo '<td>' . $j['product'] . '</td>';
			echo '<td>' . $j['jigname'] . '</td>';
			echo '<td>' . $j['drawing_no'] . '</td>';
			echo '<td>' . $j['type'] . '</td>';
			echo '<td>' . $j['qty'] . '</td>';
			echo '<td>' . $j['purpose'] . '</td>';
			echo '<td>' . $j['budget'] . '</td>';
			echo '<td>' . $j['date_requested'] . '</td>';
			echo '<td>' . $j['requested_by'] . '</td>';
			echo '<td>' . $j['required_delivery_date'] . '</td>';
			echo '<td>' . $j['remarks'] . '</td>';
			echo '<td>' . $j['uploaded_by'] . '</td>';

			echo '<td>' . $j['date_of_issuance_rfq'] . '</td>';
			echo '<td>' . $j['rfq_no'] . '</td>';
			echo '<td>' . $j['target_date_reply_quotation'] . '</td>';
			echo '<td>' . $j['item_code'] . '</td>';
			echo '<td>' . $j['i_uploaded_by'] . '</td>';

			echo '<td>' . $j['date_reply_quotation'] . '</td>';
			echo '<td>' . $j['leadtime'] . '</td>';
			echo '<td>' . $j['quotation_no'] . '</td>';
			echo '<td>' . $j['unit_price_jpy'] . '</td>';
			echo '<td>' . $j['unit_price_usd'] . '</td>';
			echo '<td>' . $j['unit_price_php'] . '</td>';
			echo '<td>' . $j['total_amount'] . '</td>';
			echo '<td>' . $j['fsib_no'] . '</td>';
			echo '<td>' . $j['fsib_code'] . '</td>';
			echo '<td>' . $j['date_sent_to_internal_signatories'] . '</td>';
			echo '<td>' . $j['target_approval_date_of_quotation'] . '</td>';
			echo '<td>' . $j['c_uploaded_by'] . '</td>';

			echo '</tr>';
		}
	} else {

	}
}

if ($method == 'filter_rfq_process') {
	$rfq_status_search = $_POST['rfq_status_search'];
	$c = 0;
	$query = "SELECT joms_request.request_id, joms_request.status, joms_request.carmaker, joms_request.carmodel, joms_request.product, joms_request.jigname, joms_request.drawing_no, joms_request.type,
	joms_request.qty, joms_request.purpose, joms_request.budget, joms_request.date_requested, joms_request.requested_by , joms_request.required_delivery_date, joms_request.remarks, joms_request.uploaded_by,
	joms_rfq_process.date_of_issuance_rfq, joms_rfq_process.rfq_no, joms_rfq_process.target_date_reply_quotation, joms_rfq_process.item_code, joms_rfq_process.date_reply_quotation , joms_rfq_process.leadtime, joms_rfq_process.quotation_no, joms_rfq_process.i_uploaded_by,joms_rfq_process.c_uploaded_by,
	joms_rfq_process.unit_price_jpy, joms_rfq_process.unit_price_usd, joms_rfq_process.unit_price_php, joms_rfq_process.total_amount, joms_rfq_process.fsib_no, joms_rfq_process.fsib_code, joms_rfq_process.date_sent_to_internal_signatories
	FROM joms_request
	LEFT JOIN joms_rfq_process ON joms_rfq_process.request_id = joms_request.request_id WHERE joms_request.status = 'open' AND date_reply_quotation IS NULL AND leadtime IS NULL  AND quotation_no IS NULL AND unit_price_jpy IS NULL AND total_amount IS NULL AND leadtime IS NULL AND" . "'$rfq_status_search' = 'open_initial' ";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			echo '<tr>';
			echo '<td>';
			$disable_row = '';
			if ($rfq_status_search == 'cancelled') {
				$disable_row = 'disabled';
			}
			echo '<input type="checkbox" class="singleCheck bg-secondary" value="' . $j['request_id'] . '" onclick="get_checked_length()" ' . $disable_row . '>';
			echo '</td>';
			echo '<td>' . $c . '</td>';
			echo '<td>' . $j['status'] . '</td>';
			echo '<td>' . $j['carmaker'] . '</td>';
			echo '<td>' . $j['carmodel'] . '</td>';
			echo '<td>' . $j['product'] . '</td>';
			echo '<td>' . $j['jigname'] . '</td>';
			echo '<td>' . $j['drawing_no'] . '</td>';
			echo '<td>' . $j['type'] . '</td>';
			echo '<td>' . $j['qty'] . '</td>';
			echo '<td>' . $j['purpose'] . '</td>';
			echo '<td>' . $j['budget'] . '</td>';
			echo '<td>' . $j['date_requested'] . '</td>';
			echo '<td>' . $j['requested_by'] . '</td>';
			echo '<td>' . $j['required_delivery_date'] . '</td>';
			echo '<td>' . $j['remarks'] . '</td>';
			echo '<td>' . $j['uploaded_by'] . '</td>';

			echo '<td>' . $j['date_of_issuance_rfq'] . '</td>';
			echo '<td>' . $j['rfq_no'] . '</td>';
			echo '<td>' . $j['target_date_reply_quotation'] . '</td>';
			echo '<td>' . $j['item_code'] . '</td>';
			echo '<td>' . $j['i_uploaded_by'] . '</td>';


			echo '</tr>';
		}
	}

	$query = "SELECT joms_request.request_id, joms_request.status, joms_request.carmaker, joms_request.carmodel, joms_request.product, joms_request.jigname, joms_request.drawing_no, joms_request.type,
	joms_request.qty, joms_request.purpose, joms_request.budget, joms_request.date_requested, joms_request.requested_by , joms_request.required_delivery_date, joms_request.remarks,joms_request.uploaded_by,
	joms_rfq_process.date_of_issuance_rfq, joms_rfq_process.rfq_no, joms_rfq_process.target_date_reply_quotation,joms_rfq_process.item_code, joms_rfq_process.date_reply_quotation , joms_rfq_process.leadtime, joms_rfq_process.quotation_no, joms_rfq_process.i_uploaded_by,joms_rfq_process.c_uploaded_by,
	joms_rfq_process.unit_price_jpy, joms_rfq_process.unit_price_usd, joms_rfq_process.unit_price_php, joms_rfq_process.total_amount, joms_rfq_process.fsib_no, joms_rfq_process.fsib_code, joms_rfq_process.date_sent_to_internal_signatories, joms_rfq_process.target_approval_date_of_quotation
	FROM joms_request
	LEFT JOIN joms_rfq_process ON joms_rfq_process.request_id = joms_request.request_id WHERE joms_request.status = 'open' AND date_reply_quotation IS   NOT NULL AND leadtime IS   NOT NULL  AND quotation_no IS NOT NULL  AND unit_price_jpy IS NOT NULL AND total_amount IS NOT NULL AND " . "'$rfq_status_search' = 'open_complete' ";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			echo '<tr>';
			echo '<td>';
			$disable_row = '';
			if ($rfq_status_search == 'cancelled') {
				$disable_row = 'disabled';
			}
			echo '<input type="checkbox" class="singleCheck bg-secondary" value="' . $j['request_id'] . '" onclick="get_checked_length()" ' . $disable_row . '>';
			echo '</td>';
			echo '<td>' . $c . '</td>';
			echo '<td style = " '.$color. $cursor. '"  class="'.$class_mods.'" onclick="get_cancel_details(&quot;' . $j['request_id'] . '~!~' . $j['cancel_date'] . '~!~' . $j['cancel_reason'] . '~!~' . $j['cancel_by'] .'~!~' . $j['cancel_section'] .'&quot;)">' . $j['status'] . '</td>';
			echo '<td>' . $j['carmaker'] . '</td>';
			echo '<td>' . $j['carmodel'] . '</td>';
			echo '<td>' . $j['product'] . '</td>';
			echo '<td>' . $j['jigname'] . '</td>';
			echo '<td>' . $j['drawing_no'] . '</td>';
			echo '<td>' . $j['type'] . '</td>';
			echo '<td>' . $j['qty'] . '</td>';
			echo '<td>' . $j['purpose'] . '</td>';
			echo '<td>' . $j['budget'] . '</td>';
			echo '<td>' . $j['date_requested'] . '</td>';
			echo '<td>' . $j['requested_by'] . '</td>';
			echo '<td>' . $j['required_delivery_date'] . '</td>';
			echo '<td>' . $j['remarks'] . '</td>';
			echo '<td>' . $j['uploaded_by'] . '</td>';

			echo '<td>' . $j['date_of_issuance_rfq'] . '</td>';
			echo '<td>' . $j['rfq_no'] . '</td>';
			echo '<td>' . $j['target_date_reply_quotation'] . '</td>';
			echo '<td>' . $j['item_code'] . '</td>';
			echo '<td>' . $j['i_uploaded_by'] . '</td>';

			echo '<td>' . $j['date_reply_quotation'] . '</td>';
			echo '<td>' . $j['leadtime'] . '</td>';
			echo '<td>' . $j['quotation_no'] . '</td>';
			echo '<td>' . $j['unit_price_jpy'] . '</td>';
			echo '<td>' . $j['unit_price_usd'] . '</td>';
			echo '<td>' . $j['unit_price_php'] . '</td>';
			echo '<td>' . $j['total_amount'] . '</td>';
			echo '<td>' . $j['fsib_no'] . '</td>';
			echo '<td>' . $j['fsib_code'] . '</td>';
			echo '<td>' . $j['date_sent_to_internal_signatories'] . '</td>';
			echo '<td>' . $j['target_approval_date_of_quotation'] . '</td>';
			echo '<td>' . $j['c_uploaded_by'] . '</td>';

			echo '</tr>';
		}
	}
	$query = "SELECT joms_request.request_id, joms_request.status, joms_request.carmaker, joms_request.carmodel, joms_request.product, joms_request.jigname, joms_request.drawing_no, joms_request.type,
	joms_request.qty, joms_request.purpose, joms_request.budget, joms_request.date_requested, joms_request.requested_by , joms_request.required_delivery_date, joms_request.remarks,joms_request.uploaded_by,
	joms_rfq_process.date_of_issuance_rfq, joms_rfq_process.rfq_no, joms_rfq_process.target_date_reply_quotation, joms_rfq_process.item_code, joms_rfq_process.date_reply_quotation , joms_rfq_process.leadtime, joms_rfq_process.quotation_no, joms_rfq_process.i_uploaded_by,joms_rfq_process.c_uploaded_by,
	joms_rfq_process.unit_price_jpy, joms_rfq_process.unit_price_usd, joms_rfq_process.unit_price_php, joms_rfq_process.total_amount, joms_rfq_process.fsib_no, joms_rfq_process.fsib_code, joms_rfq_process.date_sent_to_internal_signatories, joms_rfq_process.target_approval_date_of_quotation
	FROM joms_request
	LEFT JOIN joms_rfq_process ON joms_rfq_process.request_id = joms_request.request_id WHERE joms_request.status = 'open' AND " . "'$rfq_status_search' = 'open_all' ";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			echo '<tr>';
		echo '<td>';
			$disable_row = '';
			if ($rfq_status_search == 'cancelled') {
				$disable_row = 'disabled';
			}
			echo '<input type="checkbox" class="singleCheck bg-secondary" value="' . $j['request_id'] . '" onclick="get_checked_length()" ' . $disable_row . '>';
			echo '</td>';
			echo '<td>' . $c . '</td>';
			echo '<td style = " '.$color. $cursor. '"  class="'.$class_mods.'" onclick="get_cancel_details(&quot;' . $j['request_id'] . '~!~' . $j['cancel_date'] . '~!~' . $j['cancel_reason'] . '~!~' . $j['cancel_by'] .'~!~' . $j['cancel_section'] .'&quot;)">' . $j['status'] . '</td>';
			echo '<td>' . $j['carmaker'] . '</td>';
			echo '<td>' . $j['carmodel'] . '</td>';
			echo '<td>' . $j['product'] . '</td>';
			echo '<td>' . $j['jigname'] . '</td>';
			echo '<td>' . $j['drawing_no'] . '</td>';
			echo '<td>' . $j['type'] . '</td>';
			echo '<td>' . $j['qty'] . '</td>';
			echo '<td>' . $j['purpose'] . '</td>';
			echo '<td>' . $j['budget'] . '</td>';
			echo '<td>' . $j['date_requested'] . '</td>';
			echo '<td>' . $j['requested_by'] . '</td>';
			echo '<td>' . $j['required_delivery_date'] . '</td>';
			echo '<td>' . $j['remarks'] . '</td>';
			echo '<td>' . $j['uploaded_by'] . '</td>';

			echo '<td>' . $j['date_of_issuance_rfq'] . '</td>';
			echo '<td>' . $j['rfq_no'] . '</td>';
			echo '<td>' . $j['target_date_reply_quotation'] . '</td>';
			echo '<td>' . $j['item_code'] . '</td>';
			echo '<td>' . $j['i_uploaded_by'] . '</td>';

			echo '<td>' . $j['date_reply_quotation'] . '</td>';
			echo '<td>' . $j['leadtime'] . '</td>';
			echo '<td>' . $j['quotation_no'] . '</td>';
			echo '<td>' . $j['unit_price_jpy'] . '</td>';
			echo '<td>' . $j['unit_price_usd'] . '</td>';
			echo '<td>' . $j['unit_price_php'] . '</td>';
			echo '<td>' . $j['total_amount'] . '</td>';
			echo '<td>' . $j['fsib_no'] . '</td>';
			echo '<td>' . $j['fsib_code'] . '</td>';
			echo '<td>' . $j['date_sent_to_internal_signatories'] . '</td>';
			echo '<td>'. $j['target_approval_date_of_quotation'] . '</td>';
			echo '<td>' . $j['c_uploaded_by'] . '</td>';

			echo '</tr>';
		}
	}

	$query = "SELECT joms_request.request_id, joms_request.status, joms_request.carmaker, joms_request.carmodel, joms_request.product, joms_request.jigname, joms_request.drawing_no, joms_request.type,
	joms_request.qty, joms_request.purpose, joms_request.budget, joms_request.date_requested, joms_request.requested_by , joms_request.required_delivery_date, joms_request.remarks, joms_request.uploaded_by, joms_request.cancel_date, joms_request.cancel_reason, joms_request.cancel_by, joms_request.cancel_section,
	joms_rfq_process.date_of_issuance_rfq, joms_rfq_process.rfq_no, joms_rfq_process.target_date_reply_quotation, joms_rfq_process.item_code, joms_rfq_process.date_reply_quotation , joms_rfq_process.leadtime, joms_rfq_process.quotation_no, joms_rfq_process.i_uploaded_by,joms_rfq_process.c_uploaded_by,
	joms_rfq_process.unit_price_jpy, joms_rfq_process.unit_price_usd, joms_rfq_process.unit_price_php, joms_rfq_process.total_amount, joms_rfq_process.fsib_no, joms_rfq_process.fsib_code, joms_rfq_process.date_sent_to_internal_signatories, joms_rfq_process.target_approval_date_of_quotation
	FROM joms_request
	LEFT JOIN joms_rfq_process ON joms_rfq_process.request_id = joms_request.request_id WHERE joms_request.status = 'cancelled' AND " . "'$rfq_status_search' = 'cancelled' ";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			echo '<tr>';
		echo '<td>';
			$disable_row = '';
			if ($rfq_status_search == 'cancelled') {
				$disable_row = 'disabled';
				$cursor = 'cursor:pointer';
				$class_mods = 'modal-trigger" data-toggle="modal" data-target="#cancel_info_modal';
			} else {
				$cursor = "";
				$class_mods= "";
			}
			
			echo '<input type="checkbox" class="singleCheck bg-secondary" value="' . $j['request_id'] . '" onclick="get_checked_length()" ' . $disable_row . '>';
			echo '</td>';
			echo '<td>' . $c . '</td>';
			echo '<td style = " '.$color. $cursor. '"  class="'.$class_mods.'" onclick="get_cancel_details(&quot;' . $j['request_id'] . '~!~' . $j['cancel_date'] . '~!~' . $j['cancel_reason'] . '~!~' . $j['cancel_by'] .'~!~' . $j['cancel_section'] .'&quot;)">' . $j['status'] . '</td>';
			echo '<td>' . $j['carmaker'] . '</td>';
			echo '<td>' . $j['carmodel'] . '</td>';
			echo '<td>' . $j['product'] . '</td>';
			echo '<td>' . $j['jigname'] . '</td>';
			echo '<td>' . $j['drawing_no'] . '</td>';
			echo '<td>' . $j['type'] . '</td>';
			echo '<td>' . $j['qty'] . '</td>';
			echo '<td>' . $j['purpose'] . '</td>';
			echo '<td>' . $j['budget'] . '</td>';
			echo '<td>' . $j['date_requested'] . '</td>';
			echo '<td>' . $j['requested_by'] . '</td>';
			echo '<td>' . $j['required_delivery_date'] . '</td>';
			echo '<td>' . $j['remarks'] . '</td>';
			echo '<td>' . $j['uploaded_by'] . '</td>';

			echo '<td>' . $j['date_of_issuance_rfq'] . '</td>';
			echo '<td>' . $j['rfq_no'] . '</td>';
			echo '<td>' . $j['target_date_reply_quotation'] . '</td>';
			echo '<td>' . $j['item_code'] . '</td>';
			echo '<td>' . $j['i_uploaded_by'] . '</td>';

			echo '<td>' . $j['date_reply_quotation'] . '</td>';
			echo '<td>' . $j['leadtime'] . '</td>';
			echo '<td>' . $j['quotation_no'] . '</td>';
			echo '<td>' . $j['unit_price_jpy'] . '</td>';
			echo '<td>' . $j['unit_price_usd'] . '</td>';
			echo '<td>' . $j['unit_price_php'] . '</td>';
			echo '<td>' . $j['total_amount'] . '</td>';
			echo '<td>' . $j['fsib_no'] . '</td>';
			echo '<td>' . $j['fsib_code'] . '</td>';
			echo '<td>' . $j['date_sent_to_internal_signatories'] . '</td>';
			echo '<td>'. $j['target_approval_date_of_quotation'] . '</td>';
			echo '<td>' . $j['c_uploaded_by'] . '</td>';

			echo '</tr>';
		}
	}
}

if ($method == 'cancellation') {
	$id = [];
	$id = $_POST['id'];
	$cancel_date = $_POST['cancel_date'];
	$cancel_reason = $_POST['cancel_reason'];
	$count = count($id);
	foreach ($id as $j) {
		//echo $j;
		$query = "UPDATE joms_request 
		SET status = 'cancelled', cancel_date = '$cancel_date', cancel_reason = '$cancel_reason', 
		cancel_by = '" . $_SESSION['fullname'] . "', cancel_section = '" . $_SESSION['section'] . "' WHERE request_id = '$j'";
		$stmt = $conn->prepare($query);
		if ($stmt->execute() > 0) {
			$count = $count - 1;
		}
	}
	if ($count == 0) {
		echo 'success';
	} else {
		echo 'fail';
	}
}

$conn = NULL;
?>