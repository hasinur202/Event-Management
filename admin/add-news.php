<?php
session_start();
error_reporting(0);
include('inc/config.php');
if(strlen($_SESSION['adminsession'])==0)
{   
header('location:logout.php');
}
else{ 
if(isset($_POST['add']))
  {
$newstitle=$_POST['newstitle'];
$decrption=$_POST['description'];
$sql="INSERT INTO  tblnews(NewsTitle,NewsDetails) VALUES(:newstitle,:decrption)";
$query = $dbh->prepare($sql);
$query->bindParam(':newstitle',$newstitle,PDO::PARAM_STR);
$query->bindParam(':decrption',$decrption,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Success : News added successfully ');</script>";
echo "<script>window.location.href='news-list.php'</script>";
}
else 
{
echo "<script>alert('Error : Something went wrong. Please try again. ');</script>"; 
}
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 offset-2">
            <h1 class="m-0 text-dark">Add News</h1>
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
          <h2 class="card-title">News</h2>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          
              <form role="form" method="post" >
                    <!--Category Name -->
                    <div class="form-group">
                    <label>News Title</label>
                    <input class="form-control" type="text" name="newstitle" autocomplete="off" required autofocus>
                    </div>
                    <!--New Pasword -->
                    <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description"  required></textarea>
                    </div>

                    <!--Button -->  
                    <div class="form-group" align="right">  
                    <a href="news-list.php" class="btn btn-info">Back</a>                   
                    <button type="submit" class="btn btn-primary" name="add">Add</button>
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