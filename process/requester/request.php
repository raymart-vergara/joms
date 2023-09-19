<?php
include '../conn.php';

$method = $_POST['method'];

if ($method == 'fetch_request') {
	// declated the name="";  filter with on-change code 
	$request_status = $_POST['request_status'];
	$request_date_from = $_POST['request_date_from'];
	$request_date_to = $_POST['request_date_to'];

	//Select or check all the data in the table and combine Request+RFQ+PO+Installation
	$c = 0;
	$query = "SELECT joms_request.status, joms_request.carmaker, joms_request.carmodel, joms_request.product, joms_request.jigname, joms_request.drawing_no, joms_request.type, joms_request.qty, joms_request.purpose, joms_request.budget, joms_request.date_requested, joms_request.requested_by , joms_request.required_delivery_date, joms_request.remarks, 
	joms_rfq_process.date_of_issuance_rfq, joms_rfq_process.rfq_no, joms_rfq_process.target_date_reply_quotation, joms_rfq_process.date_reply_quotation, joms_rfq_process.leadtime, joms_rfq_process.quotation_no, joms_rfq_process.unit_price_jpy, joms_rfq_process.unit_price_usd, joms_rfq_process.total_amount, joms_rfq_process.fsib_no, joms_rfq_process.fsib_code, joms_rfq_process.date_sent_to_internal_signatories, 
	joms_po_process.target_approval_date_of_quotation, joms_po_process.approval_date_of_quotation, joms_po_process.target_date_submission_to_purchasing, joms_po_process.actual_date_of_submission_to_purchasing, joms_po_process.target_po_date, joms_po_process.po_date, joms_po_process.po_no, joms_po_process.ordering_additional_details, joms_po_process.supplier, joms_po_process.etd, joms_po_process.eta, joms_po_process.actual_arrival_date, joms_po_process.invoice_no, joms_po_process.classification, joms_po_process.remarks AS remarks2,
	joms_installation.installation_date
		FROM joms_request
		LEFT JOIN joms_rfq_process ON joms_rfq_process.request_id = joms_request.request_id
		LEFT JOIN joms_po_process ON joms_po_process.request_id = joms_request.request_id
		LEFT JOIN joms_installation ON joms_installation.request_id = joms_request.request_id";
	//process para sa mga table  kapag may date ang intallation  i-display ng data kay ame 3 if wala i-display ang data kay ame 3.
	if ($request_status == 'ame2') {
		$query = $query . " WHERE joms_request.status = 'closed' AND joms_installation.installation_date != ''";
	} else if ($request_status == 'ame3') {
		$query = $query . " WHERE joms_request.status = 'closed' AND joms_installation.installation_date IS NULL";
	} else {
		$query = $query . " WHERE joms_request.status = '$request_status'";
	}
	//color for coding for the delay of date 
	$query = $query . " AND (joms_request.date_updated >= '$request_date_from 00:00:00' AND joms_request.date_updated <= '$request_date_to 23:59:59')";

	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			$supplier = $j['supplier'];
			$date_requested = $j['date_requested']; // May 8 // server_date_only = Aug 14 (or Date Today)
			$date_of_issuance_rfq = $j['date_of_issuance_rfq']; // May 11
			$restriction_of_issuance_rfq = date('Y-m-d', (strtotime('+2 day', strtotime($date_requested)))); // May 8 + 2 days = May 10

			$date_reply_quotation = $j['date_reply_quotation']; // May 13
			$restriction_of_reply_quotation = date('Y-m-d', (strtotime('+14 day', strtotime($restriction_of_issuance_rfq)))); // May 10 + 14 days = May 24


			$approval_date_of_quotation = $j['approval_date_of_quotation']; // May 16
			$restriction_of_approval_date_of_quotation = date('Y-m-d', (strtotime('+7 day', strtotime($restriction_of_reply_quotation)))); // May 24 + 7 days = May 31

			if ($supplier == 'Local') {

			} else if ($supplier == 'FAS' || $supplier == 'FAPV' || $supplier == 'FSKIP') {
				if ($date_of_issuance_rfq == '' && $server_date_only > $restriction_of_issuance_rfq || $date_of_issuance_rfq > $restriction_of_issuance_rfq) {
					$color = "color:red;";

				} else {
					$color = "";
				}

				if ($date_reply_quotation == '' && $server_date_only > $restriction_of_reply_quotation || $date_reply_quotation > $restriction_of_issuance_rfq) {
					$color2 = "color:orange";
				} else {
					$color2 = "";
				}

				if ($approval_date_of_quotation == '' || $server_date_only > $restriction_of_approval_date_of_quotation || $approval_date_of_quotation > $restriction_of_approval_date_of_quotation) {
					$color3 = "color:purple";
				} else {
					$color3 = "";
				}
			} else {
				$color = "";
				$color2 = "";
				$color3 = "";
			}
			//displaying the data
			echo '<tr>';
			echo '<td style = "' . $color . '">' . $c . '</td>';
			echo '<td style = "' . $color . '">' . $j['status'] . '</td>';
			echo '<td style = "' . $color . '">' . $j['carmaker'] . '</td>';
			echo '<td style = "' . $color . '">' . $j['carmodel'] . '</td>';
			echo '<td style = "' . $color . '">' . $j['product'] . '</td>';
			echo '<td style = "' . $color . '">' . $j['jigname'] . '</td>';
			echo '<td style = "' . $color . '">' . $j['drawing_no'] . '</td>';
			echo '<td style = "' . $color . '">' . $j['type'] . '</td>';
			echo '<td style = "' . $color . '">' . $j['qty'] . '</td>';
			echo '<td style = "' . $color . '">' . $j['purpose'] . '</td>';
			echo '<td style = "' . $color . '">' . $j['budget'] . '</td>';
			echo '<td style = "' . $color . '">' . $j['date_requested'] . '</td>';
			echo '<td style = "' . $color . '">' . $j['requested_by'] . '</td>';
			echo '<td style = "' . $color . '">' . $j['required_delivery_date'] . '</td>';
			echo '<td style = "' . $color . '">' . $j['remarks'] . '</td>';
			//rfq
			echo '<td style = "' . $color2 . '">' . $j['date_of_issuance_rfq'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['rfq_no'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['target_date_reply_quotation'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['date_reply_quotation'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['leadtime'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['quotation_no'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['unit_price_jpy'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['unit_price_usd'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['total_amount'] . '</td>';
			//rfq added
			echo '<td style = "' . $color3 . '">' . $j['fsib_no'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['fsib_code'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['date_sent_to_internal_signatories'] . '</td>';

			//po
			echo '<td style = "' . $color3 . '">' . $j['target_approval_date_of_quotation'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['approval_date_of_quotation'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['target_date_submission_to_purchasing'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['actual_date_of_submission_to_purchasing'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['target_po_date'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['po_date'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['po_no'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['ordering_additional_details'] . '</td>';
			// echo '<td style = "'.$color3.'">'.$j['car_model_for_formula'].'</td>';
			echo '<td style = "' . $color3 . '">' . $j['supplier'] . '</td>';
			// echo '<td style = "'.$color3.'">'.$j['start_of_usage'].'</td>';
			// echo '<td style = "'.$color3.'">'.$j['required_delivery_date2'].'</td>';
			echo '<td style = "' . $color3 . '">' . $j['etd'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['eta'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['actual_arrival_date'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['invoice_no'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['classification'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['remarks2'] . '</td>';

			echo '<td>' . $j['installation_date'] . '</td>';
			echo '</tr>';
		}
	}
}
//display all request data with all pending request in the Ame1 table or mppd1
if ($method == 'fetch_requested_processed') {
	$c = 0;
	$query = "SELECT * FROM joms_request WHERE status = 'pending'";
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
			echo '</tr>';
		}
	}
}

$conn = NULL;
?>