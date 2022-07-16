<?php

// Starts The Session 
session_start();

// Includes the Main page navigation bar  Connection file

include 'outside_navbar.php';
include 'connection.php';

$Forename = $Surname = $Email = $Address = $PostCode = $Username = $Password = $confirm_password =  $PhoneNumber = "";


if(isset($_POST['Submit'])) {
	
    // making a empty variables for error handlings
	$error_message = "";

    // Retreiving Data From the Form
	$Forename=$_POST['Forename'];
	$Surname=$_POST['Surname'];
	$Email= $_POST['Email'];  
	$Address = $_POST['Address'];
	$PostCode = $_POST['Post_Code'];
	$Username = $_POST['user_name'];
	$Password = $_POST['pass_word'];
	$confirm_password = $_POST['confirm_password'];
	$PhoneNumber = $_POST['tel_num'];
	
    // Preg Match for Password
	$uppercase = preg_match('@[A-Z]@', $Password);
    $lowercase = preg_match('@[a-z]@', $Password);
    $number    = preg_match('@[0-9]@', $Password);
    $specialChars = preg_match('@[^\w]@', $Password);

    //Preg Match for other details
	$Forename_check = preg_match("/^[a-zA-Z-' ]*$/",$Forename);
	$Surname_check = preg_match("/^[a-zA-Z-' ]*$/", $Surname);
	$Email_check = preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$Email);
	$PhoneNumber_check = preg_match('@[0-9]@',$PhoneNumber);
	
    // Prepares a SQL Select Statement to see if the Customers Forename, Surname and PhoneNumber is already in the databse
	$sql  = mysqli_query($conn, "SELECT * FROM Customer WHERE Surname = '". $Surname . "' AND Forename = '".$Forename."' AND Phone_number = '".$PhoneNumber."'");
	$result = mysqli_fetch_array($sql);



    ///////   ----------------------------- ALL KINDS OF VALIDATION  --------------------------------   ///////


	
	// To see if the customer has left any box empty
	if (($Forename == "") or ($Surname == "") or  ($Email == "") or ($Username == "") or($Password == "") or  ($_POST['confirm_password'] == "") or ($Address == "") or ($PhoneNumber == "")){
		?>
		<p2 align="center" style="color:aliceblue">Please fill in the boxes </p2>
		<?php

	}

	// Validating that the Forename doesn't have any numbers in it

	elseif(!$Forename_check){
		?>
		<p2 align="center" style="color:aliceblue">Invalid Forename.</p2>
		<?php
	}


	// Validating that The surname doesn't have any numbers in it

	elseif(!$Surname_check){
		?>
		<p2 align="center" style="color:aliceblue">Invalid Surname.</p2>
		<?php
	}

	// Checking so that the email is in its correct format. It should have something before "@" and then a "@" and then a word or a letter and then a "." and then another word or a letter

	elseif (!$Email_check) {
		?>
		<p2 align="center" style="color:aliceblue">Invalid Email.</p2>
		<?php
	}


	// Checks if the phone number have any letters in it or if the PhoneNumber have <=  to 10 numbers or greater then 14 numbers
	
	elseif(!$PhoneNumber_check || strlen($PhoneNumber) > 14  || strlen($PhoneNumber) <= 10){
		?>
		<p2 align="center" style="color:aliceblue">Invalid Phone Number.</p2>
		<?php
	}


    // Checking if the Customer is already signed in or not. If he is already signed in, then it will allow him to access the login page
	
	elseif(is_array($result)){
		?>
		<form>
		<div align = "center">
		<br>
		<p align="center" style="color: white; font-size: 20px; font-family:'Courier New', Courier, monospace" >  You already have an account. Please <a href="login.php">Sign in</a>. </p>
	</div> 
		</form>
	<?php
	}


    // Checking so that the address is not just numbers
	
	elseif(is_numeric($Address)){
		?>
		<p2 align="center" style="color:aliceblue">Invalid Address.</p2>
		<?php
		
	}


	// Checking so that PostCode does not contain only numbers and it should have more then 2 and less then 9 characters
	
	elseif(is_numeric($PostCode) || strlen($PostCode) >= 10 || strlen($PostCode) <=3 ){
		?>
		<p2 align="center" style="color:aliceblue">Invalid Post Code.</p2>
		<?php
	}


	// Username cannot be just numbers
	
	elseif(is_numeric($Username)){
		?>
		<p2 align="center" style="color:aliceblue">Invalid value for Username. Username should not be numeric.</p2>
		<?php
	}


	// Validating the Password. The password should contain at least one Upper Case letter, one Lower Case letter, one special character and one number in it
	
	elseif(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($Password) < 9){
		?>
		<p2 align="center" style="color:aliceblue">Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character</p2>
		<?php
	}


	// To see if the password and confirm password matches up.
	
	elseif($Password !== $confirm_password){
		?>
		<p2 align="center" style="color:aliceblue">Your passwords does not match</p2>
		<?php
	}


    // If all the Details customer has provided are valid then this code adds the customer in the database in a table called Customer
	
	else{
		$Password = password_hash($Password, PASSWORD_BCRYPT);
		mysqli_query($conn,"INSERT INTO Customer(Forename, Surname, Email, Address, Post_Code, user_name, pass_word, Phone_number) VALUES('$Forename','$Surname', '$Email', '$Address', '$PostCode',   '$Username',  '$Password', '$PhoneNumber')") or die(mysqli_error($conn));
		?>
		<p align="center" style="color:white"> New Record created Successfully. Please <a href="login.php"> Log in </a> to access the rest of the site.</p>
	<?php
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/signup.css" type="text/css" rel="stylesheet"/>
		<title style="color:white" >SignUP Page</title>
	</head>
	<style>
	#submit {
		background-color: #04AA6D;
		color: white;
		padding: 12px 20px;
		border: none;
		border-radius: 4px;
		cursor: pointer;
	}
	
	#submit:hover {
	background-color: #45a049;
	}

	body{
		margin: 0;
		padding: 0;
		font-family: sans-serif;
		background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url("pictures/navbar.jpg");
		background-position: center;
		background-size: cover;
		font-weight: 300;
	}
