<?php
/*

   _____ _           _                                         _     
  / ____| |         (_)              /\                       | |    
 | |    | |__   ___  _  ___ ___     /  \__      ____ _ _ __ __| |___ 
 | |    | '_ \ / _ \| |/ __/ _ \   / /\ \ \ /\ / / _` | '__/ _` / __|
 | |____| | | | (_) | | (_|  __/  / ____ \ V  V / (_| | | | (_| \__ \
  \_____|_| |_|\___/|_|\___\___| /_/    \_\_/\_/ \__,_|_|  \__,_|___/
                                                                     
                                                                     
Author: Chris Lemke
This will reset all of the votes in the table to 0. Used for testing and to run before final release.
Do not use unless you know you want to reset ALL the votes in the table.
*/

include_once 'database.php';

$tableName = "movies";
$db = new Database($tableName);
$db->connect();
//$db->resetVotes(); //ARE YOU SURE YOU WANT TO UNCOMMENT THIS
$db->disconnect();
echo "Done. Votes reset to 0.";

?>