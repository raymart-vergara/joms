<?php
session_start();
include '../conn.php';

$method = $_POST['method'];

if ($method == 'fetch_request') {
	$has_installation_date = $_POST['has_installation_date'];
	$c = 0;
	$query = "SELECT joms_request.id,joms_request.request_id,joms_request.status, joms_request.carmaker, joms_request.carmodel, joms_request.product, joms_request.jigname, joms_request.drawing_no, joms_request.type, joms_request.qty, joms_request.purpose, joms_request.budget, joms_request.date_requested, joms_request.requested_by, joms_request.required_delivery_date, joms_request.remarks, joms_request.uploaded_by,
	joms_rfq_process.date_of_issuance_rfq, joms_rfq_process.rfq_no, joms_rfq_process.target_date_reply_quotation, joms_rfq_process.item_code, joms_rfq_process.date_reply_quotation, joms_rfq_process.leadtime, joms_rfq_process.quotation_no, joms_rfq_process.unit_price_jpy, joms_rfq_process.unit_price_usd, joms_rfq_process.unit_price_php, joms_rfq_process.total_amount, joms_rfq_process.fsib_no, joms_rfq_process.fsib_code, joms_rfq_process.date_sent_to_internal_signatories,  joms_rfq_process.i_uploaded_by,  joms_rfq_process.c_uploaded_by,
	joms_rfq_process.target_approval_date_of_quotation, joms_po_process.approval_date_of_quotation, joms_po_process.target_date_submission_to_purchasing, joms_po_process.actual_date_of_submission_to_purchasing, joms_po_process.target_po_date, joms_po_process.po_date, joms_po_process.po_no,  joms_po_process.supplier, joms_po_process.etd, joms_po_process.eta, joms_po_process.actual_arrival_date, joms_po_process.invoice_no, joms_po_process.po_uploaded_by , joms_po_process.remarks AS remarks2,
	joms_installation.installation_date,joms_installation.set_by, joms_installation.line_no
		FROM joms_request
		LEFT JOIN joms_rfq_process ON joms_rfq_process.request_id = joms_request.request_id
		LEFT JOIN joms_po_process ON joms_po_process.request_id = joms_request.request_id
		LEFT JOIN joms_installation ON joms_installation.request_id = joms_request.request_id
		WHERE joms_request.status = 'closed' AND joms_po_process.invoice_no IS NOT NULL";

	if ($has_installation_date == 1) {
		$query = $query . " AND joms_installation.installation_date IS NOT NULL";
	} else if ($has_installation_date == 0) {
		$query = $query . " AND joms_installation.installation_date IS NULL";
	}

	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			$supplier = $j['supplier'];
			$date_requested = $j['date_requested'];
			$date_of_issuance_rfq = $j['date_of_issuance_rfq'];
			$restriction_of_issuance_rfq = date('Y-m-d', (strtotime('+2 day', strtotime($date_requested))));

			$date_reply_quotation = $j['date_reply_quotation'];
			$restriction_of_reply_quotation = date('Y-m-d', (strtotime('+14 day', strtotime($restriction_of_issuance_rfq))));


			$approval_date_of_quotation = $j['approval_date_of_quotation'];
			$restriction_of_approval_date_of_quotation = date('Y-m-d', (strtotime('+7 day', strtotime($restriction_of_reply_quotation))));

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

			echo '<tr>';
			if ($has_installation_date == 0) {
				echo '<td>';
				echo '<input type="checkbox" class="singleCheck bg-secondary" value="' . $j['request_id'] . '" onclick="get_checked_length()">';
				echo '</td>';
			}
			echo '<td style = "' . $color . '">' . $c . '</td>';
			echo '<td style = " '.$color.'">' . $j['status'] . '</td>';
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
			echo '<td style = "' . $color . '">' . $j['uploaded_by'] . '</td>';
			//rfq
			echo '<td style = "' . $color2 . '">' . $j['date_of_issuance_rfq'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['rfq_no'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['target_date_reply_quotation'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['item_code'] . '</td>';
			echo '<td style = "' . $color2. '">' . $j['i_uploaded_by'] . '</td>';

			echo '<td style = "' . $color2 . '">' . $j['date_reply_quotation'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['leadtime'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['quotation_no'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['unit_price_jpy'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['unit_price_usd'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['unit_price_php'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['total_amount'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['fsib_no'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['fsib_code'] . '</td>';
			echo '<td style = "' . $color2 . '">' . $j['date_sent_to_internal_signatories'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['target_approval_date_of_quotation'] . '</td>';
			echo '<td style = "' . $color2. '">' . $j['c_uploaded_by'] . '</td>';

			//po
			echo '<td style = "' . $color3 . '">' . $j['approval_date_of_quotation'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['target_date_submission_to_purchasing'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['actual_date_of_submission_to_purchasing'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['target_po_date'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['po_date'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['po_no'] . '</td>';
			// echo '<td style = "' . $color3 . '">' . $j['ordering_additional_details'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['supplier'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['etd'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['eta'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['actual_arrival_date'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['invoice_no'] . '</td>';
			// echo '<td style = "' . $color3 . '">' . $j['classification'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['remarks2'] . '</td>';
			echo '<td style = "' . $color3 . '">' . $j['po_uploaded_by'] . '</td>';

			echo '<td>' . $j['line_no'] . '</td>';
			echo '<td>' . $j['installation_date'] . '</td>';
			echo '<td>' . $j['set_by'] . '</td>';
			echo '</tr>';
		}
	}
}

if ($method == 'install') {
	$id = [];
	$id = $_POST['id'];
	$installation_date = $_POST['installation_date'];
	$line_no = $_POST['line_no'];
	$count = count($id);
	foreach ($id as $j) {
		echo $j;
		$query = "SELECT id FROM joms_installation WHERE request_id = '$j'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			$stmt = NULL;
			$query = "UPDATE joms_installation SET installation_date = '$installation_date', line_no = '$line_no', set_by = '" . $_SESSION['fullname'] . "' WHERE request_id = '$j'";
			$stmt = $conn->prepare($query);
			if ($stmt->execute() > 0) {
				$count = $count - 1;
			}
		} else {
			$stmt = NULL;
			$query = "UPDATE joms_request SET status = 'closed' WHERE id = '$j'";
			$stmt = $conn->prepare($query);
			if ($stmt->execute()) {
				$stmt = NULL;
				$query = "INSERT INTO joms_installation(`request_id`,`line_no`,`installation_date`,`set_by`)VALUES('$j','$line_no','$installation_date','" . $_SESSION['fullname'] . "')";
				$stmt = $conn->prepare($query);
				if ($stmt->execute()) {
					$count = $count - 1;
				}
			}
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