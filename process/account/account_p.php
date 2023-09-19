<?php 
session_start();
include '../conn.php';

$method = $_POST['method'];

//showing the list of accounts
if ($method == 'load_accounts') {
	$c = 0;
 
	$query = "SELECT * FROM `user_accounts` WHERE section ='" . $_SESSION['section'] . "'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchAll() as $j) {
			$c++;
			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_acc_details(&quot;' . $j['id'] . '~!~' . $j['fullname'] . '~!~' . $j['username'] . '~!~' . $j['password'] . '~!~' . $j['section'] . '~!~' . $j['role'] . '&quot;)">';
			echo '<td>' . $c . '</td>';
			echo '<td>' . $j['username'] . '</td>';
			echo '<td>' . $j['fullname'] . '</td>';
			echo '<td>' . $j['section'] . '</td>';
			echo '<td>' . strtoupper($j['role']) . '</td>';
			echo '</tr>';
		}
	} else {
		echo '<tr>';
		echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}

};
// Inserting the account in the database
if ($method == 'add_account') {
	$add_fullname = trim($_POST['add_fullname']);
	$add_username = trim($_POST['add_username']);
	$add_password = trim($_POST['add_password']);
	$add_section = trim($_POST['add_section']);
	$add_role = trim($_POST['add_role']);

	$check = "SELECT id FROM user_accounts WHERE username = '$add_username' AND section = '$add_section'";
	$stmt = $conn->prepare($check);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		echo 'Already Exist';
	} else {
		$stmt = NULL;
		$query = "INSERT INTO user_accounts (`fullname`, `username`,`password`,`section`,`role`)VALUES('$add_fullname','$add_username','$add_password','$add_section', '$add_role')";
		$stmt = $conn->prepare($query);
		if ($stmt->execute()) {
			echo 'success';
		} else {
			echo 'error';
		}
	}
};

if ($method == 'update_account') {
	$update_id = $_POST['update_id'];
	$update_fullname = trim($_POST['update_fullname']);
	$update_username = trim($_POST['update_username']);
	$update_password = trim($_POST['update_password']);
	$update_section = trim($_POST['update_section']);
	$update_role = trim($_POST['update_role']);

	$query = "SELECT id FROM user_accounts WHERE username = '$update_username' AND `role` ='$update_role'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		echo 'duplicate';
	} else {
		$stmt = NULL;
		$query = "UPDATE user_accounts SET `fullname` = '$update_fullname', `username` = '$update_username', `password` = '$update_password', `section` = '$update_section', `role` ='$update_role'  WHERE id = '$update_id'";
		$stmt = $conn->prepare($query);
		if ($stmt->execute()) {
			echo 'success';
		} else {
			echo 'error';
		}
	}
};

if ($method == 'delete_exc') {
	$update_id = $_POST['update_id'];

	$query = "DELETE FROM user_accounts WHERE id = '$update_id'";
	$stmt = $conn->prepare($query);
	if ($stmt->execute()) {
		echo 'success';
	} else {
		echo 'error';
	}
};

if ($method == 'search_account') {
	$fullname = $_POST['fullname'];
	$c = 0;
	$query = "SELECT * FROM user_accounts WHERE `fullname` LIKE '$fullname%' AND section ='" . $_SESSION['section'] . "'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_acc_details(&quot;' . $j['id'] . '~!~' . $j['fullname'] . '~!~' . $j['username'] . '~!~' . $j['password'] . '~!~' . $j['section'] . '~!~' . $j['role'] . '&quot;)">';
			echo '<td>' . $c . '</td>';
			echo '<td>' . $j['username'] . '</td>';
			echo '<td>' . $j['fullname'] . '</td>';
			echo '<td>' . $j['section'] . '</td>';
			echo '<td>' . strtoupper($j['role']) . '</td>';
			echo '</tr>';
		}
	} else {
		echo '<tr>';
		echo '<td colspan="4" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
};


?>