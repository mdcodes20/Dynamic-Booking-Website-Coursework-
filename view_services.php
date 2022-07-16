<?php
// Includes connection file
include "connection.php";
// Includes navbar file
include "staff_navbar.php";
// Starts the session
session_start();

// Retreives all the data from the services table
$sql = "SELECT * FROM `Service`";
$results = $conn->query($sql);
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/customer.css" type="text/css" rel="stylesheet"/>
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
            <th>Service ID</th>
            <th>Service Name</th>
            <th>Price</th>
            <th>Duration</th>
            <th>Staff</th>
        </tr>
        <?php while($data = $results->fetch_assoc()){ ?>
        <tr>
            <!-- SHows the data -->
            <td><?php echo $data['Service_ID']; ?></td>

            <td><?php echo $data['Service_name']; ?></td>

            <td> <?php  echo "£", $data['price']?></td>
                
            <td><?php echo $data['duration']; ?></td>

            <td><?php echo $data['staff_name'];?></td>
            
        </tr>
        <?php } ?>
    </table>
</body>
</html>