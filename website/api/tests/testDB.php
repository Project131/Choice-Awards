<?php
/*

   _____ _           _                                         _     
  / ____| |         (_)              /\                       | |    
 | |    | |__   ___  _  ___ ___     /  \__      ____ _ _ __ __| |___ 
 | |    | '_ \ / _ \| |/ __/ _ \   / /\ \ \ /\ / / _` | '__/ _` / __|
 | |____| | | | (_) | | (_|  __/  / ____ \ V  V / (_| | | | (_| \__ \
  \_____|_| |_|\___/|_|\___\___| /_/    \_\_/\_/ \__,_|_|  \__,_|___/
                                                                     
                                                                     
Author(s): 

*/

include_once '../resources/database.php'; //connect to database

//Test Connection to DB
$tableName = "movies";
$db = new Database($tableName);

echo "Testing connection to database starting. If no error message, connection good. <br>";
$db->connect();
echo "Testing connection to database finished. <br>";

//Test readVotes
//make sql string example
//$sql = "make sql string example";
echo "Testing readVotes. <br>";
//test readVotes($sql);
echo "Testing readVotes done. <br>";

//Test sqlArrayResult
//Test query
//Test disconnect


?>