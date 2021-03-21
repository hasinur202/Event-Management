<?php
session_start();
//datbase connection file
include('includes/config.php');
error_reporting(0);
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Event Management System | About us  </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico in the root directory -->
        <link rel="shortcut icon" type="image/x-icon" href="img/icon/favicon.ico">

        <!-- all css here -->
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
        
         <div class="wrapper waraper-404">
         
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
                        <li class="active">About us
                        </li>
                    </ol>
                </div>
            </div> 
            <!--  breadcumb-area end-->    


<br><br><br><br>


            <!--404 area start-->
            

            <div class="area-404 fix">
                <div class="container ptb50">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                        </div>
                    </div>
                </div>
            </div>



                        <!------Team Members------->
<section id="team">
<div class="container text-center">
 <h1>Our Team</h1>

 <?php
 $ptype="aboutus";
$ret = "select  PageDetails from tblpages where PageType=:ptype";
$query = $dbh -> prepare($ret);
$query -> bindParam(':ptype',$ptype, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ ?>                           
<p style="margin-top:2%"><?php echo $row->PageDetails;?></p>
                    <?php }} ?>


<br><br><br>
 <div class="row">
 <div class="box profile-pic text-center" style="margin-top: 0;">
 <div class="img-box">
   <img src="img/team1.jpg" class="img-responsive">
   <ul>
   <a href="https://www.facebook.com/"><li><i class="zmdi zmdi-facebook"></i></li></a>
   <a href="https://twitter.com/login"><li><i class="zmdi zmdi-twitter"></i></li></a>
   <a href="https://www.linkedin.com/"><li><i class="zmdi zmdi-linkedin"></i></li></a>
   </ul>
 </div>
   <h2>Md Nazmul Islam</h2>
   <h3> UI Designer</h3>
   <p>Like this video and ask your question in comment section.</p>
 </div>

  <div class="box profile-pic text-center">
 <div class="img-box">
   <img src="img/team2.jpg" class="img-responsive">
   <ul>
   <a href="https://www.facebook.com/"><li><i class="zmdi zmdi-facebook"></i></li></a>
   <a href="https://twitter.com/login"><li><i class="zmdi zmdi-twitter"></i></li></a>
   <a href="https://www.linkedin.com/"><li><i class="zmdi zmdi-linkedin"></i></li></a>
   </ul>
 </div>
   <h2>Faisal Kabir</h2>
   <h3>Research Design</h3>
   <p>Like this video and ask your question in comment section.</p>
 </div>
  <div class="box profile-pic text-center">
 <div class="img-box">
   <img src="img/team3.jpg" class="img-responsive">
   <ul>
   <a href="https://www.facebook.com/"><li><i class="zmdi zmdi-facebook"></i></li></a>
   <a href="https://twitter.com/login"><li><i class="zmdi zmdi-twitter"></i></li></a>
   <a href="https://www.linkedin.com/"><li><i class="zmdi zmdi-linkedin"></i></li></a>
   </ul>
 </div>
   <h2>Lutfor Rahman</h2>
   <h3>Web Developer</h3>
   <p>Like this video and ask your question in comment section.</p>
 </div>
 <br><br>
  <div class="box profile-pic text-center" style="margin-top: -21%;">
 <div class="img-box">
   <img src="img/team4.jpg" class="img-responsive">
   <ul>
   <a href="https://www.facebook.com/"><li><i class="zmdi zmdi-facebook"></i></li></a>
   <a href="https://twitter.com/login"><li><i class="zmdi zmdi-twitter"></i></li></a>
   <a href="https://www.linkedin.com/"><li><i class="zmdi zmdi-linkedin"></i></li></a>
   </ul>
 </div>
   <h2>Majibur Rahman</h2>
   <h3>Web Developer</h3>
   <p>Like this video and ask your question in comment section.</p>
 </div>
 <div class="box profile-pic text-center">
 <div class="img-box" >
   <img src="img/team2.jpg" class="img-responsive">
   <ul>
   <a href="https://www.facebook.com/"><li><i class="zmdi zmdi-facebook"></i></li></a>
   <a href="https://twitter.com/login"><li><i class="zmdi zmdi-twitter"></i></li></a>
   <a href="https://www.linkedin.com/"><li><i class="zmdi zmdi-linkedin"></i></li></a>
   </ul>
 </div>
   <h2>Majibur Rahman</h2>
   <h3>Web Developer</h3>
   <p>Like this video and ask your question in comment section.</p>
 </div>


 </div>
</div>
</section>



<style>

/*---------Team Members---------*/
#team
{
    padding-top: 50px;
    padding-bottom: 50px;
    color: #555;
}
#team h1
{
    text-align: center;
    color: #555 !important;
    font-weight: 700;
    padding-bottom: 10px;
    cursor: pointer;
}
#team h1:after
{
    content: '';
    background: #ff004d;
    display: block;
    height: 3px;
    width: 120px;
    margin: 10px auto 5px;
    transition: 0.5s linear;
}
#team h1:hover:after
{
    width: 200px;
}
#team .container .row{
    width: 1200px;
    columns: 5;
    column-gap: 0px;
}


    

.profile-pic
{
    margin-top: 25px;
    padding: 10px 0;
    transition: 0.8s ease;
}
.profile-pic:hover
{
    background: #1f2430;
    color: white;
    border-radius: 10px;
    box-shadow: 0 10px -10px 10px #222;
}
.profile-pic .img-box
{
    opacity: 1;
    display: block;
    position: relative;
}
.profile-pic .img-box img
{
    margin-left: 12%;
    height: 190px;
    width: 180px;
    filter: grayscale(1);
    transition: 0.5s linear;
}
.profile-pic:hover .img-box img
{
    border-radius: 50%;
    transform: scale(0.75);
    filter: grayscale(0);
    cursor: pointer;
}
.profile-pic h2{
    font-size: 22px;
    font-weight: bold;
    margin-top: 15px;
    color: #222!important;
}
.profile-pic:hover h2{

    color: #fff!important;
}
.profile-pic h3{
    font-size: 15px;
    font-weight: bold;
    margin-top: 15px;
}
#team ul
{
    margin-top: 10px;
    
}
#team .zmdi
{
    height: 25px;
    width: 25px;
    color: #fff !important;
    padding: 4px;
    border-radius: 50%;
}
#team .zmdi-twitter{
    background: rgb(7, 132, 250);
}
#team .zmdi-facebook{
    background: rgb(2, 33, 172);
}
#team .zmdi-linkedin{
    background: yellow;
}
.img-box ul{
    padding: 15px 0;
    position: absolute;
    z-index: 2;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    opacity: 0;
}
.img-box ul li
{
    padding: 5px;
    display: inline-block;
}
.img-box:hover ul
{
    opacity: 1;
}
.img-box ul, .img-box ul li
{
    transition: 1s;
}



@media (max-width: 1200px){
    #team .container .row{
          columns: 2;
          width: calc(100% - 40px);
          box-sizing: border-box;
          padding: 20px 20px 20px 0;
          height: 100vh;
    }
    .profile-pic .img-box img{
    margin-left: 22%;
    }

}
</style>


                        </div>
                    </div>
                </div>
            </div>
            <!--404 area end-->
            <br><br><br><br>



            <!--information area are start-->

            <!--footer area are start-->
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
