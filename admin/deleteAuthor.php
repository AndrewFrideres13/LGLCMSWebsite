<?php
//Ensure user is logged in and authenticated first
if(!session_id()) {
  session_start();
  require "../authenticate.php";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Delete Author</title>
    <link href="../css/styles.css" rel="stylesheet">
  </head>
  <body>
  <div id="container">
    <h2> Delete Developer </h2>
    <?php
    if(isset($_GET['devId'])) {
        $devId = $_GET['devId'];
        $devName = $_GET['devName'];
    } else {
		echo "<h2 style=\"color:red\">Developer ID and/or name not found<h2>\n";
	}
      
      if(isset($_POST['submit'])) {
        require "../dbConnect.php";
        
        try {
          $sqlToDeleteDevFromGamesTable = "DELETE FROM games WHERE devId = :devId";
          $sqlToDeleteDevFromDevelopersTable = "DELETE FROM developers WHERE developer = :devName";
		  
          $devGameTableDeleteStatement = $pdo->prepare($sqlToDeleteDevFromGamesTable);
          $developerTableDeleteStatement = $pdo->prepare($sqlToDeleteDevFromDevelopersTable);
          
          $devGameTableDeleteStatement->bindValue(":devId", $devId);
          $developerTableDeleteStatement->bindValue(":devName", $devName);
          
          $devGameTableDeleteStatement->execute();
          $developerTableDeleteStatement->execute();
          header("Location: http://localhost/admin/devsAdmin.php");
          
        } catch (Exception $ex) {
          //Error handles here
        }
      }
    ?>
    <form method="post">
      <p>Are you sure you want to delete the developer <?= $devName ?> AND all associated games?</p>
      <input type="hidden" name="devId" value="<?= $devId ?>">
      <input type="hidden" name="devName" value="<?= $devName ?>">
      <a href="devsAdmin.php"><input type="button" value="No"></a>
      <input type="submit" name="submit" value="Yes - DO IT NOW!">
    </form>
    </div>
  </body>
</html>