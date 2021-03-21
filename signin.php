
<?php
session_start();
error_reporting(0);
include('includes/config.php');
//Process for Sign
if(isset($_POST['signin']))
{
//Getting Post Values
$uname=$_POST['username'];
$password=md5($_POST['password']);
// Quer for signing matching username and password with db details
$sql ="SELECT Userid,FullName,PhoneNumber,IsActive FROM tblusers WHERE UserName=:uname and UserPassword=:password";
//preparing the query
$query= $dbh -> prepare($sql);
//Binding the values
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
//Execute the query
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
 foreach ($results as $result) {
    $status=$result->IsActive;
    $_SESSION['usrid']=$result->Userid;
    $_SESSION['fullname']=$result->FullName;
    $_SESSION['fnNumber']=$result->PhoneNumber;
  } 
if($status==0)
{
echo "<script>alert('Your account is Inactive. Please contact admin');</script>";
} else{
echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
} }
else{
  echo "<script>alert('Invalid Details');</script>";

}

}

?>

<!doctype html>
<html class="no-js" lang="en">
    <head>

        <title>Event Management System | user signin </title>
    <!-- bootstrap v3.3.6 css -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- animate css -->
        <link rel="stylesheet" href="css/animate.css">
    <!-- meanmenu css -->
        <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- owl.carousel css -->
        <link rel="stylesheet" href="css/owl.carousel.css">
    <!-- icofont css -->
        <link rel="stylesheet" href="css/icofont.css">
    <!-- Nivo css -->
        <link rel="stylesheet" href="css/nivo-slider.css">
    <!-- animaton text css -->
        <link rel="stylesheet" href="css/animate-text.css">
    <!-- Metrial iconic fonts css -->
        <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive css -->
        <link rel="stylesheet" href="css/responsive.css">
        <!-- color css -->
    <link href="css/color/skin-default.css" rel="stylesheet">
     <!-- font-awesome cdn -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        
    <!-- modernizr css -->
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--body-wraper-are-start-->
         <div class="wrapper single-blog">
         
           <!--slider header area are start-->
           <div id="home" class="header-slider-area">
                <!--header start-->
                   <?php include_once('includes/header.php');?>
                <!-- header End-->
            </div>
           <!--slider header area are end-->
            
            <!--  breadcumb-area start-->
            <div class="breadcumb-area bg-overlay">
                <div class="container">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li class="active">Signin</li>
                    </ol>
                </div>
            </div> 
            <!--  breadcumb-area end-->    

            <!-- main blog area start-->
            <div class="single-blog-area ptb100 fix">
               <div class="container">
                   <div class="row">
                       <div class="col-md-8 col-sm-7">
                           <div class="single-blog-body">


                        
                                <div class="Leave-your-thought mt50">
                                    <h3 class="aside-title uppercase">User Signin</h3>
                                    <div class="row">
                                                                               <form name="signin" method="post">
                                            <div class="col-md-12 col-sm-6 col-xs-12 lyt-left">
                                                <div class="input-box leave-ib">
<input type="text" placeholder="Username" class="info sign-up-info-02" name="username" required="true">

<input type="password" name="password" placeholder="Password"  class="info sign-up-info-02" required /> 
<a href="forgot-password.php" style="color:blue;">Forgot Password ?</a>

</div>
                                            </div>
                                       
<div class="col-xs-12 mt10">
<div class="input-box post-comment">
<input type="submit" value="Signin" name="signin" class="submit uppercase"> 
</div>
</div>

 <div class="col-xs-12 mt30 sign-up-form-02">
 <div class="input-box post-comment" style="color:black; "> 
  Not Register yet ? <i class="fa fa-long-arrow-right" style="padding: 0 10px;"></i> <a href="signup.php" > Signup Here</a>
</div>
</div>

                                        </form>
                                    </div>
                                </div>
                           </div>
                       </div>
                        <!--sidebar-->
                      <?php include_once('includes/sidebar.php');?>
               </div>
           </div>
         </div>
            <!--main blog area start-->
<!-- signup css -->
<style>
.Leave-your-thought h3.aside-title{
    font-size: 26px;
    font-weight: 600;
    font-family: 'Oswald', sans-serif;
    margin-bottom: 35px;
    color: #222;
}
.Leave-your-thought{
    background-color: #fff;
    border-radius: 15px;
    margin: 0 30px;
    padding: 80px;
    box-shadow: 0 10px 10px 10px #ddd;
}
.Leave-your-thought input.sign-up-info-02{
    background: white;
    box-shadow: 0 5px 5px 5px #ddd;
    width: 100%;
    height: 50px;
    border-radius: 8px;
    border: none;
    padding: 20px;
}
.Leave-your-thought select.sign-up-info-02{
    background: white;
    box-shadow: 0 5px 5px 5px #ddd;
    width: 100%;
    height: 50px;
    border-radius: 5px;
    border: none;
    padding: 0 15px;
}

.signup-form-02 .input-box a{
    font-family: sans-serif;
    background-color: #333!important; 
    padding: 10px 20px;
     color: #fff; 
    font-weight: 500;
     border-radius: 5px;
}
.sign-up-form-02 a{
    font-family: sans-serif;
    background: linear-gradient(45deg, #006eff, #406cfd, #0040c9)!important; 
    padding: 12px 20px;
     color: #fff; 
    font-weight: 500;
     border-radius: 5px;
}
</style>
            <!--information area are start-->
                 <?php include_once('includes/footer.php');?>
            <!--footer area are start-->
         </div>   
        <!--body-wraper-are-end-->
    
    <!--==== all js here====-->
    <!-- jquery latest version -->
        <script src="js/vendor/jquery-3.1.1.min.js"></script>
    <!-- bootstrap js -->
        <script src="js/bootstrap.min.js"></script>
    <!-- owl.carousel js -->
        <script src="js/owl.carousel.min.js"></script>
    <!-- meanmenu js -->
        <script src="js/jquery.meanmenu.js"></script>
    <!-- Nivo js -->
        <script src="js/nivo-slider/jquery.nivo.slider.pack.js"></script>
        <script src="js/nivo-slider/nivo-active.js"></script>
    <!-- wow js -->
        <script src="js/wow.min.js"></script>
        <!-- Youtube Background JS -->
        <script src="js/jquery.mb.YTPlayer.min.js"></script>
    <!-- datepicker js -->
        <script src="js/bootstrap-datepicker.js"></script>
    <!-- waypoint js -->
        <script src="js/waypoints.min.js"></script>
    <!-- onepage nav js -->
        <script src="js/jquery.nav.js"></script>
        <!-- animate text JS -->
        <script src="js/animate-text.js"></script>
    <!-- plugins js -->
        <script src="js/plugins.js"></script>
        <!-- main js -->
        <script src="js/main.js"></script>
    </body>
</html>
