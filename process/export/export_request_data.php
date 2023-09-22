<?php
include '../../process/conn.php';
$delimiter = ",";

$filename = 'Request Data Request_'.$server_date_only.'.csv';

// Create a file pointer 
$f = fopen('php://memory', 'w');

// Set column headers 
$fields = array('Request ID', 'Status', 'Car Maker', 'Car Model', 'Product', 'Jig Name', 'Drawing No', 'Type', 'Qty', 'Purpose', 'Budget', 'Date Requested', 'Requested By', 'Required Delivery Date', 'Remarks (fill up if ECT jig is under new design, supplier)', 'Date of Issuance of RFQ', 'RFQ No', 'Target Date of Reply Quotation');
$fields_exp = array('Request ID', 'Status', 'Ex. Mazda', 'Ex. J12SRHD', 'Ex.123', 'Ex. DA-123', 'Ex.', 'Ex.Assy jig', 'Ex.123', 'Ex. EV-MP Set up', 'Ex.12345', 'Ex. YYYY-MM-DD', 'Ex. Juan', 'Ex. YYYY-MM-DD', 'Example','Ex. YYYY-MM-DD', 'RFQ No','Ex. YYYY-MM-DD');

fputcsv($f, $fields, $delimiter);
fputcsv($f, $fields_exp, $delimiter);

$sql = "SELECT * FROM joms_request WHERE status = 'pending'";
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
			$row['remarks']

			
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