
<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    // Signup Process

?>

<!doctype html>
<html class="no-js" lang="en">
    <head>
        <title>Event Details </title>
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
        <!--body-wraper-are-start-->
         <div id="home" class="wrapper event-details">
         
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
                        <li class="active">Event-details</li>
                    </ol>
                </div>
            </div> 
            <!--  breadcumb-area end--> 
<?php
// Event Details
$eid=intval($_GET['evntid']);

$_SESSION['eventId'] = $eid;

$isactive=1;
$sql = "SELECT tblcategory.CategoryName,tblevents.EventName,tblevents.EventCost,tblevents.EventLocation,tblevents.EventStartDate,tblevents.EventEndDate,tblevents.EventImage,tblevents.id,tblevents.EventDescription,tblevents.PostingDate,tblsponsers.sponserName,tblsponsers.sponserLogo,tblevents.EventImage from tblevents left join tblcategory on tblcategory.id=tblevents.CategoryId left join tblsponsers on tblsponsers.id=tblevents.SponserId where tblevents.id=:eid and tblevents.IsActive=:isactive";

$query = $dbh -> prepare($sql);
$query->bindParam(':isactive',$isactive,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ 
    ?>           


<!--about area are start-->
<div class="about-area ptb100 fix" id="about-event">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="about-left">                
                    <div class="about-top">
                    <h1 class="section-title sec-title"> <?php echo htmlentities($row->EventName);?> Details</h1>
                        <div class="total-step">
                            <p style="margin-top:4%"><b>Posting Date:</b> <?php echo htmlentities($row->PostingDate);?></p>  
                            <div class="descp">
                                <p><?php echo htmlentities($row->EventDescription);?></p>
                            </div>
                        </div>
                    </div>
                    <h3 class="spon-theme">Sponser</h3>
                    <div class="total-step">
                        <div class="about-step">
                            <h2 class="sub-title"><?php echo htmlentities($row->sponserName);?></h2>
                            <div class="descp">
                                <p><img src="admin/sponsers/<?php echo htmlentities($row->sponserLogo);?>" width="250" style="border:solid 1px #000"></p>
                            </div>
                        </div>
                    </div>
                </div>  

           
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">

                 <p style="background-color: #FF5B17;" align="center">
                    <img class="img-event" src="admin/eventimages/<?php echo htmlentities($row->EventImage);?>" width="350"></p>
                <div class="about-right">
                    <ul>
                        <li><i class="zmdi zmdi-palette"></i><?php echo htmlentities($row->CategoryName);?> (Category)</li>
                        <li><i class="zmdi zmdi-calendar-note"></i>
                            <?php echo htmlentities($row->EventStartDate);?> To
                            <?php echo htmlentities($evntenddate=$row->EventEndDate);?></li>
                        <li><i class="zmdi zmdi-pin"></i><?php echo htmlentities($row->EventLocation);?> </li>
						<li><i class="zmdi zmdi-money"></i><?php echo htmlentities($row->EventCost);?> </li>  
                    </ul>
                    <?php 
                    $cadte=date('Y-m-d');
                    if($cadte<=$evntenddate){
                        
                    if(strlen($_SESSION['usrid'])=='0'){
                        ?>
                    <div class="about-btn"> <a href="signin.php" class="btn-def bnt-2">Book Now</a> </div>  
                    <?php } else{?>

                    <div class="about-btn"> 


<a href="checkout.php?price=<?php echo $row->EventCost;?>" type="button" class="btn btn-info btn-lg">Book Now</a>  

<!--
<?php

    $userid=$_SESSION['usrid'];
    $eid = $_SESSION['eventId'];
    $sql3 = "SELECT * from tblbookings";
    $query3 = $dbh -> prepare($sql3);
    $query3->execute();
    $resulted=$query3->fetchAll(PDO::FETCH_OBJ);

        if($query3->rowCount() > 0) { 
        foreach($resulted as $rows) {    
        if($rows->UserId == $userid && $rows->EventId == $eid) { ?>

                <a href="#" type="button" class="btn btn-info btn-lg">Already Booked</a>
        <?php } else { ?>
            <a href="checkout.php?price=<?php echo $row->EventCost;?>" type="button" class="btn btn-info btn-lg">Book Now</a>      
        <?php } } } ?>

-->

                    </div> 

                    <?php }} else { ?>
                      <div class="about-btn"> <a href="#" class="btn-def bnt-2">Event Expired</a> </div>  
                    <?php } ?>     
                </div>
            </div>
        </div>
    </div>
</div>
        <!--about area are end-->
    <?php }} else {?>
    <h3 align="center" style="color:red; margin-top: 4%">No record found</h3>
    <?php }?>



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
