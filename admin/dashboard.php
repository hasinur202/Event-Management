<?php
session_start();
error_reporting(0);
include('inc/config.php');
if(strlen($_SESSION['adminsession'])==0)
{   
header('location:logout.php');
}
else{ 
?>

<!DOCTYPE html>
<html>
<head>
    <?php include 'inc/head.php'; ?>
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">

<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
                              


          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                      <?php 
                          $sql ="SELECT id from tblcategory ";
                          $query = $dbh -> prepare($sql);
                          $query->execute();
                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                          $listedcategories=$query->rowCount();
                      ?>

              <div class="inner">
                <h3><?php echo htmlentities($listedcategories);?></h3>
                <p>Listed Categories</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="category-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col 


         -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">

                      <?php 
                          $sql ="SELECT id from tblsponsers ";
                          $query = $dbh -> prepare($sql);
                          $query->execute();
                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                          $listedsponsers=$query->rowCount();
                      ?>
              <div class="inner">
                <h3><?php echo htmlentities($listedsponsers);?></h3>
                <p>Sponsors</p>
              </div>
              <div class="icon">
                <i class="fa fa-tasks fa-5x"></i>
              </div>
              <a href="sponsor-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>



        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                  <?php 
                      $sql ="SELECT id from tblevents ";
                      $query = $dbh -> prepare($sql);
                      $query->execute();
                      $results=$query->fetchAll(PDO::FETCH_OBJ);
                      $totalevents=$query->rowCount();
                  ?>
              <div class="inner">
                <h3><?php echo htmlentities($totalevents);?></h3>
                <p>Total Events</p>
              </div>
              <div class="icon">
                <i class="fa fa-table fa-fw fa-5x"></i>
              </div>
              <a href="events-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col 


          <!- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                  <?php 
                      $sql ="SELECT Userid from tblusers";
                      $query = $dbh -> prepare($sql);
                      $query->execute();
                      $results=$query->fetchAll(PDO::FETCH_OBJ);
                      $regusers=$query->rowCount();
                  ?>
              <div class="inner">
                <h3><?php echo htmlentities($regusers);?></h3>

                <p>Total Reg. Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="users-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>



       <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                      <?php 
                          $sql ="SELECT id from tblbookings ";
                          $query = $dbh -> prepare($sql);
                          $query->execute();
                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                          $totalbookings=$query->rowCount();
                      ?>
              <div class="inner">
                <h3><?php echo htmlentities($totalbookings);?></h3>
                <p>Total Bookings</p>
              </div>
              <div class="icon">
                <i class="fa fa-book  fa-5x"></i>
              </div>
              <a href="bookings-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>





          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                  <?php 
                        $sql ="SELECT id from tblbookings where BookingStatus is null";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $newbooking=$query->rowCount();
                  ?>
              <div class="inner">
                <h3><?php echo htmlentities($newbooking);?></h3>
                <p>New Booking</p>
              </div>
              <div class="icon">
                <i class="fa fa-book  fa-5x"></i>
              </div>
              <a href="newbookings.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>



          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                  <?php 
                      $status="Confirmed";
                      $sql ="SELECT id from tblbookings where BookingStatus=:status";
                      $query = $dbh -> prepare($sql);
                      $query->bindParam(':status',$status,PDO::PARAM_STR);
                      $query->execute();
                      $results=$query->fetchAll(PDO::FETCH_OBJ);
                      $confirmedbooking=$query->rowCount();
                  ?>
              <div class="inner">
                <h3><?php echo htmlentities($confirmedbooking);?></h3>

                <p>Confirmed Booking</p>
              </div>
              <div class="icon">
                <i class="fa fa-tasks fa-5x"></i>
              </div>
              <a href="confirmed-bookings.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>




          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                    <?php 
                        $status="Cancelled";
                        $sql ="SELECT id from tblbookings where BookingStatus=:status";
                        $query = $dbh -> prepare($sql);
                        $query->bindParam(':status',$status,PDO::PARAM_STR);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $cancelledbooking=$query->rowCount();
                    ?>
              <div class="inner">
                <h3><?php echo htmlentities($cancelledbooking);?></h3>
                <p>Cancelled Bookings</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="cancelled-bookings.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>





          <!-- ./col -->
        </div>

        <!-- /.row -->
   
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  



<?php 
    include 'inc/footer.php';
 
?>


</body>
</html>

<?php } ?>