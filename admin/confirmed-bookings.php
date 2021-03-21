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

<style>
    .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }
    .succWrap{
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }

</style>

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
            <h1 class="m-0 text-dark">Confirmed Bookings List</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">


<div class="card">

            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">


                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Booking Id</th>
                                        <th>Event Name</th>
                                        <th>FullName</th>
                                        <th>Number of Members</th>
                                        <th>Status</th>
                                        <th>Booking Date</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$status='Confirmed';
$sql = "SELECT tblbookings.id as bid,tblbookings.BookingId,tblevents.EventName,tblusers.FullName,tblbookings.NumberOfMembers,tblbookings.BookingStatus,tblbookings.BookingDate from tblbookings left  join tblusers on tblusers.Userid=tblbookings.UserId left join tblevents on tblevents.id=tblbookings.EventId where tblbookings.BookingStatus=:status";
$query = $dbh -> prepare($sql);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ 
    ?>

<tr >
<td><?php echo htmlentities($cnt);?></td>
<td><?php echo htmlentities($row->BookingId);?></td>
<td><?php echo htmlentities($row->EventName);?></td>
<td><?php echo htmlentities($row->FullName);?></td>
<td><?php echo htmlentities($row->NumberOfMembers);?></td>
<td><?php echo htmlentities($row->BookingDate);?></td>

<td><?php $status=$row->BookingStatus;
if($status==""){
echo htmlentities("Not Confirmed yet");    
} else {
echo htmlentities("$status");        
}
?></td>
<td>
<a class="btn btn-info btn-sm" href="bookings-details.php?bkid=<?php echo htmlentities($row->bid);?>">
<i class="fa fa-eye"></i>
</a>
                            </button>    
                            </a></td>
</tr>
        <?php $cnt++;
    }} ?>                         

                                </tbody>
             </table>
            </div>
            <!-- /.card-body -->
          </div>

    </section>
    <!-- /.content -->
  </div>

<?php 
    include 'inc/footer.php';
?>



<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>


</body>
</html>

<?php } ?>