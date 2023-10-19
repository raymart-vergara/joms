<?php
include '../conn.php';

$method = $_POST['method'];

if ($method == 'get_closed_request_history') {
	$history_date_from = $_POST['history_date_from'];
	$history_date_to = $_POST['history_date_to'];
	$c = 0;
	$query = "SELECT joms_request.id,joms_request.status, joms_request.carmaker, joms_request.carmodel, joms_request.product, joms_request.jigname, joms_request.drawing_no, joms_request.type, joms_request.qty, joms_request.purpose, joms_request.budget, joms_request.date_requested, joms_request.requested_by, joms_request.required_delivery_date, joms_request.remarks, joms_request.uploaded_by,
	joms_rfq_process.date_of_issuance_rfq, joms_rfq_process.rfq_no, joms_rfq_process.target_date_reply_quotation, joms_rfq_process.item_code, joms_rfq_process.date_reply_quotation, joms_rfq_process.leadtime, joms_rfq_process.quotation_no, joms_rfq_process.unit_price_jpy, joms_rfq_process.unit_price_usd, joms_rfq_process.unit_price_php, joms_rfq_process.total_amount, joms_rfq_process.fsib_no, joms_rfq_process.fsib_code, joms_rfq_process.date_sent_to_internal_signatories, joms_rfq_process.i_uploaded_by, joms_rfq_process.c_uploaded_by, 
	joms_po_process.target_approval_date_of_quotation, joms_po_process.approval_date_of_quotation, joms_po_process.target_date_submission_to_purchasing, joms_po_process.actual_date_of_submission_to_purchasing, joms_po_process.target_po_date, joms_po_process.po_date, joms_po_process.po_no, joms_po_process.supplier, joms_po_process.etd, joms_po_process.eta, joms_po_process.actual_arrival_date, joms_po_process.invoice_no, joms_po_process.po_uploaded_by, joms_po_process.remarks AS remarks2,
	joms_installation.installation_date, joms_installation.set_by
		FROM joms_request
		LEFT JOIN joms_rfq_process ON joms_rfq_process.request_id = joms_request.request_id
		LEFT JOIN joms_po_process ON joms_po_process.request_id = joms_request.request_id
		LEFT JOIN joms_installation ON joms_installation.request_id = joms_request.request_id
		WHERE joms_request.status = 'closed' AND (joms_po_process.date_updated >= '$history_date_from' AND joms_po_process.date_updated <= '$history_date_to')";
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
			echo '<td>' . $j['uploaded_by'] . '</td>';
			//rfq
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
			echo '<td>' . $j['c_uploaded_by'] . '</td>';
			//po
			echo '<td>' . $j['target_approval_date_of_quotation'] . '</td>';
			echo '<td>' . $j['approval_date_of_quotation'] . '</td>';
			echo '<td>' . $j['target_date_submission_to_purchasing'] . '</td>';
			echo '<td>' . $j['actual_date_of_submission_to_purchasing'] . '</td>';
			echo '<td>' . $j['target_po_date'] . '</td>';
			echo '<td>' . $j['po_date'] . '</td>';
			echo '<td>' . $j['po_no'] . '</td>';
			// echo '<td>' . $j['ordering_additional_details'] . '</td>';
			echo '<td>' . $j['supplier'] . '</td>';
			echo '<td>' . $j['etd'] . '</td>';
			echo '<td>' . $j['eta'] . '</td>';
			echo '<td>' . $j['actual_arrival_date'] . '</td>';
			echo '<td>' . $j['invoice_no'] . '</td>';
			// echo '<td>' . $j['classification'] . '</td>';
			echo '<td>' . $j['remarks2'] . '</td>';
			echo '<td>' . $j['po_uploaded_by'] . '</td>';

			echo '</tr>';
		}
	} else {

	}
}

$conn = NULL;
?>