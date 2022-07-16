<?php 

include "connection.php";
session_start();

// Checks if the Customer is logged in
if(isset($_SESSION['user_name'])){
    session_write_close();
    include "navbar.php";

    $Customer_ID = $_SESSION["Customer_ID"];

    // SQL statement to retreive data from the customers table
    $sql = mysqli_query($conn,"SELECT * FROM Customer WHERE Customer_ID = '".$Customer_ID."'");
    $result = mysqli_fetch_array($sql);

    if(isset($_POST['Submit'])){

        // Collecting data from the form
        $Forename = $_POST['Forename'];
        $Surname = $_POST['Surname'];
        $email = $_POST['Email'];
        $tel_num = $_POST['tel_num'];
        $Address = $_POST['Address'];
        $PostCode = $_POST['Post_Code'];
        $user_name = $_POST['user_name'];
        $pass_word = $_POST['pass_word'];

        // Preg Match for password
        $uppercase = preg_match('@[A-Z]@', $pass_word);
        $lowercase = preg_match('@[a-z]@', $pass_word);
        $number    = preg_match('@[0-9]@', $pass_word);
        $specialChars = preg_match('@[^\w]@', $pass_word);

        //Preg Match for other details
        $Forename_check = preg_match("/^[a-zA-Z-' ]*$/",$Forename);
        $Surname_check = preg_match("/^[a-zA-Z-' ]*$/", $Surname);
        $Email_check = preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$email);
        $PhoneNumber_check = preg_match('@[0-9]@',$tel_num);

        // Different IF statements for each data, so that the customer can change whatever he wishes and other data does not need to be dependent on another one

        if(isset($_POST['Forename'])){
            if(!$Forename_check){
                echo "Invalid Forename. ";
            }
            elseif($Forename_check){
                $sql_2 = "UPDATE Customer
                SET Forename ='$Forename'
                WHERE Customer_ID = '$Customer_ID'";
                
                if(mysqli_query($conn,$sql_2)){
                    header("location: Customer.php");
                }
                else{
                    echo "Error";
                }
            }

        }
        
        if(isset($_POST['Surname'])){
            if(!$Surname_check){
                echo "Invalid Surname";
            }
            else{
            
                $sql_2 = "UPDATE Customer
                SET Surname ='$Surname'
                WHERE Customer_ID = '$Customer_ID'";
                
                if(mysqli_query($conn,$sql_2)){
                    header("location: Customer.php");
                }
                else{
                    echo "Error";
                }
            }

        }

        if(isset($_POST['Email'])){
            if(!$Email_check){
                echo "?><script type='text/javascript'> alert('Error, Invalid Email'); </script><?php";
            }
            else{
                $sql_2 = "UPDATE Customer
                SET Email ='$email'
                WHERE Customer_ID = '$Customer_ID'";

                if(mysqli_query($conn,$sql_2)){
                    header("location: Customer.php");
                }
                else{
                    echo "Error";
                }
            }
        }

        if(isset($_POST['tel_num'])){
            if(!$PhoneNumber_check || strlen($tel_num) > 14  || strlen($tel_num) <= 10){
                echo "Invalid Phone Number";
            }
            else{
                $sql_2 = "UPDATE Customer
                SET Phone_Number ='$tel_num'
                WHERE Customer_ID = '$Customer_ID'";
                if(mysqli_query($conn,$sql_2)){
                    header("location: Customer.php");
                }
                else{
                    echo "Error";
                }
            }

        }

        if(isset($_POST['Address'])){
            if(is_numeric($Address)){
                echo "Invalid Address";
            }
            else{
                $sql_2 = "UPDATE Customer
                SET Address ='$Address'
                WHERE Customer_ID = '$Customer_ID'";
                
                if(mysqli_query($conn,$sql_2)){
                    header("location: Customer.php");
                }
                else{
                    echo "Error";
                }
            }
        }
        if(isset($_POST['Post_Code'])){
            if(is_numeric($PostCode)){
                echo "Invalid Post Code";
            }
            else{
                $sql_2 = "UPDATE Customer
                SET Post_Code ='$PostCode'
                WHERE Customer_ID = '$Customer_ID'";
                
                if(mysqli_query($conn,$sql_2)){
                    header("location: Customer.php");
                }
                else{
                    echo "Error";
                }
            }
        }

        if(isset($_POST['user_name'])){
            if(is_numeric($user_name)){
                echo "Invalid Username";
            }
            else{
                $sql_2 = "UPDATE Customer
                SET user_name ='$user_name'
                WHERE Customer_ID = '$Customer_ID'";
                
                if(mysqli_query($conn,$sql_2)){
                    header("location: Customer.php");
                }
                else{
                    echo "Error";
                }

            }
        }

        if(isset($_POST['pass_word'])){
            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($Password) < 8){
                echo "Invalid password";
            }
            else{
                $pass_word =  password_hash($pass_word, PASSWORD_BCRYPT);
                $sql_2 = "UPDATE Customer
                SET pass_word ='$pass_word'
                WHERE Customer_ID = '$Customer_ID'";
                
                if(mysqli_query($conn,$sql_2)){
                    header("location: Customer.php");
                }
                else{
                    echo "Error";
                }

            }
        }
    
    }
}

