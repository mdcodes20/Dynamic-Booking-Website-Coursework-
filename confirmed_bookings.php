<?php
include 'staff_navbar.php';
session_start();
include 'connection.php';

if(isset($_SESSION['staff_username'])){

    $is_completed = "1";
    $is_paid      = "1";
    
    $sql_2 = "SELECT *
    FROM Appointment INNER JOIN Customer ON Appointment.Customer_ID = Customer.Customer_ID 
    INNER JOIN Staff ON Appointment.Staff_ID = Staff.Staff_ID
    INNER JOIN Service ON Appointment.Service_ID = Service.Service_ID
    AND Appointment.completed = '".$is_completed."'";
    
    $records = $conn->query($sql_2);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/all_bookings.css" type="text/css" rel="stylesheet"/>
	<title>Cancelled bookings</title>
    <style>
        #table{
            background-color: wheat;
        }
        </style>        
</head>
<body id="background">
    <table id="myTable" >
        <tr  id ="Mytable_head" class="header">
            <th>Appointment ID</th>
            <th>Appointment Time</th>
            <th>Appointment Date</th>
            <th>Staff Forename</th>
            <th>Service </th>
            <th>Price</th>
            <th></th>
            <th>Actions</th>
            <th></th>
            <p> <input type="text"  id="searchbar" onkeyup="myFunction()" placeholder="Search for booking.." title="Type in a Appointment ID"></p>

        </tr>
        <?php while($data = $records->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $data['Appointment_ID']; ?></td>

            <td><?php echo $data['Appointment_time']; ?></td>

            <td><?php echo $data['Appointment_date']; ?></td>
                
            <td><?php echo $data['Staff_Forename']; ?></td>

            <td><?php echo $data['Service_name'];?></td>

            <td> <?php  echo "£", $data['price']?></td>

            <td><a class="btn btn-success">Completed</a></td>
            
            
            <?php if($data['Paid'] == $is_paid){ ?>
            <td><a class = 'btn btn-info'  >Paid</a></td>
            <?php }else{ ?>
            <td></td>
            <?php } ?>

            <td><a  href="delete_booking.php?delete= <?php echo $data['Appointment_ID']; ?>" title="Delete the cancelled booking" class='btn btn-danger' > Delete</a></td>
        </tr>
        <?php } ?>
    </table>
    <!-- SCRIPT FOR SEARCHNING -->
    <script>
    function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchbar");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
        }       
    }
    }
    </script>
</body>
</html>