<?php
//If there is no session, let's begin one
if (!session_id()) {
    session_start();
}
//If we do not have a fail count from previous abd attempts, init one to 0 failed password attempts
if (!isset($_SESSION['failCount'])) {
    $_SESSION['failCount'] = 0;
}

//if we have any session info grab it, else start it
if (isset($_GET['url'])) {
    $_SESSION['url'] = $_GET['url'];
} else {
    $_SESSION['url'] = "/index.php";
}
?>

<!-- This will contain all the logic for our login page, from getting user info for a username and password to access the games DB
to handling the logic of a proper login (complete with login failure and kick out) -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link href="css/styles.css" rel="stylesheet">
  </head>
  <body>
  <header>
  <nav id="nav">
        <a href="index.php">Home</a>
        <a href="makeAccounts.php">Create Account</a>
        <a href="login.php">Login</a>
        <a href="/admin/adminPage.php">Admin CMS</a>
        <input type="text" id="my_color_picker" />
        </nav>
</header>
<div id="container">
  <h2 id="topHeading">Login</h2>
  <?php
if (isset($_GET['logOut'])) {
    echo "<h2 id=\"login\" style=\"color:white\">Logout sucessful<h2>\n";
} else if (isset($_POST['submit'])) {
    $uName = $_POST['uName'];
    $pWord = $_POST['pWord'];

    //If the username or password field is empty show an error message
    if ($uName == "" || $pWord == "") {
        echo "<h2 style=\"color:red\">C'mon, enter something at least<h2>\n";
    } else {
      $_SESSION['uName'] = $uName;
      //Pass hashed copy of password
      $_SESSION['pWord'] = $pWord;//password_hash($pWord, PASSWORD_DEFAULT);
      //password_verify($pWord, $servWord) //Verifies hashed password if needed
      header("Location: http://localhost:" . $_SESSION['url']);
    }
}
?>
    <!-- Our actual form that includes a: Username field, Password Field, Submit button -->
    <form method="post">
      <label id="hidden" for="username">Username:</label>
      <input type="text" name="uName" placeholder="Username"><br>
      <label id="hidden" for="password">Password:</label>
      <input type="password" name="pWord" placeholder="Password"><br>
      <input type="submit" name="submit" value="Login">
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>
      <link
         href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/ui-lightness/jquery-ui.css"
         rel="stylesheet"
         type="text/css"
         />
      
      <link rel='stylesheet' href='css/jquery.colorpicker.css' />
      <script src="js/jquery.easing.1.3.js"></script>
      <script src='js/jquery.colorpicker.js'></script>
      <script src="js/slidePanes.js"></script>
      <div class="debug">
        <?php
        if (isset($_SESSION['passedColor'])) {
          include 'colorpicker.php'; 
        }
        ?>	  
      </div>
      <script>$("#my_color_picker").colorpicker();</script>
  </body>
</html>
