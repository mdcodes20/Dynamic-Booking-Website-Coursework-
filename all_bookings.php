<?php
// Includes the Navigation bar and the connection.php file
include 'navbar.php';
include "connection.php";

// Sql code to retreive the Forename of the customer to show it in the page
if(isset($_SESSION["Customer_ID"])){
  $sql = "SELECT Forename FROM Customer WHERE Customer_ID = '".$_SESSION['Customer_ID']."'";
  $records = $conn->query($sql);
  $dataUser = $records->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>

<head>
  <link href="css/all_bookings.css" type="text/css" rel="stylesheet"/>
  <title>All appointments</title>
</head>
<style>
#action_boxes{
  background-color: wheat;
  border-style: hidden;
  color: black;
}
footer{
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: wheat;
  color: white;
  text-align: center;
}

</style>
<body id="background">

<h2 style="color:white" >Appointment Details</h2>

<!-- Making a table to shwo all the appointments -->
<div id = "table">
  <table  id="myTable" border="2" method="GET">
    <tr   id ="Mytable_head" class="header">
      <!-- Headers -->

        <th>Appointment ID</th>
        <th>Appointment Time</th>
        <th>Appointment Date</th>
        <th>Staff Forename</th>
        <th>Service </th>
        <th>Price</th>
        <th></th>
        <th></th>
        <th>Actions</th>
        <th></th>
        <th></th>
        <th></th>


        <p style="color:white"  > Here is are all your appointments <?php echo $dataUser['Forename'] ?> </p>

        <!-- Searchbar -->
        <p> <input type="text"  id="searchbar" onkeyup="myFunction()" placeholder="Search for booking.." title="Type in a Appointment ID"></p>

        <!-- Sort Dates button -->
        <button id="sort_button" onclick="sortTable(2)" title="Sort the Appointment Dates">Sort The Dates</button>

        <!-- Getting appointments withing a time button -->
        <form  method="POST">
          <div  >
            <input id="background"  type="date" name="StartDate" >
            <input id="background"  type="date" name="EndDate" >
            <button id="sort_button"  class="btn" type="submit" title="Get List of Appointments within a given time" name="Sort">Sort</button>
          </div>
        </form>

        <!-- Cancelled Appointments button -->
        <form method="get" action="cancelled_bookings.php">
          <button id="sort_button" type="Submit" title="Get a list of all the cancelled bookings " class="btn btn-link" >Cancelled bookings</button>
        </form>


      </tr>
      <?php
      

      // Necessary Variables
      $Customer_ID = $_SESSION['Customer_ID'];

      $is_not_cancelled = "1";
      $is_paid          = "0";
      $is_completed     = "1";
      $Price            = 0;
      $finalprice       = 0;
      $total_finalprice = 0;
      $total_original_price = 0;
      $vatrate          = 1.2;
      

      if(isset($_SESSION["Customer_ID"])){

        if(isset($_POST['Sort'])){

          // SQL code to retreive data if the Customer chooose to see appointments within a given time

          $start_date = $_POST["StartDate"];
          $end_date = $_POST["EndDate"];

          $sql = "SELECT *
          FROM Appointment 
          INNER JOIN Customer ON Appointment.Customer_ID = Customer.Customer_ID 
          INNER JOIN Staff ON Appointment.Staff_ID = Staff.Staff_ID
          INNER JOIN Service ON Appointment.Service_ID = Service.Service_ID
          WHERE Customer.Customer_ID = '".$Customer_ID."'
          AND Appointment.Cancelled = '".$is_not_cancelled."'
          AND Appointment.Appointment_date BETWEEN '".$start_date."' AND '".$end_date."'";

        }
        else{

          // SQL code to retreive data from different tables
          
            $sql = "SELECT *
            FROM Appointment 
            INNER JOIN Customer ON Appointment.Customer_ID = Customer.Customer_ID 
            INNER JOIN Staff ON Appointment.Staff_ID = Staff.Staff_ID
            INNER JOIN Service ON Appointment.Service_ID = Service.Service_ID
            WHERE Customer.Customer_ID = '".$Customer_ID."'
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

        // $finalprice  = $finalprice + ($data['price'] * $vatrate)  ; // with VAT
        // $Price = $Price + $data['price']; // without VAT
        $Appointment_ID = $data['Appointment_ID'];

          ?>
         
         <!-- Showing all the details -->
          <tr>  

          <td><?php echo $data['Appointment_ID']; ?></td>

          <td><?php echo $data['Appointment_time']; ?></td>

          <td><?php echo $data['Appointment_date']; ?></td>
              
          <td><?php echo $data['Staff_Forename']; ?></td>

          <td><?php echo $data['Service_name'];?></td>

          <td> <?php  echo "£".  $data['price']?></td>

          <!-- Creating buttons to different actions that can be taken for one single appointment -->

          <?php if($data['Paid'] == $is_paid){?>
          <td><a id = "action_boxes" href="update_booking.php?update= <?php echo $data['Appointment_ID']; ?>" title="Edit your booking details" class='btn btn-info '>Update Booking</a></td>
          <?php }else{  ?>
          <td></td>
          <?php } ?>


          <?php if($data['Paid'] == $is_paid){ ?>
          <td><a  id = "action_boxes" href="cancel_booking.php?remove= <?php echo $data['Appointment_ID']; ?>" title="Remove this booking" class="btn btn-info" >Remove Booking</a></td>
          <?php }else{ ?>
          <td></td>
          <?php } ?>

          <td><a id = "action_boxes" href="reciept.php?reciept= <?php echo $data['Appointment_ID']; ?>" title="Get a Reciept for this booking" class='btn btn-info '>Reciept </a></td>
          
          <td><a id = "action_boxes" href="review.php?review= <?php echo $data['Appointment_ID']; ?>" title="Give it a review" class='btn btn-info '> Give Review </a></td> 
          
          <!-- If the appointment has been paid than the code below wont allow the  customer to pay again (which may cause error) and show them that the appointment has been paid already -->
          <?php if($data['Paid'] == $is_paid){ ?>
          <td><a id = "action_boxes"  href="pay.php?pay= <?php echo $data['Appointment_ID'];?>" title="Pay for a single booking" class='btn btn-success'>Pay </a></td>
          <?php }else{ ?>         
          <td><a  class = 'btn btn-info' title = "Paid">Paid</a></td>         
          <?php } ?>


          <!-- If the Appointment is Completed by the staff than it will show Completed here and if not than it will show not confirmed -->
          <?php if($data['completed'] == $is_completed){ ?>
          <td><a class= 'btn btn-success' title="Completed">Completed</a></td>
          <?php }else{ ?>
          <td><a id= "action_boxes" title="Not completed yet" class="btn btn-danger" disabled="disabled">Not Completed</a></td>
          <?php } ?>
         
          </tr>
          <?php 

          }
      }
        
      ?>

      <tr>

      <!-- For Desing Purposes.... -->
        
        <td  style="border-radius: 2">Price: </td>

        <td  style="border-radius: 2">______</td>

        <td  style="border-radius: 2">______</td>
            
        <td  style="border-radius: 2">______</td>

        <td style="border-radius: 2">______</td>
        

        <td class="price" style="border-radius: 2"><?php echo "£", $total_original_price;?></td>
      
        <td style="border-radius: 2">______</td>
        <td style="border-radius: 2">______</td>
        <td style="border-radius: 2">______</td>
        <td style="border-radius: 2">______</td>
        <td style="border-radius: 2">______</td>
        <td style="border-radius: 2">______</td>


      </tr>
      <tr>
        <td  style="border-radius: 2">VAT: </td>
        <td  style="border-radius: 2">______</td>

        <td  style="border-radius: 2">______</td>
            
        <td  style="border-radius: 2">______</td>

        <td style="border-radius: 2">______</td>

        <td class="price" style="border-radius: 2"><?php echo "£",($total_finalprice - $total_original_price) ?> </td>

        <td style="border-radius: 2">______</td>
        <td style="border-radius: 2">______</td>
        <td style="border-radius: 2">______</td>
        <td style="border-radius: 2">______</td>
        <td style="border-radius: 2">______</td>
        <td style="border-radius: 2">______</td>

                
      </tr>
      <tr>
        <td  style="border-radius: 2">Total Price: </td>
        <td  style="border-radius: 2">______</td>

        <td  style="border-radius: 2">______</td>

       

            
        <td  style="border-radius: 2">______</td>

        <td style="border-radius: 2">______</td>

        <td class="price" style="border-radius: 2"><?php echo "£",$total_finalprice ?> </td>

        <td style="border-radius: 2">______</td>
        <td style="border-radius: 2">______</td>
        <td style="border-radius: 2">______</td>
        <td style="border-radius: 2">______</td>
        <td style="border-radius: 2">______</td>
        <td style="border-radius: 2">______</td>


      </tr>
      <!--  ... END "for design purposes"  -->

  </table>
</div>
<!-- button to create a pdf  -->
<button type="button" class="btn btn-info" id="pdf_button"  onclick="createPDF()"><span class="glyphicon glyphicon-print" ></span>Create PDF</button>

<!-- SCRIPT FOR CREATING PDF -->
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
  win.document.write('<html><head>');
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

<!-- SCRIPT TO SORT THE TABLE -->
<script>

function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  // It makes it so that the direction of set is Ascending
  dir = "asc"; 
  // It goes over the loop until the user switches again.
  while (switching) {
    
    switching = false;
    rows = table.rows;
    // It loops trhough all the rows
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];

      // check if the two rows should switch place, based on the direction, asc or desc:
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;  

    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>


</body>
</html>


