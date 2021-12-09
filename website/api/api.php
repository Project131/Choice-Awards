<?php
/*

	 _____ _           _                                         _     
	/ ____| |         (_)              /\                       | |    
 | |    | |__   ___  _  ___ ___     /  \__      ____ _ _ __ __| |___ 
 | |    | '_ \ / _ \| |/ __/ _ \   / /\ \ \ /\ / / _` | '__/ _` / __|
 | |____| | | | (_) | | (_|  __/  / ____ \ V  V / (_| | | | (_| \__ \
	\_____|_| |_|\___/|_|\___\___| /_/    \_\_/\_/ \__,_|_|  \__,_|___/
																																		 
																																		 
Author(s): Chris Lemke &
Entry point for rest api.
Queries url call and returns JSON
*/

include_once 'resources/database.php';  //used to connect to our DB
 
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
 
echo "This is the URL we received from the call: {$urlCall}";

$isEmpty = empty($getMovie);
echo "<br> Movie: {$getMovie} and it is {$isEmpty}"; //1 is empty, nothing/0 is full
$isEmpty = empty($getAwardYear);
echo "<br> Year: {$getAwardYear} and it is {$isEmpty}<br>";

print_r($request);

//test url, returns one winner in JSON
//  https://choiceawards.xyz/api/api.php/bestpicture/year/1997/winner
//  https://choiceawards.xyz/api/api.php/search?type=actor&year=1997&category=supporting



//LOGIC FOR SPLITTING
if($getCategory)
	select from table where nominationCategory=$getCategory
//may need to make a ton of if statements

/*

Maybe Call classes?

//Get Single movies
//Get Multiple movies


*/

//Use the parsed variables received from the api call to create a mysql query string
//Use the parsed variables to figure out what type of call the request wants
//connect to DB
//query to DB like $db->query($sql)
//disconnect from the DB
//ensure returned value is saved as an array
//push the received array data as json to the screen as a result (code below)
//echo json_encode($arrayName);

function callQuery($sql) {
	$tableName = "movies";
	$db = new Database($tableName);
	$db->connect();  //connect to DB

	$arrayName = $db->query($sql);  //make the query call, save in arrayName
	$db->disconnect();  //disconnect from DB

	echo json_encode($arrayName);  //print to the screen as JSON

}

?>