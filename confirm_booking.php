<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Confirm booking </title>
</head>


<?php

session_start();
include 'connection.php';

include 'staff_navbar.php';

$A_id = $_GET['confirm'];

$sql = mysqli_query($conn,"UPDATE Appointment
SET completed=true,
Paid=true
WHERE Appointment_ID=$A_id");

if(isset($_POST['Submit'])){
    $sql = "SELECT price,Customer_ID
    FROM Appointment INNER JOIN Service ON Appointment.Service_ID = Service.Service_ID
    WHERE Appointment.Appointment_ID = '".$A_id."'";
    $records = $conn->query($sql);
    $data = $records->fetch_assoc();

    $Customer_ID = $data['Customer_ID'];
    $price = $data['price'];
    $method = $_POST['method'];
    $date = date("Y/m/d");
    $time = date("H:i");

    $sql = "INSERT INTO payment(Payment_type,Date_of_payment,time_of_payment,price_paid,Appointment_ID,Customer_ID)
    VALUES('$method', '$date', '$time', '$price', '$A_id', '$Customer_ID' )";
    if(mysqli_query($conn,$sql)){
        echo "";
        header("location: staff_all_bookings.php");
    }
}

?>
<body>
    <form method="post" >

    <div align="center">
        <label style="color:white" >What method did the customer use to pay? </label>
        <select name="method" >
            <option value="Chip and Pin reader" >Chip and Pin reader</option>
            <option value="Cash">Cash</option>
            <option value="Cheque">Cheque</option>
        </select>
    </div>

    <div  align="center">
        <br>
        <button id="box" class="btn" type="submit" name="Submit">Submit</button>
    </div>
    </form>

</body>
</html>