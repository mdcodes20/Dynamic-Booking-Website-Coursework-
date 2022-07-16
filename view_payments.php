<?php
// Includes connection file
include "connection.php";
// Includes navbar file
include "staff_navbar.php";
// Starts the session
session_start();

// Retreives all the data from the payment table
$sql = "SELECT * FROM `payment`";
$results = $conn->query($sql);
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/all_bookings.css" type="text/css" rel="stylesheet"/>
    <title>View Services</title>
    <style>
        #table{
            background-color: wheat;
        }
        </style>        
</head>
<body id="background">
    <table id="table">
        <tr  id ="Mytable_head" class="header">
            <!-- Headers -->
            <th>Payment_ID </th>
            <th>Appointment_ID</th>
            <th>Payment type</th>
            <th>Date of Payment</th>
            <th>Time of Payment</th>
            <th>Price Paid</th>

        </tr>
        <?php while($data = $results->fetch_assoc()){ ?>
        <tr>
            <!-- Shows the data -->
            <td><?php echo $data['Payment_ID']; ?></td>
            <td><?php echo $data['Appointment_ID']; ?></td>
            <td><?php echo $data['Payment_type']; ?></td>        
            <td><?php echo $data['Date_of_payment'];?></td>
            <td><?php echo $data['time_of_payment'];?></td>
            <td> <?php  echo "£", $data['price_paid']?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
