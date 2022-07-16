<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="all_bookings.css" type="text/css" rel="stylesheet"/>
<title style="color:white" >Update Booking</title>
</head>

<body id="background">
<?php
session_start();

include 'connection.php';

if(isset($_SESSION["user_name"])){
  session_write_close();
  include 'navbar.php';

  $A_id = $_GET["update"];

    $sql_1 = mysqli_query($conn, "SELECT *
    FROM Appointment
    INNER JOIN Service ON Appointment.Service_ID = Service.Service_ID
    WHERE Appointment.Appointment_ID= '".$A_id."'") or die(mysqli_error($conn));

  $records = mysqli_fetch_array($sql_1);

  $Service_ID   = $records['Service_ID'];
  $Service_name = $records['Service_name'];
  $Payment_type = $records['Payment_type'];


  if(isset($_POST['Submit'])){

    $AppointmentTime = $_POST['Appointment_time'];
    $AppointmentDate = $_POST['Appointment_date'];
    $Service_ID      = $_POST["Service_ID"];
    $Post_Code       = $_POST['Post_Code'];
    $Address         = $_POST['address'];
    $pay = $_POST['method'];

    // Assiging each staff for different services

    if($Service_ID == 7){
      $Staff_ID = 1;}
    else if($Service_ID == 8){
      $Staff_ID = 1;}
    else if($Service_ID == 9){
      $Staff_ID = 2;}
    else if($Service_ID == 10){
      $Staff_ID = 2;}
    else{
      $Staff_ID = 3;}

    // Preparing a SQL Select Statement to see if the Appointment Date and staff is same
    $sql = mysqli_query($conn,"SELECT * FROM Appointment WHERE Appointment_date = '" . $AppointmentDate . "' AND Staff_ID = '" . $Staff_ID . "' AND Cancelled = True ");
    $row = mysqli_fetch_array($sql);

    if(($AppointmentTime == "") or ($AppointmentDate == "") or ($Address == "") or($Post_Code == "") ){
      ?>
      <b style="color:aliceblue">Please fill in all the boxes. </b>
      <?php
    }
    // If Customer tries to book in past
    elseif (strtotime($AppointmentDate) < time()){
      ?>
      <b style="color:aliceblue">You cannot book in past days. </b>
      <?php
    }
    // If the Appointment Already exist
    elseif(is_array($row)){
      ?>
      <b style="color:aliceblue">Staff is already booked that day, Please Try another date</b>
      <?php	
    }
    // If there is no errors than the appointment will be booked
    else{
      $sql_update = "UPDATE Appointment
      SET Appointment_time = '$AppointmentTime',
      Appointment_date     = '$AppointmentDate',
      Service_ID           = '$Service_ID',
      Post_Code            = '$Post_Code',
      address              = '$Address',
      Payment_type         = '$pay'
      WHERE Appointment_ID= '$A_id'";
      
      if(mysqli_query($conn,$sql_update)){
        ?>
        <p style="color:white">Record Updated Successfully</p>
        <?php
      }else{
        echo "Error Updating Record: " . mysqli_errno($conn);
      }
    }
  }
}


elseif(isset($_SESSION["staff_username"])){
  session_write_close();

  include 'staff_navbar.php';

  $A_id = $_GET["update"];

  $sql_1 = mysqli_query($conn, "SELECT *
  FROM Appointment
  INNER JOIN Service ON Appointment.Service_ID = Service.Service_ID
  WHERE Appointment.Appointment_ID= '".$A_id."'") or die(mysqli_error($conn));
  
  $records = mysqli_fetch_array($sql_1);

  $Service_name = $records['Service_name'];
  $Service_ID   = $records['Service_ID'];
  $Payment_type = $records['Payment_type'];


  if(isset($_POST['Submit'])){

    $AppointmentTime = $_POST['Appointment_time'];
    $AppointmentDate = $_POST['Appointment_date'];
    $Service_ID      = $_POST["Service_ID"];
    $Post_Code       = $_POST['Post_Code'];
    $Address         = $_POST['address'];
		$pay             = $_POST['method'];



    // Assiging each staff for different services

    if($Service_ID == 7){
      $Staff_ID = 1;}
    else if($Service_ID == 8){
      $Staff_ID = 1;}
    else if($Service_ID == 9){
      $Staff_ID = 2;}
    else if($Service_ID == 10){
      $Staff_ID = 2;}
    else{
      $Staff_ID = 3;}

    // Preparing a SQL Select Statement to see if the Appointment Date and staff is same
    $sql = mysqli_query($conn,"SELECT * FROM Appointment WHERE Appointment_date = '" . $AppointmentDate . "' AND Staff_ID = '" . $Staff_ID . "' AND Cancelled = True ");
    $row = mysqli_fetch_array($sql);


    if(($AppointmentTime == "") or ($AppointmentDate == "") or ($Address == "") or($Post_Code == "") ){
      ?>
      <b style="color:aliceblue">Please fill in all the boxes. </b>
      <?php
    }
    // If Staff tries to book in past
    elseif (strtotime($AppointmentDate) < time()){
      ?>
      <b style="color:aliceblue">You cannot book in past days. </b>
      <?php
    }
    // // If the Appointment Already exist
    // elseif(is_array($row)){
    //   
     //   <b style="color:aliceblue">Staff is already booked that day, Please Try another date</b> -->
    // }
    else{
      $sql_update = "UPDATE Appointment
      SET Appointment_time = '$AppointmentTime',
      Appointment_date     = '$AppointmentDate',
      Service_ID           = '$Service_ID',
      Post_Code            = '$Post_Code',
      address              = '$Address',
      Payment_type         = '$pay'
      WHERE Appointment_ID= '$A_id'";
      
      if(mysqli_query($conn,$sql_update)){
        ?>
        <p style="color:white">Record Updated Successfully</p>
        <?php
      }else{
        echo "Error Updating Record: " . mysqli_errno($conn);
      }
    }
  }
}

?>


<form align="center" method="post">
  <h1 style="color:white" >Update Booking</h1>
  
  <h3  style="color:white" > Change your appointment date and time</h3>

  <!-- Time box -->
  <div>
    <label style="color:white"  >Appointment Time</label>
    <br>
    <input type="time" name="Appointment_time" value= "<?php echo $records["Appointment_time"]; ?>" >
  </div>

  <!-- Date Box -->
  <div>
    <label style="color:white"  >Appointment Date</label>
    <br>
    <input type="date" name ="Appointment_date" value= "<?php echo $records["Appointment_date"]; ?>">
    <br>
  </div>

  <!-- Address box -->
  <div>
    <label style="color: aliceblue;">Address</label>
    <br>
    <input type="text" name="address" value="<?php echo $records['Address']; ?>">
    <br>
  </div>

  <!-- Post Code box -->
  <div>
    <label style="color: aliceblue;">Post Code</label>
    <br>
    <input type="text" name="Post_Code" value="<?php echo $records['Post_Code']; ?>">
    <br>
  </div>

  <!-- Services dropdown menu -->
  <div>
    <label style="color:white"  >Services</label>
    <br>
    <select name="Service_ID">
      <option value="<?php echo $Service_ID; ?>">Previous option: <?php echo $Service_name; ?></option>
      <option value="7">Hardwood and laminate Flooring</option>
      <option value="8">Shelving</option>
      <option value="9">Flat pack building</option>
      <option value="10">Sillicone sealing for baths, sinks, show</option>
      <option value="11">Fence repairs and painting</option>
      <option value="12">Decking</option>
      <option value="13">Lock replacement</option>
    </select>
    <br>
  </div>
  
  <!-- Payment method dropdown -->
  <div>
    <br>
		<label style="color:white" >What method would you like to use to pay?</label>
		<br>
		<select id="box" name="method" >
      <option value="<?php echo $Payment_type; ?>"> Previous option: <?php echo $Payment_type; ?></option>
			<option  value="Chip and Pin reader" >Chip and Pin reader</option>  
			<option  value="Cash">Cash</option>
			<option value="Cheque">Cheque</option>
		</select>
  </div>

  <!-- Submit button -->
  <div>
    <br>
    <button  class="btn" type="submit" name="Submit">Submit</button>
  </div>

</form>
</html>