<?php
//datbase connection file
include('includes/config.php');
error_reporting(0);
// Signup Process
if(isset($_POST['signup']))
{

// Getting Post values
$fname=$_POST['name'];
$uname=$_POST['username'];
$emailid=$_POST['email'];   
$pnumber=$_POST['phonenumber']; 
$gender=$_POST['gender']; 
$password=md5($_POST['pass']);  
$status=1;
// query for data insertion
$sql="INSERT INTO tblusers(FullName,UserName,Emailid,PhoneNumber,UserGender,UserPassword,IsActive) VALUES(:fname,:uname,:emailid,:pnumber,:gender,:password,:status)";
//preparing the query
$query = $dbh->prepare($sql);
//Binding the values
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':uname',$uname,PDO::PARAM_STR);
$query->bindParam(':emailid',$emailid,PDO::PARAM_STR);
$query->bindParam(':pnumber',$pnumber,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
//Execute the query
$query->execute();
//Check that the insertion really worked
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Success : User signup successfull. Now you can signin');</script>";
echo "<script>window.location.href='signin.php'</script>";  
}
else 
{
echo "<script>alert('Error : Something went wrong. Please try again');</script>";   
}

}

    ?>

<!doctype html>
<html class="no-js" lang="en">
    <head>

        <title>Event Management System | user signup </title>
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
<script>
function checkusernameAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'uname='+$("#username").val(),
type: "POST",
success:function(data){
$("#username-availabilty-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

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
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Signup</li>
                    </ol>
                </div>
            </div> 
            <!--  breadcumb-area end-->    

            <!-- main blog area start-->
            <div class="single-blog-area ptb100 fix">
               <div class="container">
                   <div class="row">
                       <div class="col-md-12 col-sm-12">
                           <div class="single-blog-body">


                        
                                <div class="Leave-your-thought mt50">
                                   
                                    <div class="row">
   <form name="signup" method="post" class="signup-form-02">
                <div class="col-md-7 col-sm-12 col-xs-12 lyt-left" >
                <h3 class="aside-title uppercase text-center">User Signup</h3>
                    <div class="input-box leave-ib" style="padding-right: 30px;">
                            <input type="text" placeholder="Name" class="info sign-up-info-02" name="name" required="true">
                            <input type="text" placeholder="Username" class="info sign-up-info-02" name="username" id="username" required="true" onBlur="checkusernameAvailability()">
                            <span id="username-availabilty-status" style="font-size:14px;"></span> 
                            <input type="email" placeholder="Email Id" class="info sign-up-info-02" name="email" required="true">
                            <input type="tel" placeholder="Phone Number" pattern="[0-9]{10}" title="10 numeric characters only" class="info sign-up-info-02" name="phonenumber" maxlength="10" required="true">
                            <select class="info sign-up-info-02" name="gender" required="true">
                            <option value="">Select Gender</option> 
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Transgender">Transgender</option>
                            </select>
                            <input type="password" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Password" title="at least one number and one uppercase and lowercase letter, and at least 6 or more characters" class="info sign-up-info-02" required /> 
                            <span style="font-size:11px; color:red">Password atleast one number and one uppercase and lowercase letter, and at least 6 or more characters</span>
                        </div>

                   </div>
                       <div class="col-md-5 col-sm-12 col-xs-12 lyt-left text-center signup-form-sidenote">
                           <h3 style="color: #ddd; font-size: 28px; font-weight: 700; font-family: 'Oswald', sans-serif;">Thank You for SignUp</h3>
                           <p style="margin-top: 15px; font-fomily: 'Roboto',sans-serif; font-weight: 600;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus,
                                aliquam praesentium rem quisquam, voluptate autem vel odio nam eos ex quasi
                                beatae nesciunt et repellat harum sed. Accusantium, deleniti consectetur.
                                Accusantium, deleniti consectetur!</p>
                            <div class="side-img">
                            <img src="img/side-img.png" alt="">
                            </div>


                       </div>
   
     
                       <div class="col-xs-12">
                                <div class="input-box post-comment">
                                    <input type="submit" value="Submit" id="signup" name="signup" class="submit uppercase"> 
                                </div>
                       </div>


                    <div class="col-xs-12 mt30 sign-up-form-02">
                         <div class="input-box post-comment" style="color:black;"> 
                             Already Registered <i class="fa fa-long-arrow-right"></i>
                               <a href="signin.php"> Signin Here</a>
                        </div>
                    </div>


                    </form>
                </div>
            </div>
       </div>
   </div>
                        <!--sidebar-->
                       
                   
               </div>
           </div></div>
            <!--main blog area start-->
<!-- signup css -->
<style>
.Leave-your-thought h3.aside-title{
    font-size: 35px;
    font-weight: 600;
    font-family: 'Oswald', sans-serif;
    margin-bottom: 35px;
    color: #000;
}
.Leave-your-thought{
    background-color: #fff;
    border-radius: 15px;
    margin: 0px 70px;
    padding: 80px;
    box-shadow: 0 10px 10px 10px #ddd;
}
.signup-form-02 input.sign-up-info-02{
    background: white;
    box-shadow: 0 5px 5px 5px #ddd;
    width: 100%;
    height: 50px;
    border-radius: 8px;
    border: none;
    padding: 20px;
}
.signup-form-02 select.sign-up-info-02{
    background: white;
    box-shadow: 0 5px 5px 5px #ddd;
    width: 100%;
    height: 50px;
    border-radius: 8px;
    border: none;
    padding: 0 15px;
}

.signup-form-02 .input-box a{
    font-family: sans-serif;
    background: linear-gradient(45deg, #006eff, #406cfd, #0040c9)!important; 
    padding: 12px 20px;
     color: #fff; 
    font-weight: 500;
     border-radius: 5px;
}
.signup-form-02 .signup-form-sidenote{
    position:absolute;
    left: 63%;
    top: 30%;
    height: 300px;
    width: 450px;
    color: #ddd;
    background: linear-gradient(45deg, rgb(0, 110, 255), rgb(64, 108, 253), rgb(0, 64, 201));
    /* background-color: #007bff; */
    border-radius: 15px;
    padding: 40px;
    /* box-shadow: 0 15px 8px 15px #cacaca; */
   box-shadow:         inset 0 0 10px #000000,
   0 10px 10px 10px #cacaca;
}
.signup-form-02 .side-img{
    position:absolute;
    left:350px;
    top: 200px;
    z-index:1;
}
@media (max-width: 920px){
    .signup-form-02 .signup-form-sidenote{
    position:absolute;
    left: 13%;
    top: 120%;
}

}
</style>
            <!--information area are start-->
                 <!-- <?php include_once('includes/footer.php');?> -->
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
