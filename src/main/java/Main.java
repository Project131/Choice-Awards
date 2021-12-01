/*
public String toString(): As in any class, toString() returns the string representation of the given URL object.
public String getAuthority(): returns the authority part of URL or null if empty.
public String getPath(): returns the path of the URL, or null if empty.
public String getQuery(): returns the query part of URL. Query is the part after the ‘?’ in the URL. Whenever logic is used to display the result, there would be a query field in URL. It is similar to querying a database.
public String getHost(): return the hostname of the URL in IPv6 format.
public String getFile(): returns the file name.
public String getRef(): Returns the reference of the URL object. Usually, the reference is the part marked by a ‘#’ in the URL. You can see the working example by querying anything on Google and seeing the part after ‘#’.
public int getPort(): returns the port associated with the protocol specified by the URL.
public int getDefaultPort: returns the default port used.
public String getProtocol(): returns the protocol used by the URL.
*/

http://choiceawards.xyz/search?type=___&year=___&categories=___

protocol://host:port/path?query#ref

import java.net.*;
import java.io.*;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import SqlDatabase;
public static void main(String args[]) {
    System.out.println("Parsing URL and querying the Database to return a JSON file of results");
    String sampleURLParameters = "http://choiceawards.xyz/search?type=___&year=___&categories=___";  //http://choiceawards.xyz/search?type=___&year=___&categories=___
    String sampleURLsingle = "http://choiceawards.xyz/bestpicture/year/1997/winner"; //get winnner best pic 1997

    URL aURL = new URL(sampleURLParameters);
    URL singleURL = new URL(sampleURLsingle);

    System.out.println("protocol = " + aURL.getProtocol());
    System.out.println("authority = " + aURL.getAuthority());
    System.out.println("host = " + aURL.getHost());
    System.out.println("port = " + aURL.getPort());
    System.out.println("path = " + aURL.getPath());
    System.out.println("query = " + aURL.getQuery());
    System.out.println("filename = " + aURL.getFile());
    System.out.println("ref = " + aURL.getRef());

    //custom query                                      //logins needed
    SqlDatabase database = new SqlDatabase("Movies", "root", "MysqlGroup4@");
    database.customQuery(aURL.getQuery());

    //if not a custom query and is only a path:
    database.readTableTitle(singleURL.getPath());
    //or may have to rewrite method to break URL into reapeated statements like:
    //  singleURL(string category,int year,bool win, ..optional args movieTitle, year released)
    // select * from table where category=category
}

/*  Example JSON format to return, all database info
 {
   "year_film": 2018,
   "year_ceremony": 2019,
   "ceremony": 91,
   "category": "ANIMATED FEATURE FILM",
   "name": "Brad Bird, John Walker and Nicole Paradis Grindle",
   "film": "Incredibles 2",
   "winner": false
 },
*/
