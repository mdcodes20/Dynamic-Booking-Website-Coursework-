<!DOCTYPE html>
<html lang="en">
<head>
  <title>Navigation Bar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  #background{
    background-color: wheat;
  }
  </style>
</head>
<body id ="background" >

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Home page link -->
    <div class="navbar-header">
      <a class="navbar-brand" href="staff_index.php">My woodworker</a>
    </div>
    <ul class="nav navbar-nav">
      <!-- Different important links -->
      <li><a href="staff_booking.php">Book</a></li>
      <li><a href="staff_all_bookings.php">All bookings</a></li>
      <li><a href="view_customers.php">Customers</a></li>
      <li><a href="check_review.php">Reviews</a></li>
      <li><a href="data.php">Data</a></li>
      <li><a href="view_services.php">View Services</a></li>
      <li><a href="view_payments.php">View All the payments made</a></li>
    </ul>
    <u1 class="nav navbar-nav navbar-right">
      <!-- Logout -->
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
    </u1>
  </div>
</nav>

</body>
</html>