</style>

<body id="background">

	<!----------------------------- making the boxes   ----------------------------->

	<h1 style="color:white">Signup</h1>
	<p></p>
	<form align="center" method="post">

		<h3  style="color: white; font-size: 20px; font-family:'Courier New', Courier, monospace" > Enter your Details</h3>
		
		<!--------------------- Forename Box --------------------->

		<div >
			<label style="color: white; font-size: 20px; font-family:'Courier New', Courier, monospace" >Forename</label>
			<br>
			<input style="color:black" type="text" name="Forename" value="<?php echo $Forename; ?>">
		</div>


		<!--------------------- Surname Box --------------------->

		<div >
			<label style="color: white; font-size: 20px; font-family:'Courier New', Courier, monospace" >Surname</label>
			<br>
			<input style="color:black" type="text" name ="Surname" value="<?php echo $Surname; ?>">

		</div>


		<!--------------------- Email Box --------------------->

		<div >
			<label style="color: white; font-size: 20px; font-family:'Courier New', Courier, monospace" >Email</label>
			<br>
			<input style="color:black" type= "text" name="Email" value="<?php echo $Email; ?>">
		</div>


		<!--------------------- Phone Number Box --------------------->
		<div >
			<label style="color: white; font-size: 20px; font-family:'Courier New', Courier, monospace" >Phone Number</label>
			<br>
			<input style="color:black" type= "text" name="tel_num" value="<?php echo $PhoneNumber; ?>">
		</div>


		<!--------------------- Address Box --------------------->

		<div >
			<label style="color: white; font-size: 20px; font-family:'Courier New', Courier, monospace" >Address</label>
			<br>
			<input style="color:black" type= "text" name="Address" value="<?php echo $Address; ?>" >
		</div>


		<!--------------------- Post Code Box --------------------->

		<div >
			<label style="color: white; font-size: 20px; font-family:'Courier New', Courier, monospace" >Post code</label>
			<br>
			<input style="color:black" type= "text" name="Post_Code" value="<?php echo $PostCode; ?>" >
		</div>


		<!--------------------- Username Box --------------------->

		<div >
			<label style="color: white; font-size: 20px; font-family:'Courier New', Courier, monospace" >Username</label>
			<br>
			<input style="color:black" type= "text" name="user_name" value="<?php echo $Username; ?>" >
		</div>


		<!---------------------Password Box ---------------------->

		<div >
			<label style="color: white; font-size: 20px; font-family:'Courier New', Courier, monospace" for="psw" id="psw" >Password</label>
			<br>
			<input style="color:black" id="pass" type="password" name="pass_word" value="<?php echo $Password; ?>">
		</div>


		<!--------------------- Confirm Password Box ---------------------->

		<div >
			<label style="color: white; font-size: 20px; font-family:'Courier New', Courier, monospace" > Confirm Password</label>
			<br>
			<input style="color:black" id="pass"  type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
		</div>

		<div >
			<p1 style="color: white;"><input type="checkbox" onclick="myFunction()">Show Password</p1>

		</div>
		<!--------------------- SUBMIT BUTTON --------------------->

		<div >
			<br>
			<button class="btn btn-primary" type="submit" id="submit" name="Submit">Submit</button>
		</div>

	</form>


	<p1 style="color:white; font-size:15px" >Already have an account? <a href="login.php">Login now</a>.</p1>

	<script>
	function myFunction() {
		var x = document.getElementById("pass");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}

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
