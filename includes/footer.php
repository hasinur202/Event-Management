
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

<!-- 
 <div class="information-area off-white ptb100">
      <div class="container">
     <div class="row">
   <div class="col-md-6 contact-info">
   <div class="follow"><b>Address:</b><i class="zmdi zmdi-pin" style="margin-right: 20px"></i> Dhaka, Bangladesh</div>
   <div class="follow"><b>Phone:</b><i class="zmdi zmdi-phone" style="margin-right: 20px"></i>+88 01700000000</div>
   <div class="follow"><b>Email:</b><i class="zmdi zmdi-email-open" style="margin-right: 20px"></i> <a style="color: #333; text-decoration: underline;" href="mailto:company@email.com">Ibrahim@gmail.com</a></div>
   <div class="follow"><label style="margin-right: 20px"><b>Get Social:</b></label>
   <a href="https://www.facebook.com/"><i class="zmdi zmdi-facebook" style="color: rgb(2, 33, 172);"></i></a>
   <a href="https://www.youtube.com/"><i class="zmdi zmdi-youtube-play" style="color: red;"></i></a>
   <a href="https://twitter.com/login"><i class="zmdi zmdi-twitter" style="color: rgb(7, 132, 250;"></i></a>
   <a href=""><i class="zmdi zmdi-google" style="color: green;"></i></a>
   </div>
 </div>   
                          
                        </div>
                    </div>
                </div> -->
            <!--information area are start-->



   




<style>
.information-area{
    background: #efefef;
	padding-top: 40px;
	padding-bottom: 40px;
    color: #777;
    font-size: 20px;
    font-family: 'Roboto', sans-serif;
}
/*#contact
{
    background: #1f2430;
    color: #fbbc07 !important;
    text-align: center; 

	background: #efefef;
	padding-top: 40px;
	padding-bottom: 40px;
	color: #777;
}*/

.follow
{
    width: 200%;
	background: #fff;
    padding: 10px 10px 10px 30px;
    margin: 15px;
}
.contact-info .zmdi
{
	margin: 10px;
	color: #007bff;
    font-weight: bold;
    font-size: 25px;
    transition: 0.5s linear;
}
.contact-info .zmdi:hover
{
	transform: scale(1.4);
}


</style>




            <!--footer area are start-->
            <div class="footer-area" align="center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="social-area">
                                        Created by WUB Team
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>
            <?php }} ?>