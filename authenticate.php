<?php
//Begin a session if first time connecting
if(!session_id()) {
  session_start();
}

//check to see if user authenticated
if(!isset($_SESSION['authenticated'])) {
  //user is not authenticated so redirect to login
  header("Location: http://localhost/login.php?url=" . urlencode($_SERVER['SCRIPT_NAME']));
}