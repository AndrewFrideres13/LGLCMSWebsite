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
    <title>Authors Admin Page: Genres</title>
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
    <h2>Manage Genres</h2>
    <?php
      require "../dbConnect.php";
      //Grab all entries from our authors table, and order them nicely
      try {
        $sql = "SELECT * FROM genres ORDER BY catName";
        
        $genres = $pdo->query($sql);
      } catch (Exception $ex) {
         echo "<h2 style=\"color:red\">Error loading genres<h2>\n";
         //Suitable error handling 
      }
      
      echo "<table>\n";
      
      //Grab all the authors, and begin outputting them to a table
      $genreArray = $genres->fetchAll();
      
      foreach($genreArray as $row) {
        echo <<<TABLEROW
        <tr>
          <td class="game">$row[catName]</td>
          <td class="gameId">$row[id]</td>
          <td class="links">
            <a href="deleteGenre.php?genreId=$row[id]&catName=$row[catName]">Delete</a>   
          </td>
        </tr>            
TABLEROW;
        
      }
      echo "</table>";
    ?>
    </div>
  </body>
</html>
