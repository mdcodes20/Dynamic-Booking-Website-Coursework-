<html>
<head>
<title>Home</title>
</head>
<link href="css/staff_all_bookings.css" type="text/css" rel="stylesheet"/>	
<style>
h1{
	text-align: center;
	font-size: 10cm;
	color: blue;
}
</style>
<body  id="background">
<?php 
include 'staff_navbar.php';
?>
<?php
session_start();
if(isset($_SESSION["staff_username"])){
	?>
	<div class="container">
	<h1>  <?php  echo  "Welcome  ", $_SESSION["staff_username"]; ?> </h1>
	</div>
	<?php
}
else{
	echo "<h1>Please login first .</h1>";}
	
?>
