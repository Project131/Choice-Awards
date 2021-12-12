<?php 
/*

   _____ _           _                                         _     
  / ____| |         (_)              /\                       | |    
 | |    | |__   ___  _  ___ ___     /  \__      ____ _ _ __ __| |___ 
 | |    | '_ \ / _ \| |/ __/ _ \   / /\ \ \ /\ / / _` | '__/ _` / __|
 | |____| | | | (_) | | (_|  __/  / ____ \ V  V / (_| | | | (_| \__ \
  \_____|_| |_|\___/|_|\___\___| /_/    \_\_/\_/ \__,_|_|  \__,_|___/
                                                                     
                                                                     
Author: Chris Lemke
This code is used to take in a movie title and update the vote counts in the database
*/

include_once "../api/resources/database.php"; //used for connection to DB

$tableName = "movies";

//create new connection
$db = new Database($tableName);
$db->connect();

//if we recieved a post from the webpage
if(isset($_POST["submit"])) {
    $title = $_POST["movie"];
    $category = $_POST["category"];

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
    if($db->query($sql) === TRUE) {
        echo "<br>Updated votes for: {$title} successfully";
    } 
    else {
        echo "<br>Updating votes for: {$title} Failed. Error: " . $sql . "<br>" . $conn->error;
    }
}

$db->disconnect();

//after the file is over, redirect user to this page
header("Location: https://choiceawards.xyz/thank-you-for-voting/");


function categoryExists($category, $title){
    $tableName = "movies";
    //create new connection
    $db = new Database($tableName);
    $db->connect();

    $query = "select id from {$tableName} where nominationCategory = '{$category}' and title = '{$title}'";
    $result = $db->query($query);
    $db->disconnect();
    return $result->num_rows === 0 ? false :  true;
}

?>