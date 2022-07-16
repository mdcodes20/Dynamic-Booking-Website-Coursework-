<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pay for one Booking </title>
</head>
<body>

<?php

include 'connection.php';
include 'navbar.php';
$Customer_ID = $_SESSION['Customer_ID'];

if(isset($_POST['Submit'])){

    $A_id = $_GET['pay'];

    
    $sql = "SELECT price
    FROM Appointment INNER JOIN Service ON Appointment.Service_ID = Service.Service_ID
    WHERE Appointment.Appointment_ID = '".$A_id."'";
    $records = $conn->query($sql);
    $data = $records->fetch_assoc();

    $price = $data['price'];
    $method = $_POST['method'];
    $date = date("Y/m/d");
    $time = date("H:i");


    $sql = "INSERT INTO payment(Payment_type,Date_of_payment,time_of_payment,price_paid,Appointment_ID,Customer_ID)
    VALUES('$method', '$date', '$time', '$price', '$A_id', '$Customer_ID' )";
    if(mysqli_query($conn,$sql)){
        echo "Payment Done!";
    }

    $sql_2 = "UPDATE Appointment
    SET Paid = True,
    completed=True
    WHERE Appointment_ID = '$A_id' ";

    if(mysqli_query($conn,$sql_2)){
        header("location: all_bookings.php");
    }
       
}
?>


<form method="post" >

    <div align="center">
        <label style="color:white" >What method did you use to pay? </label>
        <select      name="method" >
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