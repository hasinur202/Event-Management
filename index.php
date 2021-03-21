<?php
  session_start();
  //datbase connection file
  include('includes/config.php');
  error_reporting(0);
  // Code for Email Subscription
  if(isset($_POST['subscribe']))
  {

  // Getting Post values
  $emailid=$_POST['email'];   
  // query for data insertion
  $sql="INSERT INTO tblsubscriber(UserEmail) VALUES(:emailid)";
  //preparing the query
  $query = $dbh->prepare($sql);
  //Binding the values
  $query->bindParam(':emailid',$emailid,PDO::PARAM_STR);
  //Execute the query
  $query->execute();
  //Check that the insertion really worked
  $lastInsertId = $dbh->lastInsertId();
  if($lastInsertId) {
      echo "<script>alert('Success : Successfully subscribed');</script>";
      echo "<script>window.location.href='index.php'</script>";  
  }
  else {
      echo "<script>alert('Error : Something went wrong. Please try again');</script>";   
  }

  }

?>

<!doctype html>
<html class="no-js" lang="en">
    <head>
        <title>Event Management System | Home Page </title>
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

        <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">

        <!-- modernizr css -->
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        
        <!--body-wraper-are-start-->
         <div class="wrapper home-02">
            <!--slider header area are start-->
         <?php include_once('includes/header.php');?>
                <!-- header End-->
                <!--slider area are start-->
             <div class="slider-container slider-02">
                    <!-- Slider Image -->
                <div id="mainSlider" class="nivoSlider slider-image"> 
                    <img src="logo/Header_JPG.png" alt="event-management-system" title="#htmlcaption1" height="200" /> 
                </div>

              </div>
                <!--slider area are End-->
                <div class="down-arrow"> <a class="see-demo-btn" href="#about-event"><i class="zmdi zmdi-long-arrow-down"></i></a> </div>
        </div>
            <!--slider header area are end-->
       <!-- Slider Caption 1 -->
            <div id="htmlcaption1" class="nivo-html-caption slider-caption-1" >
                <div class="container">
                    <div class="slide1-text">
                        <div class="middle-text slide-def">
                    <div class="cap-dec wow fadeInDown" data-wow-duration=".9s" data-wow-delay="0.2s" style="margin-top:-100px">
                        <h1 align="center" style="line-height: 60px; font-weight: 700; font-size: 48px">Event Management System<br />
                                We create, You Celebrate</h1>
                                <p align="center" style="font-size: 15px; text-transform: none; margin-top: -8px; font-weight: 600;">We are always ready to give you the gift of our best event within your budget</p>
                    </div>  
                        </div>
                    </div>
                </div>
            </div>


        <!--up comming events area-->
    <div class="upcomming-events-area off-white ptb100">
          <div class="container">
              <div class="row">
                  <h1>Upcoming Event</h1>
                  <hr>
                  <?php
// Fetching Upcomong events
$isactive=1;
$sql = "SELECT EventName,EventDescription,EventLocation,EventStartDate,EventEndDate,EventImage,id from tblevents where IsActive=:isactive order by id desc limit 3";
$query = $dbh -> prepare($sql);
$query->bindParam(':isactive',$isactive,PDO::PARAM_STR);
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

    <?php } } ?>

          </div>
      </div>
    </div> 




            
      <!--Counter area start-->
      <div class="counter-area pb150">
          <div class="container">
              <div class="row">
                  <div class="col-md-2 col-sm-4 col-xs-12">
                      <div class="single-count text-center uppercase">
                         <div class="count-icon">
                             <img src="icon/events.png" alt="">
                         </div>
                          <h3><span class="counter2">50</span></h3><br>
                          <p>+ Events</p>
                      </div>
                  </div>
                  <div class="col-md-2 col-sm-4 col-xs-12">
                      <div class="single-count text-center uppercase">
                         <div class="count-icon">
                             <img src="icon/idea.png" alt="">
                         </div>
                          <h3><span class="counter2">19</span></h3><br>
                          <p>+ Location</p>
                      </div>
                  </div>
                  <div class="col-md-2 col-sm-4 col-xs-12">
                      <div class="single-count text-center uppercase">
                         <div class="count-icon">
                             <img src="icon/live.png" alt="">
                         </div>
                          <h3><span class="counter2">12</span></h3><br>
                          <p>+ Newtwork</p>
                      </div>
                  </div>
                  <div class="col-md-2 col-sm-4 col-xs-12">
                      <div class="single-count text-center uppercase">
                         <div class="count-icon">
                             <img src="icon/location.png" alt="">
                         </div>
                          <h3><span class="counter2">90</span></h3><br>
                          <p>+ Countries</p>
                      </div>
                  </div>
                  <div class="col-md-2 col-sm-4 col-xs-12">
                      <div class="single-count text-center uppercase">
                         <div class="count-icon">
                             <img src="icon/network.png" alt="">
                         </div>
                          <h3><span class="counter2">200</span></h3><br>
                          <p>+ Live Telecast</p>
                      </div>
                  </div>
                  
              </div>
          </div>
      </div>
      <!--Counter area end-->
            
   

