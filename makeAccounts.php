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
    <?php
require "dbConnect.php";
// Check if user clicked the Add new book title link
if (isset($_GET['createNewAcc'])) {
    $createNewAcc = $_GET['createNewAcc'];
}
else { // add new book title link was NOT clicked
    $createNewAcc = 0;
}
//Insert new user into our database
if (isset($_POST['uName']) && isset($_POST['pWord'])) {
    try {
        $sql = "INSERT INTO users VALUES(:uName, :pWord)";
        $statement = $pdo->prepare($sql);
        $uName = $_POST['uName'];
        $pWord = $_POST['pWord'];
        $statement->bindValue(":uName", $uName);
        $statement->bindValue(":pWord", $pWord);
        //$password = password_hash($password, PASSWORD_DEFAULT);
        $statement->execute();
        echo "<h2 >$uName has sucessfully been added.<h2>";
    } catch(Exception $ex) {
        echo "<h2 style=\"color:red\">Error adding $uName. Verify the DB is reachable.<h2>";
    }
}
?>
      <!-- On our form the name will be what gets posted and how we retrieve it in other places -->
      <form id="logins" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="uName"><br>
        <label for="password">Password:</label>
        <input type="password" name="pWord"><br>
        <input type="submit" name="submit" value="Login" >
      </form>
    </div>
  </body>
</html>
