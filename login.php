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
}
else {
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
  <?php
if (isset($_GET['logOut'])) {
    echo "<h2 style=\"color:white\">Logout sucessful<h2>\n";
} else if (isset($_POST['submit'])) {
    $uName = $_POST['uName'];
    $pWord = $_POST['pWord'];

    //If the username or password field is empty show an error message
    if ($uName == "" || $pWord == "") {
        echo "<h2 style=\"color:red\">C'mon, enter something at least<h2>\n";
    } else {
        //We have a username AND password (maybe not valid yet), so proceed forward
        require "dbConnect.php";

        //Attempt to get user info, begin by seeing if our user is valid, and if so, grab the password
        //associated with them so we can later check it against the entered one
        try {
            $sql = "SELECT pWord FROM users WHERE uName = '$uName'";
            //Hash and protect the result right away
            $servWord = password_hash($pdo->query($sql)->fetchColumn() , PASSWORD_DEFAULT);
        } catch(Exception $ex) {
            echo "<h2 style=\"color:red\">Error, invalid user<h2>\n";
        }
        echo ($pWord . "ServerWord:" . $servWord);
        //Verify the password entered matches the db password (hashed) associated with the user
        if (password_verify($pWord, $servWord)) {
            //user logged in
            $_SESSION['authenticated'] = true;
            $_SESSION['uName'] = $uName;
            header("Location: http://localhost:" . $_SESSION['url']);
        } else {
            //not logged in, incr fail counter
            $_SESSION['failCount']++;
            echo "<h2 style=\"color:red\">Login failed. " . (3 - $_SESSION['failCount']) . "  Attempts left.<h2>\n";
            //Too many attempts, lock the user out
            if ($_SESSION['failCount'] >= 3) {
                header("Location: http://www.google.com");
            }
        } //End if block for valid password
    } //End else for if we have a username and pass
} else {
     echo "<h2 style=\"color:red\">Error Retrieving Username and/or Password<h2>\n";
}
?>
    <!-- Our actual form that includes a: Username field, Password Field, Submit button -->
    <form method="post">
      <label for="username">Username:</label>
      <input type="text" name="uName"><br>
      <label for="password">Password:</label>
      <input type="password" name="pWord"><br>
      <input type="submit" name="submit" value="Login">
    </form>
  </div>
  </body>
</html>
