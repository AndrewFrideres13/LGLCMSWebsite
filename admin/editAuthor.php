<?php
if(!session_id()) {
  session_start();
  require "../authenticate.php";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Edit Dev</title>
    <link href="../css/styles.css" rel="stylesheet">
  </head>
  <body>
  <div id="container">
  <h2> Update Developer Name </h2>
    <?php
      if(isset($_GET['devId'])) {
        $devId = $_GET['devId'];
        $devName = $_GET['devName'];
      } else {
		echo "<h2 style=\"color:red\">Developer ID and/or name not found<h2>\n";
	}
      
      if(isset($_POST['submit'])) {
        if(trim(strip_tags($_POST['developer'])) != null) {
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
              $updateDeveloperInDevelopersTable = "UPDATE developers SET developer = :developer WHERE id = $devId";
              $developersTableStatement = $pdo->prepare($updateDeveloperInDevelopersTable);
              $developersTableStatement->bindValue(":developer", $_POST['developer']);
              $developersTableStatement->execute();
              header("Location: http://localhost/admin/devsAdmin.php");
            } catch (Exception $ex) {
              echo "Error";
            }
        } else {
          echo "<h2 style=\"color:red\">Fill in the developer name please<h2>\n";
        }
      }
    ?>
    <form method="post">
      <label for="authorName">Developer Name: </label>
      <input type="text" name="developer" value="<?= $devName ?>">
      <input type="hidden" name="devId" value="<?= $devId ?>">
      <input type="submit" name="submit" value="Update">
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
