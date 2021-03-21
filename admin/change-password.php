<?php
session_start();
error_reporting(0);
include('inc/config.php');
if(strlen($_SESSION['adminsession'])==0)
{   
header('location:logout.php');
}
else{ 
if(isset($_POST['change']))
  {
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$aid=$_SESSION['adminsession'];
  $sql ="SELECT Password FROM admin where id=:aid and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':aid', $aid, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update admin set Password=:newpassword where id=:aid";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':aid', $aid, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
$msg="Your Password succesfully changed.";
}
else {
$error="Your current password is wrong";  
}
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
            <h1 class="m-0 text-dark">Change Admin Password</h1>
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
          <h2 class="card-title">Change Password</h2>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">

        <form role="form" method="post" onSubmit="return valid();" name="chngpwd">
        <!-- Success / Error Message -->
                 <?php if($error){?><div class="errorWrap"><strong>ERROR</strong> : <?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?> 


                <!--Current Pasword -->
                <div class="form-group">
                <label>Current Password</label>
                <input class="form-control" type="password" name="password" autocomplete="off" required autofocus>
                </div>
                <!--New Pasword -->
                <div class="form-group">
                <label>New Password</label>
                <input class="form-control" type="password" name="newpassword" autocomplete="off" required autofocus />
                </div>
                <!--Confirm Pasword -->
                <div class="form-group">
                <label>Confirm Password</label>
                <input class="form-control"  type="password" name="confirmpassword" autocomplete="off" required  />
                </div>

                <!--Button -->                       
                <button type="submit" class="btn btn-primary" name="change">Change</button>
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