// Checks if the Staff is logged in

elseif(isset($_SESSION['staff_username'])){
    session_write_close();
    include "staff_navbar.php";
    
    $Customer_ID = $_GET['edit'];

    $sql = mysqli_query($conn,"SELECT * FROM Customer WHERE Customer_ID = '".$Customer_ID."'");
    $result = mysqli_fetch_array($sql);

    
    if(isset($_POST['Submit'])){
        // Collecting data from the form
        $Forename = $_POST['Forename'];
        $Surname = $_POST['Surname'];
        $email = $_POST['Email'];
        $tel_num = $_POST['tel_num'];
        $Address = $_POST['Address'];
        $PostCode = $_POST['Post_Code'];
        $user_name = $_POST['user_name'];
        $pass_word = $_POST['pass_word'];

        // Preg Match for password
        $uppercase = preg_match('@[A-Z]@', $pass_word);
        $lowercase = preg_match('@[a-z]@', $pass_word);
        $number    = preg_match('@[0-9]@', $pass_word);
        $specialChars = preg_match('@[^\w]@', $pass_word);

        //Preg Match for other details
        $Forename_check = preg_match("/^[a-zA-Z-' ]*$/",$Forename);
        $Surname_check = preg_match("/^[a-zA-Z-' ]*$/", $Surname);
        $Email_check = preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$email);
        $PhoneNumber_check = preg_match('@[0-9]@',$tel_num);
    
        // Different IF statements for each data, so that the customer can change whatever he wishes and other data does not need to be dependent on another one

        if(isset($_POST['Forename'])){
            if(!$Forename_check){
                echo "Invalid Forename. ";
            }
            else{
                $sql_2 = "UPDATE Customer
                SET Forename ='$Forename'
                WHERE Customer_ID = '$Customer_ID'";
                
                
                if(mysqli_query($conn,$sql_2)){
                    header("location: view_customers.php");
                }
                else{
                    echo "Error";
                }
            }
        }

        if(isset($_POST['Surname'])){
            if(!$Surname_check){
                echo "Invalid Surname";
            }
            else{
            
                $sql_2 = "UPDATE Customer
                SET Surname ='$Surname'
                WHERE Customer_ID = '$Customer_ID'";
                
                if(mysqli_query($conn,$sql_2)){
                    header("location: view_customers.php");
                }
                else{
                    echo "Error";
                }
            }

        }

        if(isset($_POST['Email'])){
            if(!$Email_check){
                echo "?><script type='text/javascript'> alert('Error, Invalid Email'); </script><?php";
            }
            else{
                $sql_2 = "UPDATE Customer
                SET Email ='$email'
                WHERE Customer_ID = '$Customer_ID'";

                if(mysqli_query($conn,$sql_2)){
                    header("location: view_customers.php");
                }
                else{
                    echo "Error";
                }
            }
        }
        if(isset($_POST['Phone_number'])){
            if(!$PhoneNumber_check || strlen($tel_num) > 14  || strlen($tel_num) <= 10){
                echo "Invalid Phone Number";
            }
            else{
                $sql_2 = "UPDATE Customer
                SET Phone_number ='$tel_num'
                WHERE Customer_ID = '$Customer_ID'";
                if(mysqli_query($conn,$sql_2)){
                    header("location: view_customers.php");
                }
                else{
                    echo "Error";
                }
            }

        }

        if(isset($_POST['Address'])){

            $sql_2 = "UPDATE Customer
            SET Address ='$Address'
            WHERE Customer_ID = '$Customer_ID'";
            
            if(mysqli_query($conn,$sql_2)){
                header("location: view_customers.php");
            }
            else{
                echo "Error";
            }

        }

        if(isset($_POST['Post_Code'])){
            if(is_numeric($PostCode)){
                echo "Invalid Post Code";
            }
            else{
                $sql_2 = "UPDATE Customer
                SET Post_Code ='$PostCode'
                WHERE Customer_ID = '$Customer_ID'";
                
                if(mysqli_query($conn,$sql_2)){
                    header("location: Customer.php");
                }
                else{
                    echo "Error";
                }
            }
        }
        if(isset($_POST['user_name'])){


            $sql_2 = "UPDATE Customer
            SET user_name ='$user_name'
            WHERE Customer_ID = '$Customer_ID'";
            
            if(mysqli_query($conn,$sql_2)){
                header("location: view_customers.php");
            }
            else{
                echo "Error";
            }

        }
    
    }
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/Customer.css" type="text/css" rel="stylesheet"/>
	<title>Change Details</title>

