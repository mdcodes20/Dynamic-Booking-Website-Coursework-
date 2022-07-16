<?php
include 'connection.php';
session_start();
if(isset($_SESSION['user_name'])){
    session_write_close();
    include 'navbar.php';
}
elseif(isset($_SESSION['staff_username'])){
    session_write_close();
    include 'staff_navbar.php';
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
        <?php
        if(isset($_SESSION['user_name'])){
            $Customer_ID = $_SESSION['Customer_ID'];
            $is_cancelled = "0";
            $is_paid      = "1";
                $sql = "SELECT *
                FROM Appointment INNER JOIN Customer ON Appointment.Customer_ID = Customer.Customer_ID 
                INNER JOIN Staff ON Appointment.Staff_ID = Staff.Staff_ID
                INNER JOIN Service ON Appointment.Service_ID = Service.Service_ID
                WHERE Customer.Customer_ID = '".$Customer_ID."' 
                AND Appointment.Cancelled = '".$is_cancelled."'";
            $records = $conn->query($sql);
        }
        elseif(isset($_SESSION['staff_username'])){
            $is_cancelled = "0";
            $is_paid      = "1";
            $sql_2 = "SELECT *
            FROM Appointment INNER JOIN Customer ON Appointment.Customer_ID = Customer.Customer_ID 
            INNER JOIN Staff ON Appointment.Staff_ID = Staff.Staff_ID
            INNER JOIN Service ON Appointment.Service_ID = Service.Service_ID
            AND Appointment.Cancelled = '".$is_cancelled."'";

            $records = $conn->query($sql_2);
        
        }    

        while($data = $records->fetch_assoc()){

            ?>
            <tr>
                <td><?php echo $data['Appointment_ID']; ?></td>
                <td><?php echo $data['Appointment_time']; ?></td>
                <td><?php echo $data['Appointment_date']; ?></td>
                <td><?php echo $data['Staff_Forename']; ?></td>
                <td><?php echo $data['Service_name'];?></td>
                <td> <?php  echo "£", $data['price']?></td>
                <?php if(isset($_SESSION['staff_username'])){ ?>
                <td><a  href="delete_booking.php?delete= <?php echo $data['Appointment_ID']; ?>" title="Delete the cncelled booking" class='btn btn-danger' > Delete</a></td>
                <?php }else{  ?>
                <td></td>
                <?php } ?>
                <?php if($data['Paid'] == $is_paid){ ?>
                <td><a class = 'btn btn-info'  >Paid</a></td>
                <?php }else{ ?>
                <td></td>
                <?php } ?>
                <td><a title="Cancelled"   class = 'btn btn-warning'>Cancelled</a></td>
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