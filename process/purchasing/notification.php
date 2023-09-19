<?php 
include '../conn.php';

if (!isset($_POST['method'])) {
	echo 'method not set';
	exit;
}
$method = $_POST['method'];

if ($method == 'count_notif_ame3') {
	$new_joms_request = 0;

	$sql = "SELECT `new_joms_request` FROM `notif_joms_request` WHERE interface = 'AME3'";
	$stmt = $conn -> prepare($sql);
	$stmt -> execute();
	if ($stmt -> rowCount() > 0) {
		while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
			$new_joms_request = intval($row['new_joms_request']);
		}
	}

	$total = $new_joms_request;

	$response_arr = array(
        'new_joms_request' => $new_joms_request,
        'total' => $total
    );

    echo json_encode($response_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

if ($method == 'update_notif_new_joms_request') {
	$sql = "UPDATE `notif_joms_request` SET `new_joms_request`= 0 WHERE interface = 'AME3'";
	$stmt = $conn -> prepare($sql);
	$stmt -> execute();
}

$conn = null;
?>