</head>
<body id="background">

<!-- Creates a form to change the details -->
<form align="center" method="POST">

    <div method="POST" >
        <label style="color:white;" >Forename</label>
        <br>
        <input type="text" name="Forename" value= "<?php echo $result['Forename']; ?>" >
    </div>

    <div method="POST" >
        <label style="color:white;" >Surname</label>
        <br>
        <input type="text" name ="Surname" value= "<?php echo $result['Surname']; ?>" >
    </div>
    
    <div method="POST" >
        <label style="color:white;" >Customer Email</label>
        <br>
        <input type="text" name="Email" value= "<?php echo $result['Email']; ?>" >
    </div>

    <div method="POST" >
        <label style="color:white;" >Phone Number</label>
        <br>
        <input type= "text" name="tel_num" value= "<?php echo $result['Phone_number']; ?>">
    </div>

    <div method="POST" >
        <label style="color:white;" >Address</label>
        <br>
        <input type= "text" name="Address" value= "<?php echo $result['Address']; ?>" >
    </div>

    <div method="POST" >
        <label style="color:white;" >Post Code</label>
        <br>
        <input type= "text" name="Post_Code" value= "<?php echo $result['Post_Code']; ?>" >
    </div>

    <div method="POST" >
        <label style="color:white;" >Username</label>
        <br>
        <input type= "text" name="user_name" value= "<?php echo $result['user_name']; ?>">
    </div>

    <?php if(isset($_SESSION['Customer_ID'])){ ?>
    <div method="POST" >
        <label style="color:white;" >Password</label>
        <br>
        <input  id="pass" type= "password" name="pass_word" value= "<?php echo $result['pass_word']; ?>">
        <br>
        <p1 style="color: white; "><input type="checkbox" onclick="myFunction()">Show Password</p1>

    </div>
    <?php } ?>

    <div method="POST" >
        <br>
        <button class="btn" type="submit" name="Submit">Submit</button>
    </div>

</form>
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