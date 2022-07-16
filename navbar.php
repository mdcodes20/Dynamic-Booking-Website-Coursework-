<!DOCTYPE html>
<html lang="en">
<head>
  <title>Navigation Bar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="css/navbar.css" type="text/css" rel="stylesheet"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style type="text/css">
  body{
    background-image:url("pictures/navbar.jpg");
    }
    nav{
      background-color: black;
      width: 100%;
    }
  #navbar{
    background-color: rgb(20, 5, 5);
  }
  text{
    color:white;
  }

  </style>
</head>
<body>

<nav id = "navbar" class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Home page -->
    <div class="navbar-header">
      <a id="text"  class="navbar-brand" href="index.php">My woodworker</a>
    </div>
    <!-- Dropdown for all the services -->
    <ul class="nav navbar-nav">
      <li id="dropdown" class="dropdown"><a id="text" class="dropdown-toggle" data-toggle="dropdown" href="#">Services <span class="caret"></span></a>
        <ul id="dropdown_menu" class="dropdown-menu">
          <li><a id="text" href="services/hardwood.php">Hardwood and laminate Flooring <br> Staff: Jack Morison <br> Price: £500</a></li>
          <li><a id="text" href="services/shelving.php">Shelving <br> Staff: Jack Morison<br> Price: £1500</a></li>
          <li><a id="text" href="services/flat_pack_building.php">Flat pack building <br> Staff: Talha Ahmed<br> Price: £3500 </a></li>
          <li><a id="text" href="services/sillicon_sealing.php">Sillicon Sealing for baths, sinks, show <br> Staff: Talha Ahmed <br> Price: £700</a></li>
          <li><a id="text" href="services/fence_repairs.php">Fence repairs and painting <br> Staff: Robert Junior<br> Price: £1000</a></li>
          <li><a id="text" href="services/decking.php">Decking <br> Staff: Robert Junior <br> Price: £620</a></li>
          <li><a id="text" href="services/lock_replacement.php">Lock replacement <br> Staff: Robert Junior <br> Price: £75</a></li>
        </ul>
      </li>
      <!-- Other important links -->
      <li><a id="text" href="booking.php">Book</a></li>
      <li><a id="text" href="all_bookings.php">view all bookings</a></li>
      <li><a id="text" href="check_review.php">Reviews</a></li>



    </ul>

    <?php
    session_start();
  // retreiving  username to show near the profile logo
    $Firstname = $_SESSION['user_name'];

    ?>
    <!-- logout and profile -->
    <u1 class="nav navbar-nav navbar-right">
      <li><a id="text"  href="Customer.php"><span class="glyphicon glyphicon-user"></span><?php echo $Firstname ?></a></li>
      <li><a id="text"  href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>

    </u1>
  </div>
</nav>
  

</body>

</html>

