
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
    $sql ="SELECT Userid,IsActive FROM tblusers WHERE UserName=:uname and UserPassword=:password";
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
        
        <!---------font-awesome-------->
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
                        <li><a href="index.html">Home</a></li>
                        <li class="active">News</li>
                    </ol>
                </div>
            </div> 
            <!--  breadcumb-area end-->    

            <!-- main blog area start-->
        <div class="single-blog-area ptb100 fix">
           <div class="container">
               <div class="row">
                   <div class="col-md-12 col-sm-7">
                       <div class="single-blog-body">
                            <div class="Leave-your-thought mt50">
                                <h2 class="uppercase text-center">Latest News</h2>
                                <br><br><br>
                                <div class="row">
                
            <form name="signin" method="post">

                  <div class="row news-row">
                    <div class="col-md-6 col-sm-12 modify-theme">
                        <h3>Freelancer Meet</h3>
                        <p>Freelancer Meet brings the sun, sea, and sports right to your fingertips! Whether at home or on the go, challenge your family and friends to Frisbee, Jet Ski, Basketball, Golf, Skateboarding, and Beach Tennis to claim victory! Enjoy Frisbee, Jet Ski, Basketball, Golf, Skateboarding, and Beach Tennis! Play each sport your way with various modes and controls for endless fun. Fully customize your avatar! New items will be unlocked as you progress! pick-up controls make this game fun for everyone, from kids to grandparents. Have fun wherever you go! Whether battling with four players using Nintendo Switch™ motion controls, taking
                      on a friend, or just playing on your own.</p>
                      <br>
                      <p class="news-icon"><i class="fa fa-calendar"></i> 2020-04-03 to 2020-06-20  <i class="fa fa-clock-o"></i> 10:05:04</p>
                    </div>
                    <div class="col-md-6 col-sm-12">

                    <div class="video-box">
                            <a href="https://www.youtube.com/watch?v=h6VkeI1xd8E" class="">
                              <span class="ripple"><i class="fa fa-play"></i></span>
                            <img class="img-fluid" src="img/blank-business-composition-computer-373076.jpg" alt=""></a>
                    </div>


                    </div>
                </div>



             <br><br><br>
                   <div class="row news-row">
                   <div class="col-md-6 col-sm-12">


                      <div class="video-box">
                              <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="lightbox-image overlay-box">
                                <span class="ripple"><i class="fa fa-play"></i></span>
                              <img class="img-fluid" src="img/blank-business-composition-computer-373076.jpg" alt=""></a>
                      </div>


                  </div>
                  <div class="col-md-6 col-sm-12 modify-theme">
                      <h3>Wedding Party</h3>
                      <p>One of the most personal and important aspects of your wedding
                       planning process will be choosing your wedding party! Your
                     wedding party (also known as the bridal party) will include
                    not only the people who will help you plan your big day,
                     but they also are those you will want by your side when you
                        walk down the aisle and say your vows. Typically your wedding
                        party is made up of your sisters, brothers, and closest
                           friends or family members.</p>
                       <br>
                       <p class="news-icon"><i class="fa fa-calendar"></i> 2020-04-03 to 2020-06-20  <i class="fa fa-clock-o"></i> 10:05:04</p>
                    </div>
                   </div>

      <br><br><br>
               <div class="row news-row">
               <div class="col-md-6 col-sm-12 modify-theme">
                    <h3>Music Party</h3>
                    <p>While social media and shared playlists have become the most popular
                     ways to find new music in 2020, music blogs still remain one of the best channels
                      for learning about new music from new or largely unheard-of bands and artists.
                       No matter what genre you’re interested in, there’s a space online where music
                        aficionados are talking about the best new and emerging artists across the world.
                         Music blogs not only help you stay up-to-date with emerging artists and new
                          music coming out across genres, but they can also provide important insights 
                          for musicians who are looking for a way to break into the music business. In 
                          addition to album reviews and news, these blogs provide a look at new music 
                      technologies and trends that are changing the way the music business operates.</p>
                      <br>
                      <p class="news-icon"><i class="fa fa-calendar"></i> 2020-04-03 to 2020-06-20  <i class="fa fa-clock-o"></i> 10:05:04</p>
                    </div>
                <div class="col-md-6 col-sm-12">
                  <div class="video-box">
                     <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="">
                     <span class="ripple"><i class="fa fa-play"></i></span>
                    <img class="img-fluid" src="img/man-with-headphones-facing-computer-monitor-845451.jpg" alt=""></a>
                  </div>
                </div>
                    
               </div>




               <br><br><br>
               <div class="row news-row">

               <div class="col-md-6 col-sm-12">
               <div class="video-box">
                     <a href="https://www.youtube.com/watch?v=h6VkeI1xd8E" class="">
                     <span class="ripple"><i class="fa fa-play"></i></span>
                    <img class="img-fluid" src="img/man-with-headphones-facing-computer-monitor-845451.jpg" alt=""></a>
               </div>
                    </div>

                    <div class="col-md-6 col-sm-12 modify-theme">
                        <h3>Product Launching</h3>
                        <p>Product Launching brings the sun, sea, and sports right
                  to your fingertips! Whether at home or on the go, 
                challenge your family and friends to Frisbee, Jet Ski,
             Basketball, Golf, Skateboarding, and Beach Tennis to 
               claim victory! Enjoy Frisbee, Jet Ski, Basketball,
           Golf, Skateboarding, and Beach Tennis! Play each sport 
        your way with various modes and controls for endless 
                   fun. Fully customize your avatar! New items will be 
             unlocked as you progress! Easy-to-pick-up controls make
                this game fun for everyone, from kids to grandparents. 
                 Have fun wherever you go! Whether battling with four 
                     players using Nintendo Switch™ motion controls, taking
                      on a friend, or just playing on your own.</p>
                      <br>
                      <p class="news-icon"><i class="fa fa-calendar"></i> 2020-04-03 to 2020-06-20  <i class="fa fa-clock-o"></i> 10:05:04</p>
                    </div>  
                    </div>





                    <br><br><br>
               <div class="row news-row">
               <div class="col-md-6 col-sm-12 modify-theme">
                    <h3>University Convocation</h3>
                <p>While social media and shared playlists have become the most popular
                   ways to find new music in 2020, music blogs still remain one of the best channels
                    for learning about new music from new or largely unheard-of bands and artists.
                     No matter what genre you’re interested in, there’s a space online where music
                      aficionados are talking about the best new and emerging artists across the world.
                       Music blogs not only help you stay up-to-date with emerging artists and new
                        music coming out across genres, but they can also provide important insights 
                        for musicians who are looking for a way to break into the music business. In 
                        addition to album reviews and news, these blogs provide a look at new music 
                    technologies and trends that are changing the way the music business operates.</p>
                    <br>
                  <p class="news-icon"><i class="fa fa-calendar"></i> 2020-04-03 to 2020-06-20  <i class="fa fa-clock-o"></i> 10:05:04</p>
                    </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="video-box">
                         <a href="https://www.youtube.com/watch?v=h6VkeI1xd8E" class="">
                         <span class="ripple"><i class="fa fa-play"></i></span>
                        <img class="img-fluid" src="img/man-with-headphones-facing-computer-monitor-845451.jpg" alt=""></a>
                     </div>
                    </div>
               </div>

                    <br><br><br>
                   <div class="row news-row">
                   <div class="col-md-6 col-sm-12 ">
                   <div class="video-box">
                       <a href="https://www.youtube.com/watch?v=h6VkeI1xd8E" class="">
                       <span class="ripple"><i class="fa fa-play"></i></span>
                      <img class="img-fluid" src="img/man-with-headphones-facing-computer-monitor-845451.jpg" alt=""></a>
                   </div>
                    </div>
                    <div class="col-md-6 col-sm-12 modify-theme">
                    <h3>College Event</h3>
                      <p>One of the most personal and important aspects of your wedding
                       planning process will be choosing your wedding party! Your
                     wedding party (also known as the bridal party) will include
                    not only the people who will help you plan your big day,
                     but they also are those you will want by your side when you
                        walk down the aisle and say your vows. Typically your wedding
                        party is made up of your sisters, brothers, and closest
                           friends or family members.</p>
                           <br>
                         <p class="news-icon"><i class="fa fa-calendar"></i> 2020-04-03 to 2020-06-20  <i class="fa fa-clock-o"></i> 10:05:04</p>
                    </div>
                   </div>
            </form>
                                    </div>
                                </div>
                           </div>
                       </div>
               
               </div>
           </div>
         </div>


