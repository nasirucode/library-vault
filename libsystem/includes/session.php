<?php
	include 'includes/conn.php';
	session_start();

	if(isset($_SESSION['student'])){
		$sql = "SELECT * FROM students WHERE id = '".$_SESSION['student']."'";
		$query = $conn->query($sql);
		$student = $query->fetch_assoc();

		$paymentsql = "SELECT * FROM payment WHERE payment.type = 'fellow'";
		$paymentquery = $conn->query($paymentsql);
		$payment = $query->fetch_assoc();

		$coursesql = "SELECT * FROM students JOIN course on students.course_id WHERE course.id = students.course_id AND students.id = '".$_SESSION['student']."'";
		$coursequery = $conn->query($coursesql);
		$coursestudent = $coursequery->fetch_assoc();
	}
	

?>