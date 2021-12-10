<?php
/*

   _____ _           _                                         _     
  / ____| |         (_)              /\                       | |    
 | |    | |__   ___  _  ___ ___     /  \__      ____ _ _ __ __| |___ 
 | |    | '_ \ / _ \| |/ __/ _ \   / /\ \ \ /\ / / _` | '__/ _` / __|
 | |____| | | | (_) | | (_|  __/  / ____ \ V  V / (_| | | | (_| \__ \
  \_____|_| |_|\___/|_|\___\___| /_/    \_\_/\_/ \__,_|_|  \__,_|___/
                                                                     
                                                                     
Author(s): Sir Christian Orefer Casals
Uses curl to test API url(s)
*/

//Initializes curl tool
$curl = curl_init();

//Creates url variable
$url = "https://choiceawards.xyz/api/api.php/sample?awardYear=1997&nominationCategory=best%20picture&isWinner=1";

/*URLs to test:
https://choiceawards.xyz/api/api.php/sample?awardYear=1997&nominationCategory=best%20picture&isWinner=1
https://choiceawards.xyz/api/api.php/NA/Cinematography/NA/2010/NA
https://choiceawards.xyz/api/testLogic_api.php/search?title=parasite&year=2019
*/

//Checks if url variable is empty
if(empty($url)){
	echo "No URL provided";
}
else{
	//Fetches the url
	curl_setopt($curl, CURLOPT_URL, $url);

	//Stops curl from having to verify peer certificate
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	//Stores the contents of the curl session into a variable
	$result = curl_exec($curl); 

	//Prints out the contents
	echo $result;

	//Closes curl tool
	curl_close($curl);
}

?>