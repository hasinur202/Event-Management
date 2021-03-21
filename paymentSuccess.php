
<?php


session_start();
//datbase connection file
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['usrid'])==0)
    {   
header('location:logout.php');
}
else{ ?>




<link rel="stylesheet" href="css/bootstrap.min.css">

<div id="myModal" class="modal fade" role="dialog" style="margin-top:10%">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #ddd;">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        <h4 class="modal-title">Payment Status</h4>
      </div>
      <div class="modal-body">
      		<h3><strong style="font-weight: bold;">Congratulations..! </strong>Your Payment Succesfully Done..... </h3>
			
      </div>
      <div class="modal-footer" style="background: green;">
        <a href="my-bookings.php" type="button" class="btn btn-default">OK</a>
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

<?php } ?>