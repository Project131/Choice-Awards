<?php
/*

   _____ _           _                                         _     
  / ____| |         (_)              /\                       | |    
 | |    | |__   ___  _  ___ ___     /  \__      ____ _ _ __ __| |___ 
 | |    | '_ \ / _ \| |/ __/ _ \   / /\ \ \ /\ / / _` | '__/ _` / __|
 | |____| | | | (_) | | (_|  __/  / ____ \ V  V / (_| | | | (_| \__ \
  \_____|_| |_|\___/|_|\___\___| /_/    \_\_/\_/ \__,_|_|  \__,_|___/
                                                                     
                                                                     
Author: Chris Lemke
This code is used query all of the votes in the table
*/

include_once "resources/database.php"; //used for connection to DB

$tableName = "movies";
$db = new Database($tableName);
$db->connect();
$result = $db->readVotes(); //receives a 2-D array full of rows with votes
echo serialize($result); //serialize the data and print to the screen
$db->disconnect();

?>