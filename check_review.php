<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reviews</title>
    <style>
        #table{
            background-color: rgb(223, 203, 174);
        }
    </style>
</head>
<body id = "background">
<?php

include 'connection.php';

session_start();


if(isset($_SESSION["user_name"])){
  session_write_close();
  include 'navbar.php';
}
elseif(isset($_SESSION["staff_username"])){
  session_write_close();
  include 'staff_navbar.php';
}

?>

<!-- Creating a table to show the detils -->
<table id="table">
    <tr>
      <!-- Headers -->
        <th>Stars </th>
        
        <th> Review ID</th>
        <th>Customer ID</th>
        <th>Appointment ID</th>
        <th>Service ID</th>
        <th>Staff ID</th>
        <th>Service</th>
        <th>Review</th>
        <th>Staff</th>

        <!-- The little search button so that one can view specific reviws by the amount of stars -->
        <label style="color: white;">Search for specific reviews by stars</label>
        <input type="number"  id="searchbar" onkeyup="myFunction()" placeholder="Search by stars.." min="1" max="5" >

    </tr>
    <?php 
    // Checks if the customer is logged in and requesting to view the reviews, IF it is Customer than the code will allow him to view only the reviews he have given
    if(isset($_SESSION["user_name"])){
      $Customer_ID = $_SESSION['Customer_ID'];
      
      $sql = "SELECT *
      FROM review INNER JOIN service ON review.Service_ID = service.Service_ID
      WHERE Customer_ID = '".$Customer_ID."'";
      
      $records = $conn->query($sql);
    }
    // Checks if the Staff is logged in and requesting to view all the reviews, if it is a staff than he will be allowed to view all the reviews given by all the customers with the aid of the sql code below
    elseif(isset($_SESSION["staff_username"])){
          
      $sql = "SELECT *
      FROM review INNER JOIN service ON review.Service_ID = service.Service_ID";
      
      $records = $conn->query($sql);
    }

    while($result = $records->fetch_assoc()){
      ?>
      <tr>
        <!-- Shows all the reviews -->
        <td><?php echo $result['stars']; ?> <br> <br> </td>
        <td><?php echo $result['review_ID']; ?> <br> <br></td>
        <td><?php echo $result['Customer_ID']; ?> <br> <br></td>
        <td><?php echo $result['Appointment_ID']; ?></td>
        <td><?php echo $result['Service_ID']; ?></td>
        <td><?php echo $result['Staff_ID']; ?></td>
        <td><?php echo $result['Service_name']; ?></td>
        <td><?php echo   "   " . $result['review']; ?> <br> <br></td>
        <td><?php  echo $result['staff_name'];  ?></td>
      </tr>
      <?php  } ?>
    </table>

<!-- SCRIPT FOR SEARCHING -->
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchbar");
  filter = input.value.toUpperCase();
  table = document.getElementById("table");
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