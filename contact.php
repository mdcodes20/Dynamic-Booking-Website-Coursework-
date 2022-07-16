<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/all_bookings.css" type="text/css" rel="stylesheet"/>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

#subject, select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

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

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
<title>Contact page</title>

</head>
<style>
	h1{
		text-align: center;
		font-size: 10cm;
		color: blue;
	}
	</style>

<?php

include 'outside_navbar.php';
?>
<h1 > Contact us </h1>
<?php 

if(isset($_POST['submit'])){

  // Retreiving the deatils given in the contact form
	$email = $_POST['email'];
	$name = $_POST['name'];
	$message = $_POST['message'];
	$receiver = "armanpapon651@gmail.com";
	$subject = $_POST['subject'];

  // including the file which actually sends the email
	include "mail.php";
	
	echo $message;
}

?>

<body id="background" >

<div align="center" class="container">

  <!-- Creating a contact us form, asking Name,Email,Subject and message of the customer -->

  <form class="contact-form" method="post" >
    <label style="color: white; font-size: 20px; font-family:'Courier New', Courier, monospace" >Name</label>
    <input type="text" id="name" name="firstname" placeholder="Your name..">

	<label style="color: white; font-size: 20px; font-family:'Courier New', Courier, monospace" >Email</label>
	<input type="text" name="email" placeholder="Your E-Mail">

    <label style="color: white; font-size: 20px; font-family:'Courier New', Courier, monospace" >Subject</label>
	<input type="text" name="subject" placeholder="Subject">
  <br>
  <br>
	<label style="color: white; font-size: 20px; font-family:'Courier New', Courier, monospace" >Message: </label>
    <textarea id="subject" name="message" placeholder="Write something.." style="height:200px"></textarea>

	<button  style="color: black;" id="submit" value="Submit" type="submit" name="submit">Send Mail</button>
  </form>
  <br>

  <!-- Link to the address of the business using google maps -->
  <label style="color: white; font-size: 20px; font-family:'Courier New', Courier, monospace"  >Our Address: </label>
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2989.48198407639!2d0.11993859860821067!3d51.60847658248811!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a38de40d8e21%3A0x3cfe48bc6caa705e!2sFowler%20Rd%2C%20Ilford%20IG6%203UJ!5e0!3m2!1sen!2suk!4v1646321766261!5m2!1sen!2suk" width="100%" height="100%" style="border:0;" allowfullscreen="yes" loading="lazy"></iframe>

</div>
</body>
</html>