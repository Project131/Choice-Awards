<?php
/*

   _____ _           _                                         _     
  / ____| |         (_)              /\                       | |    
 | |    | |__   ___  _  ___ ___     /  \__      ____ _ _ __ __| |___ 
 | |    | '_ \ / _ \| |/ __/ _ \   / /\ \ \ /\ / / _` | '__/ _` / __|
 | |____| | | | (_) | | (_|  __/  / ____ \ V  V / (_| | | | (_| \__ \
  \_____|_| |_|\___/|_|\___\___| /_/    \_\_/\_/ \__,_|_|  \__,_|___/
                                                                     
                                                                     
Author: Chris Lemke
Sensitive information redacted for github
call class like: $db = new Database($table);
This class is made to call our Movie database and choose the table to work with.
*/

class Database {
    protected $servername = "localhost";
    protected $username = "G4_User";
    protected $password = "MysqlGroup4@";
    protected $dbname = "Movies";
    protected $table;
    protected $debug;
    public $conn;


	//constructor for object
	function __construct($table, $debug = 0) {
		$this->table = $table;
		$this->debug = $debug;
	}

	//connect the db 
	function connect() {
		// Create connection
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check connection
        if($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $this->conn = $conn;
        return $this->conn;
	}

    //disconnect from the database
    function disconnect() {
        $this->conn->close();
    }

    //This function will read all rows from the table and return all movies & data with at least one vote as an array
    function readVotes() {
        $query = "select title, nominationCategory, yearReleased, votes from {$this->table} where votes >= 1";
        $result = $this->conn->query($query);
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
            return $default;
        }
        return $resultArray;
    }

    //This function will read all rows from the table and return all movies & data with at least one vote as an array
    function resetVotes() {
        $query = "update {$this->table} set votes = 0";
        $result = $this->conn->query($query);
    }

    //takes a mysql statement and returns an array
    function sqlArrayResult($query) {
        $result = $this->conn->query($query);
        $resultArray = array();

        //turn mysqli_result Object into an array
        if($result->num_rows > 0) {
            $i = 0;
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resultArray[$i] = $row;
                $i++;
            }
        } 
        else {
            return array('message' => 'No Movies Found');
        }
        //output the movie data array as JSON
        return $resultArray;
    }

    //custom query
    function query($query) {
        return $this->conn->query($query);
    }
}

?>