<style>
     .counter-area{
        background-image: linear-gradient(rgba(0,0,0,0.52), rgba(0,0,0,0.52)), url(icon/parallax4.jpg);
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
        color: #fff;
        padding: 150px 100px;
        font-family: 'Oswald', sans-serif;
        justify-content: center;
        align-items: center !important;
        }
    .single-count .count-icon img{
        height: 55px !important;
        width: 55px !important;
        margin-top: 10px;
        border-radius: 0;
    }
    .single-count .counter2{
        font-family: sans-serif;
        font-size: 85px;
    }
    .single-count p{
        font-size: 18px;
        font-family: 'Roboto', sans-serif;
        font-weight: bold;
    }
</style>
   
      <!--call to action area start-->
      <div class="call-to-action bg-overlay white-overlay pb100 pt85" style="background: white">
      <div class="bg-color-design">
          
      <br><br><br><br>
      <div class="color-design2">
          <div class="container">
              <div class="row">
                  <div class="col-md-6 col-sm-12 col-xs-12" style="text-align: left; justify-content: center;">
                      <div class="cal-to-wrap">
                          <h5 style="text-align: left; color: #fbbc04; font-weight:bold">Get in Touch</h5>
                          <h1 class="section-title" style="text-align: left; text-transform: capitalize; color: #fff">Subscribe Newsletters</h1>
                           
                          
                          <p style="text-align: left; margin-top: -20px">Lorem ipsum dolor sit amet consectetur adipisicing elit. <br> Labore itaque!</p>
                          </div>
                          </div>
                          <div class="col-md-6 col-sm-12 col-xs-12">
                           <form method="post" name="subscribe">
                              <div class="input-box">
                                  <input type="email" placeholder="Enter your E-mail Address" class="info" name="email" required="true"> 
                                  <button type="submit" name="subscribe" class="send-primarybtn">Submit <i class="zmdi zmdi-mail-send"></i></button>
                              </div>
                          </form>
                      </div>
              </div>
          </div>
          </div>
          <br><br><br><br>
         </div>
      </div>
  
            <!--call to action area End--> 

     <!--information area are start-->
          
    
        <style>
.call-to-action{
    /*margin: 0;
    padding: 3% 3% 3% 6%;*/
    color: #fff;
    font-weight: 600;
    overflow: hidden;
}

.bg-color-design{
    margin-top: -8%;
    margin-bottom: -8%;
    background-color: rgb(37, 41, 49);
    padding: 15px;
}
.color-design2{
    background: linear-gradient(201.69deg,#313844 -21.7%,#202329 141.87%);
    padding: 20px 10px 20px 40px;
    margin: 20px;
}
.call-to-action .input-box{
    margin-top: 10%;
    display: flex;
}
.call-to-action .input-box input{
    margin-top: 2px;
    padding: 10px;
    border: 1px solid #fbbc04;
    background: rgba(46, 46, 69, 1);
    border-radius: 0px;
    width: 60%;
    height: 55px;
}
.call-to-action .input-box button.send-primarybtn{
    width: 120px;
    height: 55px;
    margin-top: 2px;
    margin-left: 0px;
    border-radius: 0px;
    background-color: #fbbc04;
    color: #1f2430;
    border: 2px solid #fbbc04;
    transition: 0.5s ease-in-out;
}
.call-to-action .input-box button.send-primarybtn:hover{
    background-color: darkorange;
    border: 2px solid #fbbc04;
}

        </style>


<section id="contact">
  
  <div class="container">
<div class="row">
  <div class="col-md-12 text-center" style="margin-bottom: 20px;">
    <h1>Contact Us</h1>
    <h5>Let's turn your idea into greater product. </h5>
  </div>
  <br><br><br>
  <div class="col-md-12 col-lg-4 my-auto">
      <div class="get-content">
          <h3 style="font-size: 27px; font-weight: 700;">Get In Touch</h3>
        <p style="font-size: 17px; font-weight: 500;"> For business inquiry please send email to<br><a href="">ibrahim@gmail.com</a></p>
        
        <div class="social-icon">
            <a href="https://twitter.com/login"><i class="zmdi zmdi-twitter"></i></a>
            <a href="https://www.whatsapp.com/"><i class="zmdi zmdi-whatsapp"></i></a>
            <a href="https://www.facebook.com/"><i class="zmdi zmdi-facebook"></i></a>
            <a href="https://www.instagram.com/"><i class="zmdi zmdi-instagram"></i></a>
            <a href="https://www.youtube.com/"><i class="zmdi zmdi-youtube-play"></i></a>
            <a href="https://www.skype.com/en/"><i class="zmdi zmdi-skype"></i></a>
        </div>
        <br><br><br>
        <h3 style="font-size: 27px; font-weight: 700;">Phone No.</h3>
        <p>+88 01755 00000</p>
        <br>
        <h3 style="font-size: 27px; font-weight: 700;">Address</h3>
        <p>Dhaka, Bangladesh</p>
      </div>
  </div>
  <div class="col-md-12 col-lg-8 form">
    <div class="row">


 <?php 
 
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
      $name     = $_POST['name'];
      $address   = $_POST['address'];
      $phone    = $_POST['phone'];
      $message   = $_POST['message'];

    $sql = "INSERT INTO tblcontacts (name, address, phone, message) VALUES('".$name."', '".$address."', '".$phone."', '".$message."')";

    $query = $dbh->prepare($sql);
    $query->bindParam(':name',$name,PDO::PARAM_STR);
    $query->bindParam(':address',$address,PDO::PARAM_STR);
    $query->bindParam(':phone',$phone,PDO::PARAM_STR);
    $query->bindParam(':message',$message,PDO::PARAM_STR);
    $query->execute();

    if ($query) {
      $msg = 'Thank you! Your Message Send Successfully';
      echo "<script>alert('Thank you! Your Message Send Successfully');</script>";
      echo "<script>window.location.href='index.php'</script>"; 
    
    }
    else{
      echo "<script>alert('Sorry! There has been problem sending your details! Try again..');</script>";
    }
    
  }

 ?>

 
  <form role="form" action="" method="post" >
      <div class="col-md-12">
          <h6>Your Name</h6>
          <input style="font-size: 15px; font-weight: bold;" type="text" placeholder="Enter name" name="name" required="">
      </div>

      <div class="col-md-6">
        <h6>Address</h6>
        <input style="font-size: 15px; font-weight: bold; width: 100%;" type="text" name="address" placeholder="Enter Address" required="">
      </div>
      <div class="col-md-6">
        <h6>Phone Number</h6>
        <input style="font-size: 15px; font-weight: bold; width: 100%;" type="text" name="phone" placeholder="Enter phone number" required="">
      </div>
      <div class="col-md-12">
              <br>
        <h6>Your Massage</h6>
        <textarea style="font-size: 15px; font-weight: bold; " name="message" maxlength="300" rows="3" cols="30" placeholder="Write your message" required=""></textarea><br>

      </div>

      <div class="col-md-6">
          
          <button type="submit" class="btn" name="submit">Send
          <i class="zmdi zmdi-mail-send" style="color: black; font-size: 15px; margin-left: 5px"></i></button>
      </div>

    </form>
    </div>
  </div>
