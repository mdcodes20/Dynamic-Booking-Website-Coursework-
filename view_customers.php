<?php

// Inlcudes the connnection and navbar file, starts the sessiona and checks if the staff wishes to chnage the details of a customer and if he do than it wil redirect him to the appropriate page
include 'connection.php';
include 'staff_navbar.php';
session_start();


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View Customers</title>
    <h1>All the Customers</h1>
    <style>
      #searchbar {
  background-image: url('/css/searchicon.png');
  background-position: 50px 50px;
  background-repeat: no-repeat;
  background-color:rgb(216, 230, 97);
  color: black;
  height: 1px;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

input[type=text] {
  width: 40%;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}

/* When the input field gets focus, change its width to 100% */
input[type=text]:focus {
  width: 100%;
}
</style>

</head>
<body>
<div align="center">
  <label>All the Customers</label>
  <br>
  <table id="myTable">
      <tr>
        <!-- Headers -->
          <th>Customer_ID</th>
          <th>Forename</th>
          <th>Surname</th>
          <th>Email</th>
          <th>Address</th>
          <th>Post Code</th>
          <th>Username</th>
          <th></th>
      </tr>

      <!-- Searchbar to search for specific customers -->
      <input type="text"  id="searchbar" onkeyup="myFunction()" placeholder="Search for Customer.." title="Type in a Customer ID">

      <?php

      // A Sql query to loop thorugh the data
      $sql = "SELECT * FROM Customer";
      $records = $conn->query($sql);
      while($data = $records->fetch_assoc()){
      ?>
      <tr>
        <!-- Shows the data -->
          <td> <?php echo $data['Customer_ID'] ?></td>
          
          <td> <?php echo $data['Forename'] ?></td>
          
          <td> <?php echo $data['Surname']  ?></td>
          
          <td> <?php echo $data['Email'] ?></td>

          <td> <?php echo $data['Address'] ?></td>

          <td> <?php echo $data['Post_Code'] ?></td>

          <td> <?php echo $data['user_name'] ?></td>

          <!-- Staff can edit a specific customers details -->

          <td><a id = "action_boxes" href="change_details.php?edit= <?php echo $data['Customer_ID']; ?>" title="Change Details" class='btn btn-info '>Edit </a></td> 

      </tr>
      <?php
      }
      ?>
  </table>
</div>

<!-- SCRIPT for searching -->
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