package parse_json;

import java.io.*;
import java.util.*;
import org.json.simple.*;
import org.json.simple.parser.*;

import java.sql.*;
public class parse_json {

		public static void main(String args[]) {
			System.out.println("Hello");
			
			//F:\Downloads\archive\the_oscar_awards.csv
	        JSONParser parser = new JSONParser();
	        SqlDatabase database = new SqlDatabase("Movies", "user", "pw");
	        
			database.createTable("Movies", "(year_film, year_ceremony, ceremony, category, film, name, winner)");
	        try {
				JSONArray array = (JSONArray) parser.parse(new FileReader("F:\\Downloads\\the_oscar_award.json"));
				int i = 0;
				for (Object mov : array)
				  {
					System.out.println(array.get(i));
					JSONObject obj = (JSONObject) array.get(i);
					
					String year_film = "year_film";
					long year_result = (long) obj.get(year_film);
					System.out.println(year_result);
					
					String year_ceremony = "year_ceremony";
					long year_ceremony_result = (long) obj.get(year_ceremony);
					System.out.println(year_ceremony_result);
					
					String ceremony = "ceremony";
					long ceremony_res = (long)obj.get(ceremony);
					System.out.println(ceremony_res);

					String category = "category";
					String category_result = (String) obj.get(category);
					System.out.println(category_result);
					
					String film = "film";
					String result = (String) obj.get(film);
					System.out.println(result);
					
					
					String name = "name";
					String name_result = (String) obj.get(name);
					System.out.println(name_result);
					
					String winner = "winner";
					boolean win_result = (boolean) obj.get(winner);
					System.out.println(win_result);

					database.insertRow("Movies", year_result, year_ceremony_result, ceremony_res, category_result, film, name_result, win_result);
					//obj = parser.parse(film);
				//	System.out.println(obj.getJsonString("film"));
					
					i++;
				  }
	        	
	        } catch (FileNotFoundException e) {
	            e.printStackTrace();
	        } catch (IOException e) {
	            e.printStackTrace();
	        } catch (ParseException e) {
	            e.printStackTrace();
	        }
	        
	        database.customQuery("SELECT * FROM Movies WHERE year_file='1990'");
		}
}
