<?php
// 1. Connect to our DB server
// 2. Select our DB
//Login info
$servername = "localhost";
$database = "gamedb";
$uName = "root";
$pWord = "";

//Try to login, if connection fails we go down to the catch
try {
    // Create a new PDO instance, recall .'s are like +'s for strings in js
    $pdo = new PDO('mysql:host='.$servername.';dbname='.$database, $uName, $pWord);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$pdo->exec('SET NAMES "utf8"');
    
} catch (PDOExeption $e) {
    $error = 'Unable to connect to the database server';
    
    if ($closeSelect) {
        echo "</select>\n";
        $closeSelect = false;
    }
    //Will display and log our error (Generic, sort of a catch all used on all pages for errors)
    include 'error.html.php';
    exit();
}