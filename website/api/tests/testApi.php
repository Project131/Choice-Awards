<?php
/*

   _____ _           _                                         _     
  / ____| |         (_)              /\                       | |    
 | |    | |__   ___  _  ___ ___     /  \__      ____ _ _ __ __| |___ 
 | |    | '_ \ / _ \| |/ __/ _ \   / /\ \ \ /\ / / _` | '__/ _` / __|
 | |____| | | | (_) | | (_|  __/  / ____ \ V  V / (_| | | | (_| \__ \
  \_____|_| |_|\___/|_|\___\___| /_/    \_\_/\_/ \__,_|_|  \__,_|___/
                                                                     
                                                                     
Author(s): Sir Christian Orefer Casals
Uses curl to sample the JSON from API urls and then compares that to the matching query to the SQL database
*/

include_once 'resources/database.php'; //connect to database
include_once 'createSQL.php'; //connect to database

//Initialize urls into variables
$urlOne = "https://choiceawards.xyz/api/api.php/search?awardYear=1997&nominationCategory=best%20picture&isWinner=1";
$urlTwo = "https://choiceawards.xyz/api/api.php/search?nominationCategory=Cinematography&awardYear=2010";
$urlThree = "https://choiceawards.xyz/api/api.php/search?title=Gladiator";
$urlFour = "https://choiceawards.xyz/api/api.php/search?awardYear=1980&isWinner=1";
$urlFive = "https://choiceawards.xyz/api/api.php/search?winnerName=Meryl%20Streep";
$urlSix = "https://choiceawards.xyz/api/api.php/search?title=Gone%20With%20The%20Wind&isWinner=1";

//Initialize curl tool and sets options
$curl = curl_init();
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

//Connect to database code
$tableName = "movies";
$db = new Database($tableName);
$db->connect();

//Function to print result and expected, then compare them
function compare($result, $expected) {
	echo "Result: $result<br><br>";
	echo "Expected: $expected<br><br>";
	
	if($expected == $result) {
		echo "Test passed";
	}
	else {
		echo "Test failed";
	}
	echo "<br><br><br>";
}

/*Formatting:
echo = "Test [Number]";					//Prints 'Test #' to the screen

$query[Number];						//Queries the database for select information
$expected[Number];					//Converts the query result array into a json

curl_setopt($curl, CURLOPT_URL, $url[Number]);		//Sets the curl tool to the desired url
$result[Number] = curl_exec($curl);			//Executes the curl tool and puts it into a variable

compare($result[Number], $expected[Number]);		//Runs the compare function with the result and the matching expected as its input
*/

//Test One
echo "Test One:<br><br>";

$queryOne = $db->sqlArrayResult("SELECT title,nominationCategory,winnerName,yearReleased,awardYear,isWinner,votes 
								FROM movies WHERE nominationCategory='Best Picture' AND awardYear='1997' AND isWinner='1'" );
$expectedOne =  json_encode($queryOne);

curl_setopt($curl, CURLOPT_URL, $urlOne);
$resultOne = curl_exec($curl); 

compare($resultOne, $expectedOne);

//Test Two
echo "Test Two:<br><br>";

$queryTwo = $db->sqlArrayResult("SELECT title,nominationCategory,winnerName,yearReleased,awardYear,isWinner,votes		
								FROM movies WHERE nominationCategory='Cinematography' AND awardYear='2010'");							
$expectedTwo = json_encode($queryTwo);

curl_setopt($curl, CURLOPT_URL, $urlTwo);
$resultTwo = curl_exec($curl);

compare($resultTwo, $expectedTwo);

//Test Three
echo "Test Three<br><br>";

$queryThree = $db->sqlArrayResult("SELECT title,nominationCategory,winnerName,yearReleased,awardYear,isWinner,votes
								  FROM movies WHERE title='Gladiator'");
$expectedThree = json_encode($queryThree);

curl_setopt($curl, CURLOPT_URL, $urlThree);
$resultThree = curl_exec($curl);

compare($resultThree, $expectedThree);

//Test Four
echo "Test Four<br><br>";

$queryFour = $db->sqlArrayResult("SELECT title,nominationCategory,winnerName,yearReleased,awardYear,isWinner,votes
								 FROM movies WHERE awardYear='1980' AND isWinner='1'");
$expectedFour = json_encode($queryFour);

curl_setopt($curl, CURLOPT_URL, $urlFour);
$resultFour = curl_exec($curl);

compare($resultFour, $expectedFour);

//Test Five
echo "Test Five<br><br>";

$queryFive = $db->sqlArrayResult("SELECT title,nominationCategory,winnerName,yearReleased,awardYear,isWinner,votes
								 FROM movies WHERE winnerName='Meryl Streep'");
$expectedFive = json_encode($queryFive);

curl_setopt($curl, CURLOPT_URL, $urlFive);
$resultFive = curl_exec($curl);

compare($resultFive, $expectedFive);

//Test Six
echo "Test Six<br><br>";

$querySix = $db->sqlArrayResult("SELECT title,nominationCategory,winnerName,yearReleased,awardYear,isWinner,votes
								FROM movies WHERE title='Gone With The Wind' AND isWinner='1'");
$expectedSix = json_encode($querySix);

curl_setopt($curl, CURLOPT_URL, $urlSix);
$resultSix = curl_exec($curl);

compare($resultSix, $expectedSix);


//Closes the curl abd database
curl_close($curl);
$db->disconnect();
	
?>
