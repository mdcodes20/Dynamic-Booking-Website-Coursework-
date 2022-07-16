<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/reciept.css" type="text/css" rel="stylesheet"/>
	<title>reciept</title>
	<style>
		#table{
			background-color: wheat;
		}
		</style>
</head>

<?php 
include 'connection.php';
include 'navbar.php';
?>
<h1> Here is your Digital reciept </h1>

<?php
$A_id = $_GET['reciept'];

$Customer_ID = $_SESSION["Customer_ID"];


$sql = "SELECT *
FROM Appointment INNER JOIN Customer ON Appointment.Customer_ID = Customer.Customer_ID 
INNER JOIN Staff ON Appointment.Staff_ID = Staff.Staff_ID
INNER JOIN Service ON Appointment.Service_ID = Service.Service_ID
WHERE Appointment.Appointment_ID = '".$A_id."'";

$records = $conn->query($sql);
$data = $records->fetch_assoc();

$Price = 0;
$finalprice = 0;
$vatrate = 1.2;

$finalprice  = $finalprice + ($data['price'] * $vatrate)  ; // with VAT
$Price = $Price + $data['price']; // without VAT


$Staff_ID = $data['Staff_ID'];
$Staff_Forename = $data['Staff_Forename'];
		
$staff_1 = mysqli_query($conn,"SELECT Experience FROM Staff WHERE Staff_ID = '1'");
$result_staff_1 = mysqli_fetch_array($staff_1);

$staff_2 = mysqli_query($conn,"SELECT Experience FROM Staff WHERE Staff_ID = '2'");
$result_staff_2 = mysqli_fetch_array($staff_2);

$staff_3 = mysqli_query($conn,"SELECT Experience FROM Staff WHERE Staff_ID = '3'");
$result_staff_3 = mysqli_fetch_array($staff_3);

		
?>

<body id="background">
	<div id="table">
		<table  id="myreciept_table" border="1" method="POST" style="width:50%">
		<tr  id ="myreciept" >
			<th>ID: </th>
			<td><?php  echo $data['Customer_ID'];  ?> </td>
		</tr>
		<tr  id ="myreciept" >
			<th>Forename:</th>
			<td><?php  echo $data['Forename'];  ?> </td>
		</tr>
		<tr  id ="myreciept" >
			<th>Surname:</th>
			<td><?php  echo $data['Surname'];  ?> </td>
		</tr>
		<tr  id ="myreciept" >
			<th>Address:</th>
			<td><?php  echo $data['Address'];  ?> </td>
		</tr>
		<tr  id ="myreciept" >
			<th>Post Code:</th>
			<td><?php  echo $data['Post_Code'];  ?> </td>
		</tr>
		<tr  id ="myreciept" >
			<th>Appointment ID: </th>
			<td><?php  echo $data['Appointment_ID'];  ?> </td>
		</tr>
		<tr  id ="myreciept" >
			<th>Appointment time: </th>
			<td><?php  echo $data['Appointment_time'];  ?> </td>
		</tr>
		<tr  id ="myreciept" >
			<th>Appointment date: </th>
			<td><?php  echo $data['Appointment_date'];  ?> </td>
		</tr>
		<tr  id ="myreciept" >
			<th>Staff Forename: </th>
			<td><?php  echo $data['Staff_Forename'];  ?> </td>
		</tr>
		<tr  id ="myreciept" >
			<th>Service name: </th>
			<td><?php  echo $data['Service_name'];  ?> </td>
		</tr>
		<tr id ="myreciept" >
			<th>Price: </th>
			<td><?php  echo "£", $finalprice . " " . "VAT included = £" . ($finalprice - $Price)?> </td>
		</tr>
		
		</table>
		<button type="button" class="btn btn-info" id="print_button"  onclick="createPDF()"><span class="glyphicon glyphicon-print" ></span>Create PDF</button>
		<table id= "table"> 

			<?php
			if($Staff_ID == 1){
				?>
				<div  class="container">
				<img align="left" 	src="pictures/jack.png" alt="Avatar" class="image">
				<div class="overlay"><?php echo $Staff_Forename; ?></div>
			</div>
			<div class="myDiv" align="center">
				<p><?php echo $result_staff_1['Experience'] ?></p>
			</div>



			<?php
			}
			else if($Staff_ID == 2){
				?>
				<div   class="container">
				<img  align="right" src="pictures/talha.png" alt="Avatar" class="image">
				<div class="overlay"><?php echo $Staff_Forename; ?></div>
			</div>
			<div class="myDiv" align="center" >
				<p><?php echo $result_staff_2['Experience'] ?></p>
			</div>


			<?php
			}
			else if($Staff_ID == 3){
				?>
				<div   class="container">
				<img align="right"  src="pictures/robert.png" alt="Avatar" class="image" >
				<div class="overlay"><?php echo $Staff_Forename; ?></div>
			</div>
			<div class="myDiv" align="center" >
				<p><?php echo $result_staff_3['Experience'] ?></p>
			</div>

			<?php
			}
			?>
		</table>
	</div>
</body>

<script>
function createPDF() {
var sTable = document.getElementById('table').innerHTML;
// var style = "<style>";

// style = style + "table {width: 100%;font: 17px Calibri;}";
// style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
// style = style + "padding: 2px 3px;text-align: center;}";
// style = style + "</style>";

// CREATE A WINDOW OBJECT.
var win = window.open('', '', 'height=700,width=700');

win.document.write('<title>Receipt</title>');   // <title> FOR PDF HEADER.
// win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
// win.document.write('</head>');
// win.document.write('<body>');
win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
// win.document.write('</body></html>');

win.document.close(); 	// CLOSE THE CURRENT WINDOW.

win.print();    // PRINT THE CONTENTS.
}
</script>



</html>]