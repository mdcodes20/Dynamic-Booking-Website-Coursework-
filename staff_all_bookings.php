<!DOCTYPE html>
<?php 
// includes the navigation bar and the connection.php file


include 'staff_navbar.php';
include "connection.php";

session_start();

?>


<html>
<head>

<title>Display all records from Database</title>

<link href="../css/staff_all_bookings.css" type="text/css" rel="stylesheet"/>
<style>

  
#myTable {
border-radius: 50px;
width: 100%;
height: 50%;
background: rgb(223, 203, 174);
animation: mymove 5s infinite;
} 
@keyframes mymove {
  from {background-color: #cfa738;}
  to {background-color: rgb(218, 199, 115);}
}

#Mytable_head{
background-color: rgb(223, 203, 174);
}

#myTable th, #myTable td {
text-align: left;
padding: 12px;
border-style: hidden ;
border-width: 2cm;
}

#myTable tr.header, #myTable tr:hover {
background-color: #e6de79;
}

#action_boxes{
background-color: wheat;
border-style: hidden;
color: black;
}
#action_boxes:hover{
background-color: #b6be45 ;
}
#sort_button{
background-color: rgb(146, 211, 86); /* Green */
border: none;
color: white;
padding: 15px 32px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
}
#background{
background-color: wheat;
height: 50%;
}

td.price{
border-width: 5px;
}
#pdf_button{
background-color: rgb(146, 211, 86); /* Green */
border: none;
color: white;
padding: 15px 32px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
}

#searchbar {
background-image: url('/css/searchicon.png');
background-position: 50px 50px;
background-repeat: no-repeat;
background-color:rgb(216, 230, 97);
color: black;
width: 100%;
height: 1px;
font-size: 16px;
padding: 12px 20px 12px 40px;
border: 1px solid #ddd;
margin-bottom: 12px;
}
#searchbar2{
background-image: url('/css/searchicon.png');
background-position: 50px 50px;
background-repeat: no-repeat;
background-color:rgb(216, 230, 97);
color: black;
width: 100%;
height: 1px;
font-size: 16px;
padding: 12px 20px 12px 40px;
border: 1px solid #ddd;
margin-bottom: 12px;
}


  </style>
</head>

<body  id="background">

<h2>Appointment Details</h2>