<style>

.news-row{
    padding: 30px;
    font-family: 'Roboto', sans-serif;
}
.news-row h3{
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 20px;
}
.news-row img{
    border-radius: 30px;
    filter: grayscale(1);
    transition: 0.8s linear;
}
.news-row:hover img{
    filter: grayscale(0);
    filter: saturate(1.4);
} 
.news-row i.fa-clock-o{
    margin-left: 10px;
}
.video-box span{
    position: absolute;
  width:80px;
  height: 80px;
  left:50%;
    top: 50%;
  z-index:99;
  color: red;
  font-weight:400;
  font-size:24px;
  text-align: center;
  border-radius:50%;
  padding-left:4px;
  background-color: #ffffff;
  display: inline-block;
  margin-top: -40px;
  margin-left:-40px;
  transition: all 900ms ease;
    box-shadow:0px 0px 15px rgba(0,0,0,0.15);
    animation: ripple 3s infinite;
}
.video-box i{
    position: absolute;
    top: 35%;
    left: 5%;
    height: 70px;
    width: 70px;
}

.video-box .ripple,
.video-box .ripple:before,
.video-box .ripple:after {
    position: absolute;
    top: 60%;
    left: 55%;
    height: 70px;
    width: 70px;
    transform: translate(-50%, -50%);
    border-radius: 50%;
    box-shadow: 0 0 0 0 rgba(255, 255, 255, .6);
    animation: ripple 3s infinite;
}   


.video-box .ripple:before {
    animation-delay: .9s;
    content: "";
    position: absolute;
}

.video-box .ripple:after {
    animation-delay: .6s;
    content: "";
    position: absolute;
}

@-webkit-keyframes ripple {
    70% {box-shadow: 0 0 0 70px rgba(255, 255, 255, 0);}
    100% {box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);}
}




</style>
            <!--main blog area start-->

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
