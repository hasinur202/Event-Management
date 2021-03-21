
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

 
$val_id=urlencode($_POST['val_id']);
$store_id=urlencode("langc5f522197e3b0d");
$store_passwd=urlencode("langc5f522197e3b0d@ssl");
$requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=".$val_id."&store_id=".$store_id."&store_passwd=".$store_passwd."&v=1&format=json");

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $requested_url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

$result = curl_exec($handle);

$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if($code == 200 && !( curl_errno($handle)))
{

	# TO CONVERT AS ARRAY
	# $result = json_decode($result, true);
	# $status = $result['status'];

	# TO CONVERT AS OBJECT
	$result = json_decode($result);

	# TRANSACTION INFO
	$status = $result->status;
	$tran_date = $result->tran_date;
	$tran_id = $result->tran_id;
	$val_id = $result->val_id;
	$amount = $result->amount;
	$store_amount = $result->store_amount;
	$bank_tran_id = $result->bank_tran_id;
	$card_type = $result->card_type;


    $eid = $_SESSION['eventId'];
    $userid=$_SESSION['usrid'];


    if($tran_id !=="" || $amount !== "" || $card_type !== ""){

        // query for data insertion
    $sql="INSERT INTO transaction(UserId,EventId,tran_id,amount,card_type) VALUES(:userid, :eid,:tran_id,:amount,:card_type)";
    //preparing the query
    $query = $dbh->prepare($sql);
    //Binding the values
    $query->bindParam(':userid',$userid,PDO::PARAM_STR);
    $query->bindParam(':eid',$eid,PDO::PARAM_STR);
    $query->bindParam(':tran_id',$tran_id,PDO::PARAM_STR);
    $query->bindParam(':amount',$amount,PDO::PARAM_STR);
    $query->bindParam(':card_type',$card_type,PDO::PARAM_STR);
    //Execute the query
    $query->execute();


    }






	# EMI INFO
	$emi_instalment = $result->emi_instalment;
	$emi_amount = $result->emi_amount;
	$emi_description = $result->emi_description;
	$emi_issuer = $result->emi_issuer;

	# ISSUER INFO
	$card_no = $result->card_no;
	$card_issuer = $result->card_issuer;
	$card_brand = $result->card_brand;
	$card_issuer_country = $result->card_issuer_country;
	$card_issuer_country_code = $result->card_issuer_country_code; 

	# API AUTHENTICATION
	$APIConnect = $result->APIConnect;
	$validated_on = $result->validated_on;
	$gw_version = $result->gw_version;

?>


<?php
   
    // Signup Process
    if(isset($_POST['book']))
{
    // $tran_id = 
    // $card_type = 
    // $amount = 
    $bokkingid = mt_rand(100000000, 999999999);
    $userid=$_SESSION['usrid'];

    $eid = $_SESSION['eventId'];
   
    // Session::set($eid);

    // Getting Post values
    $noofmembers=$_POST['noofmembers'];
    $usrremark=$_POST['userremark'];


    // query for data insertion
    $sql="INSERT INTO tblbookings(BookingId,UserId,EventId,NumberOfMembers,UserRemark) VALUES(:bokkingid,:userid,:eid,:noofmembers,:usrremark)";
    //preparing the query
    $query = $dbh->prepare($sql);
    //Binding the values
    $query->bindParam(':bokkingid',$bokkingid,PDO::PARAM_STR);
    $query->bindParam(':userid',$userid,PDO::PARAM_STR);
    $query->bindParam(':eid',$eid,PDO::PARAM_STR);
    $query->bindParam(':noofmembers',$noofmembers,PDO::PARAM_STR);
    $query->bindParam(':usrremark',$usrremark,PDO::PARAM_STR);
    //Execute the query
    $query->execute();
    //Check that the insertion really worked
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        // echo '<script>alert("Event booked successfully. Booking number is "+"'.$bokkingid.'")</script>';
        echo "<script>window.location.href='paymentSuccess.php'</script>";  
    }
    else 
    {
        echo "<script>alert('Error : Something went wrong. Please try again');</script>";   
    }

}

?>



<link rel="stylesheet" href="css/bootstrap.min.css">

<div id="myModal" class="modal fade" role="dialog" style="margin-top:10%">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #ddd;">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        <h4 class="modal-title">Payment Confirmation</h4>
      </div>
      <div class="modal-body">

			<form name="bookevent" method="post">
				  <div class="form-group">
				    <input type="text" class="form-control" name="noofmembers" required="true" placeholder="Number Of  Members">
				  </div>

				  <div class="form-group">
				    <textarea type="password" class="form-control" name="userremark" required="true" placeholder="User Remark"></textarea>
				  </div>
				  
				  <button type="submit" name="book" class="btn btn-primary">Confirm To Pay</button>
			</form>

      </div>
      <div class="modal-footer" style="background: red;">
        <a href="all-events.php" type="button" class="btn btn-default">Cancel</a>
      </div>
    </div>

  </div>
</div>


<script src="js/vendor/jquery-3.1.1.min.js"></script>
		<!-- bootstrap js -->
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
	
	$(document).ready(function(){
		$('#myModal').modal('show');
	})

</script>




<?php } else {

	echo "Failed to connect with SSLCOMMERZ";
    }
}

?>


