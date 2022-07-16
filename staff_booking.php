<?php 
include 'staff_navbar.php'; 
include 'connection.php';


if(isset($_POST['Submit'])) {

	// Retreives these Details from database
	$AppointmentTime = $_POST['Appointment_time'];
	$AppointmentDate = $_POST['Appointment_date'];
	$Service_ID = $_POST['Service_ID'];
	$Customer_ID_2 = $_POST['Customer_ID_2'];

	if(isset($_POST['checkbox'])){
		// Retreives the Address and postcode that the customer would like the service to be done at
		$Address       = $_POST['Address'];
		$Post_Code     = $_POST['Post_Code'];
	}
	else{
		
		// Prepares an SQL statement to retreive Customers Address
		$sql_2 = mysqli_query($conn,"SELECT Post_Code,Address FROM customer WHERE Customer_ID = '".$Customer_ID_2."'");
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
			$Staff_ID = 3;}
	
	
	// Preparing a SQL Select Statement to see if the Appointment Date and staff is same
	$sql = mysqli_query($conn,"SELECT * FROM Appointment WHERE Appointment_date = '" . $AppointmentDate . "' AND Staff_ID = '" . $Staff_ID . "' AND Cancelled = True ");
	$result = mysqli_fetch_array($sql);
	$message = "";

	
	// If the Boxes are empty
	if(($AppointmentTime == "") or ($AppointmentDate == "")){
		$message = "Please fill up all the boxes";
		echo $message;
	}

	else if (strtotime($AppointmentDate) < time()){
		$message = "You cannot book in past days.";
		echo $message;
	}

	// If the Appointment Already exist
	else if(is_array($result)){
		$message =  "Staff is already booked that day, Please try another date";
		echo $message;
	}

	// Inserts the Booking Details in the Booking Table in Databse
	else{ 
		$sql= "INSERT INTO Appointment(Appointment_time,Appointment_date,Post_Code,address,Customer_ID,Service_ID,Staff_ID) 		    
		VALUES('$AppointmentTime', '$AppointmentDate', '$Post_Code', '$Address', '$Customer_ID_2', '$Service_ID', '$Staff_ID')";
		if (mysqli_query($conn,$sql)){
			?>
			<p style="color:aliceblue">Booking Complete </p>
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
#submit_box{
	background-color: #04AA6D;
	color: white;
	padding: 12px 20px;
	border: none;
	border-radius: 4px;
	cursor: pointer;
}
#submit_box:hover{
	background-color: #45a049;
}

#searchbar {
background-image: url('/css/searchicon.png');
background-position: 50px 50px;
background-repeat: no-repeat;
background-color:rgb(216, 230, 97);
color: black;
width: 100%;
height: 1px;
font-size: 16px;
padding: 12px 20px 12px 40px;
border: 1px solid #ddd;
margin-bottom: 12px;
}
</style>
<link href="booking.css" type="text/css" rel="stylesheet"/>

<title >booking Page</title>
</head>
<body id="background" >


<!--------------------- Makes the Form for the booking --------------------->



<form align="center" method="post">
	<h1> Booking</h1>
	<h3> Enter your appointment details </h3>
	<!--------------------- Appointment Time Box  --------------------->

	<div  id="form" >
		<label>Appointment Time</label>
		<br>
		<input id="box" type="time" name="Appointment_time">
	</div >



	<!--------------------- Appointment Date Box  --------------------->
	<div>
		<label>Appointment Date</label>
		<br>
		<input id="box"  type="date" name ="Appointment_date">
	</div >



	<!--------------------- Dropdown Menu  --------------------->

	<div>
		<label>Service</label>
		<br>
		<select id="box"  name="Service_ID">
		<br>
		
		<option value="7">Hardwood and laminate Flooring</option>
		<option value="8">Shelving</option>
		<option value="9">Flat pack building</option>
		<option value="10">Sillicone sealing for baths, sinks, show</option>
		<option value="11">Fence repairs and painting</option>
		<option value="12">Decking</option>
		<option value="13">Lock replacement</option>
		</select>
	</div >

	<br>
	<br>


	<!--------------------- Picks a Customer --------------------->

	<div>
		<label>Customer</label>
		<table class = "table table-bordered table-striped" id="myTable" >
		<input type="text"  id="searchbar" onkeyup="myFunction()" placeholder="Search for Customer.." title="Type in a Customer ID">
		<br>	
		<br>
		<tr>
		<th>Customer ID</th>
		<th>Name</th>
		<th>Address</th>
		<th>Select</th>
		</tr>

		<?php
		$sql = "SELECT * FROM Customer";
		$records = $conn->query($sql);
		while($data = $records->fetch_assoc()){
			$Customer_ID = $data['Customer_ID'];
			?>
			<tr>
				<td> <?php echo $Customer_ID ?> </td>
				<td><?php echo $data['Forename'] . " " . $data['Surname']; ?></td>
				<td><?php echo $data['Address'] ?></td>

				<td><input type="checkbox" name="Customer_ID_2" value= "<?php echo $Customer_ID ?>"></td>
			</tr>
			<?php
			}
			?>
		</table>
	</div>

	<!-- Address box -->
	<u style="color:aliceblue; background-color:black">Tick this box if the customer would like to have this service done in another address</u>
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

	<!--------------------- Submit button  --------------------->
	<div>
		<br>
		<button id="submit_box" class="btn" type="submit" name="Submit">Submit</button>
	</div >

</form>

<script>
function myFunction() {
var input, filter, table, tr, td, i, txtValue;
input = document.getElementById("searchbar");
filter = input.value.toUpperCase();
table = document.getElementById("myTable");
tr = table.getElementsByTagName("tr");
for (i = 0; i < tr.length; i++) {
	td = tr[i].getElementsByTagName("td")[0];
	if (td) {
	txtValue = td.textContent || td.innerText;
	if (txtValue.toUpperCase().indexOf(filter) > -1) {
		tr[i].style.display = "";
	} else {
		tr[i].style.display = "none";
	}
	}       
}
}
</script>

</body>
</html>