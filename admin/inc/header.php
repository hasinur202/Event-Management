
  
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="dashboard.php" class="nav-link">Home</a>
      </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">

        <a class="nav-link" data-toggle="dropdown" href="#">

<?php
    $sql = "SELECT tblbookings.id as bid,tblbookings.BookingId,tblbookings.BookingDate from tblbookings where tblbookings.BookingStatus is null";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $notif= $query->rowCount();
?>                    

         <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"><?php echo $notif ?></span>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

  <?php
      $sql = "SELECT tblbookings.id as bid,tblbookings.BookingId,tblbookings.BookingDate from tblbookings where tblbookings.BookingStatus is null";
      $query = $dbh -> prepare($sql);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);
      $cnt=1;
      if($query->rowCount() > 0)
      {
      foreach($results as $row)
      { 
  ?>       
        <a class="dropdown-item" href="bookings-details.php?bkid=<?php echo htmlentities($row->bid);?>">
            <div>
                <i class="fa fa-envelope fa-fw"></i> Booking #<?php echo htmlentities($row->BookingId);?>
                <span class="pull-right text-muted small"><?php echo htmlentities($row->BookingDate);?></span>
            </div>
        </a>             

<?php }}  ?>
          <div class="dropdown-divider"></div>
          <a href="newbookings.php" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> See New Bookings
          </a>
         
        </div>

      </li>


      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-user fa-fw"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="admin-profile.php"><i class="fa fa-user-circle"></i> User Profile</a>
          <a class="dropdown-item" href="change-password.php"><i class="fa fa-cog"></i> Change Password</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        
        </div>
      </li>


    </ul>
  </nav>
  <!-- /.navbar -->