<!-- Makes seperate tables to show the details -->
<div id="table">
  <table id="myTable" border="2" method="GET">
    <tr class ="header">
      <!-- Headers -->
      <th>Appointment ID</th>
      <th>Staff ID</th>     
      <th>Customer ID</th>
      <th>Appointment Time</th>
      <th>Appointment Date</th>
      <th>Customer Name</th>
      <th>Service </th>
      <th>City</th>
      <th>Price</th>
      <th></th>
      <th>Actions</th>
      <th></th>
      <th></th>

      <!-- Searchbar to search by Appointment ID -->
      <input type="text"  id="searchbar" onkeyup="myFunction()" placeholder="Search for booking..." title="Type in a Appointment ID">
      <!-- Searchbar to search by city -->
      <input type="text"  id="searchbar2" onkeyup="myFunction2()" placeholder="Search for bookings by city..." title="Type in a City name">

      <!-- Sort button (Showing all the booking made within two given dates) -->
      <form  method="POST">
        <div  align-"center">
          <input id="background"  type="date" name="StartDate" >
          <input id="background"  type="date" name="EndDate" >
          <button id="sort_button"  class="btn" type="submit" name="Sort">Sort</button>
        </div>
      </form>
      <!-- Sort button(to sort from ascendijng order of dates or descending order of dates) -->
      <button id="sort_button" onclick="sortTable(4)" title="Sort the Appointment Dates">Sort</button>

      <br>
      <br>
      <!-- Link to all the cancelled bookings -->
      <form method="get" action="cancelled_bookings.php">
        <button id="sort_button" title = "All the cancelled bookings " type="Cancelled Bookings ">Cancelled Bookings</button>
      </form>
      <br>
      <br>

      <!-- Link to all the cancelled bookings -->
      <form method="get" action="confirmed_bookings.php">
      <button id="sort_button" title = "All the confirmed bookings " type="Cancelled Bookings ">completed Bookings</button>
      </form>
      <br>
      <br>


      <p>HERE ARE ALL THE BOOKINGS:</p>


    </tr>

  <?php

  // Necessary variables
  $Staff_ID = $_SESSION['Staff_ID'];


  
  $is_not_cancelled = "1";
  $is_not_paid      = "0";
  $is_not_completed = "0";
  $price            = 0;
  $finalprice       = 0;
  $total_finalprice = 0;
  $total_original_price = 0;
  $vatrate          = 1.2;


  if(isset($_SESSION["Staff_ID"])){
    if(isset($_POST['Sort'])){

      $start = $_POST["StartDate"];
      $end = $_POST["EndDate"];
      
      // If the staff has choosen to sort the dates between two dates than it applies the given SQL statement and only returns appointments between those dates
      $sql = "SELECT *
      FROM Appointment INNER JOIN Staff ON Appointmwent.Staff_ID = Staff.Staff_ID
      INNER JOIN Customer ON Appointment.Customer_ID = Customer.Customer_ID
      INNER JOIN Service ON Appointment.Service_ID = service.Service_ID
      WHERE Appointment.Appointment_date BETWEEN '".$start."' AND '".$end."'
      AND Appointment.Cancelled = '".$is_not_cancelled."'";

    }
    else{
      // Retreive all the data from 3 tables to show in the table in webpage
      $sql = "SELECT *
      FROM Appointment INNER JOIN Staff ON Appointment.Staff_ID = Staff.Staff_ID
      INNER JOIN Customer ON Appointment.Customer_ID = Customer.Customer_ID
      INNER JOIN Service ON Appointment.Service_ID = service.Service_ID
      AND Appointment.Cancelled = '".$is_not_cancelled."'";
    }
    
    

    $records = $conn->query($sql);

    while($data = $records->fetch_assoc()){
        // Processing Calculations
        $finalprice = $data['final_price'];  // VAT included
        $price = $finalprice / 1.2;    // Original price
        $Vat = $finalprice - $price;   
        
        $total_finalprice = $total_finalprice + $finalprice; // Total 
        $total_original_price = $total_original_price + $price;  // total original
      


      ?>
      <tr>


        <!-- Showing all the data -->
        <td><?php echo $data['Appointment_ID']; ?></td>

        <td><?php echo $data['Staff_ID']  ?></td>

        <td><?php echo $data['Customer_ID']  ?></td>

        <td><?php echo $data['Appointment_time']; ?></td>

        <td><?php echo $data['Appointment_date']; ?></td>

        <td><?php echo $data['Forename']; ?></td>

        <td><?php echo $data['Service_name']; ?></td>

        <td><address style="color:black" ><?php echo $data['Address'] . ", ".  $data['Post_Code']; ?></address></td>

        <td> <?php  echo "£", $data['price']?></td>



        <!-- The action boxes below are special ones which changes from working button to not working button. -->



        <!-- This is the box for    completed.   If the staff confirms the booking than the button chnages its colour and turns into not working button -->
        <?php if($data['completed'] == $is_not_completed){ ?>
        <td><a id = "action_boxes"  href="confirm_booking.php?confirm= <?php echo $data['Appointment_ID']; ?>" title="Confirm this booking" class='btn btn-info'>Confirm </a></td>
        <?php }else{?>
        <td><a  class='btn btn-success' title="Booking Confimred">Completed</a></td>
        <?php } ?>


        <?php if($data['Paid'] == $is_not_paid){?>
        <td><a id = "action_boxes" href="update_booking.php?update= <?php echo $data['Appointment_ID']; ?>" title="Edit your booking details" class='btn btn-info '>Update Booking</a></td>
        <?php }else{  ?>
        <td></td>
        <?php } ?>

        
        <!-- This is the box for    Cancelled.   If the staff cancels the booking than the button chnages its colour and turns into not working button -->
        
        <?php
        if($data['Paid'] == $is_not_paid){
          if(($data['Cancelled'] == $is_not_cancelled) ){ ?>
        <td><a  href="cancel_booking.php?remove= <?php echo $data['Appointment_ID']; ?>" title="Remove this booking" class='btn btn-danger'>Cancel</a></td>
        <?php }elseif($data['Cancelled'] != $is_not_cancelled){ ?>
        <td><a  class = 'btn btn-warning' title="Booking Cancelled" >Cancelled</a></td>
        <?php }
        }else{ ?>
        <td></td>
        <?php } ?>  

        <!-- This is the boz for   Paid.    If the Customer has already cancelled the booking than this button turns colour and chnages into a not working button -->
        <?php if($data['Paid'] != $is_not_paid){ ?>
        <td><a  class = 'btn btn-info' title = "Paid">Paid</a></td>         
        <?php }else{ ?>
        <td ></td>
        <?php } ?>

      </tr>

      <?php

      }
    }

  ?>


