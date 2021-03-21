<?php
    session_start();
    error_reporting(0);
    include('inc/config.php');

    if(strlen($_SESSION['adminsession'])==0)
    {   
      header('location:logout.php');
    }
    else{    
    //Code for Category deletion 
    if(isset($_GET['del']))
    {
      $id=$_GET['del'];
      $sql = "delete from tblusers WHERE Userid=:id";
      $query = $dbh->prepare($sql);
      $query -> bindParam(':id',$id, PDO::PARAM_STR);
      $query -> execute();
      $_SESSION['delmsg']="User deleted";

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
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Users List</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">


<div class="card">
            
 <?php if($_SESSION['delmsg']!="") {?>
    <div class="errorWrap">
       <strong>Success :</strong> 
      <?php echo htmlentities($_SESSION['delmsg']);?>
      <?php echo htmlentities($_SESSION['delmsg']="");?>

    </div>
<?php } ?>


            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">

<thead>
                                    <tr>
                                        <th>#</th>
                                        <th>FullName</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                         <th>Reg. Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$sql = "SELECT Userid,FullName,UserName,IsActive,RegDate from tblusers";
$query = $dbh -> prepare($sql);
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
<td><?php echo htmlentities($row->FullName);?></td>
<td><?php echo htmlentities($row->UserName);?></td>
<td><?php $status=$row->IsActive;
if($status=="1"){
echo htmlentities("Active");    
} else {
echo htmlentities("Blocked");        
}
?></td>
<td><?php echo htmlentities($row->RegDate);?></td>
<td>
    <a href="edit-user.php?uid=<?php echo htmlentities($row->Userid);?>">
    <button type="button" class="btn btn-info btn-circle btn-sm"><i class="fa fa-edit"></i></button>
    </a>

    <a href="users-list.php?del=<?php echo htmlentities($row->Userid);?>" onclick="return confirm('Are you sure you want to delete?');">
      <button type="button" class="btn btn-danger btn-circle btn-sm" style="margin-left:4px;"><i class="fa fa-trash-alt"></i></button>
    </a>

      
</td>
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