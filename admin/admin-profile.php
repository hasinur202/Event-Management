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
$fname=$_POST['fullname'];
$admemail=$_POST['adminemail'];
$aid=$_SESSION['adminsession'];

$con="update admin set FullName=:fname,AdminEmail=:admemail where id=:aid";
$query = $dbh->prepare($con);
$query-> bindParam(':aid', $aid, PDO::PARAM_STR);
$query-> bindParam(':fname', $fname, PDO::PARAM_STR);
$query-> bindParam(':admemail', $admemail, PDO::PARAM_STR);
$query->execute();
$msg="Your profile updated.";
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
            <h1 class="m-0 text-dark">Admin Profile</h1>
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
          <h2 class="card-title">Edit Admin Profile</h2>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">

          <form role="form" method="post" onSubmit="return valid();" name="chngpwd">
          <!-- Success  Message -->
           <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?> 

                    <?php
                    $aid=$_SESSION['adminsession'];
                    $sql ="SELECT FullName,AdminEmail,UserName,updationDate FROM admin where id=:aid";
                    $query= $dbh -> prepare($sql);
                    $query-> bindParam(':aid', $aid, PDO::PARAM_STR);
                    $query-> execute();
                    $results = $query -> fetchAll(PDO::FETCH_OBJ);
                    if($query -> rowCount() > 0)
                    {
                    foreach ($results as $row) {
                     ?>

            <!--Current Pasword -->
            <div class="form-group">
            <label>Full Name </label>
            <input class="form-control" type="text" value="<?php echo htmlentities($row->FullName);?>" name="fullname" autocomplete="off" required autofocus>
            </div>
            <!--New Pasword -->
            <div class="form-group">
            <label>Admin Email-Id</label>
            <input class="form-control" type="email" value="<?php echo htmlentities($row->AdminEmail);?>"  name="adminemail" autocomplete="off" required autofocus />
            </div>
            <!--Confirm Pasword -->
            <div class="form-group">
            <label>UserName</label>
            <input class="form-control" value="<?php echo htmlentities($row->UserName);?>"   type="text" name="username" autocomplete="off" readonly  />
            </div>

            <?php }} ?>
            <!--Button -->                       
            <button type="submit" class="btn btn-info" name="update">Update</button>
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