
<?php
session_start();
error_reporting(0);
include('includes/config.php');


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
                        <li class="active">All Events</li>
                    </ol>
                </div>
            </div> 
            <!--  breadcumb-area end-->    
       <div class="upcomming-events-area off-white ptb100">
                  <div class="container">
                      <div class="row">
                          <div class="col-xs-12">
<?php
    $cid=intval($_GET['catid']);
    $sql = "SELECT id,CategoryName from tblcategory where id=:cid";
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
           <h1 class="section-title"><?php echo htmlentities($row->CategoryName);?> Category Event Details</h1>
       <?php }} ?>
        </div>
          <div class="total-upcomming-event col-md-12 col-sm-12 col-xs-12">

<?php
// Fetching Upcomong events
    $isactive=1;
    $sql = "SELECT EventName,EventLocation,EventStartDate,EventEndDate,EventImage,id from tblevents where IsActive=:isactive and CategoryId=:cid order by id desc ";
    $query = $dbh -> prepare($sql);
    $query->bindParam(':isactive',$isactive,PDO::PARAM_STR);
    $query->bindParam(':cid',$cid,PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;
    if($query->rowCount() > 0)
    {
    foreach($results as $row)
    { 
    ?>


<div class="col-md-4">

    <figure class="card card-product">
        <div class="img-wrap">
            <a href="event-details.php?evntid=<?php echo htmlentities($row->id);?>">
                <img src="admin/eventimages/<?php echo htmlentities($row->EventImage);?>">
            </a>
        </div>

        <figcaption class="info-wrap">
             <div class="label-rating" style="margin-bottom: 10px";>Date:  <?php echo htmlentities($row->EventStartDate);?> </div>
                <h4 class="title" style="color: black;font-weight: bold;"><?php echo htmlentities($row->EventName);?></h4>
                <p class="desc"></p>
                <div class="rating-wrap">
                    <div class="label-rating"><img src="img/icon/map.png"> Location : <?php echo htmlentities($row->EventLocation);?></div>
                  
                </div> <!-- rating-wrap.// -->
        </figcaption>
        
        <div class="bottom-wrap">
            <a href="event-details.php?evntid=<?php echo htmlentities($row->id);?>" class="btn btn-sm btn-primary float-right">View Details</a> 
            <div class="price-wrap h5">
               
            </div> <!-- price-wrap.// -->
        </div> <!-- bottom-wrap.// -->
    </figure>

</div> <!-- col // -->




 <?php } } else { ?>                
 <p>No Record Found</p>    
 <?php } ?>    
                             
                     <hr />
                  
                  </div>
              </div>
          </div>
      </div>               
         
        <?php include_once('includes/footer.php');?>
            <!--footer area are start-->
        </div>

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
