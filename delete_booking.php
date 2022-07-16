<?php
include "connection.php";
$Appointment_ID = $_GET['delete'];
$sql = "DELETE FROM Appointment WHERE Appointment_ID = '".$Appointment_ID."'";
if(mysqli_query($conn,$sql)){
    header("location: staff_all_bookings.php");
}
?>