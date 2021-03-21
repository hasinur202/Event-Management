<?php
session_start();
error_reporting(0);
include('inc/config.php');
if(strlen($_SESSION['adminsession'])==0)
{   
header('location:logout.php');
}
else{ 
// update Process
if(isset($_POST['update']))
{

//Getting User id  
$uid=intval($_GET['uid']);
// Getting Post values
$fname=$_POST['name'];
$emailid=$_POST['email'];   
$pnumber=$_POST['phonenumber']; 
$gender=$_POST['gender']; 
$status=$_POST['status'];
// query for data updation
$sql="update  tblusers set FullName=:fname,Emailid=:emailid,PhoneNumber=:pnumber,UserGender=:gender,IsActive=:status where Userid=:uid ";
//preparing the query
$query = $dbh->prepare($sql);
//Binding the values
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':emailid',$emailid,PDO::PARAM_STR);
$query->bindParam(':pnumber',$pnumber,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();

echo "<script>alert('Success : Profile updated Successfully.');</script>";
echo "<script>window.location.href='users-list.php'</script>"; 

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
            <h1 class="m-0 text-dark">Edit User Profile</h1>
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
          <h2 class="card-title">Update User Profile</h2>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">

          
        <form role="form" method="post" onSubmit="return valid();" name="chngpwd">
<!-- Success / Error Message -->
           <?php 
                if($error){?><div class="errorWrap"><strong>ERROR</strong> : <?php echo htmlentities($error); ?> </div>
                <?php } 
              else if($msg){?>
                <div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div>
          <?php }?> 


    <?php
          $usrid=intval($_GET['uid']);
          $sql = "SELECT Userid,FullName,UserName,Emailid,PhoneNumber,UserGender,IsActive,RegDate,LastUpdationDate,UserGender from tblusers where Userid=:usrid";
          $query = $dbh -> prepare($sql);
          $query->bindParam(':usrid',$usrid,PDO::PARAM_STR);
          $query->execute();
          $results=$query->fetchAll(PDO::FETCH_OBJ);
          $cnt=1;
          if($query->rowCount() > 0)
          {
          foreach($results as $row)
          { 
              ?>
              <h3 align="center"><?php echo htmlentities($row->FullName);?>'s Profile</h3>
              <hr />
              <!--Registration Date -->
              <p><strong>Reg Date : </strong><?php echo htmlentities($row->RegDate);?></p>

          <!--Last Updation Date -->
          <?php if($row->LastUpdationDate!=""){?>    
             <p><strong>Last Updated at : </strong><?php echo htmlentities($row->LastUpdationDate);?></p>
    <?php } ?>

                  <!--username -->
                  <div class="form-group">
                    <label>Username</label>
                    <input class="form-control" type="text" name="username" value="<?php echo htmlentities($row->UserName);?>" readonly>
                  </div>

                  <!--Fullanme -->
                  <div class="form-group">
                    <label>Fullname</label>
                    <input class="form-control" type="text" name="name" value="<?php echo htmlentities($row->FullName);?>" required>
                  </div>


                  <!--Email id -->
                  <div class="form-group">
                    <label>Email id</label>
                    <input class="form-control" type="email" name="email" value="<?php echo htmlentities($row->Emailid);?>" required>
                  </div>


                  <!--Phone Number -->
                  <div class="form-group">
                      <label>Phone Number</label>
                      <input class="form-control" type="test" name="phonenumber" pattern="[0-9]{10}" title="10 numeric characters only" value="<?php echo htmlentities($row->PhoneNumber);?>" required>
                  </div>


                  <!--Gender -->
                  <div class="form-group">
                      <label>Gender</label>
                  <select class="form-control" name="gender" required="true">
                      <option value="<?php echo htmlentities($row->UserGender);?>"><?php echo htmlentities($row->UserGender);?></option>    
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      <option value="Transgender">Transgender</option>
                  </select>
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
                      <option value="0">Blocked</option>   
                      <?php else: ?>
                       <option value="0">Blocked</option> 
                            <option value="1">Active</option>  
                      <?php endif; ?>
                  </select>
                  </div>

                  <?php }} ?>

                  <!--Button -->   
                  <div class="form-group" align="center">                 
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