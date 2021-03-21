<?php
session_start();
//datbase connection file
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['usrid'])==0)
    {   
header('location:logout.php');
}
else{
// update Process
if(isset($_POST['update']))
{

//Getting User id  
$uid=$_SESSION['usrid'];
// Getting Post values
$fname=$_POST['name'];
$emailid=$_POST['email'];   
$pnumber=$_POST['phonenumber']; 
$gender=$_POST['gender']; 
// query for data updation
$sql="update  tblusers set FullName=:fname,Emailid=:emailid,PhoneNumber=:pnumber,UserGender=:gender where Userid=:uid ";
//preparing the query
$query = $dbh->prepare($sql);
//Binding the values
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':emailid',$emailid,PDO::PARAM_STR);
$query->bindParam(':pnumber',$pnumber,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();

echo "<script>alert('Success : Profile updated Successfully.');</script>";
echo "<script>window.location.href='profile.php'</script>"; 

}

    ?>

<!doctype html>
<html class="no-js" lang="en">
    <head>

        <title>Event Management System | user profile </title>
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
                        <li><a href="index.html">Home</a></li>
                        <li class="active">My Profile</li>
                    </ol>
                </div>
            </div> 
            <!--  breadcumb-area end-->    

            <!-- main blog area start-->
            <div class="single-blog-area ptb100 fix">
               <div class="container">
                   <div class="row">
<?php include_once('includes/myaccountbar.php');?>
                       <div class="col-md-8 col-sm-7">
                           <div class="single-blog-body">

<?php 
$uid=$_SESSION['usrid'];
$sql = "SELECT * from  tblusers where Userid=:uid";
$query = $dbh -> prepare($sql);
$query -> bindParam(':uid',$uid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{    ?> 
                        
                                <div class="Leave-your-thought mt50">
                                    <h3 class="aside-title uppercase"><?php echo htmlentities($result->FullName);?>'s Profile</h3>
<h5>Reg. Date: <?php echo htmlentities($result->RegDate);?> </h5>
<?php if($result->LastUpdationDate!=""){?>
<h5>Last Updation Date: <?php echo htmlentities($result->LastUpdationDate);?> </h5>
<?php } ?>

                                    <div class="row">
                                        <form name="signup" method="post" class="signup-form-02">
                                            <div class="col-md-12 col-sm-6 col-xs-12 lyt-left">
                                                <div class="input-box leave-ib">
    <input type="text" placeholder="Name" class="info sign-up-info-02" name="name" value="<?php echo htmlentities($result->FullName);?>" required="true">
        <input type="text" placeholder="Username" class="info sign-up-info-02" name="username" id="username" value="<?php echo htmlentities($result->UserName);?>" readonly="true" >
            <input type="email" placeholder="Email Id" class="info sign-up-info-02" name="email" required="true" value="<?php echo htmlentities($result->Emailid);?>">
                <input type="tel" placeholder="Phone Number" pattern="[0-9]{10}" title="10 numeric characters only" class="info sign-up-info-02" name="phonenumber" maxlength="10" required="true" value="<?php echo htmlentities($result->PhoneNumber);?>">
                    <select class="info sign-up-info-02" name="gender" required="true">
                        <option value="<?php echo htmlentities($result->UserGender);?>"><?php echo htmlentities($result->UserGender);?></option>    
                            <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                    <option value="Transgender">Transgender</option>
            </select>
    </div>
                                            </div>
                                       
    <div class="col-xs-12">
    <div class="input-box post-comment">
    <input type="submit" value="Update" id="update" name="update" class="submit uppercase"> 
    </div>
    </div>


                                        </form>
                                    </div>
<?php }} ?>

                                </div>
                           </div>
                       </div>
                        <!--sidebar-->
                     
               </div>
           </div></div>
            <!--main blog area start-->
<style>
.Leave-your-thought h3.aside-title{
    font-size: 25px;
    font-weight: 600;
    font-family: 'Oswald', sans-serif;
    margin-bottom: 35px;
    color: #000;
}
.Leave-your-thought{
    background-color: #fff;
    border-radius: 15px;
    margin: 0 30px;
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
<?php } ?>
