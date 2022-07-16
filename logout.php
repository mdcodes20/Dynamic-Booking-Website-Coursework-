<?php
// Starts the session
session_start();
// Destroys the session
session_destroy();
// Locates the user back to the main page
header("Location: main_page.php");
?>

