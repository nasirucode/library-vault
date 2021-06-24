<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$course = $_POST['course'];
		$email = $_POST['email'];
		$type = $_POST['type'];
		$userid = $_POST['userid'];

		$sql = "UPDATE students SET student_id = '$userid', firstname = '$firstname', lastname = '$lastname',email = '$email', course_id = '$course', type = '$type' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Student updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:student.php');

?>