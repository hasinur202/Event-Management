<?php
session_start();
error_reporting(0);
include('inc/config.php');
if(strlen($_SESSION['adminsession'])==0)
{   
header('location:logout.php');
}
else{ 
// Code for remark updation
if(isset($_POST['updatebooking']))
    {
$bkngid=intval($_GET['bkid']);
$adminremark=$_POST['adminremark'];
$status=$_POST['status'];
$sql="update tblbookings set AdminRemark=:adminremark,BookingStatus=:status where  id=:bkngid";
$query = $dbh->prepare($sql);
$query-> bindParam(':bkngid', $bkngid, PDO::PARAM_STR);
$query-> bindParam(':adminremark', $adminremark, PDO::PARAM_STR);
$query-> bindParam(':status', $status, PDO::PARAM_STR);
$query->execute();
echo "<script>alert('Success: Booking details updated.');</script>";
echo "<script>window.location.href='bookings-list.php'</script>"; 
}
    
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
          <div class="col-sm-6 offset-1">
            <h1 class="m-0 text-dark">Booking History</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">

<?php
     $bid=intval($_GET['bkid']);     
      $sql = "SELECT tblbookings.id as bid,tblbookings.BookingId,tblevents.EventName,tblevents.id as eid,tblusers.FullName,tblbookings.NumberOfMembers,tblbookings.BookingStatus,tblbookings.BookingDate,tblusers.Emailid,tblusers.PhoneNumber,tblbookings.NumberOfMembers,tblbookings.UserRemark,tblbookings.UserCancelRemark,tblbookings.AdminRemark,tblbookings.LastUpdationDate from tblbookings left  join tblusers on tblusers.Userid=tblbookings.UserId left join tblevents on tblevents.id=tblbookings.EventId where tblbookings.id=:bid ";

        $query = $dbh -> prepare($sql);
        $query->bindParam(':bid',$bid,PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        if($query->rowCount() > 0)
        {
        foreach($results as $row)
        { 
?>              
 <div class="col-lg-9 offset-1"> 
<div class="card">
         <!-- /.card-header -->
            <div class="card-body">

              #<?php echo htmlentities($row->BookingId);?> Details
              <table id="example1" class="table table-bordered table-striped">
<tr>
      <th>Booking Id</th>    
      <td><?php echo htmlentities($row->BookingId);?></td>
      <th>Booking Date</th>    
      <td><?php echo htmlentities($row->BookingDate);?></td>
</tr> 

<tr>
      <th>Number of Members</th>    
      <td><?php echo htmlentities($row->NumberOfMembers);?></td>
      <th>Event Name</th>    
      <td>
        <a href="edit-event.php?sid=<?php echo htmlentities($row->eid);?>" target="_blank"><?php echo htmlentities($row->EventName);?></a>
      </td>
</tr> 


<tr>
    <th>Booking Status</th>    
    <td colspan="3"><?php $status=$row->BookingStatus;
        if($status==""){ ?>
          <button class="btn btn-danger btn-sm"> <?php echo htmlentities("Not Confirmed Yet"); ?></button>   
       <?php } else { ?>
          <button class="btn btn-success btn-sm"> <?php echo htmlentities("$status"); ?></button>    
        <?php }
        ?>
    </td>
</tr>

<tr>
    <th>Full Name</th>    
    <td><?php echo htmlentities($row->FullName);?></td>
    <th>Phone Number</th>    
    <td><?php echo htmlentities($row->PhoneNumber);?></td>
</tr>

<tr>
    <th>Email Id</th>    
    <td><?php echo htmlentities($row->Emailid);?></td>
    <th>User Remark</th>    
    <td colspan="5"><?php echo htmlentities($row->UserRemark);?></td>
</tr>


<?php if($row->UserCancelRemark!=""){?>
<tr>
    <th>User Cancellation Remark</th>    
    <td colspan="5"><?php echo htmlentities($row->UserCancelRemark);?></td>
</tr>
<?php } ?>

<?php if($row->AdminRemark!="" && $row->LastUpdationDate!=""){?>
<tr>
    <th>Admin Remark</th>    
    <td><?php echo htmlentities($row->AdminRemark);?></td>

    <th>Last Updation Date</th>    
    <td><?php echo htmlentities($row->LastUpdationDate);?></td>
</tr>
<?php } ?>

  </table>


<div class="form-group" align="right">  
    <a href="bookings-list.php" class="btn btn-info">Back</a>      
<?php if($status==""){?>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Take Action</button>   
   <?php } ?>              
 </div> 
       

            </div>
<?php }} ?>

          </div>
</div>
    </section>
  
  <div id="myModal" class="modal fade" role="dialog" style="margin-top:10%">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Admin take action</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form name="adminremark" method="post">
          <p><textarea  placeholder="Admin remark" class="form-control" name="adminremark" required="true"></textarea></p>
         <p><select name="status" required="true" class="form-control">
           <option value="Confirmed">Confirmed</option>  
           <option value="Cancelled">Cancelled</option> 
         </select></p> 

         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info" name="updatebooking">Submit</button>
        </div>
    </form>
      </div>
      
    </div>

  </div>
</div>


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