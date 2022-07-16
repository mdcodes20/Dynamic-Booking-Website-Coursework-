<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        .form-control{
            width: 50%;
            height: 50%;

        }
        .form-group{
            width: 20%;
            height: 20%;
        }
        .invalid-feedback{
            background-color: red;
        }
    </style>
</head>

<?php 

// starts the session

session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page

if(isset($_SESSION["loggedin_customer"]) && $_SESSION["loggedin_customer"] === true){
  header("location: index.php");
  exit;

}

// Includes the connection php file

include 'outside_navbar.php';

include 'connection.php';

// Define variables and initialize with empty values

$username = $password = "";

$username_err = $password_err = $login_err = "";


// Processing form data when form is submitted

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Check if username is empty

    if(empty(trim($_POST["user_name"]))){

        $username_err = "Please enter username.";

    } else{

        $username = trim($_POST["user_name"]);
        $username = stripcslashes($username);
        $username = mysqli_real_escape_string($conn,$username);

    }

    // Check if password is empty

    if(empty(trim($_POST["pass_word"]))){

        $password_err = "Please enter your password.";

    } else{

        $password = trim($_POST["pass_word"]);
        $password = stripcslashes($password);
        $password = mysqli_real_escape_string($conn,$password);

    }

    // Validate credentials

    if($username_err == "" and $password_err == ""){
        
        // Prepare a sql select statement

        $sql_customer = mysqli_query($conn,"SELECT * FROM Customer WHERE user_name = '" . $username . "'");
        $result_customer = mysqli_fetch_array($sql_customer);

        $sql_staff = mysqli_query($conn,"SELECT * FROM Staff WHERE staff_username = '" . $username . "'");
        $result_staff = mysqli_fetch_array($sql_staff);

        if(isset($result_customer)){
            
            // Checks if the password is right or wrong

            if(password_verify($password,$result_customer["pass_word"])){

                // if the password is right than it assigns some session variables whcih can be used in other files

                $_SESSION["loggedin_customer"] = true;

                $_SESSION["Customer_ID"] = $result_customer["Customer_ID"];

                $_SESSION["user_name"] = $result_customer["user_name"];

                $_SESSION["Forename"] = $result_customer["Forename"];

                $_SESSION["Surname"] = $result_customer["Surname"];
                
                header("location: index.php");  
            
            }else{
                // if the password is wrong....

                $password_err = "Invalid password.";

                $_SESSION['user_name'] = $_POST['user_name'];                   
                ?>
                <p2 style="color: white;">Forgot Password? <a href="reset_password.php">Reset your password now. </a></p2>
                <?php
                }
        }
        elseif(isset($result_staff)){
            if(password_verify($password,$result_staff["staff_password"])){
                // if the password is right than it assigns some session variables whcih can be used in other files

                $_SESSION["loggedin_staff"] = true;

                $_SESSION["Staff_ID"] = $result_staff["Staff_ID"];

                $_SESSION["staff_username"] = $result_staff["staff_username"];
                
                header("location: staff_index.php");  
            
            }else{
                // if the password is wrong....

                $password_err = "Invalid password.";
            }

        }
        else{
            // if both the username or the password is wrong
            $username_err = "Invalid username";
        }
    }else{
        ?>
        <p2 style="color:whitesmoke">Please fill in the gaps</p2>
        <?php
    }
}

?>

<body id="background">

    <div align="center" id ="usernamepass_boxes"  class="wrapper">
 
        <h2 style="color:white" >Login</h2>
        <p style="color:white" >Please fill in your credentials to login.</p>

        <!-- Error to show if both username and password was wrong -->
        <?php
        ?> <p style="color:white"> <?php
        if(!empty($login_err)){

            echo $login_err;

        }       
        ?> </p> <?php
        ?>

        <!-- Login form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <!-- Username box  -->
            <div   class="form-group">
                <label style="color:white" >Username</label>
                <br>
                <b style="color:white; text-decoration:underline"><span class="invalid-feedback" style="color:white" ><?php echo $username_err; ?></span></b>
                <input  type="text" id="username" name="user_name" class="form-control" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            </div>   

            <!-- Password box -->
            <div class="form-group">

                <label style="color:white" >Password</label>
                <br>
                <strong style="color:white; text-decoration:underline;" > <span class="invalid-feedback" ><?php echo $password_err; ?></span></strong>
                <input type="password" id="pass" name="pass_word" class="form-control" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>>
                <p1 style="color: white; "><input type="checkbox" onclick="myFunction()">Show Password</p1>
                <p2 id="text" style="color: white; text-decoration:underline;">WARNING! Caps lock is ON.</p2>



            </div>

            <div class="form-group">

                <input type="submit" class="btn btn-primary" value="Login">

            </div>

            <!-- Link to signup page if the customer doens't have an account -->
            <p6 style="color:white "  >Don't have an account? </p6> <p7 style="text-decoration: underline;"><a href="signup.php">Sign up now</a>.</p7>
            

        
        </form>

    </div>


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

<!-- SCRIPT to show Caps lock -->
<script>
var input = document.getElementById("pass");
var text = document.getElementById("text");
input.addEventListener("keyup", function(event) {

if (event.getModifierState("CapsLock")) {
    text.style.display = "block";
  } else {
    text.style.display = "none"
  }
});
</script>


</body>
</html>