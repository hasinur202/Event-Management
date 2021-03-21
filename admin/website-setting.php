<?php
session_start();
error_reporting(0);
include('inc/config.php');
if(strlen($_SESSION['adminsession'])==0)
{   
header('location:logout.php');
}
else{ 
if(isset($_POST['update']))
  {
$websitename=$_POST['Websitename'];
$pnumber=$_POST['phonenumber'];
$email=$_POST['emailid'];
$address=$_POST['address'];
$ftext=$_POST['footertext'];
$sql="update  tblgenralsettings set SiteName=:websitename,PhoneNumber=:pnumber,EmailId=:email,address=:address,footercontent=:ftext";
$query = $dbh->prepare($sql);
$query->bindParam(':websitename',$websitename,PDO::PARAM_STR);
$query->bindParam(':pnumber',$pnumber,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':ftext',$ftext,PDO::PARAM_STR);
$query->execute();
echo "<script>alert('Success : Data updated successfully');</script>";
echo "<script>window.location.href='website-setting.php'</script>";
}    
?>


<!DOCTYPE html>
<html>
<head>
    <?php include 'inc/head.php'; ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">

<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8 offset-1">
            <h1 class="m-0 text-dark">General Setting</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

 <div class="col-lg-8 offset-1"> 
<!-- Default box -->

      <div class="card">
        <div class="card-header">
          <h2 class="card-title">Others Settings</h2>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">

<form role="form" method="post" name="generalsetting">

<?php
$sql = "SELECT * from tblgenralsettings";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ 
?>


        <div class="form-group">
        <label>Website name</label>
        <input class="form-control" type="text" name="Websitename" value="<?php echo htmlentities($row->SiteName);?>" autocomplete="off" required >
        </div>



        <!--Phone number -->
        <div class="form-group">
        <label>Phone Number</label>
        <input class="form-control" type="text" name="phonenumber" value="<?php echo htmlentities($row->PhoneNumber);?>" autocomplete="off" required>
        </div>

        <!--Email -->
        <div class="form-group">
        <label>Email Id</label>
        <input class="form-control" type="email" name="emailid" value="<?php echo htmlentities($row->EmailId);?>" autocomplete="off" required>
        </div>

        <!--Address -->
        <div class="form-group">
        <label>Address</label>
        <textarea class="form-control" name="address"  required><?php echo htmlentities($row->address);?></textarea>
        </div>

        <!--Footer Text -->
        <div class="form-group">
        <label>Footer Text</label>
        <textarea class="form-control" name="footertext"  required><?php echo htmlentities($row->footercontent);?></textarea>
        </div>


        <!--Button -->  
        <div class="form-group" align="center">                     
        <button type="submit" class="btn btn-primary" name="update">Update</button>
        </div>                  

<?php }} ?>

</form>
            
        
        </div>
        </div>
        <!-- /.card-body -->

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  
<?php 
    include 'inc/footer.php';
?>

</body>
</html>

<?php } ?>