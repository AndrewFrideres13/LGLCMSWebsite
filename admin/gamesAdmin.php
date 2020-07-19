<?php
//Require user to be logged in and authenticated, admin page allows user to modify our DB in any way they please
if(!session_id()) {
  session_start();
  require "../authenticate.php";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin Page: Games</title>
    <link href="../css/styles.css" rel="stylesheet" type="text/css"/>
  </head>
  <body>
  <header>
        <nav id="nav">
            <a href="../index.php">Home</a>
            <a href="../makeAccounts.php">Create Account</a>
            <a href="../login.php">Login</a>
            <a href="adminPage.php">Admin CMS</a>
            <input type="text" id="my_color_picker" />
        </nav>
    </header>
    <div id="container">
    <h2>Manage Games</h2>
    <?php
    //Required anywhere we use our db
      if(!session_id()) {
          session_start();
      }
      if (isset($_SESSION["uName"])) {
        $uName = $_SESSION["uName"];
        //Is our HASHED password remember
        $pWord = $_SESSION["pWord"];
      } 
      require "../dbConnect.php";
      //Grab all entries from our authors table, and order them nicely
      try {
        $sql = "SELECT * FROM games ORDER BY gameTitle";
        
        $games = $pdo->query($sql);
      } catch (Exception $ex) {
         echo "<h2 style=\"color:red\">Error loading games<h2>\n";
         //Suitable error handling 
      }
      
      echo "<table>\n";
      
      //Grab all the authors, and begin outputting them to a table
      $gameArray = $games->fetchAll();
      
      foreach($gameArray as $row) {
        echo <<<TABLEROW
        <tr>
          <td class="categoryTitle">$row[gameTitle]</td>
          <td class="categoryID">$row[gId]</td>
          <td class="links">
            <a href="editGame.php?gId=$row[gId]&gameTitle=$row[gameTitle]">Edit</a>   
            <a href="deleteGame.php?gId=$row[gId]&gameTitle=$row[gameTitle]">Delete</a>   
          </td>
        </tr>            
TABLEROW;
        
      }
      echo "</table>";
    ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>
      <link
         href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/ui-lightness/jquery-ui.css"
         rel="stylesheet"
         type="text/css"
         />
      
      <link rel='stylesheet' href='../css/jquery.colorpicker.css' />
      <script src='../js/jquery.colorpicker.js'></script>
      <div class="debug">
	    <?php
		if (isset($_SESSION['passedColor'])) {
			include '../colorpicker.php'; 
		}
	  ?>
	  </div>
      <script>$("#my_color_picker").colorpicker();
      </script>
  </body>
</html>
