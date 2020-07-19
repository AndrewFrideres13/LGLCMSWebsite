<!DOCTYPE html>
<!--Register a new user in our DB-->
<html>
  <head>
    <meta charset="UTF-8">
    <title>Create CMS Admin Account</title>
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
  <h2 id="topHeading">Create Account</h2>
    <?php
//Required anywhere we use our db
if(!session_id()) {
    session_start();
}
if (isset($_COOKIE['color'])){
					$_POST['textcolor'] = $_COOKIE['color'];
			}
if (isset($_SESSION["uName"])) {
  $uName = $_SESSION["uName"];
  //Is our HASHED password remember
  $pWord = $_SESSION["pWord"];
} 

require "dbConnect.php";

//Insert new user into our database, logged i user MUST have GRANT permissions
if (isset($_POST['newName']) && isset($_POST['newWord'])) {
    try {
        $uName = $_POST['newName'];
        $pWord = $_POST['newWord'];
        $sqlCreateAcct = "CREATE USER '" .$uName. "'@'localhost' IDENTIFIED BY '".$pWord."'; USE gamedb; GRANT ALL PRIVILEGES ON gamedb.* TO '" .$uName. "'@'localhost' WITH GRANT OPTION;FLUSH PRIVILEGES;";
        $statement = $pdo->prepare($sqlCreateAcct);
        
        $statement->execute();
        echo "<h2 >$uName has sucessfully been added.<h2>";
    } catch(PDOException $ex) {
        echo "<h2 style=\"color:red\">Error adding $uName. Verify the DB is reachable.<h2><br><br>";
    }
}
?> 
      <!-- On our form the name will be what gets posted and how we retrieve it in other places -->
      <form method="POST">
        <label id="hidden" for="username">Username:</label>
        <input type="text" name="newName" placeholder="Username"><br>
        <label id="hidden" for="password">Password:</label>
        <input type="password" name="newWord" placeholder="Password"><br>
        <input type="submit" name="submit" value="Create Account" >
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
      <script>$("#my_color_picker").colorpicker();
      </script>
  </body>
</html>
