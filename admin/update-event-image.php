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

$evtid=intval($_GET['evntid']);    
// Posted Values
$evntimage=$_FILES["eventimage"]["name"];
// get the image extension
$extension = substr($evntimage,strlen($evntimage)-4,strlen($evntimage));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{
//rename the image file
$imgnewfile=md5($evntimage).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["eventimage"]["tmp_name"],"eventimages/".$imgnewfile);
// Query for insertion data into database
$oldimage="eventimages/".$_SESSION['entimg'];
unlink($oldimage);
// Query for Updation data into database
$sql="update tblevents set EventImage=:evntimage where id=:evtid";
$query = $dbh->prepare($sql);
$query->bindParam(':evtid',$evtid,PDO::PARAM_STR);
$query->bindParam(':evntimage',$imgnewfile,PDO::PARAM_STR);
$query->execute();
$msg="Event Image updated successfully";
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
            <h1 class="m-0 text-dark">Edit Events Photo</h1>
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
          <h2 class="card-title">Change event photo</h2>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">


<!-- Success / Error Message -->
 <?php if($error){?><div class="errorWrap"><strong>ERROR</strong> : <?php echo htmlentities($error); ?> </div><?php } 
else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?> 

<form role="form" method="post" enctype="multipart/form-data">
<?php
$eid=intval($_GET['evntid']);
$sql = "SELECT id,EventName,EventImage,PostingDate from tblevents where id=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ 
    ?>

<!--Sponser Logo -->
<div class="form-group">
<label>Event Image :</label>
<img src="eventimages/<?php echo htmlentities($_SESSION['entimg']=$row->EventImage);?>" width="300" height="200" />
</div>


<!--Sponser logo -->
<div class="form-group">
<label>New Image</label>
<input type="file" name="eventimage"  required autofocus /></td>
</div>
<?php  }}?>

<!--Button -->  
<div class="form-group" align="right">             
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