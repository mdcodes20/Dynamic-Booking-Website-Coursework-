<?php 

include 'navbar.php';
include 'connection.php';

session_start();

$A_id = $_SESSION['A_ID'];
$sql = mysqli_query($conn, "DELETE FROM Appointment WHERE Appointment_ID= '".$A_id."'") or die(mysqli_error($conn));

$result = $conn->query($sql);

header("location: staff_all_bookings.php"); 

?>