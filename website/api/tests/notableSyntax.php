<?php

$variable; //'$' makes it a variable, variables are dynamic
echo $variable; //prints to the screen
print_r(); //print entire array and indexes
include_once 'database.php'; //includes a file (not like java include, it "runs" the whole script when include is called)
include_once '../database.php'; //from other directories
//The '.' is concat 
$a  = $b . $c;
//"<br>" is new line for webpage, \n is new line in cli

$_SERVER['REQUEST_METHOD']; //gets us the method (post, get, etc)
$_SERVER['REQUEST_URI']; //get us the end part of the url
$request = explode('/', trim($_SERVER['PATH_INFO'],'/')); //splits the last part of the url into variables and puts it into an array. first variable in url, first index
empty($getMovie); //checks to see if an variable has anything in it, returns bool
isset($_GET['movie']); //checks to ensure there is something in movie variable, returns bool
json_decode(); //decodes json 
json_encode(); //encodes into json


?>