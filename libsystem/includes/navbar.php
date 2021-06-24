<header class="main-header" >
  <nav class="navbar navbar-static-top" style="background-color:black!important;border-bottom:3px solid red;">
    <div class="container">
      <div class="navbar-header"><img src="images/logo/logo.png" style="width:60px;height:60px;padding:7px;float:left;">
      <a href="#" class="navbar-brand"><b>NARC LIBRARY</b></a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <?php
            if(isset($_SESSION['student'])){
              if($student['payment_status']=='paid'){
                echo "
                  <li><a href='dashboard.php'>HOME</a></li>
                  <li><a href='transaction.php'>TRANSACTION</a></li>
                ";
              }else{
                echo "
                  <li><a href='index.php'>HOME</a></li>
                  <li><a href='transaction.php'>TRANSACTION</a></li>
                ";
              }
            } 
          ?>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo (!empty($student['photo'])) ? './images/'.$student['photo'] : './images/profile.jpg'; ?>" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo $student['firstname'].' '.$student['lastname']; ?></span>
          </a>
          <ul class="dropdown-menu" >
            <!-- User image -->
            <li class="user-header" style="background-color:black!important;">
              <img src="<?php echo (!empty($student['photo'])) ? './images/'.$student['photo'] : './images/profile.jpg'; ?>" class="img-circle" alt="User Image">

              <p>
                <?php echo $student['firstname'].' '.$student['lastname']; ?>
                <small>Member since <?php echo date('M. Y', strtotime($student['created_on'])); ?></small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="#profile" data-toggle="modal" class="btn btn-default btn-flat" id="admin_profile">Update</a>
              </div>
              <div class="pull-right">
                <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
      
      <!-- /.navbar-custom-menu -->
    </div>
    <!-- /.container-fluid -->
  </nav>
</header>
<?php include 'includes/login_modal.php'; ?>
<?php include 'includes/profile_modal.php'; ?>