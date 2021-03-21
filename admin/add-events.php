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
// Posted Values
$catid=$_POST['category'];
$spnserid=$_POST['sponser'];
$ename=$_POST['eventname'];
$ecost=$_POST['eventcost'];
$ediscription=$_POST['evetndescription'];
$esdate=$_POST['eventstartdate'];
$eedate=$_POST['eventenddate'];
$elocation=$_POST['eventlocation'];
$entimage=$_FILES["eventimage"]["name"];
$status=1;
// get the image extension
$extension = substr($entimage,strlen($entimage)-4,strlen($entimage));
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
$eventimage=md5($entimage).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["eventimage"]["tmp_name"],"eventimages/".$eventimage);
// Query for insertion data into database
$sql="INSERT INTO  tblevents(CategoryId,SponserId,EventName,EventCost,EventDescription,EventStartDate,EventEndDate,EventLocation,EventImage,IsActive) VALUES(:catid,:spnserid,:ename,:ecost,:ediscription,:esdate,:eedate,:elocation,:eventimage,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':catid',$catid,PDO::PARAM_STR);
$query->bindParam(':spnserid',$spnserid,PDO::PARAM_STR);
$query->bindParam(':ename',$ename,PDO::PARAM_STR);
$query->bindParam(':ecost',$ecost,PDO::PARAM_STR);
$query->bindParam(':ediscription',$ediscription,PDO::PARAM_STR);
$query->bindParam(':esdate',$esdate,PDO::PARAM_STR);
$query->bindParam(':eedate',$eedate,PDO::PARAM_STR);
$query->bindParam(':elocation',$elocation,PDO::PARAM_STR);
$query->bindParam(':eventimage',$eventimage,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo '<script>alert("Event created successfully")</script>';
echo "<script>window.location.href='events-list.php'</script>";  
}
else 
{
echo '<script>alert("Something went wrong. Please try again")</script>';   
}

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
          <div class="col-sm-6 offset-1">
            <h1 class="m-0 text-dark">Add Event</h1>
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
          <h2 class="card-title">Add Event</h2>

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



<!--Event name -->
<div class="form-group">
<label>Event Name</label>
<input class="form-control" type="text" name="eventname" autocomplete="off" required autofocus>
</div>

<div class="form-group">
<label>Event Cost</label>
<input class="form-control" type="text" name="eventcost" autocomplete="off" required autofocus>
</div>

<!--Event Description -->
<div class="form-group">
<label>Event Description</label>
<textarea class="form-control" type="text" name="evetndescription" rows="5" autocomplete="off" required autofocus></textarea>
</div>



<!--categrory Name -->
<div class="form-group">
  <label>Category</label>
  <select class="form-control"  name="category" autocomplete="off" required >
  <option>Select</option>
  <?php
  $sql = "SELECT id,CategoryName,CategoryDescription,CreationDate,IsActive from tblcategory";
  $query = $dbh -> prepare($sql);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  $cnt=1;
  if($query->rowCount() > 0)
  {
  foreach($results as $row)
  { ?>  
  <option value="<?php echo htmlentities($row->id);?>"><?php echo htmlentities($row->CategoryName);?></option>
  <?php }} ?>
  </select>
</div>


<!--Sponser logo -->
<div class="form-group">
  <label>Event Sponsors : </label>

  <select class="form-control"  name="sponser" autocomplete="off" required >
  <option>Select</option>
  <?php
  $sql = "SELECT id,sponserName from tblsponsers";
  $query = $dbh -> prepare($sql);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  $cnt=1;
  if($query->rowCount() > 0)
  {
  foreach($results as $row)
  { ?>  
  <option value="<?php echo htmlentities($row->id);?>"><?php echo htmlentities($row->sponserName);?></option>
  <?php }} ?>
  </select>

</div>

<!--Event Start date -->
<div class="form-group">
<label>Event Start Date</label> 
<input  class="form-control" type="date" name="eventstartdate" autocomplete="off" required autofocus />
</div>

<!--Event End Date -->
<div class="form-group">
<label>Event End Date</label>
<input  class="form-control" type="date" name="eventenddate" autocomplete="off" required autofocus />
</div>

<!--Event Location -->
<div class="form-group">
<label>Event location</label>
<input  class="form-control" type="text" name="eventlocation" autocomplete="off" required autofocus />
</div>

<!--Event Featured Image -->
<div class="form-group">
<label>Event Featured Image</label>
<input  class="form-control" type="file" name="eventimage" autocomplete="off" required autofocus />
</div>

<div class="form-group" align="right">
  <a href="events-list.php" class="btn btn-info">Back</a>
<button  type="submit" class="btn btn-success" name="add">Add</button>
</div>

<!--Button -->                       

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