<?php
//Require user to be logged in and authenticated, admin page allows user to modify our DB in any way they please
if(!session_id()) {
  session_start();
  require "../authenticate.php";
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>CMS Admin Page</title>
        <link href="../css/styles.css" rel="stylesheet">
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
            <h2 id="CMS">Content Management System</h2>
            <!-- Links to games page (to delete individual titles), and publisher page (which will delete publisher, and ALL games associated with) -->
            <ul>
                <li><a class="CMSOption" href="gamesAdmin.php">Manage Games</a></li>
                <li><a class="CMSOption" href="devsAdmin.php">Manage Devs</a></li>
                <li><a class="CMSOption" href="genresAdmin.php">Manage Genres</a></li>
            </ul>
            <!-- Logout page if user wishes to quit application -->
            <a class="logout" href="../login.php?logOut=1">Log Out</a>
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
		} else {
			echo "<h2 style=\"color:red\">COLOR LOAD ERROR<h2>\n";
		}
		  ?>
		  </div>
        <script>$("#my_color_picker").colorpicker();
        </script>
    </body>
</html>
