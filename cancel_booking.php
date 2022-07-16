
<?php 

include 'connection.php';

session_start();    
if(isset($_SESSION["staff_username"])){
    session_write_close();
    include 'staff_navbar.php';
    $reason = "Staff";

    $A_id = $_GET['remove'];
    $sql = mysqli_query($conn, "UPDATE Appointment SET reason_of_cancellation = '$reason', Cancelled=false  WHERE Appointment_ID = '".$A_id."'") or die(mysqli_error($conn));
    header("location: staff_all_bookings.php");
    
}

    
elseif(isset($_SESSION["user_name"])){
    session_write_close();
    include 'navbar.php';
    if(isset($_POST['submit'])){
        $reason = $_POST['reason'];
        $A_id = $_GET['remove'];

        $sql = mysqli_query($conn, "UPDATE Appointment SET reason_of_cancellation = '$reason', Cancelled=false  WHERE Appointment_ID = '".$A_id."'") or die(mysqli_error($conn));
        header("location: all_bookings.php");
    }
}

?>

<body style="background-color:wheat" >


<!-- A form which will ask the user to tell why they are cancelling the appointment -->
<?php 
if(isset($_SESSION['user_name'])){
?>
<form align="center" method="post">
    <label style="color:aliceblue">Please tell us why you cancelling the appointment</label>
    <div>
        <textarea id="reason" name="reason" placeholder="Reason..."></textarea>
    </div>
    <div>
        <button id="submit_button" type="submit" name="submit">Submit</button>
    </div>
</form>
<?php  }  ?>



<script>
var input = document.getElementById("reason");
input.addEventListener("keyup", function(event) {
if (event.keyCode === 13) {
event.preventDefault();
document.getElementById("submit_button").click();
}
});
</script>

</body>












