<!DOCTYPE html>
<html lang="en">
<head>
  <title>Main Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="css/navbar.css" type="text/css" rel="stylesheet"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    body{
    background-image:url("pictures/navbar.jpg");
    }
    nav{
      background-color: black;
    }
  #navbar{
    background-color: rgb(20, 5, 5);
  }
  h1{
      /* color: rgba(182, 153, 59, 0.925); */
      color: white;
      font-family:'Brush Script MT', cursive;
  }
  p{
    /* color: rgba(182, 153, 59, 0.925); */
    font-size: 30px;
    color: white;
    font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
  }
  
  .container {
    height: 100vh; 
    width: 100%; 
    background-image: url("pictures/navbar.jpg");
    background-position: center;
    background-size: cover; 
    padding-left: 2%;
    padding-right: 2%;
    box-sizing: border-box;
    position: relative;
  }
  .abc{
    height: 100vh; 
    width: 100%; 
    background-image: url("pictures/navbar.jpg");
    background-position: center;
    background-size: cover; 
    padding-left: 19%;
    padding-right: 19%;
    box-sizing: border-box;
    position: relative;

  }
  .a{
 
    background-position: center;
    background-size: cover;
    box-sizing: border-box;
    position: relative;
  }
  /* .navbar{
    background-image: url("pictures/navbar.jpg");
  } */

  </style>
</head>
<body id="background" >

<nav id = "navbar" class="navbar navbar-inverse">
  <div class="banner_area">
    <div class="navbar-header">
      <a class="navbar-brand" href="/mywoodworker/main_page.php">My Woodworker</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="dropdown">
        <a id="dropdown" class="dropdown-toggle" data-toggle="dropdown" href="#">Services
        <span class="caret"></span></a>
        <ul id="dropdown_menu" class="dropdown-menu">
          <li><a href="/mywoodworker/services/hardwood.php">Hardwood and laminate Flooring  </a></li>
          <li><a href="/mywoodworker/services/shelving.php"><br>Shelving </a></li>
          <li><a href="/mywoodworker/services/flat_pack_building.php"> <br> Flat pack building </a></li>
          <li><a href="/mywoodworker/services/sillicon_sealing.php">  <br> Sillicon Sealing for baths, sinks, show  </a></li>
          <li><a href="/mywoodworker/services/fence_repairs.php"> <br> Fence repairs and painting   </a></li>
          <li><a href="/mywoodworker/services/decking.php"> <br>  Decking   </a></li>
          <li><a href="/mywoodworker/services/lock_replacement.php"> <br>  Lock replacement  </a></li>
        </ul> 
      </li>
      <li><a href="/mywoodworker/about.php"><i class="fa fa-fw fa-envelope"></i> About Us</a></li>
      <li><a href="/mywoodworker/contact.php">Contact Us </a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="/mywoodworker/signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="/mywoodworker/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>

    </ul>
  </div>
</nav>

</body>
</html>
