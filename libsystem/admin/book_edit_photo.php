<?php
	include 'includes/session.php';

	if(isset($_POST['upload'])){
		$id = $_POST['id'];
		$bookimage = $_FILES['photo']['name'];
		if(!empty($bookimage)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/bookimages/'.$bookimage);	
		}
		
		$sql = "UPDATE books SET books.image = '$bookimage' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'book photo updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select book to update photo first';
	}

	header('location: book.php');
?>