<!-- Below is the last row of the table which  shows the total price and the reason behind all those    style="borbar_radius:2"   is so that that line does not have any border lines which makes the table to look better  -->
  <tr>  
    <td style="border-radius: 2">Total original Price: </td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"> </td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"><?php echo "£", $total_original_price;?>  </td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
  </tr>
  <tr>  
    <td style="border-radius: 2">VAT: </td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"> </td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"><?php echo "£",($total_finalprice - $total_original_price) ?>   </td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
  </tr>
  <tr>  
    <td style="border-radius: 2">Total Price: </td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"> </td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"><?php echo "£", $total_finalprice;?>  </td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
    <td style="border-radius: 2"></td>
  </tr>

  </table>
</div>


<!-- Pdf button -->
<p>
	<input id="sort_button" type="button" value="Create PDF" id="btPrint" onclick="createPDF()" />
</p>  



<!-- SCRIPT for searching address -->
<script>
$(document).ready(function () {
    //Convert address tags to google map links - Copyright Michael Jasper 2011
    $('address').each(function () {
        var link = "<a href='http://maps.google.com/maps?q=" + encodeURIComponent( $(this).text() ) + "' target='_blank'>" + $(this).text() + "</a>";
        $(this).html(link);
    });
});
</script>


<!-- SCRIPT for sorting the table from ascending order to descending order -->

<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  // Make a loop that will continue until no switching has been done:
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    // Loop through all table rows (except the first, which contains table headers):
    for (i = 1; i < (rows.length - 1); i++) {
      //start by stating there should be no switching:
      shouldSwitch = false;
      //Get the two elements you want to compare, one from current row and one from the next:
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      // check if the two rows should switch place, based on the direction, asc or desc:
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>

<!-- SCRIPT for creating PDF -->
<script>
function createPDF() {
var sTable = document.getElementById('table').innerHTML;
var style = "<style>";

style = style + "table {width: 100%;font: 17px Calibri;}";
style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
style = style + "padding: 2px 3px;text-align: center;}";
style = style + "</style>";

// CREATE A WINDOW OBJECT.
var win = window.open('', '', 'height=700,width=700');

win.document.write('<title>Receipt</title>');   // <title> FOR PDF HEADER.
win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
win.document.write('</head>');
win.document.write('<body>');
win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
win.document.write('</body></html>');

win.document.close(); 	// CLOSE THE CURRENT WINDOW.

win.print();    // PRINT THE CONTENTS.
}
</script>


<!-- SCRIPT for firs searchbar -->
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchbar");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
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

// SCRIPT for second searchbar
function myFunction2() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchbar2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[7];
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





