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
  <h2> Update Game Info </h2>
    <?php
    if(isset($_GET['gId'])) {
        $gId = $_GET['gId'];
        $gameTitle = $_GET['gameTitle'];
    } else {
        echo "<h2 style=\"color:red\">Game ID and/or title not found<h2>\n";
    }
      
      if(isset($_POST['submit'])) {
        if (trim(strip_tags($_POST['gameTitle'])) != null && trim(strip_tags($_POST['yearReleased'])) != null && trim(strip_tags($_POST['summary'])) != null) {
          require "../dbConnect.php";
          
          try {
            $sql = "UPDATE games SET gId = :gId, gameTitle = :gameTitle, yearReleased = :yearReleased, summary = :summary WHERE gId = $gId";
            $statement = $pdo->prepare($sql);
            //We use post down here to capture the values from our form
            $statement->bindValue(":gId", $_POST['gId']);
            $statement->bindValue(":gameTitle", $_POST['gameTitle']);
            
            $statement->bindValue(":yearReleased", $_POST['yearReleased']);
            $statement->bindValue(":summary", $_POST['summary']);
         
            $statement->execute();

            header("Location: http://localhost/admin/gamesAdmin.php");
          } catch (Exception $ex) {
            echo "Error";
          }
        } else {
           echo "<h2 style=\"color:red\">Fill in all info to update the game please<h2>\n";
        } 
      }
    ?>
    <form  method="post">
      <label for="authorName">Game Name: </label>
      <input type="text" name="gameTitle" value="<?= $gameTitle ?>">
	  <label for="authorName">Game Year: </label>
      <input type="text" name="yearReleased" value="">
	  <label for="authorName">Game Summary: </label>
      <input type="text" name="summary" value="">
	  
      <input type="hidden" name="gId" value="<?= $gId ?>">
      <input type="submit" name="submit" value="Update">
    </form>
    </div>
  </body>
</html>
