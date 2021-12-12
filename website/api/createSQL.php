<?php
/*

   _____ _           _                                         _     
  / ____| |         (_)              /\                       | |    
 | |    | |__   ___  _  ___ ___     /  \__      ____ _ _ __ __| |___ 
 | |    | '_ \ / _ \| |/ __/ _ \   / /\ \ \ /\ / / _` | '__/ _` / __|
 | |____| | | | (_) | | (_|  __/  / ____ \ V  V / (_| | | | (_| \__ \
  \_____|_| |_|\___/|_|\___\___| /_/    \_\_/\_/ \__,_|_|  \__,_|___/
                                                                     
                                                                     
Author(s): Chris Lemke & Matthew Williams
Creates a mysql query string based on information from API call
Returns mysql string
*/

function createSQL($request, $tableName){
    $nullVal = "NA";  //Check against 'NA' in API call.
    $firstQuery = true;  
    $startQuery ="select title, nominationCategory, winnerName, yearReleased, awardYear, isWinner, votes from {$tableName}";

    if(isset($request[0]) && $request[0] != $nullVal){
        if($firstQuery){
            $startQuery .= " where title = '{$request[0]}'";
            $firstQuery = false;
        } 
        else{
            $startQuery .= " and title = '{$request[0]}'";
        }
    }
    if(isset($request[1]) && $request[1] != $nullVal){
        if($firstQuery){
            $startQuery .= " where nominationCategory = '{$request[1]}'";
            $firstQuery = false;
        } 
        else{
            $startQuery .= " and nominationCategory = '{$request[1]}'";
        }
    }
    if(isset($request[2]) && $request[2] != $nullVal){
        if($firstQuery){
            $startQuery .= " where winnerName = '{$request[2]}'";
            $firstQuery = false;
        } 
        else{
            $startQuery .= " and winnerName = '{$request[2]}'";
        }
    }
    if(isset($request[3]) && $request[3] != $nullVal){
        if($firstQuery){
            $startQuery .= " where awardYear = '{$request[3]}'";
            $firstQuery = false;
        }
        else{
            $startQuery .= " and awardYear = " . $request[3];
        }
    }
    if(isset($request[4]) && $request[4] != $nullVal){
        if($firstQuery){
            $startQuery .= " where isWinner = '{$request[4]}'";
            $firstQuery = false;
        } else{
            $startQuery .= " and isWinner = " . $request[4];
        }
    
    }

    return $startQuery;
}

?>