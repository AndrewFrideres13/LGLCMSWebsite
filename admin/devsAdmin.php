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
    <title>Authors Admin Page</title>
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
    <h2>Manage Devs</h2>
    <?php
      require "../dbConnect.php";
      //Grab all entries from our authors table, and order them nicely
      try {
        $sql = "SELECT * FROM developers ORDER BY developer";
        
        $authorResults = $pdo->query($sql);
      } catch (Exception $ex) {
         echo "<h2 style=\"color:red\">Error loading developers<h2>\n";
         //Suitable error handling 
      }
      
      echo "<table>\n";
      
      //Grab all the authors, and begin outputting them to a table
      //while($row = $authorResults->fetch())
      $authorArray = $authorResults->fetchAll();
      
      foreach($authorArray as $row) {
        echo <<<TABLEROW
        <tr>
          <td class="developer">$row[developer]</td>
          <td class="devId">$row[id]</td>
          <td class="links">
            <a href="editAuthor.php?devId=$row[id]&devName=$row[developer]">Edit</a>   
            <a href="deleteAuthor.php?devId=$row[id]&devName=$row[developer]">Delete</a>   
          </td>
        </tr>            
TABLEROW;
        
      }
      echo "</table>";
    ?>
    </div>
  </body>
</html>