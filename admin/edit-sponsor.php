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
// Posted Values
    $sponser=$_POST['sponser'];
    $sponserid=intval($_GET['sid']);
    // Query for insertion data into database
    $sql="update tblsponsers set sponserName=:sponser where id=:sponserid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':sponser',$sponser,PDO::PARAM_STR);
    $query->bindParam(':sponserid',$sponserid,PDO::PARAM_STR);
    $query->execute();
    $msg="Sponser info updated";
}  
?>


<!DOCTYPE html>
<html>
<head>
    <?php include 'inc/head.php'; ?>

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
        background: #B4BB48;
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 offset-2">
            <h1 class="m-0 text-dark">Edit Sponsor</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

<div class="col-lg-8 offset-2">
<!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h2 class="card-title">Sponsor Update</h2>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>


        <div class="card-body">

<!-- Success / Error Message -->
 <?php if($error){?><div class="errorWrap"><strong>ERROR</strong> : <?php echo htmlentities($error); ?> </div><?php } 
else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?> 


  <form role="form" method="post">
    <!-- <form role="form" method="post" enctype="multipart/form-data"> -->

<?php
        $sponserid=intval($_GET['sid']);
        $sql = "SELECT id,sponserName,sponserLogo,postingDate from tblsponsers where id=:sponserid";
        $query = $dbh -> prepare($sql);
        $query->bindParam(':sponserid',$sponserid,PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        if($query->rowCount() > 0)
        {
        foreach($results as $row)
        { 
            ?>

        <!--Sponser Name -->
        <div class="form-group">
        <label>Sponsor Name</label>
        <input class="form-control" type="text" name="sponser" value="<?php echo htmlentities($row->sponserName);?>" autocomplete="off" required autofocus>
        </div>
        <!--Sponser Logo -->
        <div class="form-group">
            <label>Sponsor Logo :</label><br>
            <img src="sponsers/<?php echo htmlentities($row->sponserLogo);?>" width="250" height="200" />
            <a class="btn btn-info btn-sm offset-1" href="update-sponserlogo.php?sid=<?php echo htmlentities($row->id);?>">Update Logo</a>
        </div>
        <?php  }}?>

        <!--Button --> 
        <div class="form-group" align="right">   
        <a href="sponsor-list.php" class="btn btn-info">Back</a>                
        <button type="submit" class="btn btn-primary" name="update">Update</button>
         </div> 
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

