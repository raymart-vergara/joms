<?php 
include '../conn.php';

$method = $_POST['method'];

if ($method == 'fetch_requested_processed') {
	$c = 0;
	$query = "SELECT * FROM joms_request WHERE status = 'pending'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			echo '<tr>';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['status'].'</td>';
				echo '<td>'.$j['carmaker'].'</td>';
				echo '<td>'.$j['carmodel'].'</td>';
				echo '<td>'.$j['product'].'</td>';
				echo '<td>'.$j['jigname'].'</td>';
				echo '<td>'.$j['drawing_no'].'</td>';
				echo '<td>'.$j['type'].'</td>';
				echo '<td>'.$j['qty'].'</td>';
				echo '<td>'.$j['purpose'].'</td>';
				echo '<td>'.$j['budget'].'</td>';
				echo '<td>'.$j['date_requested'].'</td>';
				echo '<td>'.$j['requested_by'].'</td>';
				echo '<td>'.$j['required_delivery_date'].'</td>';
				echo '<td>'.$j['remarks'].'</td>';
			echo '</tr>';
		}
	}else{
		
	}
}

$conn = NULL;
?>