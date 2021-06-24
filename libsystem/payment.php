<?php include 'includes/session.php'; ?>
<?php
	$where = '';
	if(isset($_GET['category'])){
		$catid = $_GET['category'];
		$where = 'WHERE category_id = '.$catid;
	}
?>
<?php include 'includes/header.php'; ?>
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
							<h3 style="text-align:center;font-weight:bold;">WELCOME HOME</h3><p style="text-align:center !important;color:red;"><i>Please Make Payment To View and Read Books</i></p><br>
							<form id="paymentForm">
							<div class="form-submit">
                                <button type="submit" class="btn btn-success" onclick="payWithPaystack()">Click Here To Pay </button>
                            </div>
							</form>
							<break>
	        				<div class="input-group">
				                <input type="text" class="form-control input-lg" id="searchBox" placeholder="Search for ISBN, Title or Author">
				                <span class="input-group-btn">
				                    <button type="button" class="btn btn-primary btn-flat btn-lg"><i class="fa fa-search"></i> </button>
				                </span>
				            </div>
	        			</div>
	        			<div class="box-body">
	        				<div class="input-group col-sm-5">
				                <span class="input-group-addon">Category:</span>
				                <select class="form-control" id="catlist">
				                	<option value=0>ALL</option>
				                	<?php
				                		$sql = "SELECT * FROM category";
				                		$query = $conn->query($sql);
				                		while($catrow = $query->fetch_assoc()){
				                			$selected = ($catid == $catrow['id']) ? " selected" : "";
				                			echo "
				                				<option value='".$catrow['id']."' ".$selected.">".$catrow['name']."</option>
				                			";
				                		}
				                	?>
				                </select>
				             </div>
	        				<table class="table table-bordered table-striped" id="booklist">
			        			<thead>
			        				<th>ISBN</th>
			        				<th>Title</th>
			        				<th>Author</th>
			        				<th>Status</th>
                                    <th>Action</th>
			        			</thead>
			        			<tbody>
			        			<?php
			        				$sql = "SELECT * FROM books $where LIMIT 5";
			        				$query = $conn->query($sql);
			        				while($row = $query->fetch_assoc()){
			        					$status = ($row['status'] == 0) ? '<span class="label label-success">available</span>' : '<span class="label label-danger">not available</span>';
										if($row['status'] == 0){
			        					echo"
										      
			        						<tr>
			        							
			        							<td>".$row['isbn']."</td>
			        							<td>".$row['title']."</td>
			        							<td>".$row['author']."</td>
			        							<td>".$status."</td>
                                                <td><button class='btn btn-primary' type='submit' name='book-id-submit'><a style= 'color:white;'href='aboutbook.php?book-id=".$row['id']."' data-toggle='modal'><i class='fa fa-edit'></i>View</a></button></td>
			        						</tr>
			        					";
										}
			        				}
			        			?>
								<?php ;?>
			        			</tbody>
			        		</table>
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