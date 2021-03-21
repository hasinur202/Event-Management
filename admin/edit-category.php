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
$cat=$_POST['category'];
$decrption=$_POST['description'];
$status=$_POST['status'];
$cid=intval($_GET['catid']);
$sql="update tblcategory set CategoryName=:cat,CategoryDescription=:decrption,IsActive=:status where id=:cid";
$query = $dbh->prepare($sql);
$query->bindParam(':cid',$cid,PDO::PARAM_STR);
$query->bindParam(':cat',$cat,PDO::PARAM_STR);
$query->bindParam(':decrption',$decrption,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();

$msg="Category updated.";

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
            <h1 class="m-0 text-dark">Edit Category</h1>
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
          <h2 class="card-title">Category Update</h2>

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



<?php
$cid=intval($_GET['catid']);
$sql = "SELECT id,CategoryName,CategoryDescription,IsActive,UpdationDate from tblcategory where id=:cid";
$query = $dbh -> prepare($sql);
$query->bindParam(':cid',$cid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ 
    ?>
<p><strong>Last Updated at : </strong><?php echo htmlentities($row->UpdationDate);?></p>
<!--Category Name -->
<div class="form-group">
<label>Category</label>
<input class="form-control" type="text" name="category" value="<?php echo htmlentities($row->CategoryName);?>" autocomplete="off" required autofocus>
</div>
<!--New Pasword -->
<div class="form-group">
<label>Description</label>
<textarea class="form-control" name="description"  autofocus required><?php echo htmlentities($row->CategoryDescription);?></textarea>
</div>
<!--status -->
<div class="form-group">
<label>Status</label>
<select class="form-control" name="status" required >
<?php
$status=$row->IsActive;
if($status==1):
?>
<option value="1">Active</option>   
<option value="0">Inactive</option>   
<?php else: ?>
 <option value="0">Inactive</option> 
      <option value="1">Active</option>  
<?php endif; ?>
</select>
</div>

<?php }} ?>

<!--Button -->   
<div class="form-group" align="right">   
<a href="category-list.php" class="btn btn-info">Back</a>                
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