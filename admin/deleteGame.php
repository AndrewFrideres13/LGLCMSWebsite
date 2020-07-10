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
    <title>Delete Game</title>
    <link href="../css/styles.css" rel="stylesheet">
  </head>
  <body>
  <div id="container">
    <h2> Delete Game </h2>
    <?php
    if(isset($_GET['gId'])) {
        $gId = $_GET['gId'];
        $gameTitle = $_GET['gameTitle'];
    } else {
		echo "<h2 style=\"color:red\">Game ID and/or title not found<h2>\n";
	}
      
      if(isset($_POST['submit'])) {
        require "../dbConnect.php";
        
        try {
          $sqlForGameDeletion = "DELETE FROM games WHERE gId = :gId";
		  
          $gameDeletionStatement = $pdo->prepare($sqlForGameDeletion);
          $gameDeletionStatement->bindValue(":gId", $_POST["gId"]);
          $gameDeletionStatement->execute();

          header("Location: http://localhost/admin/gamesAdmin.php");
          
        } catch (Exception $ex){

			echo "<h2 style=\"color:red\">Error deleting game: $ex<h2>\n";
		}			
      }
	  //Below changing the form URL will change where a message is sent, so do NOT do that
    ?>
    <form method="post">
      <p>Are you sure you want to delete the game <?= $gameTitle ?>?</p>
      <input type="hidden" name="gId" value="<?= $gId ?>">
      <input type="hidden" name="gameTitle" value="<?= $gameTitle ?>">
      <a href="gamesAdmin.php"><input type="button" value="No"></a>
      <input type="submit" name="submit" value="Yes - DO IT NOW!">
    </form>
    </div>
  </body>
</html>