<?php
include '../../process/conn.php';
$delimiter = ",";

$filename = 'Request Data with Initial RFQ_' . $server_date_only . '.csv';

// Create a file pointer 
$f = fopen('php://memory', 'w');

// Set column headers 
$fields = array('Request ID', 'Status', 'Car Maker', 'Car Model', 'Product', 'Jig Name', 'Drawing No', 'Type', 'Qty', 'Purpose', 'Kigyo Budget', 'Date Requested', 'Requested By', 'Required Delivery Date', 'Remarks (fill up if ECT jig is under new design, supplier)', 'Date of Issuance of RFQ', 'RFQ No', 'Target Date of Reply Quotation', 'Item Code','Date of Reply Quotation ', 'LEADTIME(based on quotation)', 'Quotation No ', 'Unit Price JPY ', 'Unit Price USD', 'Unit Price PHP','Total Amount', 'FSIB No.', 'FSIB Code', 'Date sent to Internal Signatories', 'Target Approval date of quotation');
$fields_exp = array('Request ID','Status', 'Ex. Mazda', 'Ex. J12SRHD', 'Ex.123', 'Ex. DA-123', 'Ex.', 'Ex.Assy jig', 'Ex.123', 'Ex. EV-MP Set up', 'Ex.12345', 'Ex. YYYY-MM-DD', 'Ex. Juan', 'Ex. YYYY-MM-DD', 'Example','Ex. YYYY-MM-DD', 'RFQ No','Ex. YYYY-MM-DD','Item Code','Ex. YYYY-MM-DD', 'LEADTIME(based on quotation)', 'Quotation No ', 'Unit Price JPY ', 'Unit Price USD', 'Unit Price PHP','Total Amount ', 'FSIB No. ', 'FSIB Code ', 'Ex. YYYY-MM-DD', 'Ex. YYYY-MM-DD');

fputcsv($f, $fields, $delimiter);
fputcsv($f, $fields_exp, $delimiter);


$sql = "SELECT joms_request.request_id, joms_request.status,joms_request.carmaker,joms_request.carmodel,joms_request.product,joms_request.jigname,joms_request.drawing_no,joms_request.type,joms_request.qty,
joms_request.purpose,joms_request.budget,joms_request.date_requested,joms_request.requested_by,joms_request.required_delivery_date,joms_request.remarks,
joms_rfq_process.date_of_issuance_rfq,joms_rfq_process.rfq_no,joms_rfq_process.target_date_reply_quotation ,joms_rfq_process.item_code
FROM joms_request LEFT JOIN joms_rfq_process ON joms_rfq_process.request_id = joms_request.request_id WHERE joms_request.status = 'open' AND joms_rfq_process.quotation_no IS NULL";
$stmt = $conn->prepare($sql);
$stmt->execute();
if ($stmt->rowCount() > 0) {

	// Output each row of the data, format line as csv and write to file pointer 
	foreach ($stmt->fetchALL() as $row) {
		$lineData = array(
			$row['request_id'],
			$row['status'],
			$row['carmaker'],
			$row['carmodel'],
			$row['product'],
			$row['jigname'],
			$row['drawing_no'],
			$row['type'],
			$row['qty'],
			$row['purpose'],
			$row['budget'],
			$row['date_requested'],
			$row['requested_by'],
			$row['required_delivery_date'],
			$row['remarks'],

			$row['date_of_issuance_rfq'],
			$row['rfq_no'],
			$row['target_date_reply_quotation'],
			$row['item_code'],
		);
		fputcsv($f, $lineData, $delimiter);
	}
} else {
	// Output each row of the data, format line as csv and write to file pointer 
	$lineData = array("NO DATA FOUND");
	fputcsv($f, $lineData, $delimiter);
}

// Move back to beginning of file 
fseek($f, 0);

// Set headers to download file rather than displayed 
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');

//output all remaining data on a file pointer 
fpassthru($f);

$conn = null;
?>