<?php
session_start();
error_reporting(0);
include('inc/config.php');

if(strlen($_SESSION['adminsession'])!==0)
{   
header('location:dashboard.php');
}

if(isset($_POST['login']))
{
//code for captach verification
if ($_POST["verficationcode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')
{
echo "<script>alert('Incorrect verification code');</script>" ;
} 
else {
// getting post values
$username=$_POST['username'];
$password=md5($_POST['password']);
// Sql Query for checking login details
$sql ="SELECT id,UserName,Password FROM admin WHERE UserName=:username and Password=:password";
$query= $dbh -> prepare($sql);
// binding post values
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
//if login details verified
if($query->rowCount() > 0)
{
// fetching id for session
foreach($results as $result)
{
$_SESSION['adminsession']=$result->id;

}
echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
} else{
    // For invalid details
echo "<script>alert('Invalid Details');</script>";
}
}
}
?>


<!DOCTYPE html>
<html>
<head>
    <?php include 'inc/head.php'; ?>
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">

</head>
<body class="hold-transition login-page">

  
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>E</b>MS</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form role="form" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="User name" name="username" autofocus required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>


        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>


        <div class="form-group">
          <input type="text"   name="verficationcode" maxlength="5" autocomplete="off" required  style="width: 200px;"  placeholder="Enter Code" />&nbsp;
          <!--Cpatcha Image -->
          <img src="captcha.php">
        </div>





        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <input type="submit" name="login"  class="btn btn-md btn-info btn-block"  value="Sign In">
          </div>
          <!-- /.col -->
        </div>

      </form>

           
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
  
</body>
</html>


