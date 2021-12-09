<?php

include_once 'resources/database.php';  //used to connect to our DB
 
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$urlCall = $_SERVER['REQUEST_URI'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

//Used to parse out /sample? queries
$getMovie = $_GET["title"];
//echo "<br> Movie: = {$getMovie}"
$getCategory = $_GET["nominationCategory"];
$getWinnerName = $_GET["winnerName"];
//$getReleaseYear = $_GET["releaseYear"];
$getAwardYear = $_GET["awardYear"];
$getIsWinner = $_GET["isWinner"];
//$getvotes = $_GET["votes"];
 
echo "This is the URL we received from the call: {$urlCall}";
//requests: title, nominationCategory, winnerName, yearReleased, awardYear, isWinner
//https://choiceawards.xyz/api/testLogic_api.php/
// request: 
/*
$isEmpty = empty($getMovie);
echo "<br> Movie: {$request[0]} and it is {$isEmpty}"; //1 is empty, nothing/0 is full

$isEmpty = empty($getAwardYear);
echo "<br> awardYear: {$request[1]} and it is {$isEmpty}<br>";

$isEmpty = empty($getCategory);
echo "<br> nominationCategory: {$request[2]} and it is {$isEmpty}<br>";

$isEmpty = empty($getWinnerName);
echo "<br> winnerName: {$request[3]} and it is {$isEmpty}<br>";

$isEmpty = empty($getReleaseYear);
echo "<br> ReleaseYear: {$request[4]} and it is {$isEmpty}<br>";

$isEmpty = empty($getIsWinner);
echo "<br> IsWinner: {$request[5]} and it is {$isEmpty}<br>";

$isEmpty = empty($getvotes);
echo "<br> Votes: {$request[6]} and it is {$isEmpty}<br>";
*/
print_r($request);

//test url, returns one winner in JSON
//  https://choiceawards.xyz/api/api.php/bestpicture/year/1997/winner
//  https://choiceawards.xyz/api/api.php/search?type=actor&year=1997&category=supporting

//empty($getMovie); //checks to see if an variable has anything in it, returns bool
//isset($_GET['movie']); //checks to ensure there is something in movie variable, returns bool

//LOGIC FOR SPLITTING
$array_of_queries = array( $getMovie,
  $getCategory, 
  $getWinnerName, 
  $getAwardYear, 
//  $getReleaseYear, 
  $getIsWinner); 
//  $getvotes );

     /* $conn->query("select title from movies where votes >= 1");

      for ($row_no = $result->num_rows - 1; $row_no >= 0; $row_no--) {
        $result->data_seek($row_no);
        $row = $result->fetch_assoc();
        echo " title = " . $row['title'] . "\n";
    }
    */
 
    //}
/*
$allQuery = "select * from movies";
echo $allQuery;
callQuery($allQuery);

$myQuery = "select * from movies where title=Joker";
echo $myQuery;
callQuery($myQuery);*/

//  https://choiceawards.xyz/api/testLogic_api.php/title/nominationCategory/winnerName/awardYear/isWinner
  $sql = "update {$tableName} set votes = votes + 1 where title = '{$title}' and nominationCategory = '{$category}';";

$start_query ="Select title from movies where isWinner = 1";
echo "<br>";
echo "isset title:" . isset($request['title']) . "<br><br>";
echo "isset nominationCategory:" . isset($request['nominationCategory']) . "<br><br>";
echo "isset awardYear:" . isset($request['awardYear']) . "<br><br>";

if(isset($request[0])){
	$start_query .= " and title = " . "{$request[0]}";    //. "'" . $request[0] . "'";
}
if(isset($request[1])){
	$start_query .= " and nominationCategory = " . $request[1];
}
if(isset($request[3])){
	$start_query .= " and awardYear = " . $request[3];
}

$start_query = $start_query . ";";
echo "<br><br><br>" . $start_query . "<br><br>";
//if($start_query != "Select * from movies ")
query_working($start_query);


/*
////////////////////////////////////////////////////////    
$start_query ="Select * from movies ";
//need and when multiple movies
echo "<br><br><br>" . $start_query;
if(isset($request['movies'])){
    $start_query .= "where title=" . $request['movies'];
    echo "<br>" . $start_query;
}
else if(isset($request['category'])){
	$start_query .= "where nominationCategory=" . $request['category'];
    echo "<br>" . $start_query;
}
else if($getWinnerName){
    $start_query .= "where winnerName=" . $getWinnerName;
    echo "<br>" . $start_query;
}
else if($getReleaseYear){
    $start_query .= "where yearReleased =" . $getReleaseYear;
    echo "<br>" . $start_query;
}
else if($getAwardYear){
    $start_query .= "where awardYear =" . $getAwardYear;
    echo "<br>" . $start_query;
}
else if($getIsWinner){
    $start_query .= "where isWinner =" . $getIsWinner;
    echo "<br>" . $start_query;
}
echo "<br><br><br>";
if($start_query != "Select * from movies ")
    query_working($start_query);
*/


//else if()

//echo $start_query;
/*
callQuery($start_query);

$allQuery = "select * from movies";
echo $allQuery;
callQuery($allQuery);

$myQuery = "select * from movies where title=Joker";
echo $myQuery;
callQuery($myQuery);
*/
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
function query_working($sql){
    $servername = "localhost";
    $username = "G4_User";
    $password = "MysqlGroup4@";
    $dbname = "Movies";
    $table = "movies";
  
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
  
        // Check connection
        if($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
       //This function will read all rows from the table and return all movies & data with at least one vote as an array
    //function readVotes() {
        //$query = "select title, nominationCategory, yearReleased, votes from movies where votes >= 1";
        //$query = "select * from movies where awardYear=";
       // $query .= $getAwardYear;
        $result = $conn->query($sql);
        $resultArray = array();
        
        if($result->num_rows > 0) {
            $i = 0;
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resultArray[$i] = $row;
                $i++;
            }
        } 
        else {
            $default = array(
                0 => array(
                    'Movie Title' => 'No Votes Yet',
                    'Movie Year' => ' ',
                    'Total Votes' => 0,
                    'Nomination Category' => ''
                ),
            );
            print_r($default);
        }
        print_r($resultArray);
}

function callQuery($sql) {
	$tableName = "movies";
	$db = new Database($tableName);
	$db->connect();  //connect to DB
    if(!$db){
        echo "Database connection failed";
    }

	$return = $db->query($sql);  //make the query call, save in arrayName
	//create array
	$db->disconnect();  //disconnect from DB

	echo $return;
	//echo json_encode($array);  //print to the screen as JSON

}


?>
