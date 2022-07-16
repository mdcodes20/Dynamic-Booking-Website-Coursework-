<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/Customer.css" type="text/css" rel="stylesheet"/>
	<title >Profile</title>
	<style>
		#table{
			background-color: wheat;
		}
		</style>
</head>
<body id="background">

<?php 
include "navbar.php";
include "connection.php";

$Customer_ID = $_SESSION["Customer_ID"];

// SQL statement to retreive all the data of the customer
$sql = mysqli_query($conn,"SELECT * FROM Customer WHERE Customer_ID = '".$Customer_ID."'");
$result = mysqli_fetch_array($sql);

if(isset($_GET['change'])){
	header("location: change_details.php");
}

?>
    <div >
		<!-- Table to show the details -->
        <table  id="table" align="left" id="myreciept_table" border="1" method="GET" style="width:50%">

		<tr    id ="myreciept" >
			<th >ID: </th>
			<td><?php  echo $result['Customer_ID'];  ?> </td>

		</tr>

		<tr  id ="myreciept" >
			<th  >Forename:</th>
			<td><?php  echo $result['Forename'];  ?> </td> 
  
		</tr>

        <tr  id ="myreciept" >
			<th  >Surname:</th>
			<td><?php  echo $result['Surname'];  ?> </td>

		</tr>

        <tr    id ="myreciept" >
			<th >Email:</th>
			<td><?php  echo $result['Email'];  ?> </td>
            <td style="border-radius: 2"> </td>
		</tr>

		<tr   id ="myreciept" >
			<th >Address:</th>
			<td><?php  echo $result['Address'];  ?> </td>
            <td></td>
		</tr>
		<tr  id ="myreciept" >
			<th  >Post Code:</th>
			<td><?php  echo $result['Post_Code'];  ?> </td>

		</tr>
        <tr  id ="myreciept" >
			<th  >Usernmae:</th>
			<td><?php  echo $result['user_name'];  ?> </td>
           
		</tr>
        <tr   id ="myreciept" >
			<th  >Password:</th>
			<td type="text"><?php  echo "•••••••••••••"  ?> </td>
		</tr>

        <tr   id ="myreciept" >
			<th  >Phone number:</th>
			<td ><?php  echo $result['Phone_number'];  ?> </td>
            
		</tr>
		</table>
	</div>
	<!-- Link to change details of thr customer -->
	<button  border="0"><a  id = "Change_button" href="Customer.php?change= <?php echo $result['Customer_ID']; ?>" title="Edit your Account Details" >Edit</a></button>
        
</body>
</html>