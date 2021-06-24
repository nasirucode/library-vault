<?php include 'includes/session.php'; ?>
<?php if(!isset($_SESSION['student'])){

	header('location: index.php');
}else{?>
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
	 
	  <div class="content-wrapper" style="background: linear-gradient(0deg, rgb(0,0,0,0.7), rgb(0,0,0,0.9)), url(./images/EB7.jpg); background-size:contain; background-position:center">
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
							<h3 style="text-align:center;font-weight:bold;">WELCOME HOME</h3>
							<?php if ($_SESSION['pstatus'] == 'paid'){?>
								<p style="text-align:center !important;color:green;"><i>Congratulations!!! You Can Now View and Read Books</i></p>
							<?php }?>
							<br>
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
			        				$sql = "SELECT * FROM books $where LIMIT 8";
			        				$query = $conn->query($sql);
			        				while($row = $query->fetch_assoc()){
			        					$status = ($row['status'] == 0) ? '<span class="label label-success">available</span>' : '<span class="label label-danger">not available</span>';
										if($row['status'] == 0){
											$_SESSION['book-file'] = $row['file']; 
			        					?>
			        						<tr>
			        							
			        							<td><?php echo $row['isbn'] ?></td>
			        							<td><?php echo $row['title'] ?></td>
			        							<td><?php echo $row['author'] ?></td>
			        							<td><?php echo $status ?></td>
												<td>
													<form action="./add-watermark-to-pdf/pdf.php" method="post" name="watermark_to_pdf" id="watermark_to_pdf">
														<input type="hidden" name="title" value="Resource Material avaialable to : <?php echo $student['firstname'].' '.$student['lastname'].' ('.$student['student_id']. '), '.$student['type'].'  of NARC' ?>">
														<input type="hidden" name="file" value="../admin/upload/<?php echo $row['file'] ?>">
														<button class='btn btn-primary'><a style= 'color:white;'href='aboutbook.php?book-id=<?php echo $row['id']?>' data-toggle='modal'><i class='fa fa-edit'></i>About</a></button>
														<button id="genrate_pdf" name="genrate_pdf" value="I" type="submit" class="btn btn-primary" tabindex="9"> Read</button>
													</form>
												</td>
                                                <!-- <td><a href="admin/upload/<?php //echo $row['file'] ?>">Read</a></td> -->
			        						</tr>
			        					<?php
										}
			        				}
			        			?>
			        			</tbody>
			        		</table>
	        			</div>
	        		</div>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
	$('#catlist').on('change', function(){
		if($(this).val() == 0){
			window.location = 'index.php';
		}
		else{
			window.location = 'index.php?category='+$(this).val();
		}
		
	});
});
</script>
</body>
</html>
<?php } ?>