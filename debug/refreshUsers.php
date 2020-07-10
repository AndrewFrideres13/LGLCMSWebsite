<?php
//Debuggery for refreshing users by dropping the table then recreating it
/*try {
$pdo->exec("DROP TABLE users");
} catch (Exception $ex) {
echo "<h2 style=\"color:red;\">Could not drop table users. Please try again later.<h2>";
}
try {
    $sql = "CREATE TABLE users" . " (" . "uName varchar(255) primary key," . "pWord varchar(255)" . " );";
    $pdo->exec($sql);
} catch (Exception $ex) {
    echo "<h2 style=\"color:red;\">Could not create table users. Please try again later.<h2>";
}*/

//echo "<h1>Username: $username Password: $password</h1><br>";
?>