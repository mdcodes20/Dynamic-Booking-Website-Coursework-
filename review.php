<?php 

include 'connection.php';
include 'navbar.php';

$A_id = $_GET['review'];

$Customer_ID = $_SESSION["Customer_ID"];


if(isset($_POST['submit'])){

	$star_rating = $_POST['star_rating'];
	$review = $_POST['details'];

  if($review == ""){
    ?>
    <p style="color: aliceblue">Please type some review</p>
    <?php

  }else{
    
    $sql = "SELECT *
    FROM Appointment INNER JOIN Customer ON Appointment.Customer_ID = Customer.Customer_ID 
    INNER JOIN Staff ON Appointment.Staff_ID = Staff.Staff_ID
    INNER JOIN Service ON Appointment.Service_ID = Service.Service_ID
    WHERE Appointment.Appointment_ID = '".$A_id."'";

    $records = $conn->query($sql);
    $data = $records->fetch_assoc();

    $Service_ID = $data['Service_ID'];
    $Service_name = $data['Service_name'];

    $sql = "INSERT INTO review(stars,review,Appointment_ID,Customer_ID,Service_ID,Service_name)
    VALUES('$star_rating','$review','$A_id','$Customer_ID','$Service_ID','$Service_name')";

    if(mysqli_query($conn,$sql)){
      ?>
      <p style="color: white;">Thank you so much!</p>
      <?php
      header("all_bookings.php");
    }

    $sql = "SELECT * FROM review where Appointment_ID = '".$A_id."'";
    $records = $conn->query($sql);
    $data  = $records->fetch_assoc();

    $review_ID = $data["review_ID"];

    $sql_2 = "UPDATE Appointment
    SET review_ID = '$review_ID'
    WHERE Appointment_ID = '$A_id'";

    if(mysqli_query($conn,$sql_2)){
      echo "";
      unset($_SESSION["A_ID"]);

    }
  }
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/review.css" type="text/css" rel="stylesheet"/>
	<title style="color:white" >Review page</title>
</head>
<body id ="background">


<!-- <table  style="color:white" id="myreview" border="2" method="GET"> -->
<form align="center"  method="POST">
  <h3 style="color:white">Let us know how we are doing</h3><br><br>
  <b style="color:white">How many stars would you give us?</b>
  <select align="center"  style="color:white" id= "stars_dropdown" name="star_rating">
    <option value="1">1 star</option>
    <option value="2">2 star</option>	
    <option value="3">3 star</option>
    <option value="4">4 star</option>
    <option value="5">5 star</option>
  </select><br><br>
  <p style="color:white"> Your review:  </p><br>
  <textarea id = "review_text" name="details" rows="10" cols="30"></textarea><br><br>
  <input id="submit" type="submit" value="Submit" name="submit">
</form>
<!-- </table> -->
</body>
</html>



