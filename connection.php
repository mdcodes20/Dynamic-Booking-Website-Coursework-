<?php

{ $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "s2000701";
 
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connection failed: %s\n". $conn -> error);
 
 
 return $conn;}
?>