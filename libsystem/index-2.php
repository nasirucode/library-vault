<?php include 'includes/session.php';

if(isset($_SESSION['student'])){
    if($student['payment_status']=='paid'){
      header('location: dashboard.php');
    }else{
        header('location: payment.php');
    }
  } 


?>

	