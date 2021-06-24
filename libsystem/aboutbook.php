<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
	$where = '';
	if(isset($_GET['category'])){
		$catid = $_GET['category'];
		$where = 'WHERE category_id = '.$catid;
	}
?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper" style="background: linear-gradient(0deg, rgb(0,0,0,0.5), rgb(0,0,0,0.9)), url(./images/download.jpg); background-size:contain; background-position:center">
	    <div class="container" >

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-8 col-sm-offset-2">
                    <?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
                    <div class="box">
	        			<div class="box-header with-border">
							<h3 style="text-align:center;font-weight:bold;">ABOUT BOOK</h3>
							<?php if($student['payment_status'] == 'paid'){ echo '';}else{ ?>

							<p style="text-align:center !important;color:red;"><i>Please Make Payment To View and Read Books</i></p><br>
							<form id="paymentForm">
							<div class="form-submit">
                                <button type="submit" class="btn btn-success" onclick="payWithPaystack()">Click Here To Pay </button>
                            </div>
							<?php } ?>
							</form>
							<break>
	        				
	        			</div>
	        			<div class="box-body">
	        				
	        				
			        			<?php
                                $id = $_GET['book-id'];
			        				$sql = "SELECT * FROM books where id = '$id'";
			        				$query = $conn->query($sql);
			        				while($row = $query->fetch_assoc()){
			        					// $status = ($row['status'] == 0) ? '<span class="label label-success">available</span>' : '<span class="label label-danger">not available</span>';
										// if($row['status'] == 0){
			        					echo "<h3 style='text-transform:uppercase'>".$row['title']."</h3>"."<br><img style='width:100px; height:100px;' src=images/bookimages/".$row['image']."><br>".$row['about'];
										}
			        				
			        			?>
	        			</div>
	        		</div>
                    
                    <script src="https://js.paystack.co/v1/inline.js"></script>
                </div>
	        </div>
	    </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<?php include 'includes/viewbook_modal.php'; ?>
<script>
    const paymentForm = document.getElementById('paymentForm');
    paymentForm.addEventListener("submit", payWithPaystack, false);
    function payWithPaystack(e) {
    e.preventDefault();
    let handler = PaystackPop.setup({
        key: 'pk_test_005327dfa5660fe50eced0262afa3f67fb41673e', // Replace with your public key
        email: '<?php echo $student["email"]; ?>',
        amount: 400 * 100,
        ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        // label: "Optional string that replaces customer email"
        onClose: function(){
        alert('Window closed.');
        },
        callback: function(response){
        let message = 'Payment complete! Reference: ' + response.reference;
        alert(message);
		window.location.href = 'verify.php';
        }
    });
    handler.openIframe();
    }
</script>
</body>
</html>