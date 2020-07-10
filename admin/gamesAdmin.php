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
    <title>Authors Admin Page: Games</title>
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
          <td class="game">$row[gameTitle]</td>
          <td class="gameId">$row[gId]</td>
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
  </body>
</html>
