<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title>The Last Game Library</title>
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
            //Needed to read our login username
            if(!session_id()) {
            	session_start();
            }
            // Check if user clicked then Add new game title link
            if (isset($_GET['clicked'])) {
                $clicked = $_GET['clicked'];
            } else { // add new game title link was NOT clicked
                $clicked = 0;
            }
                      
            // if add new game title link was clicked, display 
            //the "add a new game form"
            if ($clicked == 1) {            
         ?>
         <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" id="addForm">
            <!-- Game Title -->
            <div id="name">
              <label id="formTxt" for="newGameName">Title</label>
              <input type="text" name="newGameName">
              <br/>
            </div>
            <div id="dev">
              <!-- Game Dev -->
              <label id="formTxt" for="newDev">Developer</label>
              <input type="text" name="newDev" >
              <br/>
            </div>
            <div id="yr">
              <!-- Game Yr -->
              <label id="formTxt" for="newYr">Year</label>
              <input type="text" name="newYr" cols="2" rows="2">
              <br>
            </div>
            <div id="genre">
              <!-- Game Genre -->
              <label id="formTxt" for="genreDrop">Genre</label>
              <input type="text" name="genreDrop" >
            </div>
            <!-- Game Summary -->
            <label id="formTxt" for="newSum">Summary</label><br>
            <textarea name="newSum" id="newSumBox" rows="10" cols="40">Enter game summary</textarea>
            <br><br>
            <?php
               //
               // 1)Connect to the DB server
               // 2)Select our DB
               // 3)Query our DB
               //
               // Use an include file, dbConnect.php, to the first
               // two steps above.
               //include 'dbConnect.php';
               //
               // include - if file is not found, program continues to execute
               // require - if file is not found, program exits with error msg
               //
               require 'dbConnect.php';
               $closeSelect = true;
               
               //
               // run a query to retrieve our game categories for
               // this database and populate <option> tags inside this 
               // <select> with the category information.
               //
               try {
                   $sql = 'SELECT genreId FROM games';
                   $gGenre = $pdo->query($sql);
                   // $categoryResult is a PDOStatement object representing
                   // the result set from our SELECT query
               } catch (PDOException $e) {
                   $error = 'Error fetching game genres: ' . $e->getMessage();
                   include 'error.html.php';
                   exit();
               }
            ?>
            </select>
            <br><br>
            <input type="submit" name="addGame" value="Add Game">
         </form>
         <!-- End form submission -->
         <?php
            } // end if add new game title link was clicked
            //
            // Obtain and display game titles and their authors from the 
            // database to the web page by game category
         ?>
         <h2 id="topHeading">The Last Game Library
         <?php 
            if(isset($_SESSION['uName'])) {
               $uName = $_SESSION['uName'];
               echo "<h2 style=\"color:white;font-size:0.75rem;\">  Logged in as: " .  $uName . "<h2>\n";
            }

            require 'dbConnect.php';
            
            // Later here, we'll check if user submitted the Add a new game
            // form, and if so, validate their entered data...
            if (isset($_POST['newGameName']) && $_POST['newGameName'] != "Enter game title" && $newGameName = trim(strip_tags($_POST['newGameName']))) {
                // now, we have a valid game title, so let's check if an author
                // has been entered for the new game
                if (!$newDev = trim(strip_tags($_POST['newDev']))) {
                    $newDev = "Unknown";
                }
                if (!$newYr = trim(strip_tags($_POST['newYr']))) {
                    $newYr = "0000";
                }
                if (!$newSum = trim(strip_tags($_POST['newSum']))) {
                    $newSum = "...";
                }
                if (!$genreDrop = trim(strip_tags($_POST['genreDrop']))) {
                    $genreDrop = "ERROR";
                } 
                //
                // Check if new game  already exists in our DB
                //
                try {
                    $sql = "SELECT COUNT(gameTitle) FROM games WHERE gameTitle = '$newGameName'";
                    $numGameTitles = $pdo->query($sql)->fetchColumn();
                } catch (PDOException $e) {
                    $error = 'Error fetching game title: ' . $e->getMessage();
                    include 'error.html.php';
                    exit();
                }
                //
                // Check if new developer already exists in our DB
                //
                try {
                    $sql = "SELECT COUNT(developer) FROM developers WHERE developer = '$newDev'";
                    $numDevs = $pdo->query($sql)->fetchColumn();
                } catch (PDOException $e) {
                    $error = 'Error fetching dev name: ' . $e->getMessage();
                    include 'error.html.php';
                    exit();
                }
            
                if ($numDevs) {
                  $sql = "SELECT id FROM developers WHERE developer = '$newDev'";
                  //Dev exists so extract their ID for insertion
                  $existingDevId = $pdo->query($sql)->fetchColumn();
                } else {
                  $newDevId = rand();
                }
                //
                // Check if new genre already exists in our DB
                //
                try {
                    $sql = "SELECT COUNT(catName) FROM genres WHERE catName = '$genreDrop'";
                    $numGenres = $pdo->query($sql)->fetchColumn();
                } catch (PDOException $e) {
                    $error = 'Error fetching genre name: ' . $e->getMessage();
                    include 'error.html.php';
                    exit();
                }
            
                if ($numGenres) {
                  $sql = "SELECT id FROM genres WHERE catName = '$genreDrop'";
                  //Dev exists so extract their ID for insertion
                  $existingGenreId = $pdo->query($sql)->fetchColumn();
                } else {
                  $newGenreId = rand();
                }
                //
                // did we find the new game title in our gamestuff table?
                //
                if ($numGameTitles) { // new game is a duplicate
         ?>
                    <h3 style="color: #fff;">Game: <div class="author"><?= $newGameName ?></div>already exists in the DB</h3>
         <?php
                } else { // new game title was NOT found in our DB - so add it...
         ?>
                    <h3 style="color: #fff;">New Game: <div class="author"><?= $newGameName ?></div> added sucessfully</h3>
         <?php  
                    try {
                        // Yay!  We are finally ready to insert the new game into our DB
                        $sql = "INSERT INTO games(gId, gameTitle, summary, yearReleased, devId, genreId) VALUES(:gId, :gameTitle, :summary,:yr,:devId, :genreId);";
                        $s = $pdo->prepare($sql); // $s is a PDOStatement object
                        
                        // Bind values to our placeholders for the game DB
                        $s->bindValue(':gId', rand());
                        $s->bindValue(':gameTitle', $newGameName);
                        $s->bindValue(':summary', $newSum);
                        $s->bindValue(':yr', $newYr);
                    
                        //If the dev exists associate the existing ID here
                        if ($numDevs) {
                          $s->bindValue(':devId', $existingDevId);
                        } else {
                            $sqlDevStatement = "INSERT INTO developers(id, developer) VALUES(:id, :developer);";
                            $sqlDev = $pdo->prepare($sqlDevStatement); // $s is a PDOStatement object
                            //Does not exist, so create new genre, and associate the id
                            $s->bindValue(':devId', $newDevId);
                            $sqlDev->bindValue(':id', $newDevId);
                            $sqlDev->bindValue(':developer', $newDev);
                            $sqlDev->execute();
                        }
                        
                        //If the genre exists associate the existing ID here
                        if ($numGenres) {
                            $s->bindValue(':genreId', $existingGenreId);
                        } else {
                            $sqlGenreStatement = "INSERT INTO genres(id, catName) VALUES(:id, :catName);";
                            $sqlGenre = $pdo->prepare($sqlGenreStatement); // $s is a PDOStatement object
                            //Does not exist, so create new genre, and associate the id
                            $s->bindValue(':genreId', $newGenreId);
                            $sqlGenre->bindValue(':id', $newGenreId);
                            $sqlGenre->bindValue(':catName', $genreDrop);
                            $sqlGenre->execute();
                        }
                            
                            $s->execute();
                    } catch (PDOException $e) {
                        $error = 'Error adding new info: ' . $e->getMessage();
                        include 'error.html.php';
                        exit();
                    }
                
                } // end else new author not found - adding it
            } // end if user submitted the Add a new game form
            
            // Run a query to retrieve our game genres
            //This will order the categories that we open and close, and give us all the info we need to display
            try {
                $categoryResult = $pdo->query('SELECT * FROM genres ORDER BY catName' );
            } catch (PDOException $e) {
                $error = 'Error fetching different game genres: ' . $e->getMessage();
                include 'error.html.php';
                exit();
            }
            
            //Actual dispaly of each game's info
            while ($categoryInfo = $categoryResult->fetch()) {
                $genreName = $categoryInfo['catName'];
            ?>
                <div class="gameCategory">
                <h3><?= $genreName ?></h3>
            <?php
               try {
                 $sql = 'SELECT * FROM games, developers, genres WHERE games.genreId = genres.id AND games.devId = developers.id AND genres.catName ="'. $genreName.'" ORDER BY genres.catName' ;
                 $gameResult = $pdo->query($sql);
               } catch (PDOException $e) {
                 $error = 'Error fetching game info: ' . $e->getMessage();
                 include 'error.html.php';
                 exit();
               }
               
               echo "<blockquote>\n";
               while ($gameInfo = $gameResult->fetch()) {
               ?>
                  <div class="content">
                     <div class="title"><?= $gameInfo['gameTitle'] ?></div>
                     by 
                     <div class="author"><?= $gameInfo['developer'] ?></div>
                     Released: 
                     <div class="title"> <?= $gameInfo['yearReleased'] ?></div>
                     <br>
                     <small><?= $gameInfo['summary'] ?></small><br/><br/>
                  </div>
         <?php }//end while getting the game columns?>
            </blockquote>
         </div>
      <?php } // end while more rows in categories result set?>
         <br><br>
         <a href="<?php echo "$_SERVER[PHP_SELF]?clicked=1";?>">Add New Game</a>
      </div>
      <!-- end div#container -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>
      <link
         href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/ui-lightness/jquery-ui.css"
         rel="stylesheet"
         type="text/css"
         />
      
      <link rel='stylesheet' href='css/jquery.colorpicker.css' />
      <script src="js/jquery.easing.1.3.js"></script>
      <script src='js/jquery.colorpicker.js'></script>
      <script src="js/slidePanes.js"></script>
      <div class="debug"></div>
      <script>$("#my_color_picker").colorpicker();
      </script>
   </body>
</html>
