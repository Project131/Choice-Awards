<?php
/*

   _____ _           _                                         _     
  / ____| |         (_)              /\                       | |    
 | |    | |__   ___  _  ___ ___     /  \__      ____ _ _ __ __| |___ 
 | |    | '_ \ / _ \| |/ __/ _ \   / /\ \ \ /\ / / _` | '__/ _` / __|
 | |____| | | | (_) | | (_|  __/  / ____ \ V  V / (_| | | | (_| \__ \
  \_____|_| |_|\___/|_|\___\___| /_/    \_\_/\_/ \__,_|_|  \__,_|___/
                                                                     
                                                                     
Author(s): Chris Lemke & Matthew Williams
Entry point for rest api.
Queries url call and returns JSON
*/

include_once 'resources/database.php';  //used to connect to our DB
include_once 'createSQL.php';  //used to connect to our DB
 
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$urlCall = $_SERVER['REQUEST_URI'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

//Used to parse out /sample? queries
$getMovie = $_GET["movie"];
$getCategory = $_GET["nominationCategory"];
$getWinnerName = $_GET["winnerName"];
$getAwardYear = $_GET["awardYear"];
$getReleaseYear = $_GET["releaseYear"];
$getIsWinner = $_GET["isWinner"];
$getvotes = $_GET["votes"];

//Used for connections to the database code
$tableName = "movies";
$db = new Database($tableName);
$db->connect();

//====================================================================

//If we recieved an API call without parameterized search
//We split each call by '/' and store each variable in $request array in order received

//If we recieved an API with query style data
//We will split each variable into the $request array
if( isset($_GET["title"])      || isset($_GET["nominationCategory"]) ||
    isset($_GET["winnerName"]) || isset($_GET["awardYear"]) ||
    isset($_GET["isWinner"]) ) {
        $request[0] =  $_GET["title"];
        $request[1] =  $_GET["nominationCategory"];
        $request[2] =  $_GET["winnerName"];
        $request[3] =  $_GET["awardYear"];
        $request[4] =  $_GET["isWinner"];
}

//get an sql statement based on data read in
$sql = createSQL($request, $tableName);

//use the sql string to call the db, get an array of data back.
$jsonResult = $db->sqlArrayResult($sql);  
$db->disconnect();

//output data as JSON
echo json_encode($jsonResult);  

?>