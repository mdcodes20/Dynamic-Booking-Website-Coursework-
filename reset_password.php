<?php
include "outside_navbar.php";
include "connection.php";

session_start();


// Retreiving Data from Customer table so the password can be Updated

$username = $_SESSION['user_name'];
$sql      = mysqli_query($conn,"SELECT * FROM Customer WHERE user_name = '".$username."'");
$result   = mysqli_fetch_array($sql);



if(isset($_POST['submit'])){
    $Customer_ID  = $result['Customer_ID'];
    $password     = $result['pass_word'];
    $Phone_number = $result['Phone_number'];

    // Checks if the Phone number customer types in is the same
    if($_POST['Phone_number'] == $Phone_number){
        $new_password = $_POST['new_password'];
        $new_password = password_hash($new_password, PASSWORD_BCRYPT);
        
        $sql_2 = "UPDATE Customer SET pass_word = '$new_password' WHERE Customer_ID = '$Customer_ID' ";
        if(mysqli_query($conn,$sql_2)){
            ?>
            <p style="color: aliceblue;">Updated Successfully</p>
            <?php
        }
    }
    else{
        ?>
        <p style="color: aliceblue;">Invalid credentials</p>
        <?php
    }
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title >Reset PASSWORD</title>
</head>
<body>

<!-- The Form  -->
<form  align="center" method="post">
    <div>
        <label style="color: aliceblue;">Telephone Number</label>
        <br>
        <input type="text" name="Phone_number" >
    </div>
    <div>
        <label style="color: aliceblue;">Username</label>
        <br>
        <input type= "text" name="username" value="<?php echo $username; ?>">
    </div>
    
    <div>
        <label style="color: aliceblue;">Password</label>
        <br>
        <input id="pass" type= "password" name="new_password" >
        <br>
        <p1 style="color: white; "><input type="checkbox" onclick="myFunction()">Show Password</p1>
    </div>

    <div>
        <br>
        <input type= "submit" name="submit">
    </div>
</form>

<!-- Javascrip to show the password to customer -->
<script>
function myFunction() {
    var x = document.getElementById("pass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>
</body> 
</html>