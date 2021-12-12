<?php
/*

   _____ _           _                                         _     
  / ____| |         (_)              /\                       | |    
 | |    | |__   ___  _  ___ ___     /  \__      ____ _ _ __ __| |___ 
 | |    | '_ \ / _ \| |/ __/ _ \   / /\ \ \ /\ / / _` | '__/ _` / __|
 | |____| | | | (_) | | (_|  __/  / ____ \ V  V / (_| | | | (_| \__ \
  \_____|_| |_|\___/|_|\___\___| /_/    \_\_/\_/ \__,_|_|  \__,_|___/
                                                                     
                                                                     
Author: Chris Lemke
This code is used to parse the json data and fill the mysql with the data
*/

include_once "../api/resources/database.php";

$servername = "localhost";
$username = "G4_User";
$password = "MysqlGroup4@";
$dbname = "Movies";
$tableName = "movies";

//create new connection
$db = new Database($tableName);
$db->connect();

//create table
$sql = "create table {$tableName} (
            id int auto_increment primary key,
            title char(200),
            nominationCategory char(200),
            winnerName varchar(255),
            yearReleased int, 
            awardYear int,
            isWinner boolean,
            imbdReviewLink char(200),
            whereToWatchLink char(200),
            votes int
        )";


if ($db->query($sql) === TRUE) {
    echo "Table {$tableName} created successfully";
} 
else {
    echo "Error creating table: " . $db->error;
}

$db->disconnect();

?>