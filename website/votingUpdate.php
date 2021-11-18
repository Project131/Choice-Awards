<?php 
/*
Created by: Chris Lemke
This code is used to take in a movie title and update the vote counts in the database
*/

$servername = "localhost";
$username = "<Redacted for github>";
$password = "<Redacted for github>";
$dbname = "Movies";
$tableName = "movies";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>\n";


//if we recieved a post from the webpage
if(isset($_POST["submit"])) {
    $title = $_POST["movie"];
    $category = $_POST["category"];
    print_r($_POST);

    //if the user typed in a category for the movie and it exists in the DB
    if($category !== "" && categoryExists($category, $title)) {
        //if the movie has quotes that will mess with mysql syntax
        if(preg_match('/"/', $title)) {
            $sql = "update {$tableName} set votes = votes + 1 where title = '{$title}' and nominationCategory = '{$category}';";
        }
        else {
            $sql = "update {$tableName} set votes = votes + 1 where title = \"{$title}\" and nominationCategory = \"{$category}\";";
        }
    }
    else {
        //if the movie has quotes that will mess with mysql syntax
        if(preg_match('/"/', $title)) {

            $sql = "update {$tableName} set votes = votes + 1 where title = '{$title}';";
        }
        else {
            $sql = "update {$tableName} set votes = votes + 1 where title = \"{$title}\";";
        }
    }

    //make the query to mysql
    if($conn->query($sql) === TRUE) {
        echo "<br>Updated votes for: {$title} successfully";
    } 
    else {
        echo "<br>Updating votes for: {$title} Failed. Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

//after the file is over, redirect user to this page
header("Location: https://choiceawards.xyz/thank-you-for-voting/");



function categoryExists($category, $title){
    $servername = "localhost";
    $username = "<Redacted for github>";
    $password = "<Redacted for github>";
    $dbname = "Movies";
    $tableName = "movies";

    //create new connection
    $conn2 = new mysqli($servername, $username, $password, $dbname);
    $query = "select id from {$tableName} where nominationCategory = '{$category}' and title = '{$title}'";
    $result = $conn2->query($query);
    $conn2->close();

    return $result->num_rows === 0 ? false :  true;
}

?>