<?php
	include 'includes/session.php';

	if(isset($_POST['login'])){
		$student = $_POST['student'];
		$password = $_POST['password'];
		$sql = "SELECT * FROM students WHERE student_id = '$student' AND firstname = '$password'";
		$query = $conn->query($sql);
		if($query->num_rows > 0){
			$row = $query->fetch_assoc();
			
			$_SESSION['student'] = $row['id'];
			$_SESSION['pstatus'] = $row['payment_status'];
			
			if($_SESSION['pstatus'] == 'paid'){
				header('location: dashboard.php');
			}else{
				header('location: payment.php');
			}			
		}
		else{
			$_SESSION['error'] = 'Student not found';
			header('location: index.php');
		}

	}
	else{
		$_SESSION['error'] = 'Enter student id first';
		header('location: index.php');
	}


?>