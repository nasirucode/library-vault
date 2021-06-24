<?php
	include 'includes/session.php';

	

		$sql = "UPDATE students SET payment_status = 'paid' WHERE id = '".$_SESSION['student']."' ";
		if($conn->query($sql)){
			$_SESSION['success'] = 'payment made successfully';
            header('location:dashboard.php');
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	

	

?>