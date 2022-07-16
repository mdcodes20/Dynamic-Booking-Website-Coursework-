<html>
<head>
<title>Home</title>
</head>
<link href="css/index.css" type="text/css" rel="stylesheet"/>	
<style>
h1{
	text-align: center;
	font-size: 10cm;
	color: blue;
}
footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 5%;
  background-color: wheat;
  color: white;
  text-align: center;
}

</style>
<body id="background">	
<?php

include 'navbar.php';
include 'connection.php';

if(isset($_SESSION["user_name"])){
	$sql = mysqli_query($conn,"SELECT * FROM Customer WHERE Customer_ID= '".$_SESSION['Customer_ID']."'");
	$record = mysqli_fetch_array($sql);
	?>
	<div class="container">
	<h1 style="color:white" >  <?php  echo  "Welcome  ", $record['Forename']; ?> </h1>
	</div>
	<?php
}
else{
	echo "<h1>Please login first .</h1>";}
?>


