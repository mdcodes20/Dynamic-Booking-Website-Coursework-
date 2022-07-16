<?php 
// Includes the Navigation Bar and the connection file
include 'navbar.php'; 
include 'connection.php';
// Starts a session

$Customer_name = $_SESSION['Forename'] . $_SESSION['Surname'] ;
?><p style="color: white;" > Name:  <?php echo $Customer_name; ?> </p> <?php

if(isset($_POST['Submit'])){
	// Session Variable
	$Customer_ID = $_SESSION["Customer_ID"];

	// Retreives these Details from form
	$AppointmentTime = $_POST['Appointment_time'];
	$AppointmentDate = $_POST['Appointment_date'];
	$Service_ID      = $_POST['Service_ID'];
	$pay             = $_POST['method'];

	if(isset($_POST['checkbox'])){

		$Post_Code = $_POST['Post_Code'];
		$Address   = $_POST['Address'];

	}else{

		// Prepares an SQL statement to retreive Customers Address
		$sql_2    = mysqli_query($conn,"SELECT Post_Code,Address FROM customer WHERE Customer_ID = '".$Customer_ID."'");
		$result_2 = mysqli_fetch_array($sql_2);
		
		$Post_Code = $result_2['Post_Code'];
		$Address   = $result_2['Address'];
	}

	// Assiging each staff for different services

	if($Service_ID == 7){
		$Staff_ID = 1;}
	else if($Service_ID == 8){
		$Staff_ID = 1;}
	else if($Service_ID == 9){
		$Staff_ID = 2;}
	else if($Service_ID == 10){
		$Staff_ID = 2;}
	else{
		$Staff_ID = 3;
	}

	$sql_price = mysqli_query($conn,"SELECT price FROM service WHERE Service_ID = '" . $Service_ID . "'");
	$row_price = mysqli_fetch_array($sql_price);

	$price = $row_price['price'];
	$vatrate = 1.2;
	$price = $price * $vatrate;
	$discount_code = "SAVE10";


	// Preparing a SQL Select Statement to see if the Appointment Date and staff is same
	$sql = mysqli_query($conn,"SELECT * FROM Appointment WHERE Appointment_date = '" . $AppointmentDate . "' AND Staff_ID = '" . $Staff_ID . "' AND Cancelled = True ");
	$row = mysqli_fetch_array($sql);
	
	
	if(isset($_POST['checkbox2'])){
		$discount = $_POST['discount'];
		if($discount != $discount_code){
			?>
			<b align="center" style="color:aliceblue">
			<?php	
			die("Your Discount code is invalid");
		}elseif($discount == $discount_code){
			$price = $price * 0.9;	
		}
	}

	// If the Boxes are empty
	if(($AppointmentTime == "") or ($AppointmentDate == "") or ($Address == "") or($Post_Code == "") ){
		?>
		<b align="center" style="color:aliceblue">Please fill in all the boxes. </b>
		<?php
	}

	// If Customer tries to book in past
	else if (strtotime($AppointmentDate) < time()){
		?>
		<b align="center" style="color:aliceblue">You cannot book in past days. </b>
		<?php
	}

	// If the Appointment Already exist
	else if(is_array($row)){
		?>
		<b align="center" style="color:aliceblue">Staff is already booked that day, Please Try another date</b>
		<?php	
	}
	
	// Inserts the Booking Details in the Booking Table in Databse
	else{
		$sql= "INSERT INTO Appointment(Appointment_time,Appointment_date,Address,Post_Code,Customer_ID,Service_ID,Staff_ID,final_price,Payment_type) 		    
		VALUES('$AppointmentTime', '$AppointmentDate', '$Address', '$Post_Code','$Customer_ID', '$Service_ID', '$Staff_ID', '$price', '$pay')";
		if (mysqli_query($conn,$sql)){
			?>
			<p align="center" style="color:aliceblue">Booking Complete </p>
			<?php
		}
	}
}

?>


<!DOCTYPE html>
<head>
	<style>
	#box{
		background-color: wheat	;
}
#box:hover{
	background-color: #b6be45;
}

</style>
<link  type="text/css" rel="stylesheet"/>

<title>booking Page</title>
</head>

<body id="background">
	<!--------------------- Makes the Form for the booking --------------------->

	<h1 style="color:white" align="center">Booking</h1>
	<h3 style="color:white" align="center"> Enter your appointment details </h3>
	<form align="center" method="post">
		<!--------------------- Appointment Time Box  --------------------->

		<div  id="form" >
			<label style="color:white" >Appointment Time</label>
			<br>
			<input id="box" type="time" name="Appointment_time">
		</div >


		<!--------------------- Appointment Date Box  --------------------->
		<div  >
			<label style="color:white" >Appointment Date</label>
			<br>
			<input id="box"  type="date" name ="Appointment_date">
			<br>
			<br>
		</div >


		<!-- Address box -->
		<u style="color:aliceblue; background-color:black">Tick this box if you would you like to have this service done in another address</u>
		<br>

		<input class="container" type="checkbox" id="box" name="checkbox" onchange="showDiv(this)"/>
		<br>
		<br>

		<script>
		function showDiv(obj) {
		debugger
		if (obj.checked) {
			document.getElementById('content').innerHTML = '<div> <label style="color: aliceblue;">Post Code</label> <br> <input  id="box" type="text" name="Post_Code"> </div>      <br>        <div align="center"><label style="color: aliceblue;">Address</label> <br> <textarea id="box" type="text" name="Address"></textarea> </div>';
			}
			else {
				document.getElementById('content').innerHTML = '';
			}
		}
		</script>
		<div id="content">
		</div>

		<!--------------------- Dropdown Menu  --------------------->

		<div  >
			<label style="color:white" >Service</label>
			<br>
			<select id="box"  name="Service_ID">
				<br>
				<option value="7">Hardwood and laminate Flooring.  Price = £500</option>
				<option value="8">Shelving.  Price = £1500</option>
				<option value="9">Flat pack building.  Price = £3500</option>
				<option value="10">Sillicone sealing for baths, sinks, show.  Price = £700</option>
				<option value="11">Fence repairs and painting.  Price = £1000</option>
				<option value="12">Decking.  Price = £620</option>
				<option value="13">Lock replacement.  Price = £75</option>

			</select>
		</div>

		<br>



		<!-- Payment -->
		<div >
			<label style="color:white" >What method would you like to use to pay?</label>
			<br>
			<select id="box" name="method" >
				<option  value="Chip and Pin reader" >Chip and Pin reader</option>
				<option  value="Cash">Cash</option>
				<option value="Cheque">Cheque</option>
			</select>
			<br>
			<br>
    	</div>

		<!-- Discount -->
		<u style="color:aliceblue; background-color:black">Have Discount code? </u>
		<br>

		<input class="container" type="checkbox" id="box" name="checkbox2" onchange="showDiv2(this)"/>
		<br>

		<script>
		function showDiv2(obj) {
		debugger
		if (obj.checked) {
			document.getElementById('discount').innerHTML = '<div> <label style="color:white">Code</label> <br> <input id="box" type="text" name="discount"> </div>';
			}
			else {
				document.getElementById('discount').innerHTML = '';
			}
		}
		</script>
		<div id="discount">
		</div>

		<!--------------------- Submit button  --------------------->
		<div  >
			<br>
			<button  id="box" class="btn" type="submit" name="Submit">Submit</button>
		</div>

	</form>
</body>
</html>