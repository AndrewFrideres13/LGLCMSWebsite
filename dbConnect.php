<?php
// 1. Connect to our DB server
// 2. Select our DB
//Login info
$servername = "localhost";
$database = "gamedb";
$uName = "root";
$pWord = "";
if (isset($_SESSION["uName"])) {
  $uName = $_SESSION["uName"];
  //Is our HASHED password remember
  $pWord = $_SESSION["pWord"];
  //Try to login, if connection fails we go down to the catch
  try {
      // Create a new PDO instance, recall .'s are like +'s for strings in js
      $pdo = new PDO('mysql:host='.$servername.';dbname='.$database, $uName, $pWord);
      //Will supress errors in lieu of ours below
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //$pdo->exec('SET NAMES "utf8"');
      $_SESSION['authenticated'] = true;
  } catch (PDOException $e) {
      //not logged in, incr fail counter
      $_SESSION['failCount']++;
      echo "<h2 style=\"color:red\">Login failed. " . (500 - $_SESSION['failCount']) . "  Attempts left.<h2>\n";
      //Too many attempts, lock the user out
      if ($_SESSION['failCount'] >= 500) {
          header("Location: http://www.google.com");
      }
      /*if ($closeSelect) {
          echo "</select>\n";
          $closeSelect = false;
      }*/
      //Will display and log our error (Generic, sort of a catch all used on all pages for errors)
      include 'error.html.php';
      exit();
  }
} else {
  header("Location: http://localhost/login.php");
}