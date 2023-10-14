<?php
 include 'conn.php';
 session_start();
 if (isset($_POST['login_btn'])) {
 	$username = $_POST['username'];
 	$password = $_POST['password'];

 	if (empty($username)) {
 		echo 'Please Enter Username';
 	}else if(empty($password)){
 		echo 'Please Enter Password';
 	}else{
 		$check = "SELECT fullname, section, role FROM user_accounts WHERE BINARY username = '$username' AND BINARY password = '$password'";
 		$stmt = $conn->prepare($check);
 		$stmt->execute();
 		if ($stmt->rowCount() > 0) {
         foreach($stmt->fetchALL() as $j){
            $fullname = $j['fullname'];
            $role = $j['role'];
            $section = $j['section'];
         }
         $_SESSION['section'] = $section;
         $_SESSION['role'] = $role;
         $_SESSION['fullname'] = $fullname;
         $_SESSION['username'] = $username;
         if ($section == 'mppd1') {
            header('location: page/requester/dashboard.php');
         }elseif ($section == 'ame1req') {
            header('location: page/requester/dashboard.php');
         }elseif ($section == 'ame2req') {
            header('location: page/requester/dashboard.php');
         }elseif($section == 'ame1req') {
            header('location: page/requester/dashboard.php');
         }elseif ($section == 'ame3req') {
            header('location: page/requester/dashboard.php');
         }elseif ($section == 'ame5req') {
            header('location: page/requester/dashboard.php');
         }elseif($section == 'ame3') {
            header('location: page/purchasing/dashboard.php');
         }elseif($section == 'ame2') {
            header('location: page/installation/dashboard.php');
         } 			
 		}else{
         echo '<script>alert("Wrong Username or Password !!!")</script>';
 		}
 	}
 }
 if (isset($_POST['Logout'])) {
 	session_unset();
 	session_destroy();
 	header('location: ../index.php');
 }

?>