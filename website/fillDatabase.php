<?php
/*
Created by: Chris Lemke
This code is used to parse the json data and fill the mysql with the data
*/

$servername = "localhost";
$username = "<Redacted for github>";
$password = "<Redacted for github>";
$dbname = "Movies";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>\n";


//get json data
$json = file_get_contents('the_oscar_award.json');
//decode json data into multi array
$json_data = json_decode($json, true);

//create a timer to track how long the loop runs in seconds
$time_pre = microtime(true); 

//default values for within the loop
$defaultVotes = 0;
$successfulCreations = 0;
$failedCreations = 0;

//loop through each movie and create string
for($i = 0; $i < count($json_data); $i++){
    extract($json_data[$i]); //seperate each array of arrays to get the individual data per movie per loop
    $winner = intval($winner); //set $winner to a 0 or 1 to be used with mysql
    $category = ucwords(strtolower($category)); //sanitize all capitalized category name to first letter uppercase, rest lowercase

    if(preg_match('/"/', $film)) {
        $sql = "insert into movies(title, nominationCategory, yearReleased, awardYear, isWinner, votes) values('{$film}', \"{$category}\", {$year_film}, {$year_ceremony}, {$winner}, {$defaultVotes});"; //build sql string for that one special movie
    }
    else {
        $sql = "insert into movies(title, nominationCategory, yearReleased, awardYear, isWinner, votes) values(\"{$film}\", \"{$category}\", {$year_film}, {$year_ceremony}, {$winner}, {$defaultVotes});"; //build sql string
    }

    if($conn->query($sql) === TRUE) {
        //echo "<br>{$i}: New record for movie: {$film} created successfully";
        $successfulCreations++;
    } 
    else {
        echo "<br><br>{$i}: New failed record for movie: {$film} Error: " . $sql . "<br>" . $conn->error;
        $failedCreations++;
    }
}

//get final time in seconds
$time_post = microtime(true);
$exec_time = round($time_post - $time_pre, 2);

echo "Out of the count size of : ". count($json_data). " there were: {$successfulCreations} successful creations and {$failedCreations} failed creations. It took: {$exec_time} seconds to finish.";

$conn->close();

?>