</div>
  </div>
</section>


<style>
 
/*------------------------------contact--------------------------------------*/
#contact {
    background-color: rgb(37, 41, 49);
    color: rgb(240, 245, 246);
    width: 100%;
    padding: 7% 0 10% 0;
}

#contact h1 {
    font-size: 35px;
    font-weight: 700;
    color: #fbbc07;
}

#contact h5 {
    font-size: 17px;
    font-weight: 500;
    margin-bottom: 5%;
}

#contact .get-content a {
    color: #fbbc07;
    text-decoration: underline;
}

#contact .get-content .zmdi{
    font-size: 30px;
    color: #fbbc07;
    margin: 10px 0 15px 0;
    padding: 8px 10px;
}

#contact .form input,
textarea {
    background: rgba(46, 46, 69, 1);
    color: aliceblue;
    border: 1px solid #fbbc07;
    font-size: 22px;
    padding: 12px;
    margin-bottom: 2%;
}

#contact .form h6 {
    font-size: 19px;
    font-weight: 700;
}

#contact .form input[name="name"] {
    width: 100%;
    height: 50px;
    margin-bottom: 30px;
}

#contact .form input[name="subject"],
input[name="number"] {
    width: 100%;
    height: 50px;
}

#contact .form textarea {
    width: 100%;
    height: 150px;
    margin-bottom: 3%;
}

#contact .form .btn {
    text-decoration: none;
    background: #fbbc04;
    padding: 13px 43px 13px 43px;
    color: black;
}

#contact .form .btn:hover {
    text-decoration: none;
    background: darkorange;
}

</style>


  <!--footer area are start--> 
        
<?php
$ret = "Select  PhoneNumber,address,EmailId,footercontent from tblgenralsettings ";
$querys = $dbh -> prepare($ret);
$querys->execute();
$resultss=$querys->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($querys->rowCount() > 0)
{
foreach($resultss as $rows)
{ ?>

            <div class="footer-area" align="center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="social-area">
                              <?php echo "Created By Ibrahim Team"; ?>
                             <!-- <?php echo htmlentities($rows->footercontent);?> -->
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>
            <?php }} ?>

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
        <!-- Vedio js -->
        <script src="js/video.js"></script>
        <!-- Youtube Background JS -->
        <script src="js/jquery.mb.YTPlayer.min.js"></script>
        <!-- datepicker js -->
        <script src="js/bootstrap-datepicker.js"></script>
        <!-- waypoint js -->
        <script src="js/waypoints.min.js"></script>
        <!-- onepage nav js -->
        <script src="js/jquery.nav.js"></script>
        <!-- Google Map js -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuU_0_uLMnFM-2oWod_fzC0atPZj7dHlU"></script>
        <script src="js/google-map.js"></script>
        <!-- animate text JS -->
        <script src="js/animate-text.js"></script>
        <!-- plugins js -->
        <script src="js/plugins.js"></script>
        <!-- main js -->
        <script src="js/main.js"></script>


    </body>
</html>