/*
   _____ _           _                                         _     
  / ____| |         (_)              /\                       | |    
 | |    | |__   ___  _  ___ ___     /  \__      ____ _ _ __ __| |___ 
 | |    | '_ \ / _ \| |/ __/ _ \   / /\ \ \ /\ / / _` | '__/ _` / __|
 | |____| | | | (_) | | (_|  __/  / ____ \ V  V / (_| | | | (_| \__ \
  \_____|_| |_|\___/|_|\___\___| /_/    \_\_/\_/ \__,_|_|  \__,_|___/
                                                                     
                                                                     
Author(s): Chris Lemke
Connects to our mysql DB and queries data
*/

package choiceawards.api;

import java.sql.*;
import java.util.Arrays;  


	public class SqlDatabase {

	    private static String username = "G4_User"; 
	    private static String password = "MysqlGroup4@";
		private static String dbUrl = "jdbc:mysql://35.199.144.139:3306/Movies";


		//Takes in a custom query string and return an array of info
		public static String[] query(String query){
			String[] response = new String[10];
			String[] values = {"id", "title", "nominationCategory", "winnerName", "yearReleased", 
							   "awardYear", "isWinner", "imdbReviewLink", "whereToWatch", "votes"};

	        try {
	            Connection myConnection = DriverManager.getConnection(dbUrl, username, password);
	            Statement myStatement = myConnection.createStatement();
				ResultSet myResultSet = myStatement.executeQuery(query);

				while(myResultSet.next()){
					for(int i = 0; i < values.length; i++){
						response[i] = myResultSet.getString(values[i]);
					}
				}

	        }
	        catch(Exception e) {
	            System.out.println(e.getMessage());
	        }

			return response;
		}

	}
