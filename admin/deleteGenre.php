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
    <title>Delete Genre</title>
    <link href="../css/styles.css" rel="stylesheet">
  </head>
  <body>
  <div id="container">
    <h2> Delete Genre </h2>
    <?php
    if(isset($_GET['genreId'])) {
        $genreId = $_GET['genreId'];
        $catName = $_GET['catName'];
    } else {
		echo "<h2 style=\"color:red\">Genre ID and/or name not found<h2>\n";
	}
      
      if(isset($_POST['submit'])) {
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
        
        try {
          $sqlForGameDeletion = "DELETE FROM genres WHERE id = :genreId";
		  
          $gameDeletionStatement = $pdo->prepare($sqlForGameDeletion);
          $gameDeletionStatement->bindValue(":genreId", $_POST["genreId"]);
          $gameDeletionStatement->execute();

          header("Location: http://localhost/admin/genresAdmin.php");
          
        } catch (Exception $ex){

			echo "<h2 style=\"color:red\">Error deleting game: $ex<h2>\n";
		}			
      }
	  //Below changing the form URL will change where a message is sent, so do NOT do that
    ?>
    <form method="post">
      <p>Are you sure you want to delete the genre <?= $catName ?>?</p>
      <input type="hidden" name="genreId" value="<?= $genreId ?>">
      <input type="hidden" name="catName" value="<?= $catName ?>">
      <a href="genresAdmin.php"><input type="button" value="No"></a>
      <input type="submit" name="submit" value="Yes - DO IT NOW!">
    </form>
    </div>
	 <div class="debug">
	    <?php
		if (isset($_SESSION['passedColor'])) {
			include '../colorpicker.php'; 
		} else {
			echo "<h2 style=\"color:red\">COLOR LOAD ERROR<h2>\n";
		}
	  ?>
	  </div>
  </body>
</html>