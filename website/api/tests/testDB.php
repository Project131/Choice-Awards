<?php
/*

   _____ _           _                                         _     
  / ____| |         (_)              /\                       | |    
 | |    | |__   ___  _  ___ ___     /  \__      ____ _ _ __ __| |___ 
 | |    | '_ \ / _ \| |/ __/ _ \   / /\ \ \ /\ / / _` | '__/ _` / __|
 | |____| | | | (_) | | (_|  __/  / ____ \ V  V / (_| | | | (_| \__ \
  \_____|_| |_|\___/|_|\___\___| /_/    \_\_/\_/ \__,_|_|  \__,_|___/
                                                                     
                                                                     
Author(s): Chris Lemke
Tests to ensure the database functions work as intended.
*/

include_once '../resources/database.php'; //connect to database

//Test Connection to DB
$tableName = "movies";
$db = new Database($tableName);

//testing query
$sql = "SELECT title, nominationCategory, winnerName, yearReleased, awardYear, isWinner, votes		
        FROM movies WHERE nominationCategory='Cinematography' AND awardYear='2010'";

//Starting Test
echo "This file tests to ensure the functions used in the database class work as intended.
      It will output each result to the screen and we can ensure it returns the data we want. <br><br>";

//Testing connect
echo "Testing connection to database starting. If no error message, connection good. <br>";
$db->connect();
echo "Testing connection to database finished. <br><br>";

//Test readVotes
echo "Testing readVotes. <br>";
$result = $db->readVotes();
echo "readVotes gives us (in json, otherwise too long to print): <br> ";
echo json_encode($result);
echo "<br> Done testing readVotes. <br><br>";

//Test sqlArrayResult
echo "Testing sqlArrayResult. <br>";
$result = $db->sqlArrayResult($sql);
echo "Results from: <br> {$sql} <br> Gives us: <br>";
print_r($result);
echo "<br>Testing sqlArrayResult done. <br><br>";

//Test query
echo "Testing query. <br>";
$result = $db->query($sql);
echo "Results from: <br> {$sql} <br> Gives us a sqli object such as: <br>";
print_r($result);
echo "<br>Testing query done. <br><br>";

//Test disconnect
echo "Testing disconnect to database starting. If no error message, disconnect good. <br>";
$db->disconnect();
echo "Testing disconnect to database finished. <br>";

//Done
echo "<br>Testing class done.";


?>