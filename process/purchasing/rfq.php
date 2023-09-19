<?php
include '../conn.php';

$method = $_POST['method'];

if ($method == 'fetch_requested_processed') {
	$c = 0;
	$query = "SELECT joms_request.status, joms_request.carmaker, joms_request.carmodel, joms_request.product, joms_request.jigname, joms_request.drawing_no, joms_request.type,
joms_request.qty, joms_request.purpose, joms_request.budget, joms_request.date_requested, joms_request.requested_by , joms_request.required_delivery_date, joms_request.remarks,
joms_rfq_process.date_of_issuance_rfq, joms_rfq_process.rfq_no, joms_rfq_process.target_date_reply_quotation, joms_rfq_process.date_reply_quotation , joms_rfq_process.leadtime, joms_rfq_process.quotation_no,
joms_rfq_process.unit_price_jpy, joms_rfq_process.unit_price_usd, joms_rfq_process.total_amount, joms_rfq_process.fsib_no, joms_rfq_process.fsib_code, joms_rfq_process.date_sent_to_internal_signatories
FROM joms_request
LEFT JOIN joms_rfq_process ON joms_rfq_process.request_id = joms_request.request_id WHERE joms_request.status = 'open'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			echo '<tr>';
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

			echo '<td>' . $j['date_of_issuance_rfq'] . '</td>';
			echo '<td>' . $j['rfq_no'] . '</td>';
			echo '<td>' . $j['target_date_reply_quotation'] . '</td>';
			echo '<td>' . $j['date_reply_quotation'] . '</td>';
			echo '<td>' . $j['leadtime'] . '</td>';
			echo '<td>' . $j['quotation_no'] . '</td>';
			echo '<td>' . $j['unit_price_jpy'] . '</td>';
			echo '<td>' . $j['unit_price_usd'] . '</td>';
			echo '<td>' . $j['total_amount'] . '</td>';
			//rfq added
			echo '<td>' . $j['fsib_no'] . '</td>';
			echo '<td>' . $j['fsib_code'] . '</td>';
			echo '<td>' . $j['date_sent_to_internal_signatories'] . '</td>';

			echo '</tr>';
		}
	} else {

	}
}

if ($method == 'filter_rfq_process') {
	$rfq_status_search = $_POST['rfq_status_search'];
	$c = 0;
	$query = "SELECT joms_request.status, joms_request.carmaker, joms_request.carmodel, joms_request.product, joms_request.jigname, joms_request.drawing_no, joms_request.type,
	joms_request.qty, joms_request.purpose, joms_request.budget, joms_request.date_requested, joms_request.requested_by , joms_request.required_delivery_date, joms_request.remarks,
	joms_rfq_process.date_of_issuance_rfq, joms_rfq_process.rfq_no, joms_rfq_process.target_date_reply_quotation, joms_rfq_process.date_reply_quotation , joms_rfq_process.leadtime, joms_rfq_process.quotation_no,
	joms_rfq_process.unit_price_jpy, joms_rfq_process.unit_price_usd, joms_rfq_process.total_amount, joms_rfq_process.fsib_no, joms_rfq_process.fsib_code, joms_rfq_process.date_sent_to_internal_signatories
	FROM joms_request
	LEFT JOIN joms_rfq_process ON joms_rfq_process.request_id = joms_request.request_id WHERE joms_request.status = 'open' AND date_reply_quotation IS NULL AND leadtime IS NULL  AND quotation_no IS NULL AND unit_price_jpy IS NULL AND total_amount IS NULL AND leadtime IS NULL AND" . "'$rfq_status_search' = 'open_initial' ";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			echo '<tr>';
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

			echo '<td>' . $j['date_of_issuance_rfq'] . '</td>';
			echo '<td>' . $j['rfq_no'] . '</td>';
			echo '<td>' . $j['target_date_reply_quotation'] . '</td>';


			echo '</tr>';
		}
	}

	$query = "SELECT joms_request.status, joms_request.carmaker, joms_request.carmodel, joms_request.product, joms_request.jigname, joms_request.drawing_no, joms_request.type,
	joms_request.qty, joms_request.purpose, joms_request.budget, joms_request.date_requested, joms_request.requested_by , joms_request.required_delivery_date, joms_request.remarks,
	joms_rfq_process.date_of_issuance_rfq, joms_rfq_process.rfq_no, joms_rfq_process.target_date_reply_quotation, joms_rfq_process.date_reply_quotation , joms_rfq_process.leadtime, joms_rfq_process.quotation_no,
	joms_rfq_process.unit_price_jpy, joms_rfq_process.unit_price_usd, joms_rfq_process.total_amount, joms_rfq_process.fsib_no, joms_rfq_process.fsib_code, joms_rfq_process.date_sent_to_internal_signatories
	FROM joms_request
	LEFT JOIN joms_rfq_process ON joms_rfq_process.request_id = joms_request.request_id WHERE joms_request.status = 'open' AND date_reply_quotation IS   NOT NULL AND leadtime IS   NOT NULL  AND quotation_no IS NOT NULL  AND unit_price_jpy IS NOT NULL AND total_amount IS NOT NULL AND " . "'$rfq_status_search' = 'open_complete' ";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			echo '<tr>';
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

			echo '<td>' . $j['date_of_issuance_rfq'] . '</td>';
			echo '<td>' . $j['rfq_no'] . '</td>';
			echo '<td>' . $j['target_date_reply_quotation'] . '</td>';
			echo '<td>' . $j['date_reply_quotation'] . '</td>';
			echo '<td>' . $j['leadtime'] . '</td>';
			echo '<td>' . $j['quotation_no'] . '</td>';
			echo '<td>' . $j['unit_price_jpy'] . '</td>';
			echo '<td>' . $j['unit_price_usd'] . '</td>';
			echo '<td>' . $j['total_amount'] . '</td>';
			//rfq added
			echo '<td>' . $j['fsib_no'] . '</td>';
			echo '<td>' . $j['fsib_code'] . '</td>';
			echo '<td>' . $j['date_sent_to_internal_signatories'] . '</td>';



			echo '</tr>';
		}
	}
	$query = "SELECT joms_request.status, joms_request.carmaker, joms_request.carmodel, joms_request.product, joms_request.jigname, joms_request.drawing_no, joms_request.type,
	joms_request.qty, joms_request.purpose, joms_request.budget, joms_request.date_requested, joms_request.requested_by , joms_request.required_delivery_date, joms_request.remarks,
	joms_rfq_process.date_of_issuance_rfq, joms_rfq_process.rfq_no, joms_rfq_process.target_date_reply_quotation, joms_rfq_process.date_reply_quotation , joms_rfq_process.leadtime, joms_rfq_process.quotation_no,
	joms_rfq_process.unit_price_jpy, joms_rfq_process.unit_price_usd, joms_rfq_process.total_amount, joms_rfq_process.fsib_no, joms_rfq_process.fsib_code, joms_rfq_process.date_sent_to_internal_signatories
	FROM joms_request
	LEFT JOIN joms_rfq_process ON joms_rfq_process.request_id = joms_request.request_id WHERE joms_request.status = 'open' AND " . "'$rfq_status_search' = 'open_all' ";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			echo '<tr>';
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

			echo '<td>' . $j['date_of_issuance_rfq'] . '</td>';
			echo '<td>' . $j['rfq_no'] . '</td>';
			echo '<td>' . $j['target_date_reply_quotation'] . '</td>';
			echo '<td>' . $j['date_reply_quotation'] . '</td>';
			echo '<td>' . $j['leadtime'] . '</td>';
			echo '<td>' . $j['quotation_no'] . '</td>';
			echo '<td>' . $j['unit_price_jpy'] . '</td>';
			echo '<td>' . $j['unit_price_usd'] . '</td>';
			echo '<td>' . $j['total_amount'] . '</td>';
			//rfq added
			echo '<td>' . $j['fsib_no'] . '</td>';
			echo '<td>' . $j['fsib_code'] . '</td>';
			echo '<td>' . $j['date_sent_to_internal_signatories'] . '</td>';



			echo '</tr>';
		}
	}

}

$conn = NULL;
?>